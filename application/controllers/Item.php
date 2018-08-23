<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_itens','itens');
        $this->load->model('model_notifications', 'notifications');
        $this->load->model('model_profiles', 'profiles');
        $this->load->model('model_rating', 'rating');
        $this->load->model('model_wishes', 'wishes');
        $this->load->model('model_upload');
        $this->load->model('model_categories','categories');
    }

    public function addItem()
    {
        $this->form_validation->set_rules('title', 'Title','required|trim');
        $this->form_validation->set_rules('description', 'Description','required|trim');
        $this->form_validation->set_rules('category', 'Category','required');
        // $this->form_validation->set_rules('wishes', 'Wishes','required');
        // var_dump($this->input->post());die;
        if($this->form_validation->run()) {
            // die('here');
            $db_item = array(
                'item_date_add' => date('Y-m-d H:i:s'),
                'item_status' => '0',
                'item_title' => $this->input->post('title'),
                'item_description' => $this->input->post('description'),
                'item_idcategory' => $this->input->post('category'),
                'item_idprofile' => $this->session->userdata('idProfile'),
            );
            
            $this->db->trans_begin();
            
            $this->itens->addItem($db_item);
            $idItem = $this->db->insert_id();
            
            $wishes = $this->input->post('wishes');
            if($wishes){
                foreach($wishes AS $key=>$value){
                    $db_wishes[] = array(
                        'iw_item' => $idItem,
                        'iw_wish'  => $value
                    );
                }
                $this->wishes->addWishes($db_wishes);
            }
                
            if ($_FILES) {
                $this->model_upload->uploadImagesItem($idItem);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while adding a Item!</div>");
                redirect('Item/addItem');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Item added with success!</div>");
                redirect('Home');
            }
        }

        $data['add'] = TRUE;
        $data['wishes'] = $this->wishes->getWishes();        
        $data['categories'] = $this->categories->getCategoriesArray();
        $this->load->view('Item/add', $data);
    }

    public function listItems(){
        $idProfile = $this->session->userdata('idProfile');

        $data['currentItems'] = $this->itens->getItems($idProfile,'0');
        if($data['currentItems']){
            foreach($data['currentItems'] AS $item){
                $item->wishes = $this->wishes->getWishesByIdItem($item->item_id);
            }
        }

        $data['tradedItems'] = $this->itens->getItems($idProfile,'1');
        if($data['tradedItems']){
            foreach($data['tradedItems'] AS $item){
                $item->wishes = $this->wishes->getWishesByIdItem($item->item_id);
            }
        }
        // var_dump($data,$idProfile);die;
        $this->load->view('Item/list', $data);
    }

    public function deleteItem($idItem){
        $this->itens->deleteItem($idItem);
        $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>The Item was deleted!</div>");
        redirect('Item/listItems');
    }

    public function editItem($idItem)
    {
        $this->form_validation->set_rules('title', 'Title','required|trim');
        $this->form_validation->set_rules('description', 'Description','required|trim');
        $this->form_validation->set_rules('category', 'Category','required');
        // $this->form_validation->set_rules('wishes', 'Wishes','required');

        if($this->form_validation->run()) {
            $db_item = array(
                'item_title' => $this->input->post('title'),
                'item_description' => $this->input->post('description'),
                'item_idcategory' => $this->input->post('category')
            );
            
            $this->db->trans_begin();

            $this->itens->updateItem($idItem, $db_item);

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while editing a Item!</div>");
                redirect('Exchange/editItem/'.$idItem);
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Item edited with success!</div>");
                redirect('Home');
            }
        }

        $data['edit'] = TRUE;
        $data['wishes'] = $this->wishes->getWishes();                
        $wishesItem = $this->wishes->getWishesByIdItem($idItem);
        $idsItem = array();
        if($wishesItem){
            foreach($wishesItem AS $wish) {
                $idsItem[$wish->typ_id] = $wish;
            }        
        }
        $data['wishesItem'] = $idsItem;
        $data['categories'] = $this->categories->getCategoriesArray();    
        $data['item'] = $this->itens->getItemById($idItem);
        $this->load->view('Item/add',$data);
    }

    public function itemDetails($idItem){
        $data['profileLogged'] = $this->session->userdata('idProfile');
        $data['item'] = $this->itens->getItemById($idItem);
        $data['wishes'] = $this->wishes->getWishesByIdItem($idItem);
        $data['profileItem'] = $data['item']->item_idprofile;
        // var_dump($data);die;
        $this->load->view('Item/details', $data);
    }
}