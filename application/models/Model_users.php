<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function addUser($user){
        $this->db->insert('users', $user);
    }

    public function getUserById($idUser){
        $this->db->where('user_id', $idUser);
        $user = $this->db->get('users');

        if($user && $user->num_rows() > 0){
            return $user->row();
        }

        return FALSE;
    }

    public function checkEmailPassword($user){
        $this->db->where('user_email', $user->user_email);
        $this->db->where('user_password', $user->user_password);
        $auth = $this->db->get('users');

        if($auth && $auth->num_rows() > 0){
            return TRUE;
        }

        return FALSE;
    }

    public function getUser($user){
        $this->db->where('user_email', $user->user_email);
        $this->db->where('user_password', $user->user_password);
        $user = $this->db->get('users');

        if($user && $user->num_rows() > 0){
            return $user->row()->user_id;
        }

        return FALSE;
    }

    public function getName($user){
        $this->db->where('user_email', $user->user_email);
        $this->db->where('user_password', $user->user_password);
        $user = $this->db->get('users');

        if($user && $user->num_rows() > 0){
            return $user->row()->user_username;
        }

        return FALSE;
    }

    public function verifyAdmin($id_user){
        $this->db->where('user_role', 'Admin');
        $this->db->where('user_id', $id_user);
        $users = $this->db->get('users');  

        if ( $users && $users->num_rows() > 0){
            return TRUE;
        }

        return FALSE;
    }

    public function getUsers($id_user){
        
        $sql = "SELECT user_id,user_username,user_email,user_date_add,user_role FROM users WHERE user_id <> ?";

        $users = $this->db->query($sql, array($id_user));

        if($users && $users->num_rows() > 0){
            return $users->result();
        }

        return FALSE;
    }   

    public function setUserProfile($idUser,$idProfile){
        $this->db->where('user_id',$idUser);
        $arr = array('user_pro_id' => $idProfile);
        $this->db->update('users',$arr);
    }

    public function hasProfile($idUser){
        $this->db->where('user_id',$idUser);
        $user = $this->db->get('users');

        if(is_null($user->row()->user_pro_id)){
            return false;
        }

        return true;
    }

    public function checkUserGoogle($idGoogle)
    {
        $this->db->where('user_idgoogle', $idGoogle);
        $user = $this->db->get('users');

        if($user && $user->num_rows() > 0) {
            return $user->row();
        }

        return FALSE;
    }

    public function getCountUsers($status)
    {
        $this->db->where_in('user_status', $status);
        return $this->db->count_all_results('users');
    }

    public function getUsernameByProfile($idProfile){
        $this->db->where('user_pro_id',$idProfile);
        $result = $this->db->get('users');

        if($result && $result->num_rows() > 0) {
            return $result->row()->user_username;
        }
        
        return FALSE;
    }
}