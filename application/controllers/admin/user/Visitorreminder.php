<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitorreminder extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(".$this->UserRoleID . ",29)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        
        if(empty($this->cur_module) ){
            show_404();
        }

        $this->load->model('admin/visitorreminder_model');
        $this->load->model('admin/config_model');
        $this->configdata = $this->config_model->getConfig();
    }


    public function ajax_listing($PageSize = 10, $CurrentPage = 1) {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->visitorreminder_model->ListData($PageSize, $CurrentPage);
        
        if (!isset($res['data_array'][0]->VisitorReminderID))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);

        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/visitorreminder/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="15" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function add($ID=0) {
        if(@$this->cur_module->is_insert == 0)
                    show_404();
        $data = $res = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Message', 'Message', 'trim|required');
            $this->form_validation->set_rules('ReminderDate', 'ReminderDate', 'trim|required');
            $this->form_validation->set_rules('ReminderTime', 'ReminderTime', 'trim|required');
            $this->form_validation->set_rules('PastDate', 'PastDate', 'trim|required');
            $this->form_validation->set_rules('PastTime', 'PastTime', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = array();
                $data = $this->input->post();
                $res = $this->visitorreminder_model->Insert($data);

                if (@$res->ID) {
                    redirect($this->config->item('base_url') . 'admin/user/visitor/details/'.$data['VisitorID'] ."#reminder");
                }else{
                    $msg = label('please_try_again');
                    if(@$res->Message){
                        $arr = explode('~',$res->Message);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url( 'admin/user/visitorreminder/add/'.$data['VisitorID']));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url( 'admin/user/visitorreminder/add/'.$data['VisitorID']));
            }
        }
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['VisitorID'] = $ID;
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/visitorreminder/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/visitorreminder/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data,$res);
    }

    public function edit($ID = NULL) {
        $data = $res = array();
        $data['data'] = $this->visitorreminder_model->GetByID($ID);
        if(!isset($data['data']->VisitorReminderID)){
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/user/visitorreminder'));
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Message', 'Message', 'trim|required');
            $this->form_validation->set_rules('ReminderDate', 'ReminderDate', 'trim|required');
            $this->form_validation->set_rules('ReminderTime', 'ReminderTime', 'trim|required');
            $this->form_validation->set_rules('PastDate', 'PastDate', 'trim|required');
            $this->form_validation->set_rules('PastTime', 'PastTime', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $data['ID'] = $ID;
                $res = $this->visitorreminder_model->Update($data);
                if (@$res->ID) {
                    redirect($this->config->item('base_url') . 'admin/user/visitor/details/'.$data['VisitorID'] ."#reminder");
                } else {
                    $msg = label('please_try_again');
                    if(@$res->Message){
                        $arr = explode('~',$res->Message);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url( 'admin/user/visitorreminder/edit/' . $ID));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url( 'admin/user/visitorreminder/edit/' . $ID));
            }
        }

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'edit/' . $ID;
        $data['VisitorID'] = $data['data']->VisitorID;
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/visitorreminder/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/visitorreminder/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data,$res);
    }

    function ChangeStatus() {
        if($this->cur_module->is_status == 0){
            echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
            die;
        }
        parent::ChangeStatus();
    }
    
    public function export_to_excel() {
        if($this->cur_module->is_export == 0)
                        show_404();
        $array = array();
        $fields = array(
            "Rno"=>"Sr No",
            "Name"=>"Name",
            "EmployeeName"=>"Employee Name",
            "CompanyName"=>"Company Name",
            "EmailID"=>"EmailID",
            "MobileNo"=>"Mobile No",
            "Location"=>"Location",
            "Service"=>"Service",
            "WorkingDays"=>"Working Days",
            "WorkingHours"=>"Working Hours",
            "NoOfPowerRequire"=>"No Of Power Require",
            "LeadType"=>"Lead Type"
        ); 

        $this->load->library('excel');
        $array['data'] = $this->visitorreminder_model->ListData(-1, 1);
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Export Data');
        $this->excel->setActiveSheetIndex(0);
        //Set Header Style
        $col = 0;
        foreach ($fields as $key => $field) {
            $column = PHPExcel_Cell::stringFromColumnIndex($col);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords($field))
            ->getStyle($column."1")->getFont()->setBold(true);
            $col++;
        }
        //Set Headers of Excel
        $row = 2;
        $SerialNo = 1;
        if (!empty($array['data'])) {
            foreach ($array['data'] as $rr => $data) {
                if(@$data->Message){
                    break;
                }
                $col = 0;
                foreach ($fields as $key => $field) {
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$key);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'VisitorReminder.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
