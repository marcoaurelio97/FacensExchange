<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_rating extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function add($rating){
        $this->db->insert('profiles_rating', $rating);
    }
}
