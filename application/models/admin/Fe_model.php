<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fe_model extends CI_Model 
{
    function __construct(){
        parent::__construct();
        $this->load->helper('common_helper');
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_GetFEByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function GetUserByFEcode($FECode = '') {
        $sql = "call usp_GetUserByFEcode('$FECode')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function changePassword($data = array()) {
        $data['NewPassword'] = fnEncrypt($data['NewPassword']);
        $data['OPassword'] = fnEncrypt($data['Password']);
        $sql = "call usp_ChangePassword('" . 
                $data['UserID'] . "','" .
                $data['OPassword'] . "','" . 
                $data['NewPassword'] . "')";
        $query = $this->db->query($sql);
        $query->next_result(); 
        return $query->row_array();
    }
    /* public function checkLogin($login_data_array){
        $login_data_array['email'] = @$login_data_array['FECode'];
        $login_data_array['password'] = @$login_data_array['Password'];

        $sql = "call usp_A_FELogin('".
                    $login_data_array['email'] . "','".
                    fnEncrypt($login_data_array['password']).
                "')";
        $query = $this->db->query($sql);
        $query->next_result($sql);        
        $user_data = $query->result_array();
        return $user_data;
    }
    

    public function resetPassword($data){
        $sql = "call usp_ResetPassword('".
                    $data['FECode'] . "','".
                    fnEncrypt($data['Password']).
                "')";
        $query = $this->db->query($sql);
        $query->next_result($sql);        
        $user_data = $query->result_array();
        return $user_data;
    } */
}