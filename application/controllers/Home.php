<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		redirect('Home/listTrades');
	}
	
	public function listTrades($idCategory = false)
	{
		$this->load->model('model_trades');
		$this->load->model('model_categories');
		$this->load->model('model_notifications');
		$this->load->model('model_profiles');
		$this->load->model('model_wishes','wishes');
		

		$idUser = $this->session->userdata('idUser') ? $this->session->userdata('idUser') : FALSE;

		if ($idUser) {
			$profile = $this->model_profiles->getProfileByUserId($idUser);
			
			if ($profile) {
				$this->session->set_userdata('proPicture', $profile->pro_picture);
				$this->session->set_userdata('email', $profile->user_email);
			}
		}

		$data['trades'] = $this->model_trades->getTrades(FALSE, $idCategory);
		foreach($data['trades'] AS $trade){
			$trade->wishes = $this->wishes->getWishesById($trade->trade_id);
		}
		// var_dump($data['trades']);die;
		$this->session->set_userdata('categories', $this->model_categories->getCategories());
		$this->session->set_userdata('offersNotifications', $this->model_trades->getOffersNotifications($idUser));
		$this->session->set_userdata('notifications', $this->model_notifications->getNotifications($idUser));
		if($this->session->userdata('logged')) {
			$this->session->set_userdata('proPicture', $this->model_profiles->getProfileByUserId($idUser)->pro_picture);
			$this->session->set_userdata('email', $this->model_profiles->getProfileByUserId($idUser)->user_email);
		}
		// var_dump($this->session->userdata());die;

		$this->load->view('home_view', $data);
	}
}
