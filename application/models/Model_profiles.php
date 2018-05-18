<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_profiles extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function add($profile){
        $this->db->insert('profiles', $profile);
    }

    public function getProfileByUserId($idUser) {
        $this->db->where('user_id',$idUser);
        $this->db->join('users','user_pro_id = pro_id');
        $this->db->join('profiles_address','address_pro_id = pro_id');
        $this->db->join('profiles_telephone','tel_pro_id = pro_id');

        $result = $this->db->get('profiles');

        if($result && $result->num_rows() > 0) {
            return $result->row();
        }
        
        return false;
    }
}