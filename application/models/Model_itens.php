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
        $this->db->where('item_views','ASC');
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
        $this->db->update('itens',$array);
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

    public function getIdProfileByItem($idItem) {
        $this->db->where('item_id',$idItem);
        $item = $this->db->get('itens');

        if($item && $item->num_rows() > 0) {
            return $item->row()->item_idprofile;
        }
        
        return FALSE;
    }

    public function getHomeItems($idProfile = FALSE){

        if($idProfile){
            $this->db->where('item_idprofile !=',$idProfile);
        }
        $this->db->join('itens_pictures', 'item_id = itempic_iditem', 'left');
        $this->db->where('item_status = "0"');
        $items = $this->db->get('itens');

        if($items && $items->num_rows() > 0){
            return $items->result();
        }
        return FALSE;
    }

    public function getAllTrades(){
        $this->db->join('profiles', 'item_idprofile = pro_id');
        $this->db->join('users', 'user_pro_id = pro_id');
        $this->db->join('categories', 'item_idcategory = category_id');

        $item = $this->db->get('itens');

        if($item && $item->num_rows() > 0) {
            return $item->row();
        }
        
        return FALSE;
    }

    public function getCountItems($status){
        $this->db->where_in('item_status', $status);
        return $this->db->count_all_results('itens');
    }

    public function getItemsDonutChart(){
        $this->db->select('category_name AS name, COUNT(item_idcategory) AS count');
        $this->db->where('item_status !=',2);
        $this->db->join('categories','category_id = item_idcategory');
        $this->db->group_by('item_idcategory');

        $ret = $this->db->get('itens',FALSE);

        if($ret && $ret->num_rows() > 0) {
            return $ret->result();
        }
        
        return FALSE;
    }
    public function getTopItens($idProfile = FALSE){
        
        if($idProfile){
            $this->db->where('item_idprofile !=',$idProfile);
        }
        $this->db->join('itens_pictures', 'item_id = itempic_iditem', 'inner join');
        $this->db->where('item_status = "0"');
        $this->db->limit(3);
        $items = $this->db->get('itens');

        if($items && $items->num_rows() > 0){
            return $items->result();
        }
        return FALSE;
    }

    public function getItemPicture($idItem)
    {
        $this->db->where('itempic_iditem', $idItem);
        $picture = $this->db->get('itens_pictures');

        if ($picture && $picture->num_rows() > 0) {
            return $picture->row();
        }

        return false;
    }

    public function removeItemPicture($idItem)
    {
        $this->db->where('itempic_iditem', $idItem);
        $this->db->delete('itens_pictures');
    }
}