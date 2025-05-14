<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teamdefination_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $SitesID = ($this->input->post('SitesID') != '') ? $this->input->post('SitesID') : -1;
        $QuotationID = ($this->input->post('QuotationID') != '') ? $this->input->post('QuotationID') : -1;
        $CustomerID = ($this->input->post('CustomerID') != '') ? $this->input->post('CustomerID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;

        $sql = "call usp_A_GetTeamDefinition( '$PageSize','$CurrentPage','$SitesID','$Status','$QuotationID','$CustomerID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function ListDataByDate($PageSize = 10, $CurrentPage = 1)
    {
        $SitesID = ($this->input->post('SitesID') != '') ? $this->input->post('SitesID') : -1;
        $QuotationID = ($this->input->post('QuotationID') != '') ? $this->input->post('QuotationID') : -1;
        $CustomerID = ($this->input->post('CustomerID') != '') ? $this->input->post('CustomerID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $AttendanceDate = ($this->input->post('AttendanceDate') != '') ? $this->input->post('AttendanceDate') : '';

        $sql = "call usp_A_GetTeamDefinitionByDate( '$PageSize','$CurrentPage','$SitesID','$Status','$QuotationID','$CustomerID','$AttendanceDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['UserID'] = getStringClean((isset($array['UserID'])) ? $array['UserID'] : 0);
        $array['SitesID'] = getStringClean((isset($array['SitesID'])) ? $array['SitesID'] : 0);
        $array['QuotationID'] = getStringClean((isset($array['QuotationID'])) ? $array['QuotationID'] : 0);
        $array['StartDate']   = ($array['StartDate'] != '') ? GetDateInFormat($array['StartDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['EndDate']   = ($array['EndDate'] != '') ? GetDateInFormat($array['EndDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['StartTime'] = getStringClean((isset($array['StartTime'])) ? $array['StartTime'] : '');
        $array['EndTime'] = getStringClean((isset($array['EndTime'])) ? $array['EndTime'] : '');
        $array['Type'] = getStringClean((isset($array['Type'])) ? $array['Type'] : 'New');
        
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddTeamdefination('" .
            $array['UserID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['SitesID'] . "','" .
            $array['QuotationID'] . "','" .
            $array['StartDate'] . "','" .
            $array['StartTime'] . "','" .
            $array['EndDate'] . "','" .
            $array['EndTime'] . "','" .
            $array['Type'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0)
    {
        $sql = "call usp_A_GetQuotationByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

}
