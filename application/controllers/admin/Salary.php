<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salary extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",33)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/salary_model');
    }

    public function index()
    {
        $array = $data = array();
        $array['User'] = getUserComboBox();
        $this->load->view('admin/includes/header');
        $array['Service'] = getServiceComboBox();
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/salary/list', $array);
        $data['page_level_js'] = $this->load->view('admin/salary/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->salary_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/salary/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="15" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function add()
    {
        if (@$this->cur_module->is_insert == 0)
            show_404();
        $data = $res = array();
        if ($this->input->post()) {
            $res = $this->salary_model->Insert($this->input->post());

            if (@$res->ID) {
                if($this->input->post('Advance') != "None") {
                    $res = $this->salary_model->InsertAdvance($this->input->post());
                }
                redirect(site_url('admin/salary'));
            } else {
                $msg = label('please_try_again');
                if (@$res->Message) {
                    $arr = explode('~', $res->Message);
                    $msg = @$arr[1];
                }
                $this->session->set_flashdata('posterror', $msg);
                redirect(site_url('admin/salary'));
            }
        }

        $data['users'] = getUserComboBox();

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['loading_button'] = getLoadingButton();

        $this->load->view('admin/salary/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/salary/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }
    public function getAttandance()
    {
        $data = $this->salary_model->ListDataByDate();
        echo json_encode($data);
    }

    public function addAdvance($ID) {
        if (@$this->cur_module->is_insert == 0)
            show_404();
        $data = $res = array();
        if ($this->input->post()) {
            $data = $this->input->post();
            $data['UserID'][0] = $ID;
            $res = $this->salary_model->InsertAdvance($data);
            if (@$res->ID) {
                redirect(site_url('admin/user/employee/details/'.$ID.'#Advance'));
            } else {
                $msg = label('please_try_again');
                if (@$res->Message) {
                    $arr = explode('~', $res->Message);
                    $msg = @$arr[1];
                }
                $this->session->set_flashdata('posterror', $msg);
                redirect(site_url('admin/salary'));
            }
        }

        $data['ID'] = $ID;
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'addAdvance/'.$ID;
        $data['loading_button'] = getLoadingButton();

        $this->load->view('admin/salary/add_edit_advance', $data);
        $res['page_level_js'] = $this->load->view('admin/salary/add_edit_advance_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }
}
