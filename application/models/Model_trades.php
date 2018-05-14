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

    public function getTrades($idTrade = false, $idCategory = false, $getUser= FALSE){
        $this->db->join('trade_pictures', 'trade_id = trade_pic_idtrade', 'left');
        $this->db->join('categories', 'category_id = trade_id_category', 'left');

        if($getUser) {
            $this->db->join('users', 'trade_id_user_from = user_id', 'left');          
        }
        if($idTrade){
            $this->db->where('trade_id', $idTrade);
        }

        if($idCategory){
            $this->db->where('trade_id_category', $idCategory);
        }

        $this->db->where('trade_status', '0');
        $this->db->order_by('trade_date_add', 'desc');
        $trades = $this->db->get('trades');

        if($trades && $trades->num_rows() > 0){
            if($idTrade){
                return $trades->row();
            }

            return $trades->result();
        }

        return FALSE;
    }

    public function insertPicTrade($db){
        $this->db->insert('trade_pictures', $db);
    }

    public function getTradesUser($idUser){
        $this->db->join('trade_pictures', 'trade_id = trade_pic_idtrade', 'left');
        $this->db->where('trade_id_user_from', $idUser);
        $trades = $this->db->get('trades');

        if($trades && $trades->num_rows() > 0){
            return $trades->result();
        }

        return FALSE;
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

    public function addTradeOffer($db){
        $this->db->insert('trade_offers', $db);
    }

    public function getOffersNotifications($idUser){
        if(!$idUser){
            return array();
        }

        $offers = $this->db->query("
            SELECT 
                *
            FROM
                trade_offers
                    LEFT JOIN
                trades
                ON trade_id = trade_offer_idtrade_from
            WHERE
                trade_offer_iduser_to = {$idUser}
                AND trade_offer_status = '0'
        ");

        if($offers && $offers->num_rows() > 0){
            return $offers->result();
        }

        return array();
    }

    public function getTradeById($idTrade, $pendente = false) {
        $this->db->join('trade_pictures', 'trade_id = trade_pic_idtrade', 'left');
        $this->db->where('trade_id',$idTrade);
        if($pendente) {
            $this->db->where('trade_status','0');
        }
        $trade = $this->db->get('trades');

        if($trade && $trade->num_rows() > 0) {
            return $trade->row();
        }
        
        return FALSE;
    }

    public function getTradeOffer($idTradeOffer){
        $this->db->where('trade_offer_id', $idTradeOffer);
        $offer = $this->db->get('trade_offers');

        if($offer && $offer->num_rows() > 0){
            return $offer->row();
        }

        return FALSE;
    }

    public function updateTradeOffer($idTradeOffer, $db){
        $this->db->where('trade_offer_id', $idTradeOffer);
        $this->db->update('trade_offers', $db);
    }
}