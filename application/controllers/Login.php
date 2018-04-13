<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_users');
	}

	public function index()
	{
		$this->load->view('login_view');
	}

	public function register(){
		if($this->input->post('password') != $this->input->post('password_confirm')){
			$this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Passwords doesn't match!</div>");
			redirect('Login');
		}

		if(!$this->input->post('terms')){
			$this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>You have to accept the terms!</div>");
			redirect('Login');
		}

		if($this->input->post()){
			require_once dirname(__FILE__) . "../../libraries/class/user.php";
			$user = new User();
			$user->user_name = $this->input->post('name');
			$user->user_email = $this->input->post('email');
			$user->user_password = md5($this->input->post('password'));
			$user->user_date_add = date('Y-m-d H:i:s');

			$this->model_users->addUser($user);
			$idUser = $this->db->insert_id();

			$this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>User registered with success!</div>");
			redirect('login');
		}

		$this->load->view('login_view');
	}

	public function login(){
		if($this->input->post()){
			require_once dirname(__FILE__) . "../../libraries/class/user.php";

			$user = new User();
			$user->user_email = $this->input->post('email');
			$user->user_password = md5($this->input->post('password'));
			

			$authorized = $this->model_users->checkEmailPassword($user);

			if($authorized){
				$this->session->set_userdata('logged', true);
				$id_user = $this->model_users->getUser($user);				
				$this->session->set_userdata('idUser', $id_user);
				$this->session->set_userdata('userName', $this->model_users->getName($user));
				$this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>User logged with success!</div>");
				
				$this->verifyAdmin($id_user);
				redirect('Home');
			}

			$this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Failed to login!</div>");
			redirect('login');
		}

		$this->load->view('login_view');
	}

	public function signOut(){
		$this->session->unset_userdata('logged');
		$this->session->unset_userdata('admin');
		$this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>User sign out with success!</div>");
		redirect('Home');
	}

	public function verifyAdmin($id_user){

		if($this->input->post()){
			require_once dirname(__FILE__) . "../../libraries/class/user.php";
			$user = new User();
			$user->user_email = $this->input->post('email');
			$user->user_password = md5($this->input->post('password'));			

			$is_admin = $this->model_users->verifyAdmin($id_user);			

			if($is_admin){
				$this->session->set_userdata('admin', true);
			}else{
				$this->session->set_userdata('admin', false);
			}
		}

		$this->load->view('login_view');
	}


}
