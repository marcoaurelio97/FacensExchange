<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_users');
		$this->load->model('model_credentials');
	}

	public function index()
	{
		$this->load->view('login_view');
	}

	public function cadastrar(){
		if($this->input->post('password') != $this->input->post('password_confirm')){
			$this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Passwords doesn't match!</div>");
			redirect('Login');
		}

		if($this->input->post()){
			$name  = $this->input->post('name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$db = array(
				'user_name' => $name
			);

			$this->model_users->addUser($db);
			$idUser = $this->db->insert_id();

			$db = array(
				'credentials_iduser' => $idUser,
				'credentials_email'  => $email,
				'credentials_password' => md5($password)
			);

			$this->model_credentials->addCredential($db);

			$this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>User registered with success!</div>");
			redirect('Home');
		}

		$this->load->view('login_view');
	}

	public function login(){
		if($this->input->post()){
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$credentials = $this->model_credentials->checkEmailPassword($email, md5($password));

			if($credentials){
				$this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>User logged with success!</div>");
				redirect('Home');
			}

			$this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Failed to login!</div>");
			redirect('login');
		}

		$this->load->view('login_view');
	}
}
