<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Config_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function getConfig(){
        $query = $this->db->query("call usp_GetConfig()");
        $query->next_result();
        return $query->row();
    }

    public function insertUpdateConfig($array) {
        $array['SupportEmail'] = (isset($array['SupportEmail'])) ? $array['SupportEmail'] : NULL;
        $array['MailFromName'] = (isset($array['MailFromName'])) ? $array['MailFromName'] : NULL;
        $array['EmailPassword'] = (isset($array['EmailPassword'])) ? $array['EmailPassword'] : NULL;
		$array['TimeZone'] = (isset($array['TimeZone'])) ? '+'.$array['TimeZone'] : NULL;
		$array['AppVersionAndroid'] = (isset($array['AppVersionAndroid'])) ? $array['AppVersionAndroid'] : 0;
        $array['AppVersionIOS'] = (isset($array['AppVersionIOS'])) ? $array['AppVersionIOS'] : 0;
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
        $array['Createdby'] = $this->session->userdata['UserID'];


		$query = "call usp_AddEditConfig('" .
            $array['SupportEmail'] . "','" .
            $array['MailFromName'] . "','" .
            $array['EmailPassword'] . "','" .
            $array['TimeZone'] . "','" .
            $array['AppVersionAndroid'] . "','" .
            $array['AppVersionIOS'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','".
            $array['Createdby'] . "','" . 
            $array['ID'] .
            "')";
            
        return $this->db->query($query);
    }

    

}
