<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/page_model');
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",9)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
    }

    public function index() {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/masters/page/list', $array);
        $data['page_level_js'] = $this->load->view('admin/masters/page/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
        
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1) {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->page_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;

        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/masters/page/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="3" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function add() {
        if(@$this->cur_module->is_insert == 0)
                    show_404();
        $data = $res = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('PageName', 'PageName', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $res = $this->page_model->Insert($this->input->post());
                if (@$res->ID) {
                    redirect(site_url('admin/masters/page'));
                }else{
                    $msg = label('please_try_again');
                    if(@$res->Message){
                        $arr = explode('~',$res->Message);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/masters/page/add'));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/masters/page/add'));
            }
        }
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/masters/page/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/masters/page/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data,$res);
    }

    public function edit($ID = NULL) {
        $data = $res = array();
        $data['data'] = $this->page_model->GetByID($ID);
        if(@$this->cur_module->is_edit == 0)
            show_404();
        if(@$data['data']->Message){
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/masters/page'));
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('PageName', 'PageName', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $data['ID'] = $ID;
                $res = $this->page_model->Update($data);
                if (@$res->ID) {
                    redirect(site_url('admin/masters/page'));
                } else {
                    $msg = label('please_try_again');
                    if(@$res->Message){
                        $arr = explode('~',$res->Message);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/masters/page/edit/' . $ID));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/masters/page/edit/' . $ID));
            }
        }

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'edit/' . $ID;
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/masters/page/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/masters/page/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data,$res);
    }

    public function ChangeStatus() {
        if($this->cur_module->is_status == 0){
            echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
            die;
        }
        parent::ChangeStatus();
    }
    
    public function combobox(){
        if($this->input->get()){
            $json = array();
            $_POST['PageName'] = ($this->input->get('q')=="")?'':$this->input->get('q');
            $_POST['Status'] = 1;
            $data = $this->page_model->listData(10,1);
            foreach ($data as $key => $value) {
                if(@$value->Message)
                    break;
                $json[] = ['id'=>$value->PageID, 'text'=>$value->PageName];
            }
            echo json_encode($json);
        }
    }

    public function export_to_excel() {
        if($this->cur_module->is_export == 0)
                        show_404();
        $array = array();
        $fields = array(
            "Rno"=>"Sr No",
            "PageName"=>"PageName"
        ); 

        $this->load->library('excel');
        $array['data'] = $this->page_model->ListData(-1, 1);
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
        $filename = 'Page.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
