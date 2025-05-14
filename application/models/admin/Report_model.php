<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function TrainingListData($PageSize = 10, $CurrentPage = 1)
    {
        $FromDate = getStringClean(($this->input->post('FromDate') != '') ? GetDateInFormat($this->input->post('FromDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $EndDate = getStringClean(($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');

        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetReportEmployeeTraining( '$PageSize' , '$CurrentPage','$Status','$FromDate','$EndDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function UniformListData($PageSize = 10, $CurrentPage = 1)
    {
        $FromDate = getStringClean(($this->input->post('FromDate') != '') ? GetDateInFormat($this->input->post('FromDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $EndDate = getStringClean(($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');

        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetReportEmployeeUniform( '$PageSize' , '$CurrentPage','$Status','$FromDate','$EndDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function AttendanceListData($PageSize = 10, $CurrentPage = 1)
    {
        $FromDate = getStringClean(($this->input->post('FromDate') != '') ? GetDateInFormat($this->input->post('FromDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $EndDate = getStringClean(($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $UserID = ($this->input->post('UserID') != '') ? $this->input->post('UserID') : -1;

        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetReportEmployeeAttendance( '$PageSize' , '$CurrentPage','$Status','$FromDate','$EndDate','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function PaymentListData($PageSize = 10, $CurrentPage = 1)
    {
        $FromDate = getStringClean(($this->input->post('FromDate') != '') ? GetDateInFormat($this->input->post('FromDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $EndDate = getStringClean(($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $SitesID = ($this->input->post('SitesID') != '') ? $this->input->post('SitesID') : -1;
        $QuotationID = ($this->input->post('QuotationID') != '') ? $this->input->post('QuotationID') : -1;

        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetReportCustomerPayment( '$PageSize' , '$CurrentPage','$SitesID','$Status','$QuotationID','$FromDate','$EndDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
}
