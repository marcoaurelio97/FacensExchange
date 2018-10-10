<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user_control extends CI_Model {

    public function __construct(){        
        parent::__construct();
    }

    public function addUserControl($user_control){        
        $this->db->insert('user_control', $user_control);
    }

    public function getUserControl($user_control) {

        $this->db->where('item_id',$user_control['item_id']);
        $this->db->where('user_ip',$user_control['user_ip']);

        $item = $this->db->get('user_control');

        if($item && $item->num_rows() > 0) {
            return $item->row();
        }
        
        return false;
    }

    public function updateUserControl($user_control,$id_user_control){  
        $this->db->where('id_user_control',$id_user_control);   
        $this->db->update('user_control', $user_control);
        
    }
}



