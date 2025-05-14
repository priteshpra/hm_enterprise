<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitorreminder_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $VisitorID = ($this->input->post('VisitorID') != '') ? $this->input->post('VisitorID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetVisitorReminder('$PageSize','$CurrentPage','$VisitorID','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {

        $array['VisitorID']   =   (isset($array['VisitorID'])) ? $array['VisitorID'] : 0;
        $array['Message']   =   getStringClean((isset($array['Message'])) ? $array['Message'] : '');
        $array['ReminderTime']     = (isset($array['ReminderTime']))    ? $array['ReminderTime'] . ":00"  : '00:00:00';
        $str = $array['ReminderDate'] . " " . $array['ReminderTime'];
        $array['ReminderDate']     = (isset($array['ReminderDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;
        $array['PastTime']     = (isset($array['PastTime']))    ? $array['PastTime'] . ":00"  : '00:00:00';
        $str = $array['PastDate'] . " " . $array['PastTime'];
        $array['PastDate']     = (isset($array['PastDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;

        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['IPAddress'] = GetIP();
        $array['usertype'] = 'Admin Web';

        $sql = "call usp_A_AddVisitorReminder('" .
            $array['VisitorID'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Message'] . "','" .
            $array['ReminderDate'] . "','" .
            $array['PastDate'] . "');";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array)
    {
        $array['Message']   =   getStringClean((isset($array['Message'])) ? $array['Message'] : '');
        $array['ReminderTime']     = (isset($array['ReminderTime']))    ? $array['ReminderTime'] . ":00"  : '00:00:00';
        $str = $array['ReminderDate'] . " " . $array['ReminderTime'];
        $array['ReminderDate']     = (isset($array['ReminderDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;

        $array['PastTime']     = (isset($array['PastTime']))    ? $array['PastTime'] . ":00"  : '00:00:00';
        $str1 = $array['PastDate'] . " " . $array['PastTime'];
        $array['PastDate']     = (isset($array['PastDate'])) ? GetDateTimeInFormat($str1, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;

        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_EditVisitorReminder('" .
            $array['Message'] . "','" .
            $array['ModifiedBy'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['PastDate'] . "','" .
            $array['ReminderDate'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }


    function addReminders($array)
    {
        //print_r($array);exit;
        $array['SiteID'] = $this->session->userdata('SiteID');
        $array['QuotationID'] = $this->session->userdata('QuotationID');
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $array['Category'] = getStringClean((isset($array['Category'])) ? $array['Category'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $array['ReminderTime']     = (isset($array['ReminderTime']))    ? $array['ReminderTime'] . ":00"  : '00:00:00';
        $str = $array['ReminderDate'] . " " . $array['ReminderTime'];
        $str = !empty($str) ? $str : '';
        $array['ReminderDate']     = (isset($array['ReminderDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;
        $array['PastTime']     = (isset($array['PastTime']))    ? $array['PastTime'] . ":00"  : '00:00:00';
        $str = $array['PastDate'] . " " . $array['PastTime'];
        $str = !empty($str) ? $str : '';
        $array['PastDate']     = (isset($array['PastDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;

        $sql = "call usp_A_AddCustomerPaymentReminder('" .
            $array['SiteID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Message'] . "','" .
            $array['ReminderDate'] . "','" .
            $array['PastDate'] . "','" .
            $array['Amount'] . "','" .
            $array['QuotationID'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function updateReminders($array)
    {
        $array['SiteID'] = $this->session->userdata('SiteID');
        $array['QuotationID'] = $this->session->userdata('QuotationID');
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $array['Category'] = getStringClean((isset($array['Category'])) ? $array['Category'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
       /* echo "ECHO IN MODEL<pre>";
        print_r($array);
        die;*/
         $array['ReminderDate']     = (isset($array['ReminderDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;
        $array['PastTime']     = (isset($array['PastTime']))    ? $array['PastTime'] . ":00"  : '00:00:00';
        $str = $array['PastDate'] . " " . $array['PastTime'];
        $array['PastDate']     = (isset($array['PastDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;
        $sql = "call usp_A_AddCustomerPaymentReminder('" .
            $array['SiteID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Message'] . "','" .
            $array['ReminderDate'] . "','" .
            $array['PastDate'] . "','" .
            $array['Amount'] . "','" .
            $array['QuotationID'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }


    public function GetByID($ID = 0)
    {
        $sql = "call usp_A_GetVisitorReminderByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
}
