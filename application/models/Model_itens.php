<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_itens extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function addItem($item){
        $this->db->insert('itens', $item);
    }

    public function insertPicItem($db){
        $this->db->insert('itens_pictures', $db);
    }

    public function getItems($idProfile,$status = FALSE){
        $this->db->where('item_idprofile',$idProfile);
        $this->db->join('itens_pictures', 'item_id = itempic_iditem', 'left');
        if($status || $status === '0'){
            $this->db->where('item_status',$status);
        }
        $items = $this->db->get('itens');

        if($items && $items->num_rows() > 0){
            return $items->result();
        }
        return FALSE;
    }

    public function deleteItem($idItem){
        $this->db->where('item_id', $idItem);
        $this->db->update('itens', array('item_status' => '2'));
    }

    public function updateItem($idItem,$array){
        $this->db->where('item_id',$idItem);
        $this->db->update('items',$array);
    }

    public function getItemById($idItem) {
        $this->db->where('item_id',$idItem);
        $this->db->join('itens_pictures', 'item_id = itempic_iditem', 'left');
        $this->db->join('profiles', 'item_idprofile = pro_id');
        $this->db->join('users', 'user_pro_id = pro_id');
        $this->db->join('categories', 'item_idcategory = category_id');

        $item = $this->db->get('itens');

        if($item && $item->num_rows() > 0) {
            return $item->row();
        }
        
        return FALSE;
    }

    public function getHomeItems($idProfile){
        $this->db->where('item_idprofile !=',$idProfile);
        $this->db->join('itens_pictures', 'item_id = itempic_iditem', 'left');
        $this->db->where('item_status = "0"');
        $items = $this->db->get('itens');

        if($items && $items->num_rows() > 0){
            return $items->result();
        }
        return FALSE;
    }
}