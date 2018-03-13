<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_usuarios');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function cadastrar(){
		
		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required');
		$this->form_validation->set_rules('senha', 'Senha', 'required');
		$this->form_validation->set_rules('senha_confirmar', 'Confirmação de Senha', 'required|matches[senha]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if($this->form_validation->run()){
			$usuario = $this->input->post('usuario');
			$email   = $this->input->post('email');
			$senha   = $this->input->post('senha');

			$db = array(
				'usuario' => $usuario,
				'email'   => $email,
				'senha'   => md5($senha)
			);

			$this->model_usuarios->cadastrarUsuario($db);

			redirect('login');
		} else {
			$this->load->view('login');
		}
	}

	public function login(){
		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('senha', 'Senha', 'required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if($this->form_validation->run()){
			$usuario = $this->input->post('usuario');
			$senha   = $this->input->post('senha');

			$credenciais = $this->model_usuarios->verificaUsuarioSenha($usuario, $senha);

			if($credenciais){
				redirect('login');
			}

			redirect('login');
		} else {
			$this->load->view('login');
		}
	}
}
