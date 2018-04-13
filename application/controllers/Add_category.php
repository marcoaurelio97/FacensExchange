<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_category extends CI_Controller {

	public function index()
	{		              
        if($this->session->userdata('admin')) 
        {
            $this->load->view('add_category');
        }else{
            $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>You shall not pass!</div>");
			redirect('home');
        }
	}

    public function addCategories(){
        if($this->input->post()){
            $this->load->model('Model_categories');
            require_once dirname(__FILE__) . "../../libraries/class/category.php";
            $category = new Category();
            $category->category_name = $this->input->post('name');
			$category->category_description = $this->input->post('description');

			$this->Model_categories->addCategory($category);

            $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Category added with success!</div>");
			redirect('Home');
        }

        $this->load->model('model_categories');
        $data['categories'] = $this->model_categories->getCategoriesArray();
        $this->load->view('add_exchange_view', $data);
	}
	
	public function addCategory($category){
        $this->db->insert('categories', $category);
    }
	
}
