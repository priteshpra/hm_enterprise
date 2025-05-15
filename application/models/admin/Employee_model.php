<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $EmailID = getStringClean(($this->input->post('EmailID') != '') ? $this->input->post('EmailID') : '');
        $IsDeleted = ($this->input->post('IsDeleted') != '') ? $this->input->post('IsDeleted') : -1;
        $sql = "call usp_GetEmployee( '$PageSize' , '$CurrentPage','$Name','$EmailID','$IsDeleted', '783', '-1')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['FirstName'] = getStringClean((isset($array['FirstName'])) ? $array['FirstName'] : '');
        $array['LastName'] = getStringClean((isset($array['LastName'])) ? $array['LastName'] : '');
        $array['EmailID'] = getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : '');
        $array['MobileNo'] = getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : '');
        $array['Address'] = getStringClean((isset($array['Address'])) ? $array['Address'] : '');
        $array['Password'] = (isset($array['Password'])) ? fnEncrypt(getStringClean($array['Password'])) : '';

        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_AddEmployee('" .
            $array['FirstName'] . "','" .
            $array['LastName'] . "','" .
            $array['EmailID'] . "','" .
            $array['Password'] . "','" .
            $array['MobileNo'] . "','" .
            $array['Address'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array)
    {
        $array['FirstName'] = getStringClean((isset($array['FirstName'])) ? $array['FirstName'] : '');
        $array['LastName'] = getStringClean((isset($array['LastName'])) ? $array['LastName'] : '');
        $array['MobileNo'] = getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : '');
        $array['Address'] = getStringClean((isset($array['Address'])) ? $array['Address'] : '');
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_EditEmployee('" .
            $array['UserID'] . "','" .
            $array['FirstName'] . "','" .
            $array['LastName'] . "','" .
            $array['MobileNo'] . "','" .
            $array['Address'] . "','" .
            $array['ModifiedBy'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0)
    {
        $sql = "call usp_GetEmployeeByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function ChangePassword($array)
    {
        $sql = "call usp_ChangePassword('" .
            $array['UserID'] . "','-1','" .
            fnEncrypt($array['Passowrd']) . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row_array();
    }
}
