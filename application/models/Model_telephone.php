<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_telephone extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function add($telephone){
        $this->db->insert('profiles_telephone', $telephone);
    }
}