<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_trades extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function addTrade($trade){
        $this->db->insert('trades', $trade);
    }

    public function getTrades(){
        
        $trades = $this->db->get('trades');

        if($trades && $trades->num_rows() > 0){
            return $trades->result();
        }

        return FALSE;
    }
}