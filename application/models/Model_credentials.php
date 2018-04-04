<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_credentials extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function addCredential($db){
        $this->db->insert('credentials', $db);
    }

    public function checkEmailPassword($email, $password){
        $this->db->where('credentials_email', $email);
        $this->db->where('credentials_password', $password);
        $credentials = $this->db->get('credentials');

        if($credentials->row()){
            return TRUE;
        }

        return FALSE;
    }
}