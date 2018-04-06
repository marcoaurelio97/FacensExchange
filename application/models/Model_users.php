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
            return $user->row()->user_name;
        }

        return FALSE;
    }
}