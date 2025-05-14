<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $EmailID = getStringClean(($this->input->post('EmailID') != '') ? $this->input->post('EmailID') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $CityID = $this->CityID;

        $sql = "call usp_A_GetCustomer( '$PageSize','$CurrentPage','$Name','$EmailID','$Status','$CityID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    
    public function GetByID($ID = 0)
    {
        $sql = "call usp_A_GetCustomerByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

}
