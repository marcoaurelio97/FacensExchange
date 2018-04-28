<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function listCategories()
    {
        if(!$this->session->userdata('admin')){
            $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>You shall not pass!</div>");
			redirect('home');
        }
        
        $this->load->model('model_categories');
        $data['categories'] = $this->model_categories->getCategoriesArray();
        $this->load->view('add_category', $data);
	}
	
    public function addCategory()
    {
        $db = array(
            'category_name'        => $this->input->post('name'),
            'category_description' => $this->input->post('description')
        );

        $this->load->model('model_categories');
        $this->model_categories->addCategory($db);

        $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Category added with success!</div>");
        redirect('Home');
    }
	
}
