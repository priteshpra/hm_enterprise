<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subcategory_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $SubCategoryName = getStringClean(($this->input->post('SubCategoryName') != '') ? $this->input->post('SubCategoryName') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $CategoryID = ($this->input->post('CategoryID') != '') ? $this->input->post('CategoryID') : -1;
        
        $sql = "call usp_A_GetSubCategory( '$PageSize' , '$CurrentPage','$SubCategoryName','$Status','$CategoryID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['SubCategoryName'] = getStringClean((isset($array['SubCategoryName'])) ? $array['SubCategoryName'] : '');
        $array['CategoryID'] = getStringClean((isset($array['CategoryID'])) ? $array['CategoryID'] : 0);

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddSubCategory('" .
                $array['SubCategoryName'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['CategoryID']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        
        $array['SubCategoryName'] = getStringClean((isset($array['SubCategoryName'])) ? $array['SubCategoryName'] : '');
        $array['CategoryID'] = getStringClean((isset($array['CategoryID'])) ? $array['CategoryID'] : 0);
       
        $array['StateID'] = (isset($array['StateID'])) ? $array['StateID'] : 0;
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_A_EditSubCategory('" .
                $array['SubCategoryName'] . "','" .
                $array['ModifiedBy'] . "','" .
                $array['Status'] . "','" .
                $array['ID'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['CategoryID']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_A_GetSubCategoryByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   

    function GetSubMenu($ID) {       
        $sql = "call usp_A_GetMenuSubCategoryParentIDZero('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function GetSubSubMenu($ID) {       
        $sql = "call usp_A_GetMenuSubCategory('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
}
