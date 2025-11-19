<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quotation_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $SitesID = ($this->input->post('SitesID') != '') ? $this->input->post('SitesID') : -1;
        $VisitorID = ($this->input->post('VisitorID') != '') ? $this->input->post('VisitorID') : -1;
        $CustomerID = ($this->input->post('CustomerID') != '') ? $this->input->post('CustomerID') : -1;
        $sql = "call usp_A_GetQuotation( '$PageSize','$CurrentPage','$SitesID','$VisitorID','$CustomerID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function MenuListData($PageSize = 10, $CurrentPage = 1)
    {
        $SitesID = ($this->input->post('SitesID') != '') ? $this->input->post('SitesID') : -1;
        $VisitorID = ($this->input->post('VisitorID') != '') ? $this->input->post('VisitorID') : -1;
        $CustomerID = ($this->input->post('CustomerID') != '') ? $this->input->post('CustomerID') : -1;
        $QoutationStatus = ($this->input->post('QoutationStatus') != '') ? $this->input->post('QoutationStatus') : '';
        $CityID = ($this->input->post('CityID') != '') ? $this->input->post('CityID') : -1;

        $sql = "call usp_A_GetQuotationByStatus( '$PageSize','$CurrentPage','$SitesID','$VisitorID','$CustomerID','$QoutationStatus','$CityID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function ItemListData($PageSize = 10, $CurrentPage = 1)
    {
        $QuotationID = ($this->input->post('QuotationID') != '') ? $this->input->post('QuotationID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetQuotationItem( '$PageSize','$CurrentPage','$QuotationID','$Status','-1','-1')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['ServiceID'] = getStringClean((isset($array['ServiceID'])) ? $array['ServiceID'] : 1);
        $array['VisitorID'] = getStringClean((isset($array['VisitorID'])) ? $array['VisitorID'] : 1);
        $array['CustomerID'] = getStringClean((isset($array['CustomerID'])) ? $array['CustomerID'] : 1);
        $array['SitesID'] = getStringClean((isset($array['SitesID'])) ? $array['SitesID'] : 0);
        $array['CompanyID'] = getStringClean((isset($array['CompanyID'])) ? $array['CompanyID'] : 0);
        $array['EstimateDate']   = ($array['EstimateDate'] != '') ? GetDateInFormat($array['EstimateDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;

        $array['Address'] = getStringClean((isset($array['Address'])) ? $array['Address'] : '');
        $array['Address2'] = getStringClean((isset($array['Address2'])) ? $array['Address2'] : '');
        $array['PinCode'] = getStringClean((isset($array['PinCode'])) ? $array['PinCode'] : '');
        $array['CityID'] = getStringClean((isset($array['CityID'])) ? $array['CityID'] : 0);
        $array['StateID'] = getStringClean((isset($array['StateID'])) ? $array['StateID'] : 0);


        $array['SubTotal'] = getStringClean((isset($array['SubTotal'])) ? $array['SubTotal'] : 0);
        $array['CGST'] = getStringClean((isset($array['CGST'])) ? $array['CGST'] : 0);
        $array['SGST'] = getStringClean((isset($array['SGST'])) ? $array['SGST'] : 0);
        $array['IGST'] = getStringClean((isset($array['IGST'])) ? $array['IGST'] : 0);
        $array['Rounding'] = getStringClean((isset($array['Rounding'])) ? $array['Rounding'] : 0);
        $array['Total'] = getStringClean((isset($array['Total'])) ? $array['Total'] : 0);

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['StartDate'] = getStringClean((isset($array['StartDate'])) ? $array['StartDate'] : '');
        $array['EndDate'] = getStringClean((isset($array['EndDate'])) ? $array['EndDate'] : '');
        $array['QuotationType'] = getStringClean((isset($array['QuotationType'])) ? $array['QuotationType'] : '');
        $array['OTP'] = getStringClean((isset($array['OTP'])) ? $array['OTP'] : '');
        $array['AppointmentID'] = getStringClean((isset($array['AppointmentID'])) ? $array['AppointmentID'] : 0);
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddQuotation('" .
            $array['SitesID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['CompanyID'] . "','" .
            $array['EstimateDate'] . "','" .
            $array['Address'] . "','" .
            $array['Address2'] . "','" .
            $array['CityID'] . "','" .
            $array['StateID'] . "','" .
            $array['PinCode'] . "','" .
            $array['SubTotal'] . "','" .
            $array['CGST'] . "','" .
            $array['SGST'] . "','" .
            $array['IGST'] . "','" .
            $array['Rounding'] . "','" .
            $array['Total'] . "','" .
            $array['ServiceID'] . "','" .
            $array['VisitorID'] . "','" .
            $array['CustomerID'] . "','" .
            $array['Terms'] . "','" .
            $array['Notes'] . "','" .
            $array['Notes'] . "','" .
            $array['StartDate'] . "','" .
            $array['EndDate'] . "','" .
            $array['QuotationType'] . "','" .
            $array['OTP'] . "','" .
            $array['AppointmentID'] . "'
            )";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function InsertItem($array)
    {
        $array['QuotationID'] = getStringClean((isset($array['QuotationID'])) ? $array['QuotationID'] : 0);
        $array['UsertypeID'] = getStringClean((isset($array['UsertypeID'])) ? $array['UsertypeID'] : 0);
        $array['Description'] = getStringClean((isset($array['Description'])) ? $array['Description'] : '');
        $array['HSN_SAC'] = getStringClean((isset($array['HSN_SAC'])) ? $array['HSN_SAC'] : '');
        $array['Qty'] = getStringClean((isset($array['Qty'])) ? $array['Qty'] : 0);
        $array['Rate'] = getStringClean((isset($array['Rate'])) ? $array['Rate'] : 0);
        $array['Amount'] = getStringClean((isset($array['Amount'])) ? $array['Amount'] : 0);
        $array['Days'] = getStringClean((isset($array['Days'])) ? $array['Days'] : 0);
        $array['InstallationService'] = getStringClean((isset($array['InstallationService'])) ? $array['InstallationService'] : '');
        $array['Uom'] = getStringClean((isset($array['Uom'])) ? $array['Uom'] : '');

        $array['Status'] = 1;
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddQuotationItem('" .
            $array['QuotationID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['UsertypeID'] . "','" .
            $array['UsertypeID'] . "','" .
            $array['Qty'] . "','" .
            $array['Rate'] . "','" .
            $array['Amount'] . "','" .
            $array['Days'] . "','" .
            $array['InstallationService'] . "','" .
            $array['Uom'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function convertToCustomer($array)
    {
        $array['VisitorID'] = getStringClean((isset($array['VisitorID'])) ? $array['VisitorID'] : 0);

        $array['Status'] = 1;
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_ConvertToCustomer('" .
            $array['CreatedBy'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['VisitorID'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function convertToAccept($array)
    {
        $array['StartDate']     = (isset($array['StartDate']))    ? GetDateInFormat($array['StartDate'], DATE_FORMAT, DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $array['EndDate']     = (isset($array['EndDate']))    ? GetDateInFormat($array['EndDate'], DATE_FORMAT, DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $array['CustomerID'] = getStringClean((isset($array['CustomerID'])) ? $array['CustomerID'] : 0);
        $array['FieldOperatorID'] = getStringClean((isset($array['FieldOperatorID'])) ? $array['FieldOperatorID'] : 0);
        $array['QualityManagerID'] = getStringClean((isset($array['QualityManagerID'])) ? $array['QualityManagerID'] : 0);
        $array['OperationManagerID'] = getStringClean((isset($array['OperationManagerID'])) ? $array['OperationManagerID'] : 0);
        $array['TotalEmployee'] = getStringClean((isset($array['TotalEmployee'])) ? $array['TotalEmployee'] : 0);

        $array['Status'] = 1;
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_ConvertToQuotationAccept('" .
            $array['StartDate'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['QuotationID'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['EndDate'] . "','" .
            $array['CustomerID'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }


    function convertToReject($array)
    {
        $array['ReasonID'] = getStringClean((isset($array['Reason'])) ? $array['Reason'] : 0);

        $array['Status'] = 1;
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_ConvertToQuotationReject('" .
            $array['ReasonID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['QuotationID'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "')";

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

    public function GetItemByID($ID = 0)
    {
        $sql = "call usp_A_GetQuotationItemByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
}
