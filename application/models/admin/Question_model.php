<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Question_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $Question = getStringClean((isset($array['Question'])) ? $array['Question'] : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetQuestion( '$PageSize','$CurrentPage','$Question','$Status', '-1' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['Question'] = getStringClean((isset($array['Question'])) ? $array['Question'] : '');
        $array['Questionoption'] = getStringClean((isset($array['Questionoption'])) ? $array['Questionoption'] : '');
        $array['Type'] = getStringClean((isset($array['Type'])) ? $array['Type'] : '');
        $array['Question'] = getStringClean((isset($array['Question'])) ? $array['Question'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddQuestion('" .
            $array['Question'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Questionoption'] . "','" .
            $array['Type'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array)
    {
        $array['Question'] = getStringClean((isset($array['Question'])) ? $array['Question'] : '');
        $array['Questionoption'] = getStringClean((isset($array['Questionoption'])) ? $array['Questionoption'] : '');
        $array['Type'] = getStringClean((isset($array['Type'])) ? $array['Type'] : '');
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_EditQuestion('" .
            $array['Question'] . "','" .
            $array['ModifiedBy'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Questionoption'] . "','" .
            $array['Type'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0)
    {
        $sql = "call usp_A_GetQuestionByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
}
