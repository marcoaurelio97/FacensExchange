<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_address extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function add($address){
        $this->db->insert('profiles_address', $address);
    }

    public function update($idProfile, $db_adress){
        $this->db->where('address_pro_id', $idProfile);
        $this->db->update('profiles_address', $db_adress);
    }
}