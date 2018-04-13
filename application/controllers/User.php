<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('model_trades');
    }

    public function listTrades(){
        $idUser = $this->session->userdata('idUser');

        $data['trades'] = $this->model_trades->getTradesUser($idUser);

        $this->load->view('trades_user_view', $data);
    }
}
