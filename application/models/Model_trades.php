<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_trades extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function addTrade($trade){
        $this->db->insert('trades', $trade);
    }

    public function updateTrade($idTrade,$array){
        $this->db->where('trade_id',$idTrade);
        $this->db->update('trades',$array);
    }

    // public function getTrades($idTrade = false, $idCategory = false, $getUser= FALSE, $current=TRUE, $interval=FALSE){
    //     $this->db->join('trade_pictures', 'trade_id = trade_pic_idtrade', 'left');
    //     $this->db->join('categories', 'category_id = trade_id_category', 'left');     

    //     if($getUser) {
    //         $this->db->join('users', 'trade_id_user_from = user_id', 'left');          
    //     }
    //     if($idTrade){
    //         $this->db->where('trade_id', $idTrade);
    //     }
    //     if($idCategory){
    //         $this->db->where('trade_id_category', $idCategory);
    //     }
    //     if($this->session->userdata('idUser') AND !$getUser){
    //         $this->db->where('trade_id_user_from !=', $this->session->userdata('idUser'));
    //     }
    //     if($current) {
    //         $this->db->where('trade_status', '0');
    //     } else {
    //         $this->db->where('trade_status', '1');            
    //     }
    //     if($interval){
    //         $this->db->where('DATE(trade_date_add) >=', $interval['start']);
    //         $this->db->where('DATE(trade_date_add) <=', $interval['end']);            
    //     }
    //     $this->db->order_by('trade_date_add', 'desc');
    //     $trades = $this->db->get('trades');
    //     // print_r($this->db->last_query());die;
    //     if($trades && $trades->num_rows() > 0){
    //         if($idTrade){
    //             return $trades->row();
    //         }

    //         return $trades->result();
    //     }

    //     return FALSE;
    // }

    public function getTradeForOffer($idTrade){
        $this->db->join('trade_pictures', 'trade_id = trade_pic_idtrade', 'left');
        $this->db->join('categories', 'category_id = trade_id_category', 'left');
        $this->db->where('trade_id', $idTrade);
        $this->db->where('trade_status', '0');
        $trade = $this->db->get('trades');
        // print_r($this->db->last_query());die;

        if($trade && $trade->num_rows() > 0){
            return $trade->row();
        }

        return FALSE;
    }

    public function getLastExchanges(){
        
        $sql = " 
            SELECT 
                T0.trade_id,
                T0.trade_title,
                T0.trade_description,
                T1.user_username,
                T0.trade_status
            FROM trades T0
            INNER JOIN users T1
            ON T0.trade_id_user_from = T1.user_id";

        $last_exchanges = $this->db->query($sql);

        if($last_exchanges && $last_exchanges->num_rows() > 0){
            return $last_exchanges->result();
        }

        return FALSE;
    }

    public function insertPicTrade($db){
        $this->db->insert('trade_pictures', $db);
    }

    public function findOfferBySearch($search){
        $this->db->like('trade_title', $search);
        $this->db->join('trade_pictures', 'trade_id = trade_pic_idtrade', 'left');
        $this->db->join('categories', 'category_id = trade_id_category', 'left');
        $this->db->order_by('trade_date_add', 'desc');
        $offers = $this->db->get('trades');

        if($offers && $offers->num_rows() > 0){
            return $offers->result();
        }

        return FALSE;
    }

    public function getOffersNotifications($idProfile){
        if(!$idProfile){
            return array();
        }

        $offers = $this->db->query("
            SELECT 
                *, rec_item.item_title AS myTrade, sen_item.item_title AS offeredToMe
            FROM
                trades AS t
                    JOIN
                itens AS rec_item ON rec_item.item_id = t.trade_iditem_receiver
                    JOIN
                profiles ON rec_item.item_idprofile = pro_id AND pro_id = {$idProfile}
                    JOIN
                itens AS sen_item ON sen_item.item_id = t.trade_iditem_sender
            WHERE t.trade_status = '0'
        ");

        if($offers && $offers->num_rows() > 0){
            return $offers->result();
        }

        return array();
    }

    public function deleteTrade($idTrade){
        $this->db->where('trade_id', $idTrade);
        $this->db->update('trades', array('trade_status' => '2'));
    }

    public function getTradeDetails($idTrade) {
        $this->db->join('trade_pictures', 'trade_id = trade_pic_idtrade', 'left');
        $this->db->join('categories', 'category_id = trade_id_category', 'left');
        $this->db->where('trade_id', $idTrade);
        $trade = $this->db->get('trades');

        if($trade && $trade->num_rows() > 0){
            return $trade->row();
        }

        return FALSE;
    }

    public function getCountTrades($status)
    {
        $this->db->where_in('trade_status', $status);
        return $this->db->count_all_results('trades');
    }

    public function getTradeById($idTrade){
        $this->db->where('trade_id', $idTrade);
        $trades = $this->db->get('trades');

        if($trades && $trades->num_rows() > 0){
            return $trades->row();
        }

        return FALSE;
    }

    public function getTradeAndItensByIdTrade($idTrade){
        $this->db->where('trade_id', $idTrade);
        $trades = $this->db->get('trades');

        if($trades && $trades->num_rows() > 0){

            $retorno = array();

            $retorno['trade'] = $trades->row();
            $retorno['receiver'] = $this->itens->getItemById($trades->row()->trade_iditem_receiver);
            $retorno['sender'] = $this->itens->getItemById($trades->row()->trade_iditem_sender);

            return $retorno;
        }

        return FALSE;
    }

    public function getTrades($current = false){

        if ($current) {
            $this->db->where('trade_status', '0');
        } else {
            $this->db->where('trade_status', '1');
        }

        $trades = $this->db->get('trades');
        if($trades && $trades->num_rows() > 0){
            return $trades->result();
        }

        return FALSE;
    }
}