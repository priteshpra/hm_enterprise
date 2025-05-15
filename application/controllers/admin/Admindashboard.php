<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admindashboard extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(-1,1)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();

        if (@$this->cur_module->is_view != 1) {
            show_404();
        }

        $this->load->library('session');
    }

    public function index()
    {
        $data = array();
        $this->load->view('admin/includes/header');
        $data['Dashboard'] = $this->common_model->GetDashboard($this->input->post());
        // echo "<pre>";
        // print_r($data['Dashboard']);
        // die;
        $this->load->view('admin/admindasboard/index', $data);
        $data['page_level_js'] = $this->load->view('admin/admindasboard/index_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $data);
    }

    public function ajax_dashboard()
    {
        if ($this->input->post()) {

            $data = array();
            $data['FilterType'] = $this->input->post('FilterType');
            $data['Dashboard'] = $this->common_model->GetDashboard($this->input->post());
            $this->load->view('admin/admindasboard/ajax_listing', $data);
        }
    }

    public function followup_ajax_listing($per_page_record = 10, $page_number = 1)
    {

        $result = array();
        $result['PageSize'] = $per_page_record;
        $result['CurrentPage'] = $page_number;
        $result['data_araay'] = $this->common_model->DashboardFollowUplistData($per_page_record, $page_number);
        if (!isset($result['data_araay'][0]->VisitorReminderID))
            $result['TotalRecords'] = 0;
        else {
            $result['TotalRecords'] = $result['data_araay'][0]->rowcount;
        }

        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);

        $ajax_listing = $this->load->view('admin/admindasboard/followup_ajax_listing', $result, TRUE);
        if ($result['TotalRecords'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="9" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
    }

    public function visitor_ajax_listing($per_page_record = 10, $page_number = 1)
    {

        $result = array();
        $result['PageSize'] = $per_page_record;
        $result['CurrentPage'] = $page_number;
        $result['data_array'] = $this->common_model->DashboardVisitorlistData($per_page_record, $page_number);
        if (isset($result['data_array'][0]->Message))
            $result['TotalRecords'] = 0;
        else
            $result['TotalRecords'] = $result['data_array'][0]->rowcount;
        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);

        $ajax_listing = $this->load->view('admin/admindasboard/visitor_ajax_listing', $result, TRUE);
        if ($result['TotalRecords'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="9" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
    }
}
