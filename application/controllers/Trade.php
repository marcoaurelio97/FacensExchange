<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trade extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_notifications', 'notifications');
        $this->load->model('model_profiles', 'profiles');
        $this->load->model('model_rating', 'rating');
        $this->load->model('model_wishes', 'wishes');
        $this->load->model('model_itens', 'itens');
        $this->load->model('model_trades', 'trades');
        $this->load->model('model_upload');
    }

    public function makeAnOffer($idItem)
    {
        $idProfile = $this->session->userdata('idProfile');

        $data['item'] = $this->itens->getItemById($idItem);
        $data['tradesProfile'] = $this->itens->getItems($idProfile, '0');

        $this->load->view('Trade/makeOffer', $data);
    }

    public function sendOffer($idItemRec, $idItemSender)
    {
        $itemRec = $this->itens->getItemById($idItemRec);
        $itemSender = $this->itens->getItemById($idItemSender);

        $db = array(
            'trade_status'          => '0',
            'trade_iditem_receiver' => $idItemRec,
            'trade_iditem_sender'   => $idItemSender,
            'trade_date_add'        => date('Y-m-d H:i:s')
        );

        $this->db->trans_begin();
        
        $this->trades->addTrade($db);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while sending an offer!</div>");
            redirect('Exchange/makeAnOffer/'.$idTradeB);
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Offer sent with success!</div>");
            redirect('Home');
        }
    }

    public function editTrade($tradeId) {

        $this->load->model('Model_trades','trades');

        $this->form_validation->set_rules('title', 'Title','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('description', 'Description','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('category', 'Category','required|trim','You must select a %s for this trade.');
        
        if($this->form_validation->run()) {
            // var_dump($this->input->post());die;
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
                redirect('Home');
            }
        }

        $this->load->model('model_categories');
        $data['edit'] = TRUE;
        $data['wishes'] = $this->wishes->getWishes();                
        $wishesTrade = $this->wishes->getWishesById($tradeId);
        $idsTrade = array();
        foreach($wishesTrade AS $wish) {
            $idsTrade[$wish->typ_id] = $wish;
        }        
        $data['wishesTrade'] = $idsTrade;
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

    public function responseOffer($reply, $idTradeOffer)
    {
        $tradeOffer = $this->model_trades->getTradeOffer($idTradeOffer);
        $tradeA  = $this->model_trades->getTradeForOffer($tradeOffer->trade_offer_idtrade_to);
        $tradeB  = $this->model_trades->getTradeForOffer($tradeOffer->trade_offer_idtrade_from);
        
        $this->db->trans_begin();
        
        // var_dump($tradeA,$tradeB);die;
        if($reply == '1'){
            $messageToA = "You just accepted the offer. Don't forget to rate the other user";
            $messageToB = "The owner of <strong>$tradeA->trade_title</strong> accepted your trade! Don't forget to rate the other user";


            $dbA = array(
                'trade_status'     => '1',
                'trade_id_user_to' => $tradeB->trade_id_user_from
            );
    
            $this->model_trades->updateTrade($tradeA->trade_id, $dbA);
    
            $dbB = array(
                'trade_status'     => '1',
                'trade_id_user_to' => $tradeA->trade_id_user_from
            );
    
            $this->model_trades->updateTrade($tradeB->trade_id, $dbB);
    
            $db = array(
                'trade_offer_status'     => '1',
            );

            $this->model_trades->updateTradeOffer($idTradeOffer, $db);

        } else {
            $messageToA = "You refused to trade!";
            $messageToB = "The owner of <strong>$tradeA->trade_title</strong> refused to trade with you!";
            

            $db = array(
                'trade_offer_status' => '2'
            );
    
            $this->model_trades->updateTradeOffer($idTradeOffer, $db);
        }

        $dbNotification = array(
            'notif_iduser'          => $tradeA->trade_id_user_from,
            'notif_date_add'        => date('Y-m-d H:i:s'),
            'notif_status'          => '1',
            'notif_message'         => $messageToA,
            'notif_tradeoffer_id'   => $idTradeOffer
        );

        $this->notifications->addNotification($dbNotification);

        $dbNotification = array(
            'notif_iduser'          => $tradeB->trade_id_user_from,
            'notif_date_add'        => date('Y-m-d H:i:s'),
            'notif_status'          => '1',
            'notif_message'         => $messageToB,
            'notif_tradeoffer_id'   => $idTradeOffer            
        );

        $this->notifications->addNotification($dbNotification);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while trading!</div>");
            redirect('Exchange/viewOffer/'.$idTradeOffer);
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>The exchange was successful!</div>");
            redirect('Home');
        }
    }

    public function exchangeConfirmation($idNotification, $idTradeOffer = FALSE){
        if(!$idTradeOffer) {
            $this->notifications->updateNotification(array('notif_status' => '0'),$idNotification);
            redirect('Home');
        }

        $this->form_validation->set_rules('rating','Rating','required');        
        
        if($this->form_validation->run()) {
            $tradeOffer = $this->model_trades->getTradeOffer($idTradeOffer);
            if($tradeOffer->trade_offer_iduser_from != $this->session->userdata('idUser')) {
                $userToBeRated = $this->profiles->getProfileByUserId($tradeOffer->trade_offer_iduser_from);
                $userThatRated = $this->profiles->getProfileByUserId($tradeOffer->trade_offer_iduser_to);
                
            } else {
                $userToBeRated = $this->profiles->getProfileByUserId($tradeOffer->trade_offer_iduser_to);
                $userThatRated = $this->profiles->getProfileByUserId($tradeOffer->trade_offer_iduser_from);                  
            }
            
            $this->db->trans_begin();
            
            $rating = $this->input->post('rating');
            $idProfile = $userToBeRated->pro_id;
            
            $db_rating = array(
                'rat_idprofile' => $idProfile,
                'rat_rating' => $rating,
                'rat_comments' => $this->input->post('comments'),
                'rat_idprofile_sender' => $userThatRated->pro_id,
            );
            // var_dump($db_rating);die;
            $this->rating->add($db_rating);
            
            $ratUser = $this->profiles->getRatingProfile($idProfile);
            
            $soma = $ratUser->pro_sum_rating + $rating;
            $nbOfEvaluations = $ratUser->pro_number_of_evaluations + 1;
            $newRating = $soma / $nbOfEvaluations;
            
            $db_rating = array(
                'pro_sum_rating' => $soma,
                'pro_number_of_evaluations' => $nbOfEvaluations,
                'pro_rating' => $newRating
            );
            
            $ratUser = $this->profiles->updateRatingProfile($idProfile,$db_rating);

            $this->notifications->updateNotification(array('notif_status'=> '0'), $idNotification);
            
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while rating!</div>");
                redirect('Exchange/exchangeConfirmation');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>User rated with success!</div>");
                redirect('Home');
            }
        }

        $tradeOffer = $this->model_trades->getTradeOffer($idTradeOffer);
        $data['tradeOffer'] = $tradeOffer;

        if($tradeOffer->trade_offer_iduser_from != $this->session->userdata('idUser')) {
            $data['userToBeRated'] = $this->profiles->getProfileByUserId($tradeOffer->trade_offer_iduser_from);
        } else {
            $data['userToBeRated'] = $this->profiles->getProfileByUserId($tradeOffer->trade_offer_iduser_to);            
        }
        
        $this->load->view('exchange_confirmation',$data);
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
