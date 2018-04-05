<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['logged'] = $this->session->userdata('logged');
		$this->load->view('home_view', $data);
    }
}
