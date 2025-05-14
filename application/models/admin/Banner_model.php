<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $Title = getStringClean(($this->input->post('Title') != '') ? $this->input->post('Title') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetBanner( '$PageSize','$CurrentPage','$Title','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['Title'] = getStringClean((isset($array['Title'])) ? $array['Title'] : '');
        $array['Image'] = getStringClean((isset($array['Image'])) ? $array['Image'] : '');
        $array['SequenceNo'] = getStringClean((isset($array['SequenceNo'])) ? $array['SequenceNo'] : 0);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddBanner('" .
                $array['Title'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['Image']."','".
                $array['SequenceNo']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['Title'] = getStringClean((isset($array['Title'])) ? $array['Title'] : '');
        $array['Image'] = getStringClean((isset($array['Image'])) ? $array['Image'] : '');
        $array['SequenceNo'] = getStringClean((isset($array['SequenceNo'])) ? $array['SequenceNo'] : 0);
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_A_EditBanner('" .
                $array['Title'] . "','" .
                $array['ModifiedBy'] . "','" .
                $array['Status'] . "','" .
                $array['ID'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['Image']."','".
                $array['SequenceNo']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_A_GetBannerByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
