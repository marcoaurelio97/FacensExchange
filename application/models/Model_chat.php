<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_chat extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function hasChat($idItem){
        $this->db->where('chat_iditem',$idItem);
        $ret = $this->db->get('chat');

        if($ret && $ret->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }

    public function getChatId($idItem){
        $this->db->where('chat_iditem',$idItem);
        $ret = $this->db->get('chat');

        if($ret && $ret->num_rows() > 0){
            return $ret->row()->chat_id;
        }

        return FALSE;
    }

    public function createChat($idItem,$idOwner){
        $db_chat['chat_idowner'] = $idOwner;
        $db_chat['chat_iditem'] = $idItem;

        $this->db->insert('chat',$db_chat);

        return $this->db->insert_id();
    }

    public function addMessage($chat,$message,$idProfile){
        $db_chat['mes_idprofile'] = $idProfile;
        $db_chat['mes_idchat'] = $chat;
        $db_chat['mes_message'] = $message;
        $db_chat['mes_time'] = date('Y-m-d H:i:s');
        $this->db->insert('messages',$db_chat);
    }

    public function addReply($message,$idMessage){
        $db_chat['mes_reply'] = $message;

        $this->db->where('mes_id', $idMessage);
        $this->db->update('messages',$db_chat);
    }

    public function getMessagesChat($idChat){
        $this->db->select(' user_username AS username,
                            mes_message AS message,
                            mes_idprofile AS idprofile,
                            mes_time AS time,
                            pro_picture AS picture,
                            mes_id AS id,
                            mes_reply AS reply');
        $this->db->where('mes_idchat',$idChat);
        $this->db->join('profiles','mes_idprofile = pro_id');        
        $this->db->join('users','mes_idprofile = user_pro_id');
        $ret = $this->db->get('messages');

        if($ret && $ret->num_rows() > 0){
            return $ret->result();
        }

        return FALSE;
    }

    public function getItemByChat($idChat){
        $this->db->where('chat_id',$idChat);
        $ret = $this->db->get('chat');


        if($ret && $ret->num_rows() > 0){
            return $ret->row()->chat_iditem;
        }

        return FALSE;
    }
}