<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class City_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $CityName = getStringClean(($this->input->post('CityName') != '') ? $this->input->post('CityName') : '');
        $CountryID = ($this->input->post('CountryID') != '') ? $this->input->post('CountryID') : -1;
        $StateID = ($this->input->post('StateID') != '') ? $this->input->post('StateID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_GetCity( '$PageSize' , '$CurrentPage','$CityName','$StateID','$CountryID','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['CityName'] = getStringClean((isset($array['CityName'])) ? $array['CityName'] : '');
        $array['StateID'] = getStringClean((isset($array['StateID'])) ? $array['StateID'] : 0);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_AddCity('" .
                $array['CityName'] . "','" .
                $array['StateID'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['CityName'] = getStringClean((isset($array['CityName'])) ? $array['CityName'] : '');
        $array['StateID'] = (isset($array['StateID'])) ? $array['StateID'] : 0;
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_EditCity('" .
                $array['CityName'] . "','" .
                $array['StateID'] . "','" .
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
        $sql = "call usp_GetCityByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
