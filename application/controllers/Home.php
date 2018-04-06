<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model('model_trades');

		$data['trades'] = $this->model_trades->getTrades();

		$this->load->view('home_view', $data);
    }
}
