<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usertype_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $UsertypeData = getStringClean(($this->input->post('UsertypeData') != '') ? $this->input->post('UsertypeData') : '');
        $IsMaterial = ($this->input->post('IsMaterial') != '') ? $this->input->post('IsMaterial') : 0;
        $ServiceID = ($this->input->post('ServiceID') != '') ? $this->input->post('ServiceID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetUsertype('$PageSize' , '$CurrentPage','$UsertypeData','$IsMaterial','$ServiceID','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    function ListUserData($PageSize = 10, $CurrentPage = 1) {
        $UsertypeData = getStringClean(($this->input->post('UsertypeData') != '') ? $this->input->post('UsertypeData') : '');
        $IsMaterial = 0;
        $ServiceID = ($this->input->post('ServiceID') != '') ? $this->input->post('ServiceID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetUsertype('$PageSize' , '$CurrentPage','$UsertypeData','$IsMaterial','$ServiceID','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    function ListMaterialData($PageSize = 10, $CurrentPage = 1) {
        $UsertypeData = getStringClean(($this->input->post('UsertypeData') != '') ? $this->input->post('UsertypeData') : '');
        $IsMaterial = 1;
        $ServiceID = ($this->input->post('ServiceID') != '') ? $this->input->post('ServiceID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetUsertype('$PageSize' , '$CurrentPage','$UsertypeData','$IsMaterial','$ServiceID','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['UsertypeData'] = getStringClean((isset($array['UsertypeData'])) ? $array['UsertypeData'] : '');
        $array['HSNNo'] = getStringClean((isset($array['HSNNo'])) ? $array['HSNNo'] : '');
        $array['Rate'] = getStringClean((isset($array['Rate'])) ? $array['Rate'] : 0);
        $array['IsMaterial'] = getStringClean((isset($array['IsMaterial']) && $array['IsMaterial'] == 'on') ? ACTIVE : INACTIVE);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddUsertype('" .
                $array['UsertypeData'] . "','" .
                $array['HSNNo'] . "','" .
                $array['Rate'] . "','" .
                $array['IsMaterial'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['UsertypeData'] = getStringClean((isset($array['UsertypeData'])) ? $array['UsertypeData'] : '');
        $array['HSNNo'] = getStringClean((isset($array['HSNNo'])) ? $array['HSNNo'] : '');
        $array['Rate'] = getStringClean((isset($array['Rate'])) ? $array['Rate'] : 0);
        $array['IsMaterial'] = getStringClean((isset($array['IsMaterial']) && $array['IsMaterial'] == 'on') ? ACTIVE : INACTIVE);
        $array['StateID'] = (isset($array['StateID'])) ? $array['StateID'] : 0;
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_A_EditUsertype('" .
                $array['UsertypeData'] . "','" .
                $array['HSNNo'] . "','" .
                $array['Rate'] . "','" .
                $array['IsMaterial'] . "','" .
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
        $sql = "call usp_A_GetUsertypeByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
