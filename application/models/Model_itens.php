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
}