<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teamdefination extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",22)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/teamdefination_model');
        $this->load->model('admin/quotation_model');
        $this->load->model('api/master_model');
    }


    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->teamdefination_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/teamdefination/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="16" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function add($ID = NULL)
    {
        $data = $res = array();
        $data['data'] = $this->quotation_model->GetByID($ID);
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('SitesID', 'SitesID', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                foreach ($data['UserID'] as $key => $value) {
                    $data['UserID'] = $value;
                    $res = $this->teamdefination_model->Insert($data);
                }
                if (@$res->ID) {
                    redirect(site_url('admin/user/customer/details/' . $data['CustomerID'] . '#Teamdefination'));
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $res['Message']);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/user/quotation/add/'));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/quotation/add/'));
            }
        }

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['User'] = getUserByDate();
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/teamdefination/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/teamdefination/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

}
