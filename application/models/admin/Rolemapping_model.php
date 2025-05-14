<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rolemapping_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function ListData($PageSize = 10, $CurrentSize = 1) {
        $RoleID = $this->input->post('RoleID');
        $sql = "call usp_GetRolesMapping('$PageSize','$CurrentSize','$RoleID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }


    function Insert($array) {
        $array['UserID'] = isset($array['UserID']) ? $array['UserID'] : NULL;
        $array['RoleID'] = isset($array['RoleID']) ? $array['RoleID'] : NULL;
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "CALL usp_AddRoletoUser('".
                    $array['UserID']."','" .
                    $array['RoleID'] . "','" .
                    $array['CreatedBy'] . "','".
                    $array['UserType']."','".
                    $array['IPAddress']. 
                    "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    

    public function GetByID($id = 0) {
        $query = $this->db->query("CALL usp_GetRoleMappingByID($id)");
        $query->next_result();
        return $query->row();
    }
    function getUser() {
        $query = $this->db->query("call usp_GetUser_ComboBox()");
        $query->next_result();
        return $query->result();
    }

}
