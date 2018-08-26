<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('admin')){
			redirect('Home/dashboardAdmin');
		} else {
			die('é o delano caralho');
			redirect('Home/listTrades/'.$idCategory);
		}
	}

	public function listTrades($idCategory = FALSE)
	{
		$this->load->model('model_trades');
		$this->load->model('model_categories');
		$this->load->model('model_notifications');
		$this->load->model('model_profiles');
		$this->load->model('model_wishes','wishes');
		$this->load->model('model_itens','itens');

		$idUser = $this->session->userdata('idUser') ? $this->session->userdata('idUser') : FALSE;

		if ($idUser) {
			$profile = $this->model_profiles->getProfileByUserId($idUser);
			if ($profile) {
				$this->session->set_userdata('idProfile', $profile->pro_id);
				$this->session->set_userdata('proPicture', $profile->pro_picture);
				$this->session->set_userdata('email', $profile->user_email);
			}
		}
		$idProfile = $this->session->Userdata('idProfile') ? $this->session->Userdata('idProfile') : FALSE;

		$data['items'] = $this->itens->getHomeItems(isset($profile) ? $profile->pro_id : FALSE);

		if ($data['items']) {
			foreach($data['items'] AS $item){
				$item->wishes = $this->wishes->getWishesByIdItem($item->item_id);
			}
		}

		$this->session->set_userdata('categories', $this->model_categories->getCategories());
		$this->session->set_userdata('offersNotifications', $this->model_trades->getOffersNotifications($idProfile));
		$this->session->set_userdata('notifications', $this->model_notifications->getNotifications($idUser));

		if ($this->session->userdata('logged') AND !$this->session->userdata('admin')) {
			$this->session->set_userdata('proPicture', $this->model_profiles->getProfileByUserId($idUser)->pro_picture);
			$this->session->set_userdata('email', $this->model_profiles->getProfileByUserId($idUser)->user_email);
		}

		$this->load->view('home', $data);
	}

	public function category($idCategory = FALSE){
		$this->listTrades($idCategory);
	}

	public function dashboardAdmin()
	{
		$this->load->model('model_trades', 'trades');
		$this->load->model('model_users', 'users');

		$data['countTrades'] = $this->trades->getCountTrades(array('0', '1'));

		$aux = $data['countTrades'];

		if($aux == 0)
		$aux = 1;
		
		$data['countFinalized'] = number_format((($this->trades->getCountTrades(array('1'))/$aux)*100), 0);
		$data['countUsers'] = $this->users->getCountUsers(array('1'));

		$data['last_trades'] = $this->trades->getLastExchanges();	

		$this->load->view('dashboard', $data);
	}


    
}
