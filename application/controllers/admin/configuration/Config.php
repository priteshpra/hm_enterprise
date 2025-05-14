<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Config extends Admin_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/config_model');
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",1)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) || @$this->cur_module->is_edit == 0){
            show_404();
        }
    }
    public  function index(){
        if($this->cur_module->is_edit == 0)
            show_404();
        $data = $array = array();
        $this->load->view('admin/includes/header');
        $array = $this->config_model->getConfig();
       
        if(empty($array)){
            $data['page_name'] = "addConfig";
        }else{
            $data['data'] = $array;
            $data['page_name'] = "editConfig/".$data['data']->ConfigID;
        }
        $data['loading_button'] = getLoadingButton(); 
        $this->load->view('admin/configuration/config/add_edit',$data);
        $data['page_level_js'] = $this->load->view('admin/configuration/config/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer',$data);    
        unset($data);
    }
    public function editConfig($ID = 0){   
		$data = $res = array();
		if ($this->input->post()){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('SupportEmail', 'SupportEmail', 'trim|required');
			if ($this->form_validation->run() == TRUE){
				$res = $this->input->post();
                $res['ID'] = $ID;
                if ($this->config_model->insertUpdateConfig($res)){
					$this->session->set_flashdata('postsuccess', label('msg_rcd_saved_successfully'));
					redirect(site_url('admin/configuration/config'));
                }else{
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect(site_url('admin/configuration/config'));
				}
            }else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/configuration/config'));
            }
        } 
    }
}
