<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_wishes extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function getWishes(){
        $result = $this->db->get('itens_wishes_types');

        if($result AND $result->num_rows() > 0) {
            return $result->result();
        }

        return FALSE;
    }

    public function getWishesByIdItem($idItem){
        $this->db->join('itens_wishes','typ_id = iw_wish');
        $this->db->where('iw_item',$idItem);
        $result = $this->db->get('itens_wishes_types');

        if($result AND $result->num_rows() > 0) {
            return $result->result();
        }

        return FALSE;
    }

    public function addWishes($db){
        $this->db->insert_batch('itens_wishes',$db);
    }
}
