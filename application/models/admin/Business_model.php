<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Business_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function ListData($array=array()) {
        $FECode = (@$array['FECode'] != '') ? @$array['FECode'] : '';
        $StartDate = (@$array['StartDate'] != '') ? @$array['StartDate'] : '2021-01-01 00:00:00';
        $EndDate = (@$array['EndDate'] != '') ? @$array['EndDate'] :  date('Y-m-d h:i:s');
        $FECode = (@$array['FECode'] != '') ? @$array['FECode'] : '';
        $Status = (@$array['Status'] != '') ? @$array['Status'] : -1;
        $PageSize = (@$array['PageSize'] != '') ? @$array['PageSize'] : '-1';
        $CurrentPage = (@$array['CurrentPage'] != '') ? @$array['CurrentPage'] : '1';
        $sql = "call usp_A_GetBusiness('$PageSize', '$CurrentPage','$FECode','$StartDate','$EndDate','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    function getSummery($data=array()) {
        $FECode = isset($data['FECode'])?$data['FECode']:'';
        $Type = isset($data['Type'])?$data['Type']:'';
        $StartDate = (@$array['StartDate'] != '') ? @$array['StartDate'] : '';
        $EndDate = (@$array['EndDate'] != '') ? @$array['EndDate'] : '';
        
        $sql = "call usp_A_GetBusinessSummery('$FECode', '$Type','$StartDate','$EndDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    

    function Insert($array) {
        $array['FECode'] = getStringClean((isset($array['FECode'])) ? $array['FECode'] : '');
        $array['FEName'] = getStringClean((isset($array['FEName'])) ? $array['FEName'] : '');
        $array['Branch'] = getStringClean((isset($array['Branch'])) ? $array['Branch'] : '');
        $array['Date'] = getStringClean((isset($array['Date'])) ? $array['Date'] : '');
        $array['LENew'] = getStringClean((isset($array['LENew'])) ? $array['LENew'] : '');
        $array['LERenew'] = getStringClean((isset($array['LERenew'])) ? $array['LERenew'] : '');
        $array['DDDone'] = getStringClean((isset($array['DDDone'])) ? $array['DDDone'] : '');
        $array['DDPositive'] = getStringClean((isset($array['DDPositive'])) ? $array['DDPositive'] : '');
        $array['GRT'] = getStringClean((isset($array['GRT'])) ? $array['GRT'] : '');
        $array['DisbClient'] = getStringClean((isset($array['DisbClient'])) ? $array['DisbClient'] : '');
        $array['DisbAmount'] = getStringClean((isset($array['AchLENew'])) ? $array['AchLENew'] : '');
        $array['AchLENew'] = getStringClean((isset($array['LENew'])) ? $array['LENew'] : '');
        $array['AchLERenew'] = getStringClean((isset($array['AchLERenew'])) ? $array['AchLERenew'] : '');
        $array['AchDDDone'] = getStringClean((isset($array['AchDDDone'])) ? $array['AchDDDone'] : '');
        $array['AchDDPositive'] = getStringClean((isset($array['AchDDPositive'])) ? $array['AchDDPositive'] : '');
        $array['AchGRT'] = getStringClean((isset($array['AchGRT'])) ? $array['AchGRT'] : '');
        $array['AchDisbClient'] = getStringClean((isset($array['AchDisbClient'])) ? $array['AchDisbClient'] : '');
        $array['AchDisbAmount'] = getStringClean((isset($array['AchDisbAmount'])) ? $array['AchDisbAmount'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddBusiness('" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['Date'] . "','" .
                $array['FECode'] . "','" .
                $array['FEName'] . "','" .
                $array['Branch'] . "','" .
                $array['LENew'] . "','" .
                $array['LERenew'] . "','" .
                $array['TotalLE'] . "','" .
                $array['DDDone'] . "','" .
                $array['DDPositive'] . "','" .
                $array['GRT'] . "','" .
                $array['DisbClient'] . "','" .
                $array['DisbAmount'] . "','" .
                $array['AchLENew'] . "','" .
                $array['AchLERenew'] . "','" .
                $array['AchTotalLE'] . "','" .
                $array['AchDDDone'] . "','" .
                $array['AchDDPositive'] . "','" .
                $array['AchGRT'] . "','" .
                $array['AchDisbClient'] . "','" .
                $array['AchDisbAmount'] . "')";
        $query = $this->db->query($sql);
        $query->next_result(); 
        return $query->row();
    }

    function Truncate() {
        $this->db->truncate('ss_business');
    }
}
