<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salary_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $UserID = ($this->input->post('UserID') != '') ? $this->input->post('UserID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetSalary('$PageSize','$CurrentPage','$UserID','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    
    function ListDataByDate()
    {
        $StartDate = ($this->input->post('StartDate') != '') ? GetDateInFormat($this->input->post('StartDate'), DATE_FORMAT, DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $EndDate = ($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT)  : DEFAULT_DATE;

        $UserID = ($this->input->post('UserID') != '') ? $this->input->post('UserID') : -1;
        $sql = "call usp_A_GetEmployeeAttendanceByFromToDateByUserID('$StartDate','$EndDate','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function Insert($array=array()) {
        $array['UserID'] = getStringClean((isset($array['UserID'][0])) ? $array['UserID'][0] : 0);
        $array['PayAmount'] = getStringClean((isset($array['PayAmount'])) ? $array['PayAmount'] : 0);
        $array['Penalty'] = getStringClean((isset($array['Penalty'])) ? $array['Penalty'] : 0);
        $array['SalaryDate'] = GetDateInFormat(date('d-m-Y'), DATE_FORMAT, DATABASE_DATE_FORMAT);
        $array['StartDate'] = ($array['StartDate'] != '') ? GetDateInFormat($array['StartDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['EndDate'] = ($array['EndDate'] != '') ? GetDateInFormat($array['EndDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['Present'] = getStringClean((isset($array['Present'])) ? $array['Present'] : 0);
        $array['Absent'] = getStringClean((isset($array['Absent'])) ? $array['Absent'] : 0);
        $array['HalfDay'] = getStringClean((isset($array['HalfDay'])) ? $array['HalfDay'] : 0);
        $array['HalfOverTime'] = getStringClean((isset($array['HalfOverTime'])) ? $array['HalfOverTime'] : 0);
        $array['FullOverTime'] = getStringClean((isset($array['FullOverTime'])) ? $array['FullOverTime'] : 0);
        $array['Rate'] = getStringClean((isset($array['Rate'])) ? $array['Rate'] : 0);

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddSalary('" .
                $array['UserID'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress'] . "','".
                $array['SalaryDate']."','".
                $array['StartDate']."','".
                $array['EndDate']."','".
                $array['Present']."','".
                $array['Absent']."','".
                $array['HalfDay']."','".
                $array['HalfOverTime']."','".
                $array['FullOverTime']."','".
                $array['Rate']."','".
                $array['Penalty']."','".
                $array['PayAmount']."')";
                
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    
    function InsertAdvance($array=array()) {
        $array['UserID'] = getStringClean((isset($array['UserID'][0])) ? $array['UserID'][0] : 0);
        $array['Amount'] = getStringClean((isset($array['AdvanceAmount'])) ? $array['AdvanceAmount'] : 0);
        $array['AdvanceDate'] = GetDateInFormat((isset($array['Date'])?$array['Date']:date('d-m-Y')), DATE_FORMAT, DATABASE_DATE_FORMAT);
        $array['Type'] = getStringClean((isset($array['Advance'])) ? $array['Advance'] : '');

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddAdvance('" .
                $array['UserID'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress'] . "','".
                $array['Amount']."','".
                $array['AdvanceDate']."','".
                $array['Type']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
}
