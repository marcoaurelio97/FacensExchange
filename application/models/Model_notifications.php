<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notifications extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function addNotification($dbNotification)
    {
        $this->db->insert('notifications', $dbNotification);
    }

    public function getNotifications($idUser)
    {
        if (!$idUser) {
            return array();
        }

        $this->db->where('notif_iduser', $idUser);
        $this->db->where('notif_status', '0');
        $notifications = $this->db->get('notifications');

        if ($notifications && $notifications->num_rows() > 0) {
            return $notifications->result();
        }

        return array();
    }
}