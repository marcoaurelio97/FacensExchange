<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exchange extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_trades');
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
                redirect('Home');
            }
        }

        $this->load->model('model_categories');
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
        $data['myTrades'] = $this->model_trades->getTradesUser($idUser);

        $this->load->view('choose_offers_trades_view', $data);
    }

    public function sendOffer($idTradeWant, $idTradeHave)
    {
        $tradeWant = $this->model_trades->getTrades($idTradeWant);
        $tradeHave = $this->model_trades->getTrades($idTradeHave);

        $db = array(
            'trade_offer_idtrade_from' => $idTradeHave, // who is sending an offer
            'trade_offer_idtrade_to'   => $idTradeWant, // who is receiving an offer
            'trade_offer_iduser_from'  => $tradeHave->trade_id_user_from,
            'trade_offer_iduser_to'    => $tradeWant->trade_id_user_from
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
            redirect('Home');
        }
    }

    public function viewOffer($idTradeOffer)
    {
        $tradeOffer = $this->model_trades->getTradeOffer($idTradeOffer);
        $data['tradeHave'] = $this->model_trades->getTrades($tradeOffer->trade_offer_idtrade_from);
        $data['tradeWant'] = $this->model_trades->getTrades($tradeOffer->trade_offer_idtrade_to);
        $this->load->view('view_offer_trade', $data);
    }

    public function responseOffer($type)
    {
        var_dump($type);die;
        if($type == 1){ //accepted

        } else { //refused

        }
    }
}
