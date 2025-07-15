<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notes_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function GetByType($Type = '')
    {
        $Type = getStringClean(($this->input->post('Type') != '') ? $this->input->post('Type') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_getNotes('$Type','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
}
