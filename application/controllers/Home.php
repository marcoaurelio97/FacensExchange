<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('admin')){
			redirect('Home/dashboardAdmin');
		} else {
			redirect('Home/listTrades');
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
		$this->load->model('Model_itens','itens');
		$this->load->model('Model_reports','reports');
		$this->load->model('Model_trades','trades');

		$data['pendingItems'] = $this->itens->getCountItems(array(0));
		$data['tradedItems'] = $this->itens->getCountItems(array(1));
		$data['userRegistrations'] = $this->users->getCountUsers(array(1));
		$data['reports'] = $this->reports->getCountReports(array(1));
		$data['donutChart'] = $this->itens->getItemsDonutChart();
		$data['pendingTrades'] = $this->trades->getCountTrades(array(0));
		$data['acceptedTrades'] = $this->trades->getCountTrades(array(1));
		$data['totalTrades'] = $this->trades->getCountTrades(array(1,2));

		$data['last_trades'] = $this->trades->getLastTrades(20);

		// var_dump($data['donutChart']);die;
		$this->load->view('dashboard', $data);
	}
}
