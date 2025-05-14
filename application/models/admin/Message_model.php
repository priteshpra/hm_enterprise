<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $Message=getStringClean(($this->input->post('Message')!='')?$this->input->post('Message'):'');     
        $sql = "call usp_GetMessage('$PageSize' , '$CurrentPage','$Message')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function Update($array) {
        $array['Language'] = getStringClean((isset($array['Language'])) ? $array['Language'] : 0);
        $array['MessageKey'] = getStringClean((isset($array['MessageKey'])) ? $array['MessageKey'] : NULL);
        $array['Message'] = getStringClean((isset($array['Message'])) ? $array['Message'] : NULL);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_EditMessage('" .
                $array['Message'] . "','" .
                $array['ModifiedBy']."','".
                $array['ID'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_GetMessageByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
