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
		$this->load->model('model_notifications');

		$idUser = $this->session->userdata('idUser') ? $this->session->userdata('idUser') : FALSE;

		$data['trades'] = $this->model_trades->getTrades(FALSE, $idCategory);
		$this->session->set_userdata('categories', $this->model_categories->getCategories());
		$this->session->set_userdata('offersNotifications', $this->model_trades->getOffersNotifications($idUser));
		$this->session->set_userdata('notifications', $this->model_notifications->getNotifications($idUser));
	
		$this->load->view('home_view', $data);
	}
}
