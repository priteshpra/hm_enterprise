<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inspection_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $UserID = ($this->input->post('UserID') != '') ? $this->input->post('UserID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetInspection('$PageSize','$CurrentPage','$UserID','$Status')";
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
        $array['UserID'] = $this->session->userdata['UserID'];
        $array['SitesID'] = getStringClean((isset($array['SitesID'])) ? $array['SitesID'] : 0);
        $array['FieldOperatorID'] = getStringClean((isset($array['FieldOperatorID'])) ? $array['FieldOperatorID'] : 0);
        $array['QualityManagerID'] = getStringClean((isset($array['QualityManagerID'])) ? $array['QualityManagerID'] : 0);
        $array['OperationManagerID'] = getStringClean((isset($array['OperationManagerID'])) ? $array['OperationManagerID'] : 0);
        $array['Remarks'] = getStringClean((isset($array['Remarks'])) ? $array['Remarks'] : '');
        $array['Image'] = getStringClean((isset($array['Image'])) ? $array['Image'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddInspection('" .
                $array['UserID'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress'] . "','".
                $array['SitesID']."','".
                $array['FieldOperatorID']."','".
                $array['QualityManagerID']."','".
                $array['OperationManagerID']."','".
                $array['Remarks']."','".
                $array['Image']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
    function InsertAnswer($array) {
        $array['InspectionID'] = getStringClean((isset($array['InspectionID'])) ? $array['InspectionID'] : 0);
        $array['QuestionID'] = getStringClean((isset($array['QuestionID'])) ? $array['QuestionID'] : 0);
        $array['Answer'] = getStringClean((isset($array['Answer'])) ? $array['Answer'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddInspectionAnswer('" .
                $array['InspectionID'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress'] . "','".
                $array['QuestionID']."','".
                $array['Answer']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
}
