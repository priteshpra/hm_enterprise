<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usersession extends Admin_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('admin/user_session_model');
    }

    public  function adminlogin(){        
        $this->load->view('admin/usersession/login_form');        
    }
    
    public function postLogin(){
        $data = array();
        $data = $this->user_session_model->checkLogin($this->input->post()); 
        if(count($data) > 0 && !empty($data) && !isset($data['0']['Message'])){ 
            // if($data['0']['UserType'] == 'Admin'){
                redirect(site_url('admin-dashboard'));
            // }
            // else{
            //      $this->session->set_flashdata('posterror',label('user_not_found'));
            //      redirect(site_url('admin-login'));
            // }
        }else{
            $message = explode('~',$data['0']['Message']);
            $this->session->set_flashdata('posterror',$message[1]);
            redirect(site_url('admin-login'));
        }
    }
    public function myProfile(){
        $data = $res =  array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
            $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $res = $this->user_session_model->editProfile($this->input->post()); 
                $this->session->set_userdata($res);
                $this->session->set_userdata('language', 'english');
                if (@$res[0]['UserID']) {
                    $this->session->set_flashdata('postsuccess', label('profile_update_successful'));
                    redirect(site_url('admin-dashboard'));
                } else {
                    $msg = isset($res['Message'])?$res['Message']:label('please_try_again');
                    $this->session->set_flashdata('posterror',$msg);
                    redirect(site_url('my-profile'));
                }
            }else{
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('my-profile'));
            }
        }
        $data['data'] = $this->user_session_model->GetProfileByID();
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/usersession/my_profile',$data);
        $res['page_level_js'] = $this->load->view('admin/usersession/my_profile_js', $data, TRUE);
        $res['footer']['listing_page'] = 'no';
        $this->load->view('admin/includes/footer', $res);
        unset($data,$res);
    }
    public function changePassword(){
        if($this->input->post()){
            $data = $this->user_session_model->checkIfCurrentPasswordMatches();
            if(@$data->Count == 0 && !isset($data->Count)){
                $this->session->set_flashdata('posterror', label('old_password_does_not_match'));
                redirect(site_url('change-password'));
            }
            $data = $this->user_session_model->changePassword();
            $msg = explode('~',$data['Message']);
            if($msg[0] == 200){
                $this->session->set_flashdata('postsuccess', label('password_change_success'));
                redirect(site_url('admin-dashboard'));
            }else{
                $Message = label('please_try_again');
                if(isset($msg[1])){
                    $Message = $msg[1];
                }
                $this->session->set_flashdata('posterror', $Message);
                redirect(site_url('change-password'));
            }
        }
        $data = array(); 
        $this->load->view('admin/includes/header');
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/usersession/change_password',$data);
        $data['page_level_js'] = $this->load->view('admin/usersession/change_password_js', NULL, TRUE);
        $data['footer']['listing_page'] = 'no';
        $this->load->view('admin/includes/footer', $data);
        unset($data);
    }

    public function forgotPassword(){
        $data = $array = array();
        if($this->input->post()){
            $Content = $this->common_model->GetEmailTemplate(2);
            $Profile = $this->user_session_model->GetProfileByID($this->input->post('UserID'));
            $data = $this->user_session_model->ForgotPassword($this->input->post('email_id'));
            $password = fnDecrypt($data->Password);
            $array['ToEmailID'] = $Profile->EmailID;
            $array['Subject']  = label('msg_lbl_site_title_name').'- '.$Content['EmailSubject'];
            $array['Body'] = $Content['Content']; 
            $array['FromEmailID'] = $this->configuration_setting_data['SupportEmail'];
            $array['FromName'] = label('msg_lbl_site_title_name');
            $array['ReplyEmailID'] = $this->configuration_setting_data['SupportEmail'];
            $array['ReplayName'] = $this->configuration_setting_data['SupportEmail'];
            $array['AltBody'] = '';  
            $login_link = site_url('admin-login');
            $websiteurl = site_url();
            $image_path = base_url(DEFAULT_WEBSITE_LOGO);  
            $back_image_path = '';//
            $data1 = array(
                    '{image_path}',
                    '{first_name}',
                    '{last_name}',
                    '{old_password}',
                    '{loginurl}',
                    '{websiteurl}',
                    '{projectname}'
                );
            $datavalue = array(
                    $image_path,
                    $Profile->FirstName,
                    $Profile->LastName, 
                    $password,
                    $login_link,
                    $websiteurl,
                    label('msg_lbl_site_title_name')
                );
            $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
            $res = CustomMail($array);
            $this->session->set_flashdata('postsuccess', label('new_passwprd_updated'));
            redirect(site_url('admin-logi'));
        }
        $this->load->view('admin/usersession/forgot_password_form');
        
    }
    public function resetpassword(){
        if($this->input->post()){
            $data = $array = array();
            $Content = $this->common_model->GetEmailTemplate(1);
            $Profile = $this->user_session_model->GetProfileByID($this->input->post('UserID'));
            $new_password = generateRandomString(10);
            $data = $this->user_session_model->ResetPassword($this->input->post('email_id'),$new_password);
            if(!@$data->ID){
                $this->session->set_flashdata('postsuccess', label('please_try_again'));
                redirect(site_url('admin-login'));
            }
            $array['ToEmailID'] = $Profile->EmailID;
            $array['Subject']  = label('msg_lbl_site_title_name').'- '.$Content['EmailSubject'];
            $array['Body'] = $Content['Content']; 
            $array['FromEmailID'] = $this->configuration_setting_data['SupportEmail'];
            $array['FromName'] = label('msg_lbl_site_title_name');
            $array['ReplyEmailID'] = $this->configuration_setting_data['SupportEmail'];
            $array['ReplayName'] = $this->configuration_setting_data['SupportEmail'];
            $array['AltBody'] = '';  
            $login_link = site_url('admin-login');
            $websiteurl = site_url();
            $image_path = base_url(DEFAULT_WEBSITE_LOGO);  
            $back_image_path = '';//
            $data1 = array(
                    '{image_path}',
                    '{first_name}',
                    '{last_name}',
                    '{created_password}',
                    '{loginurl}',
                    '{websiteurl}',
                    '{projectname}'
                );
            $datavalue = array(
                    $image_path,
                    $Profile->FirstName,
                    $Profile->LastName, 
                    $new_password,
                    $login_link,
                    $websiteurl,
                    label('msg_lbl_site_title_name')
                );
            $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
            $res = CustomMail($array);
            $this->session->set_flashdata('postsuccess', label('api_msg_new_password_send_by_mail'));
            redirect(site_url('admin-login'));
        }
       
        $this->load->view('admin/usersession/reset_password_form');
        unset($data,$array);
    }
    
    public function adminLogout(){
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) 
        {
            $this->session->unset_userdata($key);
        }
        $this->session->sess_destroy();
        redirect(site_url('admin-login'));
    }
    
    public function checkIfEmailIDIsRegistered(){
		$res = $this->user_session_model->checkIfEmailIDIsRegistered($this->input->post('email_id'));
        echo $res;exit;
	}
    
    public function checkIfCurrentPasswordMatches(){
        $res = $this->user_session_model->checkIfCurrentPasswordMatches($this->input->post('current_password'));
        echo @$res->Count;exit;
    }
}
