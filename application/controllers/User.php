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
        $idProfile = $this->session->userdata('idProfile');
        $trades = $this->trades->getTradesByIdProfile($idProfile,TRUE);
        if($trades){
            $tradesCurrent = array();
            foreach($trades AS $trade){
                $trade = $this->trades->getTradeAndItensByIdTrade($trade->trade_id);
                $t = array();

                if($idUser == $trade['receiver']->user_id){
                    $t['trade'] = $trade['trade'];
                    $t['left'] = $trade['receiver'];
                    $t['right'] = $trade['sender'];
                    $t['arrow'] = 'esq';
                    $t['rec'] = TRUE;
                } else if($idUser == $trade['sender']->user_id){
                    $t['trade'] = $trade['trade'];
                    $t['left'] = $trade['sender'];
                    $t['right'] = $trade['receiver'];
                    $t['arrow'] = 'dir';
                    $t['rec'] = FALSE;
                }
                $tradesCurrent[] = $t;
            }
            $data['tradesCurrent'] = $tradesCurrent;
        }

        $trades = $this->trades->getTradesByIdProfile($idProfile,FALSE);
        if($trades){
            $tradesFinalized = array();
            foreach($trades AS $trade){
                $trade = $this->trades->getTradeAndItensByIdTrade($trade->trade_id);
                $t = array();

                if($idUser == $trade['receiver']->user_id){
                    $t['trade'] = $trade['trade'];
                    $t['left'] = $trade['receiver'];
                    $t['right'] = $trade['sender'];
                    $t['arrow'] = 'esq';
                } else if($idUser == $trade['sender']->user_id){
                    $t['trade'] = $trade['trade'];
                    $t['left'] = $trade['sender'];
                    $t['right'] = $trade['receiver'];
                    $t['arrow'] = 'dir';
                }
                $tradesFinalized[] = $t;
            }
            $data['tradesFinalized'] = $tradesFinalized;
        }        
        $data['title'] = '';
        // var_dump($data);die;
        $this->load->view('Trade/list',$data);
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
