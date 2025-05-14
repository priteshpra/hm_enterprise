<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Document_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $SiteID = ($this->input->post('SiteID') != '') ? $this->input->post('SiteID') : -1;
        $CustomerID = ($this->input->post('CustomerID') != '') ? $this->input->post('CustomerID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetCustomerSitesDocument('$PageSize','$CurrentPage','$SiteID','$Status','$CustomerID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function ItemListData($PageSize = 10, $CurrentPage = 1)
    {
        $InspectionID = ($this->input->post('InspectionID') != '') ? $this->input->post('InspectionID') : -1;
        $sql = "call usp_A_GetInspectionAnswer('$PageSize','$CurrentPage','$InspectionID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    
    function Insert($array) {
        $array['SitesID'] = getStringClean((isset($array['SitesID'])) ? $array['SitesID'] : 0);
        $array['Title'] = getStringClean((isset($array['Title'])) ? $array['Title'] : 0);
        $array['Document'] = getStringClean((isset($array['Document'])) ? $array['Document'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddCustomerSitesDocument('" .
                $array['SitesID'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress'] . "','".
                $array['Title']."','".
                $array['Document']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    

    public function Update($array) {
        $array['Title']   =   (isset($array['Title']))?$array['Title']:NULL;
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        
        $sql ="call usp_A_EditCustomerSitesDocument('".
                $array['Title']."','".
                $array['ModifiedBy']."','".
                $array['Status']."','".
                $array['ID']."','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['Document']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
    public function GetByID($ID = 0) {
        $sql = "call usp_A_GetCustomerSitesDocumentByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
