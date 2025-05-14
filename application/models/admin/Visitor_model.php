<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitor_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $EmailID = getStringClean(($this->input->post('EmailID') != '') ? $this->input->post('EmailID') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $CityID = $this->CityID;

        $sql = "call usp_A_GetVisitor( '$PageSize','$CurrentPage','$Name','$EmailID','$Status','$CityID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['Name'] = getStringClean((isset($array['Name'])) ? $array['Name'] : '');
        $array['EmailID'] = getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : '');
        $array['MobileNo'] = getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : '');
        $array['Address'] = getStringClean((isset($array['Address'])) ? $array['Address'] : '');
        $array['CityID'] = getStringClean((isset($array['CityID'])) ? $array['CityID'] : 0);
        $array['StateID'] = getStringClean((isset($array['StateID'])) ? $array['StateID'] : '');
        $array['PinCode'] = getStringClean((isset($array['PinCode'])) ? $array['PinCode'] : '');
        $array['LeadType'] = getStringClean((isset($array['LeadType'])) ? $array['LeadType'] : '');
        
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddVisitor('" .
            $array['CreatedBy'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Name'] . "','" .
            $array['EmailID'] . "','" .
            $array['MobileNo'] . "','" .
            $array['Address'] . "','" .
            $array['StateID'] . "','" .
            $array['CityID'] . "','" .
            $array['PinCode'] . "','" .
            $array['LeadType'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array)
    {
        $array['Name'] = getStringClean((isset($array['Name'])) ? $array['Name'] : '');
        $array['EmailID'] = getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : '');
        $array['MobileNo'] = getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : '');
        $array['Address'] = getStringClean((isset($array['Address'])) ? $array['Address'] : '');
        $array['CityID'] = getStringClean((isset($array['CityID'])) ? $array['CityID'] : 0);
        $array['StateID'] = getStringClean((isset($array['StateID'])) ? $array['StateID'] : '');
        $array['PinCode'] = getStringClean((isset($array['PinCode'])) ? $array['PinCode'] : '');
        $array['LeadType'] = getStringClean((isset($array['LeadType'])) ? $array['LeadType'] : '');

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_EditVisitor('" .
            $array['Name'] . "','" .
            $array['ModifiedBy'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['EmailID'] . "','" .
            $array['MobileNo'] . "','" .
            $array['Address'] . "','" .
            $array['StateID'] . "','" .
            $array['CityID'] . "','" .
            $array['PinCode'] . "','" .
            $array['LeadType'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0)
    {
        $sql = "call usp_A_GetVisitorByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function checkMobileNo($MobileNo = 0)
    {
        $sql = "call usp_A_GetVisitorByMobileNo('$MobileNo')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

}
