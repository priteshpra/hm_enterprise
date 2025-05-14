<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",8)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
        $this->load->model('admin/message_model');
    }

    public function index() {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/masters/message/list', $array);
        $data['page_level_js'] = $this->load->view('admin/masters/message/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
        
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1) {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->message_model->ListData($PageSize, $CurrentPage);
        if (!isset($res['data_array'][0]->MessageID))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/masters/message/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="3" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function edit($ID = NULL) {
        $data = $res = array();
        $data['data'] = $this->message_model->GetByID($ID);
        if(@$this->cur_module->is_edit == 0)
            show_404();
        if(!@$data['data']->Message){
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/masters/message'));
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('MessageKey', 'MessageKey', 'trim|required');
            $this->form_validation->set_rules('Message', 'Message', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $data['ID'] = $ID;
                $res = $this->message_model->Update($data);
                if (@$res->ID) {
                    redirect(site_url('admin/masters/message'));
                } else {
                    $msg = label('please_try_again');
                    if(@$res->Message){
                        $arr = explode('~',$res->Message);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/masters/message/edit/' . $ID));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/masters/message/edit/' . $ID));
            }
        }

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'edit/' . $ID;
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/masters/message/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/masters/message/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data,$res);
    }


}
