<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $InvoiceID = ($this->input->post('InvoiceID') != '') ? $this->input->post('InvoiceID') : -1;
        $CustomerID = ($this->input->post('CustomerID') != '') ? $this->input->post('CustomerID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;

        $sql = "call usp_A_GetPayment( '$PageSize','$CurrentPage','$InvoiceID','$Status','$CustomerID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['InvoiceID'] = getStringClean((isset($array['InvoiceID'])) ? $array['InvoiceID'] : 0);

        $array['PaymentDate']   = ($array['PaymentDate'] != '') ? GetDateInFormat($array['PaymentDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;

        $array['GSTAmount'] = getStringClean((isset($array['GSTAmount'])) ? $array['GSTAmount'] : 0);
        $array['PaymentAmount'] = getStringClean((isset($array['PaymentAmount'])) ? $array['PaymentAmount'] : 0);
        $array['AmountType'] = getStringClean((isset($array['AmountType'])) ? $array['AmountType'] : 0);
        $array['PaymentMode'] = getStringClean((isset($array['PaymentMode'])) ? $array['PaymentMode'] : '');
        $array['IGST'] = getStringClean((isset($array['IGST'])) ? $array['IGST'] : 0);
        $array['ChequeNo'] = getStringClean((isset($array['ChequeNo'])) ? $array['ChequeNo'] : '');
        $array['IFCCode'] = getStringClean((isset($array['IFCCode'])) ? $array['IFCCode'] : '');
        $array['AccountNo'] = getStringClean((isset($array['AccountNo'])) ? $array['AccountNo'] : '');
        $array['BankName'] = getStringClean((isset($array['BankName'])) ? $array['BankName'] : '');
        $array['BranchName'] = getStringClean((isset($array['BranchName'])) ? $array['BranchName'] : '');

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddCustomerPayment('" .
            $array['InvoiceID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['PaymentAmount'] . "','" .
            $array['GSTAmount'] . "','" .
            $array['AmountType'] . "','" .
            $array['PaymentDate'] . "','" .
            $array['PaymentMode'] . "','" .
            $array['ChequeNo'] . "','" .
            $array['IFCCode'] . "','" .
            $array['AccountNo'] . "','" .
            $array['BankName'] . "','" .
            $array['BranchName'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0)
    {
        $sql = "call usp_A_GetInvoiceByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
}
