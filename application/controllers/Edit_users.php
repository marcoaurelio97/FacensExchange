<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_users extends CI_Controller {

	public function index()
	{		

        if($this->session->userdata('admin')) 
        {
                $this->load->model('model_users');
        
                $id_user = $this->session->userdata('idUser');
        
                $data['users'] = $this->model_users->getUsers($id_user);
        
                $this->load->view('edit_users', $data);
        }else{
            $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>You shall not pass!</div>");
			redirect('home');
        }

	}

	
}
