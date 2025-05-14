<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Goalsheet_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function ListData($array=array()) {
        $FECode = ($array['FECode'] != '') ? $array['FECode'] : '';
        $Branch = (@$array['Branch'] != '') ? $array['Branch'] : '';
        $Status = (@$array['Status'] != '') ? $array['Status'] : -1;
        
        $PageSize = (@$array['PageSize'] != '') ? $array['PageSize'] : '-1';
        $CurrentPage = (@$array['CurrentPage'] != '') ? $array['CurrentPage'] : '1';
        $sql = "call usp_A_GetGoalSheet('$PageSize', '$CurrentPage','$FECode','$Branch','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
}
