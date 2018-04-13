<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exchange extends CI_Controller {

    public function tradeDetails(){
        $this->load->view('trade_details_view');
    }
    
    
}
