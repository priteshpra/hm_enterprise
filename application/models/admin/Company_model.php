<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $CompanyName = getStringClean(($this->input->post('CompanyName') != '') ? $this->input->post('CompanyName') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetCompany( '$PageSize' , '$CurrentPage','$CompanyName','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {

        $array['Service'] = getStringClean((isset($array['Service'])) ? $array['Service'] : '');
        $array['Qty'] = getStringClean((isset($array['Qty'])) ? $array['Qty'] : '');
        $array['Rate'] = getStringClean((isset($array['Rate'])) ? $array['Rate'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddService('" .
                $array['Service'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['Qty']."','".
                $array['Rate']."')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {

        $array['Service'] = getStringClean((isset($array['Service'])) ? $array['Service'] : '');
        $array['Qty'] = getStringClean((isset($array['Qty'])) ? $array['Qty'] : '');
        $array['Rate'] = getStringClean((isset($array['Rate'])) ? $array['Rate'] : '');
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql ="call usp_A_EditService('" .
                $array['Service'] . "','" .
                $array['ModifiedBy'] . "','" .
                $array['Status'] . "','" .
                $array['ID'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['Qty']."','".
                $array['Rate']."')";
                
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_A_GetServiceByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
