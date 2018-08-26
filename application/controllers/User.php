<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_trades','trades');
        $this->load->model('model_wishes','wishes');
        $this->load->model('model_itens','itens');
        
    }

    public function listTrades()
    {
        $idUser = $this->session->userdata('idUser');
        $trades = $this->trades->getTrades(TRUE);
        if($trades){
            $tradesCurrent = array();
            foreach($trades AS $trade){
                $trade = $this->trades->getTradeAndItensByIdTrade($trade->trade_id);
                $trade['receiver']->wishes = $this->wishes->getWishesByIdItem($trade['receiver']->item_id);
                $trade['sender']->wishes = $this->wishes->getWishesByIdItem($trade['sender']->item_id); 
                
                $tradesCurrent[] = $trade;
            }
            $data['tradesCurrent'] = $tradesCurrent;
        }

        $trades = $this->trades->getTrades(FALSE);
        if($trades){
            $tradesFinalized = array();
            foreach($trades AS $trade){
                $trade = $this->trades->getTradeAndItensByIdTrade($trade->trade_id);
                $trade['receiver']->wishes = $this->wishes->getWishesByIdItem($trade['receiver']->item_id);
                $trade['sender']->wishes = $this->wishes->getWishesByIdItem($trade['sender']->item_id); 

                $tradesFinalized[] = $trade;
            }
            $data['tradesFinalized'] = $tradesFinalized;
        }        

        // var_dump($data['tradesCurrent']);die;
        $this->load->view('Trade/list', $data);
    }

    public function listUsers()
    {
        if($this->session->userdata('admin')){
            $this->load->model('model_users');
        
            $id_user = $this->session->userdata('idUser');
        
            $data['users'] = $this->model_users->getUsers($id_user);
        
            $this->load->view('edit_users', $data);
        } else {
            $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>You shall not pass!</div>");
			redirect('Home');
        }
    }
}
