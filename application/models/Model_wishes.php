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

    public function getWishesById($idTrade){
        $this->db->join('trade_wishes','typ_id = tra_wish_wish');
        $this->db->where('tra_wish_trade',$idTrade);
        $result = $this->db->get('trade_wishes_types');

        if($result AND $result->num_rows() > 0) {
            return $result->result();
        }

        return FALSE;
    }

    public function addWishes($db){
        $this->db->insert_batch('itens_wishes',$db);
    }
}
