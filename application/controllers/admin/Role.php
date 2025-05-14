<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/role_model');
    }

    public function index() {
        $result = array();
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/role/list', $result);
        $data['page_level_js'] = $this->load->view('admin/role/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1) {
        $result = array();
        $result['PageSize'] = $PageSize;
        $result['CurrentPage'] = $CurrentPage;
        $result['data_array'] = $this->role_model->ListData($PageSize, $CurrentPage);
        if (@$result['data_array'][0]->Message)
            $result['TotalRecords'] = 0;
        else
            $result['TotalRecords'] = $result['data_array'][0]->rowcount;
        if ($result['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/role/ajax_listing', $result, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'pagination' => ''));
    }

    public function add() {
        $data = $result = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Name', 'Name', 'trim|required');
            $this->form_validation->set_rules('Description', 'Description', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $res = $this->role_model->Insert($this->input->post());
                if (@$res->ID) {
                    redirect(site_url('admin/role'));
                } else {
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect(site_url('admin/role/add'));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/role/add'));
            }
        }
        $result['RoleID'] = 0;
        $result['loading_button'] = getLoadingButton();
        $result['page_name'] = "add";
        $result['parent_modules'] = $this->role_model->getParentModules();
        $result['sub_modules'] = $this->role_model->getChildModules();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/role/add_edit', $result);
        $data['page_level_js'] = $this->load->view('admin/role/add_edit_js', $result, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($data,$result);
    }

    public function edit($ID = NULL) {
        $data = $result = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Name', 'Name', 'trim|required');
            $this->form_validation->set_rules('Description', 'Description', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $array = $this->input->post();
                $array['ID'] = $ID;
                $res = $this->role_model->Update($array);
                if (@$res->ID) {
                    redirect(site_url('admin/role'));
                } else {
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect(site_url('admin/role/edit/' . $ID));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/role/edit/' . $ID));
            }
        }

        $result['role'] = $this->role_model->GetByID($ID);
        if(empty($result['role'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect(site_url('admin/role/'));
        }
        $result['parent_modules'] = $this->role_model->getParentModules($ID);
        $result['sub_modules'] = $this->role_model->getChildModules($ID);
        $result['RoleID'] = $ID;
        $result['loading_button'] = getLoadingButton();
        $result['page_name'] = "edit/$ID";
        
        $this->load->view('admin/includes/header');
        $this->load->view('admin/role/add_edit', $result);
        $data['page_level_js'] = $this->load->view('admin/role/add_edit_js', $result, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($data,$result);
    }

    public function combobox(){
        if($this->input->get()){
            $json = array();
            $_POST['RoleName'] = ($this->input->get('q')=="")?'':$this->input->get('q');
            $_POST['Status'] = 1;
            $data = $this->role_model->listData(10,1);
            foreach ($data as $key => $value) {
                if(@$value->Message)
                    break;
                $json[] = ['id'=>$value->UserID, 'text'=>$value->RoleName];
            }
            echo json_encode($json);
        }
    }
    
    public function export_to_excel() {
        $array = array();
        $fields = array(
            "Rno"=>"Sr No",
            "RoleName"=>"Role Name"
        ); 

        $this->load->library('excel');
        $array['data'] = $this->role_model->ListData(-1, 1);
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
        $filename = 'Roles.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }


}
