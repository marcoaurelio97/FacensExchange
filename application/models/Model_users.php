<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function addUser($user){
        $this->db->insert('users', $user);
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
        
        $sql = "SELECT user_name,user_email,user_date_add,user_role FROM users WHERE user_id <> ?";       

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
}