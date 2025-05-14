<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $PageID = ($this->input->post('PageID') != '') ? $this->input->post('PageID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_GetCms('$PageSize', '$CurrentPage','$PageID','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['PageID'] = (isset($array['PageID'])) ? $array['PageID'] : 0;
        $array['Content']   =  getStringClean((isset($array['Content']))?$array['Content']:NULL);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_AddCms('".
            $array['PageID']."','".
            $array['Content']."','".
            $array['CreatedBy']."','".
            $array['Status']."','".
            $array['UserType']."','".
            $array['IPAddress']."')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['PageID'] = (isset($array['PageID'])) ? $array['PageID'] : 0;
        $array['Content']   =  getStringClean((isset($array['Content']))?$array['Content']:NULL);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_EditCms('".
                $array['ID']."','".
                $array['PageID']."','".
                $array['Content']."','".
                $array['ModifiedBy']."','".
                $array['Status']."','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_GetCmsByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
    public function GetByName($PageName = '') {
        $sql = "call usp_GetCmsByPageName('$PageName')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
