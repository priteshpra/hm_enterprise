<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activitylog_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function ListData($PageSize = 10, $CurrentPage = 1) {
        $UserID = ($this->input->post('UserID') != '') ? $this->input->post('UserID') : -1;
		$ActivitylogName = ($this->input->post('ActivitylogName') != '') ? $this->input->post('ActivitylogName') : '';
        $ActivityDate = ($this->input->post('ActivityDate') != '') ? GetDateInFormat($this->input->post('ActivityDate'),DATE_FORMAT,DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $sql = "call usp_GetActivityLog( '$PageSize' , '$CurrentPage','$ActivitylogName' ,'$ActivityDate','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
}
