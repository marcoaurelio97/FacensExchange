<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_profiles extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('model_users', 'users');
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

    public function update($idUser, $db_profiles){
        $user = $this->users->getUserById($idUser);

        if(!is_null($user->user_pro_id)){
            $this->db->where('pro_id', $user->user_pro_id);
            $this->db->update('profiles', $db_profiles);

            return $user->user_pro_id;
        }

        return FALSE;
    }
}