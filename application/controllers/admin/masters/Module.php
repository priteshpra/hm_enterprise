<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/module_model');
        $this->load->helper('common_helper');
    }

    public function index($per_page_record = 10, $page_number = 1) {
        try {
            $data = $module_result = array();
            $this->load->view('admin/includes/header');
            $module_result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            $this->load->view('admin/masters/module/list', $module_result);
            $data['page_level_js'] = $this->load->view('admin/masters/module/list_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($module_result, $data);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();

        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['module'] = $this->module_model->listModule($per_page_record, $page_number);

        if (empty($result['module']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['module'][0]->rowcount;
        //$result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/module/ajax_listing_module', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'b' => ''));
    }

    public function add() {
        try {

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('ModuleName', 'ModuleName', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $res = $this->module_model->insertModule($this->input->post());
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/Module');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/Module/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/Module/add');
                }
            }

            $this->load->view('admin/includes/header');
            $data = array();
            $data['page'] = 'add';
            $data['loading_button'] = getLoadingButton();
            $data['parent'] = getParent();
            //pr($data['parent']); die();
            $this->load->view('admin/masters/module/add_edit', $data);
            unset($data);
            $data = array();
            $data['page_level_js'] = $this->load->view('admin/masters/module/add_edit_js.php', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($data);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function edit($module_id = NULL) {
        try {
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('ModuleName', 'ModuleName', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $array = $this->input->post();
                    $array['module_id'] = $module_id;
                    $res = $this->module_model->updateModule($array);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/Module');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/Module/edit/' . $module_id);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/Module/edit/' . $module_id);
                }
            }

            $this->load->view('admin/includes/header');
            $module_result = array();
            $module_result['page'] = 'edit/' . $module_id;
            $module_result['module'] = $this->module_model->getModuleByID($module_id);
            $module_result['loading_button'] = getLoadingButton();
            
            $module_result['parent'] = getParent($module_result['module']->ParentID);

            $this->load->view('admin/masters/module/add_edit', $module_result);
            $data = array();
            $data['page_level_js'] = $this->load->view('admin/masters/module/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($module_result, $data);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    function changeStatus() {
        try {
            if ($this->input->post()) {
                $this->module_model->changeStatus($this->input->post());
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function export_to_excel() {
        //load our new PHPExcel library
        $this->load->library('excel');
        $module_result['module'] = $this->module_model->listmodule(-1, 1);
        $dataResult['result'] = array();
        if (!empty($module_result['module'])) {
            $dataResult['result'] = $module_result['module'];
        }
        $fields = array("SrNo", "ModuleName"); //Header Define
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Export Data');

        $this->excel->setActiveSheetIndex(0);
        //Set Header Style
        $col = 0;
        foreach ($fields as $field) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords($field));
            $col++;
        }

        //Set Headers of Excel
        $row = 2;
        $SerialNo = 1;
        if (!empty($module_result['module'])) {
            foreach ($dataResult['result'] as $rr => $data) {
                if(@$data->Message){
                    break;
                }
                $col = 0;
                foreach ($fields as $field) {

                    if ($field == 'SrNo')
                        $data->$field = $SerialNo;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        $filename = 'module.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
