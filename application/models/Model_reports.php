<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reports extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    public function addReportItem($report){
        $this->db->insert('itens_reports', $report);
    }

    public function addReportProfile($report){
        $this->db->insert('profiles_reports', $report);
    }

    public function updateReportItem($idReport, $db_report){
        $this->db->where('rep_id', $idReport);
        $this->db->update('itens_reports', $db_report);
    }

    public function updateReportProfile($idReport, $db_report){
        $this->db->where('rep_id', $idReport);
        $this->db->update('profiles_reports', $db_report);
    }
}