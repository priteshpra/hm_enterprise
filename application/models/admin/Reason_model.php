<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reason_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $Reason = getStringClean(($this->input->post('Reason') != '') ? $this->input->post('Reason') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetReason( '$PageSize','$CurrentPage','$Reason','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['Reason'] = getStringClean((isset($array['Reason'])) ? $array['Reason'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddReason('" .
                $array['Reason'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['Reason'] = getStringClean((isset($array['Reason'])) ? $array['Reason'] : '');
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_A_EditReason('" .
                $array['Reason'] . "','" .
                $array['ModifiedBy'] . "','" .
                $array['Status'] . "','" .
                $array['ID'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_A_GetReasonByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
