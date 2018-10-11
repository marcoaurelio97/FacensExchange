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

    public function getProfileById($idProfile) {

        $this->db->where('pro_id',$idProfile);
        $this->db->join('users','user_pro_id = pro_id');
        $this->db->join('profiles_address','address_pro_id = pro_id');
        $this->db->join('profiles_telephone','tel_pro_id = pro_id');

        $result = $this->db->get('profiles');

        if($result && $result->num_rows() > 0) {
            return $result->row();
        }
        
        return false;
    }

    public function getRatingProfile($idProfile) {
        $this->db->select('pro_number_of_evaluations, pro_sum_rating, pro_rating');
        $this->db->where('pro_id',$idProfile);

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

    public function getCommentsProfile($idProfile) {
        $this->db->where('rat_idprofile',$idProfile);
        $this->db->join('profiles','rat_idprofile_sender = pro_id','left');
        $this->db->join('users','user_pro_id = pro_id','left');        
        $result = $this->db->get('profiles_rating');
        // print_r($this->db->last_query());die;

        if($result && $result->num_rows() > 0) {
            return $result->result();
        }
        
        return false;
    }

    public function updateRatingProfile($idProfile, $db_rating){
        $this->db->where('pro_id', $idProfile);
        $this->db->update('profiles', $db_rating);
    }

    public function insertPicProfile($db,$idProfile){
        $this->db->where('pro_id',$idProfile);
        $this->db->update('profiles', $db);
    }

    public function addFavorite($db) {
        $this->db->insert('profiles_favorites', $db);
    }

    public function updateFavorite($db,$idFavorite) {
        $this->db->where('fav_id',$idFavorite);        
        $this->db->update('profiles_favorites', $db);
    }
    
    public function removeFavorite($db,$idProfile,$idLogged) {
        $this->db->where('fav_id_profile',$idLogged);
        $this->db->where('fav_id_fav_profile',$idProfile);
        $this->db->update('profiles_favorites', $db);
    }

    public function checkFavorite($idProfile,$idLogged) {
        $this->db->where('fav_id_profile',$idLogged);
        $this->db->where('fav_id_fav_profile',$idProfile);
        $this->db->where('fav_status','1');
        
        
        $result = $this->db->get('profiles_favorites');

        if($result && $result->num_rows() > 0) {
            return FALSE;
        }
        
        return TRUE;
    }
    public function hasPreviousData($idProfile,$idLogged) {
        $this->db->where('fav_id_profile',$idLogged);
        $this->db->where('fav_id_fav_profile',$idProfile);
        $this->db->where('fav_status','0');
        
        $result = $this->db->get('profiles_favorites');

        if($result && $result->num_rows() > 0) {
            return $result->row()->fav_id;
        }
        
        return FALSE;
    }
    

    public function getFavoriteUsers($idProfile){
        $this->db->where('fav_id_profile',$idProfile);
        $this->db->where('fav_status','1');        
        $this->db->join('profiles_favorites','fav_id_fav_profile = pro_id');
        $this->db->join('users','user_pro_id = pro_id');
        
        $result = $this->db->get('profiles');

        if($result && $result->num_rows() > 0) {
            return $result->result();
        }
        
        return FALSE;
    }

    public function getPictureByIdProfile($idProfile){
        $this->db->select('pro_picture');
        $this->db->where('pro_id',$idProfile);

        $result = $this->db->get('profiles');

        if($result && $result->num_rows() > 0) {
            return $result->row()->pro_picture;
        }
        
        return NULL;
    }
}