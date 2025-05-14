<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emailtemplate_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $EmailTemplateTitle=getStringClean(($this->input->post('EmailTemplateTitle')!='')?$this->input->post('EmailTemplateTitle'):'');
        $EmailSubject=getStringClean(($this->input->post('EmailSubject')!='')?$this->input->post('EmailSubject'):'');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_GetEmailTemplate('$PageSize', '$CurrentPage','$EmailTemplateTitle','$EmailSubject','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['EmailTemplateTitle']   =   (isset($array['EmailTemplateTitle']))?$array['EmailTemplateTitle']:NULL; 
        $array['EmailSubject']   =   (isset($array['EmailSubject']))?$array['EmailSubject']:NULL;             
        $array['Content']   =  getStringClean((isset($array['Content']))?$array['Content']:NULL);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_AddEmailTemplate('".
            $array['EmailTemplateTitle']."','".
            $array['EmailSubject']."','".
            $array['Content']."','".
            $array['CreatedBy']."','".
            $array['Status']."','".
            $array['UserType']."','".
            $array['IPAddress']."')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['EmailTemplateTitle']   =   (isset($array['EmailTemplateTitle']))?$array['EmailTemplateTitle']:NULL; 
        $array['EmailSubject']   =   (isset($array['EmailSubject']))?$array['EmailSubject']:NULL;             
        $array['Content']   =   getStringClean((isset($array['Content']))?$array['Content']:NULL);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_EditEmailTemplate('".$array['EmailTemplateTitle']."','".
                $array['EmailSubject']."','".
                $array['Content']."','".
                $array['ModifiedBy']."','".
                $array['Status']."','".
                $array['ID']."','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_GetEmailTemplateByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
