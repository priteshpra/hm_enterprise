<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Smstemplate_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $SmsTemplateTitle = getStringClean(($this->input->post('SmsTemplateTitle')!='')?$this->input->post('SmsTemplateTitle'):'');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_GetSmsTemplate('$PageSize', '$CurrentPage','$SmsTemplateTitle','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['SmsTemplateTitle'] = (isset($array['SmsTemplateTitle']))?$array['SmsTemplateTitle']:NULL; 
        $array['SmsMessage'] = (isset($array['SmsMessage']))?$array['SmsMessage']:NULL;             
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_AddSmsTemplate('".
            $array['SmsTemplateTitle']."','".
            $array['SmsMessage']."','".
            $array['Status']."','".
            $array['CreatedBy']."','".
            $array['UserType']."','".
            $array['IPAddress']."')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['SmsTemplateTitle'] = (isset($array['SmsTemplateTitle']))?$array['SmsTemplateTitle']:NULL; 
        $array['SmsMessage'] = (isset($array['SmsMessage']))?$array['SmsMessage']:NULL;             
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_EditSmsTemplate('".$array['SmsTemplateTitle']."','".
                $array['SmsMessage']."','".
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
        $sql = "call usp_GetSmsTemplateByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
