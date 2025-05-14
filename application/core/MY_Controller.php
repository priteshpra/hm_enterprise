<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MY_Controller Class
 *
 *
 * @package Project Name
 * @subpackage  Controllers
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $configuration_setting =  $this->db->query("call usp_GetConfig()");
        $configuration_setting->next_result();
        $this->configuration_setting_data = $configuration_setting->row_array();
    }
    
}

class LoggedIn extends MY_Controller {

    public function __construct() {
        parent::__construct();
        // $this->updatelangfile('english');
    }
        function CheckDuplicate() {
        if ($this->input->post()) {
            $this->load->helper('databasetable');
            $Table = $this->input->post("Table");
            $array = GetDatabaseTableArray($Table);
            $array['ID'] = $this->input->post('ID');
            $array['DataValue'] = $this->input->post('DataValue');
            $res = $this->common_model->CheckDuplicate($array);
            if(@$res->Count == 0)
                echo json_encode(array('result' => 'Success','count'=>$res->Count));
            else
                echo json_encode(array('result' => 'Fail'));
        }
    }
    function CheckDuplicateDouble() {
        if ($this->input->post()) {
            $this->load->helper('databasetable');
            $Table = $this->input->post("Table");
            $array = GetDatabaseTableArray($Table);
            $array['ID'] = $this->input->post('ID');
            $array['DataValue'] = $this->input->post('DataValue');
            $array['SecondDataValue'] = $this->input->post('SecondDataValue');
            $res = $this->common_model->CheckDuplicateDouble($array);
            if(@$res->Count == 0)
                echo json_encode(array('result' => 'Success','count'=>$res->Count));
            else
                echo json_encode(array('result' => 'Fail'));
        }
    }
    function ChangeStatus() {
        if ($this->input->is_ajax_request() && $this->input->post()) {
            $this->load->helper('databasetable');
            $Table = $this->input->post("Table");
            $array = GetDatabaseTableArray($Table);
            $array['Status'] = $this->input->post("Status");
            $array['ID'] = $this->input->post("ID");
            $array['UserID'] = $this->session->userdata['UserID'];
            $res = $this->common_model->ChangeStatus($array);
            if($res->ID){
                $message = ($this->input->post('Status') == 1)?label('status_active'):label('status_inactive');    
                echo json_encode(array('result' => 'Success','message'=>$message));
            }else{
                echo json_encode(array('result' => 'Error',label('please_try_again')));
            }
        }else{
            show_404();
        }
    }
    function getRecordInfo() {
        if ($this->input->is_ajax_request() && $this->input->post()) {
            $this->load->helper('databasetable');
            $Table = $this->input->post("Table");
            $array = GetDatabaseTableArray($Table);
            $array['ID'] = $this->input->post("ID");
            $records = getRecordTrack($array['ID'],$array['TableName'],$array['UniqueField']);
            $data = "";
      
            $data .= '<tr><td style="width:20px;color:#000000;"><i class="mdi-action-perm-identity"></i></td><td><b>Created By</b></td><td>'.$records->CreatedBy.'</td></tr>';
            $data .= '<tr><td style="width:20px;color:#000000;"><i class="mdi-notification-event-note"></i></td><td><b>Created Date</b></td><td>'.$records->CreatedDate.'</td></tr>';
            $data .= '<tr><td style="width:20px;color:#dbab83;"><i class="mdi-action-perm-identity"></i></td><td><b>Modified By</b></td><td>'.$records->ModifiedBy.'</td></tr>';
            $data .= '<tr><td style="width:20px;color:#dbab83;"><i class="mdi-notification-event-note"></i></td><td><b>Modified Date</b></td><td>'.$records->ModifiedDate.'</td></tr>'; 
            echo $data;
        }else{
            show_404();
        }
    }
    function emailexist(){
        $email_id = $this->input->post('email');
       $exists = $this->common_model->emailexists($email_id);
        echo $exists->emailcount;exit;
        if ($exists->emailcount > 0) {
            echo label('email_exist');exit();
        } 
        else {
            echo '0';exit();
        }
    }
}

class Front_Controller extends LoggedIn {
    function __construct() {
        parent::__construct();
        $this->load->library('facebook');
        $this->load->library('googleplus');

        $current_controller = $this->router->fetch_class();
        $current_method = $this->router->fetch_method();

        $without_login_methods = array('login', 'signup', 'googlelogin', 'fblogin', 'callback', 'forgotpassword');
        $with_login_methods = array('editprofile', 'profile', /* 'ajax_listing', */ 'addstory', 'bookmark', '');


        $with_login_controllers = array(/* 'Story','Publication', */'Author');
        $user_session = $this->session->userdata("user_data");

        if (isset($user_session['AuthorID'])) {//if(isset($this->session->userdata['UserID']))
            // Session is registered
            if (in_array($current_method, $without_login_methods)) {
                redirect(site_url('home'));
            }
        } else {
            // Session is not registered
            if (in_array($current_method, $with_login_methods) || in_array($current_controller, $with_login_controllers)) {
                redirect(site_url('author-login'));
            }
        }
    }

}

class Admin_Controller extends LoggedIn {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta');
        $current_controller = $this->router->fetch_class();
        $current_method = $this->router->fetch_method();
        $this->module_data = array();
        $this->UserRoleID = NULL;
        $without_login_methods = array('adminlogin', 'forgotPassword', 'resetpassword', 'postLogin','postResetPassword','checkIfEmailIDIsRegistered','label');

        // pr($_SESSION);
        // die;
        $with_login_methods = array('adminLogout', 'changePassword', 'myProfile', 'editMyProfile', 'editProfile','checkIfEmailIDIsRegistered');
        if (isset($this->session->userdata['UserID'])) {
            $UserID = $this->session->userdata['UserID'];
            $this->UserRoleID = $this->session->userdata['RoleID'];

            $this->CityID = (@$this->session->userdata['CityID']!='')?$this->session->userdata['CityID']:783;
            $this->CityCombobox = getCityComboBox($this->CityID);

            $query = "call usp_GetRolesMappingByID('".$this->UserRoleID ."','Web');";
            $res = $this->db->query($query);
            $res->next_result();
            $data = $res->result();
            if(@$data[0]->ModuleID){
                foreach ($data as $value) {
                        $this->module_data[] = $value->ModuleID;
                }
            }
            if (in_array($current_method, $without_login_methods)) {
                redirect(site_url('admin-dashboard'));
            }
        }else{
            if (!in_array($current_method, $without_login_methods)) {
                redirect(site_url('admin-login'));
            }
        }
    }



}