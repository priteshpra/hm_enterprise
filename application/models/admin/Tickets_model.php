<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tickets_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1, $SiteName)
    {
        $RoleID = $this->session->RoleID;
        $UserID = $this->session->UserID;
        if ($RoleID == -1) {
            $UserID = $this->session->UserID;
        } else {
            $UserID = -1;
        }
        $Category = getStringClean(($this->input->post('Category') != '') ? $this->input->post('Category') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $RoleName = ($this->input->post('RoleName') != '') ? $this->input->post('RoleName') : '';
        $sql = "call usp_A_GetTicket( '$PageSize' , '$CurrentPage', '-1','-1','".$RoleName."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['Name'] = getStringClean((isset($array['Name'])) ? $array['Name'] : '');
        $array['SubjectID'] = getStringClean((isset($array['SubjectID'])) ? $array['SubjectID'] : '');
        $array['CityID'] = getStringClean((isset($array['CityID'])) ? $array['CityID'] : '');
        $array['PriorityID'] = getStringClean((isset($array['PriorityID'])) ? $array['PriorityID'] : '');
        $array['Description'] = getStringClean((isset($array['Description'])) ? $array['Description'] : '');
        $array['UserID'] = $this->session->userdata['UserID'];
        $array['Image'] = getStringClean((isset($array['Image'])) ? $array['Image'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserID'];
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddTicket('" .
            $array['UserID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Name'] . "','" .
            $array['Description'] . "','" .
            $array['PriorityID'] . "','" .
            $array['Image'] . "','" .
            $array['SubjectID'] . "','" .
            $array['CityID'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array)
    {
        //print_r($array);exit();
        $array['Name'] = getStringClean((isset($array['Name'])) ? $array['Name'] : '');
        $array['PriorityID'] = getStringClean((isset($array['PriorityID'])) ? $array['PriorityID'] : '');
        $array['Description'] = getStringClean((isset($array['Description'])) ? $array['Description'] : '');
        $array['CityID'] = getStringClean((isset($array['CityID'])) ? $array['CityID'] : '');
        $array['UserID'] = $this->session->userdata['UserID'];
        $array['ID'] = getStringClean((isset($array['TicketID'])) ? $array['TicketID'] : 0);
        $array['Image'] = getStringClean((isset($array['Image'])) ? $array['Image'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
      
        $array['UserType'] = $this->session->userdata['UserID'];    
        $array['IPAddress'] = GetIP();

         $sql = "call usp_A_EditTicket('" .
            $array['Name'] . "','" .
            $array['UserID'] . "','" .          
            $array['Description'] . "','" .
            $array['UserType'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['PriorityID'] . "','" .  
            $array['Image'] . "','" .            
            $array['CityID'] . "')";


        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0)
    {
        $sql = "call usp_A_GetTicketsByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

   public function changeStatus($category_array) {
        //print_r($category_array);exit();
          $category_array['ID']  = (isset($category_array['ID'])) ? $category_array['ID'] : NULL;
        $category_array['modified_by']     = (isset($category_array['modified_by'])) ? $category_array['modified_by'] : NULL;
        $category_array['Status']  = (isset($category_array['Status'])) ? $category_array['Status'] : NULL;

        $category_array['table_name']   = "ss_ticket";
        $category_array['field_name']   = "TicketID";
        $category_array['modified_by']  = $this->session->userdata['UserID'];
        return $this->db->query("call usp_ChangeStatus('" . $category_array['table_name'] . "','" . $category_array['field_name'] . "','" . $category_array['ID'] . "','" . $category_array['Status'] . "','" . $category_array['modified_by'] . "');");
    }
}
