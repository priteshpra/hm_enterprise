<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_session_model extends CI_Model 
{
    function __construct(){
        parent::__construct();
        $this->load->helper('common_helper');
    }

    public function checkLogin($login_data_array){
        $login_data_array['email'] = isset($login_data_array['FECode'])?$login_data_array['FECode']:$login_data_array['email'];
        $login_data_array['password'] = isset($login_data_array['Password'])?$login_data_array['Password']:$login_data_array['password'];
        
        $sql = "call usp_CheckLogin('".
                    $login_data_array['email'] . "','".
                    fnEncrypt($login_data_array['password']).
                "')";
        $query = $this->db->query($sql);
        $query->next_result($sql);        
        $user_data = $query->result_array();
        if(!@$user_data[0]['Message']){
            $sql = "call usp_GetProfileByID('". $user_data[0]['ID']. "','".base_url()."')";
            $query = $this->db->query($sql);
            $query->next_result($sql);        
            $user_data = array();
            $user_data = $query->result_array();

            if(sizeof($user_data) > 0 && !empty($user_data) && @$user_data[0]['UserType'] == 'Admin'){ 
                $this->session->set_userdata($user_data[0]);
                $this->session->set_userdata('language', 'english');
                return $user_data;
            }
        }
        return $user_data;
    }
    
    public function editProfile($data){ 
        $data['FirstName'] = getStringClean((isset($data['FirstName'])) ? $data['FirstName'] : NULL);
        $data['LastName'] = getStringClean((isset($data['LastName'])) ? $data['LastName'] : NULL);
        $data['MobileNo'] = getStringClean((isset($data['MobileNo'])) ? $data['MobileNo'] : NULL);
        $data['ModifiedBy'] = $this->session->userdata['UserID'];       
        $data['UserID'] = $this->session->userdata['UserID'];
        $UserType = $this->session->userdata['UserType'] . " Web";
        $sql = "call usp_EditProfile('" . 
                $data['FirstName'] . "','" . 
                $data['LastName'] . "','" .
                $data['MobileNo'] . "','" . 
                $data['UserID'] . "','$UserType','".
                GetIP()
                ."')";
        $query = $this->db->query($sql);
        $query->next_result();        
        $user_data = $query->result_array();

        $sql = "call usp_GetProfileByID('". $user_data[0]['ID']. "','".base_url()."')";
        $query = $this->db->query($sql);
        $query->next_result($sql);        
        $user_data = array();
        $user_data = $query->result_array();

        if(sizeof($user_data) > 0 && !empty($user_data)){ 
            $this->session->set_userdata($user_data[0]);
            $this->session->set_userdata('language', 'english');
            return $user_data;
        }
        return array();        
    }
    public function checkIfCurrentPasswordMatches($password = '') {
        $data['Password'] = fnEncrypt($this->input->post('current_password'));
        $sql = "call usp_CheckCurrentPassword('" . 
                $this->session->userdata['UserID'] . "','" . 
                $data['Password'] . "')";
        $query = $this->db->query($sql);
        $query->next_result(); 
        return $query->row();
    }
    public function checkIfEmailIDIsRegistered($email_id = null) {
        $user_type = array();
        $query = $this->db->query("call usp_CheckUserExist('".$email_id."','Admin,Employee')");
        $query->next_result();
        $user_array = $query->row_array();
        if(@$user_array['ID']){
            return $user_array['ID'];
        }else{
            return 0;
        }
    }
    public function changePassword() {
        $data['ID'] = $this->session->userdata['UserID'];       
        $data['UserID'] = $this->session->userdata['UserID'];
        $data['NewPassword'] = fnEncrypt($this->input->post('new_password'));
        $data['OPassword'] = fnEncrypt($this->input->post('current_password'));
        $sql = "call usp_ChangePassword('" . 
                $data['ID'] . "','" .
                $data['OPassword'] . "','" . 
                $data['NewPassword'] . "')";
        $query = $this->db->query($sql);
        $query->next_result(); 
        return $query->row_array();
    }
    public function GetProfileByID($ID = 0){
        $ID = ($ID == 0)?$this->session->userdata['UserID']:$ID;
        $sql = "call usp_GetProfileByID('".$ID."','".base_url()."')";
        $query = $this->db->query($sql);                
        $query->next_result();
        return $query->row();
    }
    
    public function ForgotPassword($EmailID){
        $sql = "call usp_ForgotPassword('".
                            $EmailID.
                            "')";
		$query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
    public function ResetPassword($EmailID,$Password) {
        $sql = "call usp_ResetPassword('".$EmailID."','".fnEncrypt($Password)."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

}