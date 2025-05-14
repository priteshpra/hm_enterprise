<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class State_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $StateName = getStringClean(($this->input->post('StateName') != '') ? $this->input->post('StateName') : '');
        $CountryID = getStringClean(($this->input->post('CountryID') != '') ? $this->input->post('CountryID') : -1);
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_GetState( '$PageSize' , '$CurrentPage','$StateName','$CountryID','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['StateName'] = getStringClean((isset($array['StateName'])) ? $array['StateName'] : '');
        $array['CountryID'] = getStringClean((isset($array['CountryID'])) ? $array['CountryID'] : 0);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_AddState('" .
                $array['StateName'] . "','" .
                $array['CountryID'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['StateName'] = getStringClean((isset($array['StateName'])) ? $array['StateName'] : '');
        $array['CountryID'] = getStringClean((isset($array['CountryID'])) ? $array['CountryID'] : 0);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_EditState('" .
                $array['StateName'] . "','" .
                $array['CountryID'] . "','" .
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
        $sql = "call usp_GetStateByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
