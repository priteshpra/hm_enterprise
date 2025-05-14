<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rolemapping extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/rolemapping_model');
        $this->load->model('admin/role_model');
    }

    public function index($ID = 0) {
        $this->RoleID = $ID;
        $data = $result = array();
        $_POST['RoleID'] = $data['ID'] = $ID;
        $data['role_data'] = $this->role_model->getByID($ID);
        if(empty($data['role_data'])){
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/role/'));
        }
        $result['RoleID'] = $ID;
        $data['page_level_js'] = $this->load->view('admin/rolemapping/list_js', $result, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/rolemapping/list',$data);
        $this->load->view('admin/includes/footer',$data);
        unset($data,$result);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1) {
        $result = array();
        $result['PageSize'] = $PageSize;
        $result['CurrentPage'] = $CurrentPage;
        $result['data_array'] = $this->rolemapping_model->ListData($PageSize, $CurrentPage);
        if (@$result['data_array'][0]->Message)
            $result['TotalRecords'] = 0;
        else
            $result['TotalRecords'] = $result['data_array'][0]->rowcount;
        if ($result['TotalRecords'] != 0){
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/rolemapping/ajax_listing', $result, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        }
        else{
            echo json_encode(array('listing' => '<tr><td colspan="7" style="text-align: center;">No Records Found.</td></tr>', 'pagination' => ''));
        }
    }

    public function add($ID = 0,$UID = 0) {
        if($ID == 0){
            redirect(site_url('admin/role'));
        }
        $result = $data = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $res = $this->rolemapping_model->Insert($this->input->post());
            if (@$res->ID) {
                redirect(site_url('admin/rolemapping/index/'.$ID));
            } else {
                $this->session->set_flashdata('posterror', label('please_try_again'));
                if($UID != 0){
                    $DD = "/" . $UID;
                }
                redirect(site_url('admin/rolemapping/add/'.$ID.$DD));
            }
        }
        $res = $this->role_model->GetByID($ID);
        $result['page_name'] = "add/$ID/";
        $result['RoleID'] = $ID;
        $result['loading_button'] = getLoadingButton();
        $result['User'] = getUser($UID);
        $result['Role'] = getRoleComboBox($ID);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/rolemapping/add_edit', $result);
        $data['page_level_js'] = $this->load->view('admin/rolemapping/add_edit_js', $result, TRUE);
        $this->load->view('admin/includes/footer', $data);
    }

    public function export_to_excel() {
        $array = array();
        $fields = array(
            "Rno"=>"Sr No",
            "FirstName"=>"First Name",
            "LastName"=>"Last Name",
            "RoleName"=>"Role Name"
        ); 

        $this->load->library('excel');
        $array['data'] = $this->rolemapping_model->ListData(-1, 1);
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
        $filename = 'Roles Mapping.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }


}
