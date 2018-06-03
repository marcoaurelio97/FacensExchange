<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_trade_offer extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function addTrade($tradeOffer){
        $this->db->insert('trade_offer', $tradeOffer);
    }

    public function updateTradeOffer($idTradeOffer, $db){
        $this->db->where('trade_offer_id', $idTradeOffer);
        $this->db->update('trade_offers', $db);
    }

}