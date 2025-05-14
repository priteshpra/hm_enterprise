<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Errorlog_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function ListData($PageSize = 10, $CurrentPage = 1) {
        $MethodName = ($this->input->post('MethodName') != '') ? $this->input->post('MethodName') : '';
        $ActivityDate = ($this->input->post('ActivityDate') != '') ? GetDateInFormat($this->input->post('ActivityDate'),DATE_FORMAT,DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $sql = "call usp_GetErrorLog( '$PageSize' , '$CurrentPage','$MethodName' ,'$ActivityDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
}
