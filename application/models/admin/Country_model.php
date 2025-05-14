<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Country_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $CountryName = getStringClean(($this->input->post('CountryName') != '') ? $this->input->post('CountryName') : '');
        $SortName = getStringClean(($this->input->post('SortName') != '') ? $this->input->post('SortName') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_GetCountry( '$PageSize' , '$CurrentPage','$SortName','$CountryName','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array){
        $array['CountryName'] = getStringClean((isset($array['CountryName'])) ? $array['CountryName'] : '');
        $array['SortName'] = getStringClean((isset($array['SortName'])) ? $array['SortName'] : '');
        $array['MobileCode'] = getStringClean((isset($array['MobileCode'])) ? $array['MobileCode'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_AddCountry('" .
                $array['CountryName'] . "','" .
                $array['SortName'] . "','" .
                $array['MobileCode'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array){
        $array['CountryName'] = getStringClean((isset($array['CountryName'])) ? $array['CountryName'] : '');
        $array['SortName'] = getStringClean((isset($array['SortName'])) ? $array['SortName'] : '');
        $array['MobileCode'] = getStringClean((isset($array['MobileCode'])) ? $array['MobileCode'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_EditCountry('" .
                $array['CountryName'] . "','" .
                $array['SortName'] . "','" .
                $array['MobileCode'] . "','" .
                $array['ModifiedBy'] . "','" .
                $array['ID'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0){
        $sql = "call usp_GetCountryByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
