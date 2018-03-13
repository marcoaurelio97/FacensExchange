<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_usuarios extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function cadastrarUsuario($db){
        $this->db->insert('usuarios', $db);
    }

    public function verificaUsuarioSenha($usuario, $senha){
        $this->db->where('usuario', $usuario);
        $this->db->where('senha', $senha);
        $conta = $this->db->get('usuarios');

        if($conta && $conta->num_rows() > 0){
            return $conta->row();
        }

        return FALSE;
    }
}