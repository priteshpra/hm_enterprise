<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penlty_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetPenalty('$PageSize','$CurrentPage','$Status','-1')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function ItemListData($PageSize = 10, $CurrentPage = 1)
    {
        $PenaltyID = ($this->input->post('PenaltyID') != '') ? $this->input->post('PenaltyID') : -1;
        $sql = "call usp_A_GetPenaltyByItem('$PageSize','$CurrentPage','$PenaltyID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['Reason'] = getStringClean((isset($array['Reason'])) ? $array['Reason'] : '');
        $array['SiteID'] = getStringClean((isset($array['SiteID'])) ? $array['SiteID'] : 0);
        $array['PenaltyDate'] = ($array['PenaltyDate'] != '') ? GetDateInFormat($array['PenaltyDate'], DATE_FORMAT, DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddPenalty('" .
            $array['PenaltyDate'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['SiteID'] . "','" .
            $array['Reason'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function InsertItem($array)
    {
        $array['PenaltyID'] = getStringClean((isset($array['PenaltyID'])) ? $array['PenaltyID'] : '');
        $array['UserID'] = getStringClean((isset($array['UserID'])) ? $array['UserID'] : 0);
        $array['Penalty'] = getStringClean((isset($array['Penalty'])) ? $array['Penalty'] : 0);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddPenaltyitem('" .
            $array['PenaltyID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['UserID'] . "','" .
            $array['Penalty'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
}
