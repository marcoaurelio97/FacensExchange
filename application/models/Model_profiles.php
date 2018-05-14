<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_profiles extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function add($profile){
        $this->db->insert('profiles', $profile);
    }
}