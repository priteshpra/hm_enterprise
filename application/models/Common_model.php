<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    public function CheckDuplicate($data){
        $data['DataValue'] = getStringClean($data['DataValue']);
        $sql = "CALL usp_CheckDuplicate('". 
                $data['TableName'] ."','". 
                $data['DuplicateField'] . "','".
                $data['DataValue']."','".
                $data['UniqueField']."','". 
                $data['ID']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();   
    }
    public function CheckDuplicateDouble($data){
        $sql = "CALL usp_CheckDoubleDuplicate('". 
                $data['TableName'] ."','". 
                $data['DuplicateField'] . "','".
                $data['DataValue']."','".
                $data['SecondDuplicateField'] . "','".
                $data['SecondDataValue']."','".
                $data['UniqueField']."','". 
                $data['ID']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();   
    }
    public function ChangeStatus($data) {
        $sql = "CALL usp_ChangeStatus('".
                        $data['TableName']."','".
                        $data['UniqueField']."','".
                        $data['ID']."','".
                        $data['Status']."','".
                        $data['UserID']."');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();

    }
    public function GetEmailTemplate($ID){ 
        $sql = "CALL usp_GetEmailtemplateByID('".$ID."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row_array();
        
    }
    
    public function getDeviceInfo($ID){
        $query = $this->db->query("CALL usp_GetDeviceInfo('$ID')");
        $query->next_result();
        return $query->result();
    }
     
    public function getInlineQuery($sql){  
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function CheckEmailMobExist(){
        $EmailID = $this->input->post('EmailID');
        $MobileNo = $this->input->post('MobileNo');
        $ID = $this->input->post('ID');
        $sql = "CALL usp_CheckEmailMobExist('$EmailID','$MobileNo','$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function ChangePassword($data){
        if($data['OPassword'] == ""){
            $data['OPassword'] = -1;
        }
        $sql = "call usp_ChangePassword('" . 
                $data['ID'] . "','" .
                $data['OPassword'] . "','" . 
                $data['NewPassword'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function GetPatient($SearchText = ""){
        $query = $this->db->query("call usp_A_GetPatient_Combobox('$SearchText')");
        $query->next_result();
        return $query->result();
    }
    public function getRecentAppointment($data){
        $sql = "CALL usp_A_GetRecentAppointment('" .
                $data['PageSize']. "','".
                $data['CurrentPage'].  "');";
        $query = $this->db->query($sql);
        $query->next_result();        
        return $query->result();
    }

    function GetDashboard($array)
    {
        $array['FilterType'] = (!isset($array['FilterType']) || $array['FilterType'] == "") ? "Daily" : $array['FilterType'];

        if ($this->UserRoleID == -1 || $this->UserRoleID == -2) {
            $EmployeeID = '-1';
        } else {
            $EmployeeID = $this->session->userdata['UserID'];
        }
        
        $CityID = isset($data->CityID) ? $data->CityID :'-1';
        $sql = "call usp_MA_Dashboard('" .
            'Web' . "','" .
            $array['FilterType'] . "','" .
            $EmployeeID . "','".
            $CityID."')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function DashboardFollowUplistData($PageSize = 10, $CurrentPage = 1)
    {
        $array = $this->input->post();
        $array['FilterType'] = (!isset($array['FilterType']) || @$array['FilterType'] == "") ? "Daily" : @$array['FilterType'];

        if ($this->UserRoleID == -1 || $this->UserRoleID == -2) {
            $EmployeeID = '-1';
        } else {
            $EmployeeID = $this->session->userdata['UserID'];
        }

        $sql = "call usp_MA_DashboardVisitorFollowUpReport('" .
            $PageSize . "','" .
            $CurrentPage . "','" .
            $array['FilterType'] . "','" .
            $EmployeeID . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function DashboardVisitorlistData($PageSize = 10, $CurrentPage = 1)
    {
        $array = $this->input->post();
        $array['FilterType'] = (!isset($array['FilterType']) || @$array['FilterType'] == "") ? "Daily" : @$array['FilterType'];

        if ($this->UserRoleID == -1 || $this->UserRoleID == -2) {
            $EmployeeID = '-1';
        } else {
            $EmployeeID = $this->session->userdata['UserID'];
        }

        $sql = "call usp_MA_DashboardVisitorReport('" .
            $PageSize . "','" .
            $CurrentPage . "','" .
            $array['FilterType'] . "','" .
            $EmployeeID . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

}