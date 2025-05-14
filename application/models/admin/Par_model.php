<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Par_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function ListData($array=array()) {
        $FECode = (@$array['FECode'] != '') ? @$array['FECode'] : '';
        $CenterName = (@$array['CenterName'] != '') ? @$array['CenterName'] : '';
        $LoanID = (@$array['LoanID'] != '') ? @$array['LoanID'] : '';
        $ClientID = (@$array['ClientID'] != '') ? @$array['ClientID'] : '';
        $ClientName = (@$array['ClientName'] != '') ? @$array['ClientName'] : '';
        $Bucket = (@$array['Bucket'] != '') ? @$array['Bucket'] : '';
        $Status = (@$array['Status'] != '') ? @$array['Status'] : -1;
        
        $PageSize = (@$array['PageSize'] != '') ? $array['PageSize'] : '-1';
        $CurrentPage = (@$array['CurrentPage'] != '') ? $array['CurrentPage'] : '1';
        $sql = "call usp_A_GetPar('$PageSize', '$CurrentPage','$FECode','$CenterName','$LoanID','$ClientID','$ClientName','$Bucket','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    function parSummery($array=array()) {
        $FECode = (@$array['FECode'] != '') ? $array['FECode'] : '';
        $Bucket = (@$array['Bucket'] != '') ? $array['Bucket'] : '';
        $Status = (@$array['Status'] != '') ? $array['Status'] : -1;
        
        $sql = "call usp_A_GetFEParSummery('$FECode','$Status','$Bucket')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    function Insert($array) {
        $array['FECode'] = getStringClean((isset($array['FECode'])) ? $array['FECode'] : '');
        $array['FEName'] = getStringClean((isset($array['FEName'])) ? $array['FEName'] : '');
        $array['Branch'] = getStringClean((isset($array['Branch'])) ? $array['Branch'] : '');
        $array['Center'] = getStringClean((isset($array['Center'])) ? $array['Center'] : '');
        $array['LoanID'] = getStringClean((isset($array['LoanID'])) ? $array['LoanID'] : '');
        $array['ClientID'] = getStringClean((isset($array['ClientID'])) ? $array['ClientID'] : '');
        $array['ClientName'] = getStringClean((isset($array['ClientName'])) ? $array['ClientName'] : '');
        $array['DPD'] = getStringClean((isset($array['DPD'])) ? $array['DPD'] : '');
        $array['Bucket'] = getStringClean((isset($array['Bucket'])) ? $array['Bucket'] : '');
        $array['Amount'] = getStringClean((isset($array['Amount'])) ? $array['Amount'] : '');
        $array['ODAmount'] = getStringClean((isset($array['ODAmount'])) ? $array['ODAmount'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddPar('" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['FECode'] . "','" .
                $array['FEName'] . "','" .
                $array['Branch'] . "','" .
                $array['Center'] . "','" .
                $array['LoanID'] . "','" .
                $array['ClientID'] . "','" .
                $array['ClientName'] . "','" .
                $array['DPD'] . "','" .
                $array['Bucket'] . "','" .
                $array['Amount'] . "','" .
                $array['ODAmount'] . "')";
        $query = $this->db->query($sql);
        $query->next_result(); 
        return $query->row();
    }

    function Truncate() {
        $this->db->truncate('ss_par');
        /* $sql = "call usp_A_TruncatePar()";
        $query = $this->db->query($sql);
        $query->next_result(); 
        //return $query->row(); */
    }
}