<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exchange extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_trades');
        $this->load->model('model_notifications', 'notifications');
    }

    public function tradeDetails($idTrade)
    {
        $data['idUserLogged'] = $this->session->userdata('idUser');
        $data['trade'] = $this->model_trades->getTrades($idTrade);
        $this->load->view('trade_details_view', $data);
    }

    public function addTrade()
    {
        if ($this->input->post()) {
            require_once dirname(__FILE__) . "../../libraries/class/trade.php";
            $trade = new Trade();
            $trade->trade_id_user_from = $this->session->userdata('idUser');
            $trade->trade_date_add = date('Y-m-d H:i:s');
            $trade->trade_status = 0;
            $trade->trade_title = $this->input->post('title');
            $trade->trade_description = $this->input->post('description');
            $trade->trade_id_category = $this->input->post('category');

            $this->db->trans_begin();

            $this->model_trades->addTrade($trade);
            $idTrade = $this->db->insert_id();

            if ($_FILES) {
                $this->uploadImages($idTrade);
            }

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while adding a trade!</div>");
                redirect('Exchange/addTrade');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Trade added with success!</div>");
                redirect('Home/listTrades');
            }
        }

        $this->load->model('model_categories');
        $data['add'] = TRUE;
        $data['actionForm'] = site_url('Exchange/addTrade');
        $data['categories'] = $this->model_categories->getCategoriesArray();
        $this->load->view('add_exchange_view', $data);
    }

    public function uploadImages($idTrade)
    {
        $nameImage = $_FILES['image']['name'];

        $config = array(
            'upload_path' => './dist/img/',
            'allowed_types' => '*',
            'file_name' => $nameImage,
            'max_size' => '1000000'
        );

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $db = array(
                'trade_pic_idtrade' => $idTrade,
                'trade_pic_picture' => $nameImage
            );

            $this->model_trades->insertPicTrade($db);

            return true;
        } else {
            echo $this->upload->display_errors();
        }
    }

    public function searchOffers()
    {
        $data['trades'] = $this->model_trades->findOfferBySearch($this->input->post('search'));
        $data['search'] = $this->input->post('search');
        $this->load->view('home_view', $data);
    }

    public function chooseOffer($idTrade)
    {
        $idUser = $this->session->userdata('idUser');

        $data['trade'] = $this->model_trades->getTrades($idTrade);
        $data['myTrades'] = $this->model_trades->getTradesUser($idUser, TRUE);

        $this->load->view('choose_offers_trades_view', $data);
    }

    public function sendOffer($idTradeWant, $idTradeHave)
    {
        $tradeWant = $this->model_trades->getTradeForOffer($idTradeWant);
        $tradeHave = $this->model_trades->getTradeForOffer($idTradeHave);

        $db = array(
            'trade_offer_idtrade_from' => $idTradeHave,
            'trade_offer_idtrade_to'   => $idTradeWant,
            'trade_offer_iduser_from'  => $tradeHave->trade_id_user_from,// who is sending an offer
            'trade_offer_iduser_to'    => $tradeWant->trade_id_user_from // who is receiving an offer
        );

        $this->db->trans_begin();
        
        $this->model_trades->addTradeOffer($db);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while sending an offer!</div>");
            redirect('Exchange/chooseOffer/'.$idTradeWant);
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Offer sent with success!</div>");
            redirect('Home/listTrades');
        }
    }

    public function editTrade($tradeId) {

        $this->load->model('Model_trades','trades');

        $this->form_validation->set_rules('title', 'Title','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('description', 'Description','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('category', 'Category','required|trim','You must select a %s for this trade.');
        
        if($this->form_validation->run()) {
            $db_trade = array(
                'trade_title'       => $this->input->post('title'),
                'trade_description' => $this->input->post('description'),
                'trade_id_category' => $this->input->post('category')
            );

            $this->db->trans_begin();

            $this->model_trades->updateTrade($tradeId, $db_trade);

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while editing a trade!</div>");
                redirect('Exchange/editTrade/'.$tradeId);
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Trade edited with success!</div>");
                redirect('Home/listTrades');
            }
        }

        $this->load->model('model_categories');
        $data['edit'] = TRUE;
        $data['actionForm'] = site_url('Exchange/editTrade/'.$tradeId);
        $data['categories'] = $this->model_categories->getCategoriesArray();    
        $data['trade'] = $this->trades->getTradeById($tradeId);
        $this->load->view('add_exchange_view',$data);
        
    }

    public function viewOffer($idTradeOffer)
    {
        $tradeOffer = $this->model_trades->getTradeOffer($idTradeOffer);
        $data['tradeHave'] = $this->model_trades->getTradeForOffer($tradeOffer->trade_offer_idtrade_to);
        $data['tradeWant'] = $this->model_trades->getTradeForOffer($tradeOffer->trade_offer_idtrade_from);
        $data['idTradeOffer'] = $idTradeOffer;
        $this->load->view('view_offer_trade', $data);
    }

    public function responseOffer($type, $idTradeOffer)
    {
        $tradeOffer = $this->model_trades->getTradeOffer($idTradeOffer);
        $tradeHave  = $this->model_trades->getTradeForOffer($tradeOffer->trade_offer_idtrade_to);
        $tradeWant  = $this->model_trades->getTradeForOffer($tradeOffer->trade_offer_idtrade_from);

        $this->db->trans_begin();
        
        if($type == '1'){
            $messageNotification = "Offer of <strong>$tradeWant->trade_title</strong> accepted!";

            $db = array(
                'trade_status'     => $type,
                'trade_id_user_to' => $tradeWant->trade_id_user_from
            );

            $this->model_trades->updateTrade($tradeHave->trade_id, $db);

            $db['trade_id_user_to'] = $tradeHave->trade_id_user_from;

            $this->model_trades->updateTrade($tradeWant->trade_id, $db);

            $db = array(
                'trade_offer_status' => $type
            );
    
            $this->model_trades->updateTradeOffer($idTradeOffer, $db);
        } else {
            $messageNotification = "Offer of <strong>$tradeWant->trade_title</strong> recused!";

            $db = array(
                'trade_offer_status' => $type
            );
    
            $this->model_trades->updateTradeOffer($idTradeOffer, $db);
        }

        $dbNotification = array(
            'notif_iduser'   => $tradeHave->trade_id_user_from,
            'notif_date_add' => date('Y-m-d H:i:s'),
            'notif_status'   => '0',
            'notif_message'  => $messageNotification
        );

        $this->notifications->addNotification($dbNotification);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while trading!</div>");
            redirect('Exchange/viewOffer/'.$idTradeOffer);
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>The exchange was successful!</div>");
            redirect('Home/listTrades');
        }
    }

    public function listTrades() {
        $this->load->model('model_trades');
		$this->load->model('model_categories');

        $data['trades'] = $this->model_trades->getTrades(FALSE,FALSE,TRUE);
	
		$this->load->view('list_trades', $data);
    }

    public function deleteTrade($idTrade){
        $this->model_trades->deleteTrade($idTrade);
        $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>The trade was deleted!</div>");
        redirect('User/listTrades');
    }
}
