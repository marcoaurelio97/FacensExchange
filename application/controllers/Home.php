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

		$idUser = $this->session->userdata('idUser') ? $this->session->userdata('idUser') : FALSE;

		if ($idUser) {
			$profile = $this->model_profiles->getProfileByUserId($idUser);
			
			if ($profile) {
				$this->session->set_userdata('proPicture', $profile->pro_picture);
				$this->session->set_userdata('email', $profile->user_email);
			}
		}

		$data['trades'] = $this->model_trades->getTrades(FALSE, $idCategory);
		$this->session->set_userdata('categories', $this->model_categories->getCategories());
		$this->session->set_userdata('offersNotifications', $this->model_trades->getOffersNotifications($idUser));
		$this->session->set_userdata('notifications', $this->model_notifications->getNotifications($idUser));
<<<<<<< HEAD
		if($this->session->userdata('logged')) {
			$this->session->set_userdata('proPicture', $this->model_profiles->getProfileByUserId($idUser)->pro_picture);
			$this->session->set_userdata('email', $this->model_profiles->getProfileByUserId($idUser)->user_email);
		}
		// var_dump($this->session->userdata());die;

=======
	
>>>>>>> 4212ab69ec64de8c7846799e9b2ea3abd31e5b93
		$this->load->view('home_view', $data);
	}
}
