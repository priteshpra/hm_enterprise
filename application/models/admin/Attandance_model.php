<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attandance_model extends CI_Model
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

        $sql = "call usp_A_GetAttendanceByAttendance( '$PageSize','$CurrentPage','$SitesID','$Status','$QuotationID','$CustomerID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function MenuListData($PageSize = 10, $CurrentPage = 1)
    {
        $StartDate = ($this->input->post('StartDate') != '') ? GetDateInFormat($this->input->post('StartDate'), DATE_FORMAT, DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $EndDate = ($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT)  : DEFAULT_DATE;

        $sql = "call usp_A_GetEmployeeAttendanceByFromToDate( '$PageSize','$CurrentPage','$StartDate','$EndDate')";
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
        $AttendanceDate = ($this->input->post('AttendanceDate') != '') ? $this->input->post('AttendanceDate') : date('Y-m-d');

        $sql = "call usp_A_GetTeamDefinitionByDate( '$PageSize','$CurrentPage','$SitesID','$Status','$QuotationID','$CustomerID','$AttendanceDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function ListGlobalDataByDate($PageSize = 10, $CurrentPage = 1)
    {
        $CityID = $this->CityID;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $AttendanceDate = ($this->input->post('AttendanceDate') != '') ? $this->input->post('AttendanceDate') : date('Y-m-d');

        $sql = "call usp_GetEmployeeForGlobalAttendance( '$PageSize','$CurrentPage','$CityID','$AttendanceDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['SitesID'] = getStringClean((isset($array['SitesID'])) ? $array['SitesID'] : 0);
        $array['QuotationID'] = getStringClean((isset($array['QuotationID'])) ? $array['QuotationID'] : 0);
        $array['UserID'] = getStringClean((isset($array['UserID'])) ? $array['UserID'] : 0);
        $array['Attendance'] = getStringClean((isset($array['Attendance'])) ? $array['Attendance'] : 'P');
        $array['AttendanceDate']   = ($array['AttendanceDate'] != '') ? GetDateInFormat($array['AttendanceDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['Overtime'] = getStringClean((isset($array['Overtime'])) ? $array['Overtime'] : 0);

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddEmployeeAttendance('" .
            $array['UserID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['AttendanceDate'] . "','" .
            $array['Attendance'] . "','" .
            $array['SitesID'] . "','" .
            $array['QuotationID'] . "','" .
            $array['Overtime'] . "')";

            

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
