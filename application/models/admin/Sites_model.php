<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sites_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $SiteName = getStringClean(($this->input->post('SiteName') != '') ? $this->input->post('SiteName') : '');
        $VisitorID = getStringClean(($this->input->post('VisitorID') != '') ? $this->input->post('VisitorID') : -1);
        //$CityID = getStringClean(($this->input->post('CityID') != '') ? $this->input->post('CityID') : -1);
        $CityID = $this->CityID;
        $CustomerID = ($this->input->post('CustomerID') != '') ? $this->input->post('CustomerID') : -1;
        $ServiceID = ($this->input->post('ServiceID') != '') ? $this->input->post('ServiceID') : -1;

        $ProposedStartDate   = ($this->input->post('ProposedStartDate') != '') ? GetDateInFormat($this->input->post('ProposedStartDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '';
        $ProposedEndDate   = ($this->input->post('ProposedEndDate') != '') ? GetDateInFormat($this->input->post('ProposedEndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '';
        $SiteType = ($this->input->post('SiteType') != '') ? $this->input->post('SiteType') : 'All';

        $sql = "call usp_A_GetSites('$PageSize','$CurrentPage','$SiteName','$VisitorID','-1','$ProposedStartDate','$ProposedEndDate','$SiteType','$ServiceID','$CityID','')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['Name'] = getStringClean((isset($array['Name'])) ? $array['Name'] : '');
        $array['SiteName'] = getStringClean((isset($array['SiteName'])) ? $array['SiteName'] : '');
        $array['WorkingDays'] = getStringClean((isset($array['WorkingDays'])) ? $array['WorkingDays'] : '1');
        $array['WorkingHours'] = getStringClean((isset($array['WorkingHours'])) ? $array['WorkingHours'] : '1');
        $array['GSTNo'] = getStringClean((isset($array['GSTNo'])) ? $array['GSTNo'] : '');
        $array['SiteType'] = getStringClean((isset($array['SiteType'])) ? $array['SiteType'] : '');
        $array['ProposedDate']   = ($array['ProposedDate'] != '') ? GetDateInFormat($array['ProposedDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['StartDate']   = ($array['StartDate'] != '') ? GetDateInFormat($array['StartDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['EndDate']   = ($array['EndDate'] != '') ? GetDateInFormat($array['EndDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;

        $array['VisitorID'] = getStringClean((isset($array['VisitorID'])) ? $array['VisitorID'] : 0);
        $array['CustomerID'] = getStringClean((isset($array['CustomerID'])) ? $array['CustomerID'] : 0);

        $array['Address'] = getStringClean((isset($array['Address'])) ? $array['Address'] : '');
        $array['Address2'] = getStringClean((isset($array['Address2'])) ? $array['Address2'] : '');
        $array['PinCode'] = getStringClean((isset($array['PinCode'])) ? $array['PinCode'] : '');
        $array['CityID'] = getStringClean((isset($array['CityID'])) ? $array['CityID'] : 0);
        $array['StateID'] = getStringClean((isset($array['StateID'])) ? $array['StateID'] : 0);
        $array['ServiceID'] = getStringClean((isset($array['ServiceID'])) ? $array['ServiceID'] : 0);

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddSites('" .
            $array['CreatedBy'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['VisitorID'] . "','" .
            $array['CustomerID'] . "','" .
            $array['SiteName'] . "','" .
            $array['Name'] . "','" .
            $array['SiteType'] . "','" .
            $array['Address'] . "','" .
            $array['WorkingHours'] . "','" .
            $array['WorkingDays'] . "','" .
            $array['ProposedDate'] . "','" .
            $array['StartDate'] . "','" .
            $array['EndDate'] . "','" .
            $array['GSTNo'] . "','" .
            $array['Address2'] . "','" .
            $array['CityID'] . "','" .
            $array['StateID'] . "','" .
            $array['PinCode'] . "','" .
            $array['ServiceID'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array)
    {
        $array['Name'] = getStringClean((isset($array['Name'])) ? $array['Name'] : '');

        $array['SiteName'] = getStringClean((isset($array['SiteName'])) ? $array['SiteName'] : '');
        $array['WorkingDays'] = getStringClean((isset($array['WorkingDays'])) ? $array['WorkingDays'] : '');
        $array['WorkingHours'] = getStringClean((isset($array['WorkingHours'])) ? $array['WorkingHours'] : '');
        $array['GSTNo'] = getStringClean((isset($array['GSTNo'])) ? $array['GSTNo'] : '');
        $array['SiteType'] = getStringClean((isset($array['SiteType'])) ? $array['SiteType'] : '');
        $array['ProposedDate']   = ($array['ProposedDate'] != '') ? GetDateInFormat($array['ProposedDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['StartDate']   = ($array['StartDate'] != '') ? GetDateInFormat($array['StartDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['EndDate']   = ($array['EndDate'] != '') ? GetDateInFormat($array['EndDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;

        $array['Address'] = getStringClean((isset($array['Address'])) ? $array['Address'] : '');
        $array['Address1'] = getStringClean((isset($array['Address1'])) ? $array['Address1'] : '');
        $array['PinCode'] = getStringClean((isset($array['PinCode'])) ? $array['PinCode'] : '');
        $array['CityID'] = getStringClean((isset($array['CityID'])) ? $array['CityID'] : 0);
        $array['StateID'] = getStringClean((isset($array['StateID'])) ? $array['StateID'] : 0);

        $array['VisitorID'] = getStringClean((isset($array['VisitorID'])) ? $array['VisitorID'] : 0);
        $array['CustomerID'] = getStringClean((isset($array['CustomerID'])) ? $array['CustomerID'] : 0);

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_EditSites('" .
            $array['SiteName'] . "','" .
            $array['ModifiedBy'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Name'] . "','" .
            $array['SiteType'] . "','" .
            $array['Address'] . "','" .
            $array['WorkingHours'] . "','" .
            $array['WorkingDays'] . "','" .
            $array['ProposedDate'] . "','" .
            $array['StartDate'] . "','" .
            $array['EndDate'] . "','" .
            $array['GSTNo'] . "','" .
            $array['Address2'] . "','" .
            $array['CityID'] . "','" .
            $array['StateID'] . "','" .
            $array['PinCode'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0)
    {
        $sql = "call usp_A_GetSitesByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getSites($array)
    {
        $city_id = isset($array['CityID']) ? $array['CityID'] : '-1';
        $visitor_id = isset($array['VisitorID']) ? $array['VisitorID'] : '0';
        $sql = "call usp_A_GetSites('-1','1','','" . $visitor_id . "','','','All','-1','" . $city_id . "','-1','')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
}
