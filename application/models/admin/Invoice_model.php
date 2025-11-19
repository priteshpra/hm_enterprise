<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice_model extends CI_Model
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

        $sql = "call usp_A_GetInvoice( '$PageSize','$CurrentPage','$SitesID','$Status','$QuotationID','$CustomerID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function ListInvoiceAttendance($PageSize = 10, $CurrentPage = 1)
    {
        $StartDate = ($this->input->post('StartDate') != '') ? GetDateInFormat($this->input->post('StartDate'), DATE_FORMAT, DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $EndDate = ($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $QuotationID = ($this->input->post('QuotationID') != '') ? $this->input->post('QuotationID') : -1;

        //this was only for users, material was not included
        $sql = "call usp_A_GetInvoiceAttendance( '$QuotationID','$StartDate','$EndDate')";

        //this is for user and material both
        //$sql = "call usp_A_GetInvoiceAttendanceWithMaterial( '$QuotationID','$StartDate','$EndDate')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function ListInvoiceMaterial($PageSize = 10, $CurrentPage = 1)
    {
        $StartDate = ($this->input->post('StartDate') != '') ? GetDateInFormat($this->input->post('StartDate'), DATE_FORMAT, DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $EndDate = ($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $QuotationID = ($this->input->post('QuotationID') != '') ? $this->input->post('QuotationID') : -1;

        $sql = "call usp_A_GetInvoiceMaterial( '$QuotationID','$StartDate','$EndDate')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['CustomerID'] = getStringClean((isset($array['CustomerID'])) ? $array['CustomerID'] : 0);
        $array['SitesID'] = getStringClean((isset($array['SitesID'])) ? $array['SitesID'] : 0);
        $array['QuotationID'] = getStringClean((isset($array['QuotationID'])) ? $array['QuotationID'] : 0);

        $array['StartDate']   = ($array['StartDate'] != '') ? GetDateInFormat($array['StartDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['EndDate']   = ($array['EndDate'] != '') ? GetDateInFormat($array['EndDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['InvoiceDate']   = ($array['InvoiceDate'] != '') ? GetDateInFormat($array['InvoiceDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;

        $array['Total'] = getStringClean((isset($array['TotalAmount'])) ? $array['TotalAmount'] : 0);
        $array['SubTotal'] = getStringClean((isset($array['SubTotal'])) ? $array['SubTotal'] : 0);
        $array['SGST'] = getStringClean((isset($array['SGST'])) ? $array['SGST'] : 0);
        $array['CGST'] = getStringClean((isset($array['CGST'])) ? $array['CGST'] : 0);
        $array['IGST'] = getStringClean((isset($array['IGST'])) ? $array['IGST'] : 0);

        $array['Notes'] = getStringClean((isset($array['Notes'])) ? $array['Notes'] : '');
        $array['Terms'] = getStringClean((isset($array['Terms'])) ? $array['Terms'] : '');

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['AppointmentID'] = getStringClean((isset($array['AppointmentID'])) ? $array['AppointmentID'] : 0);
        $array['CurrentLocation'] = isset($array['CurrentLocation']) ? $array['CurrentLocation'] : '';
        $array['CompanyID'] = getStringClean((isset($array['CompanyID'])) ? $array['CompanyID'] : 0);
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddInvoice('" .
            $array['CustomerID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['SitesID'] . "','" .
            $array['CompanyID'] . "','" .
            $array['QuotationID'] . "','" .
            $array['StartDate'] . "','" .
            $array['EndDate'] . "','" .
            $array['Total'] . "','" .
            $array['CGST'] . "','" .
            $array['SGST'] . "','" .
            $array['IGST'] . "','" .
            $array['Notes'] . "','" .
            $array['Terms'] . "','" .
            $array['InvoiceDate'] . "','" .
            $array['SubTotal'] . "','" .
            $array['AppointmentID'] . "','" .
            $array['CurrentLocation'] . "'
            )";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function InsertItem($array)
    {
        $array['InvoiceID'] = getStringClean((isset($array['InvoiceID'])) ? $array['InvoiceID'] : 0);
        $array['UsertypeID'] = getStringClean((isset($array['UsertypeID'])) ? $array['UsertypeID'] : 0);
        $array['Description'] = getStringClean((isset($array['Description'])) ? $array['Description'] : '');
        $array['HSN_SAC'] = getStringClean((isset($array['HSN_SAC'])) ? $array['HSN_SAC'] : '');
        $array['Qty'] = getStringClean((isset($array['Qty'])) ? $array['Qty'] : 0);
        $array['Rate'] = getStringClean((isset($array['Rate'])) ? $array['Rate'] : 0);
        $array['Amount'] = getStringClean((isset($array['Amount'])) ? $array['Amount'] : 0);

        $array['Status'] = 1;
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddInvoiceItem('" .
            $array['InvoiceID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['UsertypeID'] . "','" .
            $array['Qty'] . "','" .
            $array['Rate'] . "','" .
            $array['Amount'] . "')";

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
