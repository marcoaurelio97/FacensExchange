<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		redirect('Home/listTrades');
	}
	
	public function listTrades($idCategory = false){
		$this->load->model('model_trades');
		$this->load->model('model_categories');
	
		$data['trades'] = $this->model_trades->getTrades(FALSE, $idCategory);
		$this->session->set_userdata('categories', $this->model_categories->getCategories());
	
		$this->load->view('home_view', $data);
	}
}
