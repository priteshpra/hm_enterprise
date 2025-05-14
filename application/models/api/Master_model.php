<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_model extends CI_Model 
{
    function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    // Start : Result as per Sp query 
    public function getQueryResult($sql){  
        try{
            $query = $this->db->query($sql);
            $query->next_result();        
            return $query->result();
        }catch(Exection $e){
            return '';
        }
    }
    
    // Start : Result as per Sp query 
    public function getInlineQuery($sql){  
        try{
            $query = $this->db->query($sql);
            return $query->result();
        }catch(Exection $e){
            return '';
        }
    }
    
    // Start : Result as per Sp query 
    public function getInlineQueryNoResult($sql){  
        try{
            $query = $this->db->query($sql);
            return 1; //$query->result();
        }catch(Exection $e){
            return '';
        }
    }

    function get_emailtemplate($id){ 
        $sql = "call usp_GetEmailTemplateDetailByID('".$id."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row_array();
    }
    function get_smstemplate($id){ 
        $sql = "call usp_GetSmstemplateByID('".$id."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row_array();
    }

    public function userSocialMediaLogin($data) {
        
        if(!isset($data->EmailID)) $data->EmailID=''; 
        if(!isset($data->MobileNo)) $data->MobileNo='';
        if(!isset($data->file_name)) $data->file_name='';
        if(!isset($data->UserType)) $data->UserType='';

        $sql = "call usp_M_UserSocialMediaLogin('".$data->FirstName."','". 
                                                        $data->LastName."','". 
                                                        $data->EmailID."','". 
                                                        $data->MobileNo."','" . 
                                                        $data->RegistrationType."','" . 
                                                        $data->RegistrationID."','". 
                                                        base_url()."','". 
                                                        $data->file_name."','" . 
                                                        $data->UserType."')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
}