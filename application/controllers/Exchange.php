<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exchange extends CI_Controller {

    public function tradeDetails(){
        $this->load->view('trade_details_view');
    }
    
    public function addTrade(){
        if($this->input->post()){
            $this->load->model('model_trades');
            require_once dirname(__FILE__) . "../../libraries/class/trade.php";
            $trade = new Trade();
            $trade->trade_id_user_from = $this->session->userdata('idUser');
            $trade->trade_date_add = date('Y-m-d H:i:s');
            $trade->trade_status = 1;
            $trade->trade_title = $this->input->post('title');
            $trade->trade_description = $this->input->post('description');
            $trade->trade_id_category = $this->input->post('category');

            $this->model_trades->addTrade($trade);

            $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Trade added with success!</div>");
			redirect('Home');
        }

        $this->load->model('model_categories');
        $data['categories'] = $this->model_categories->getCategoriesArray();
        $this->load->view('add_exchange_view', $data);
    }
}
