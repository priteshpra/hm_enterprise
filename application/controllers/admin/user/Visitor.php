<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitor extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",29)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/visitor_model');
        $this->load->model('admin/sites_model');
        $this->load->model('admin/config_model');
        $this->configdata = $this->config_model->getConfig();
    }

    public function index()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/user/visitor/list', $array);
        $data['page_level_js'] = $this->load->view('admin/user/visitor/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->visitor_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/visitor/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function mobileadd()
    {
        $data = $res = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $this->session->set_userdata('NewServiceID', $data['ServiceID']);
                $res = $this->visitor_model->checkMobileNo($data['MobileNo']);
                if (isset($res)) {
                    $this->session->set_userdata('MobileNo', $data['MobileNo']);
                    if ($res->VisitorID) {
                        redirect(site_url('admin/user/visitor/edit/' . $res->VisitorID));
                    } else {
                        redirect(site_url('admin/user/visitor/add'));
                    }
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $res['Message']);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/user/visitor/add'));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/visitor/add'));
            }
        }
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'mobileadd';
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/visitor/mobileadd_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/visitor/mobileadd_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function add()
    {
        $data = $res = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('Name', 'Name', 'trim|required');
            $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();

                $res = $this->visitor_model->Insert($data);
                if (@$res->ID) {
                    $visitor = $this->visitor_model->GetByID($res->ID);
                    $data['VisitorID'] = $visitor->VisitorID;
                    $data['CustomerID'] = $visitor->CustomerID;
                    $res = $this->sites_model->Insert($data);
                    if ($data['SubmitType'] == "Add") {
                        redirect(site_url('admin/user/sites/add/' . @$data['VisitorID']));
                    } else {
                        redirect(site_url('admin/user/visitor'));
                    }
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $res['Message']);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/user/visitor/add'));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/visitor/add'));
            }
        }
        $data['service_id'] = $this->session->NewServiceID;
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['Country'] = getCountryComboBox(101);
        $data['State'] = getStateComboBox(12);
        $data['City'] = getCityComboBox(783);
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/visitor/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/visitor/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function edit($ID = NULL)
    {
        $data = $res = array();
        $data['data'] = $this->visitor_model->GetByID($ID);
        if (@$data['data']->Message) {
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/masters/visitor'));
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('Name', 'Name', 'trim|required');
            $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $data['ID'] = $ID;

                $res = $this->visitor_model->Update($data);
                if (@$res->ID) {
                    if ($data['SubmitType'] == "Add") {
                        redirect(site_url('admin/user/sites/add/' . @$res->ID));
                    } else {
                        redirect(site_url('admin/user/visitor'));
                    }
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $msg['Message']);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/user/visitor/edit/' . $ID));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/visitor/edit/' . $ID));
            }
        }
        $this->load->view('admin/includes/header');
        $data['Sites'] = $this->sites_model->getSites(array('VisitorID' => $ID));
        // pr($data);
        // die;
        $data['page_name'] = 'edit/' . $ID;
        $data['Country'] = getCountryComboBox(101);
        $data['State'] = getStateComboBox(12);
        $data['City'] = getCityComboBox(@$data['data']->CityID);
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/visitor/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/visitor/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function details($ID = 0)
    {
        $res = $data = array();
        $data['data'] = $this->visitor_model->GetByID($ID);
        if ($ID == 0 || @$data['data']->Message) {
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/masters/visitor'));
        }
        $data['VisitorID'] = $ID;
        $data['CustomerID'] = $data['data']->CustomerID;
        $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/user/visitor/details', $data);
        $res['page_level_js']  = $this->load->view('admin/user/visitor/details_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($res, $data);
    }

    public function ChangeStatus()
    {
        parent::ChangeStatus();
    }

    public function ChangePassword()
    {
        if ($this->input->is_ajax_request() && $this->input->post()) {
            $res = $this->visitor_model->ChangePassword($this->input->post());
            $msg = explode('~', @$res['Message']);
            if (@$msg[0] == 200) {
                echo json_encode(array('Status' => 'Success', 'Message' => label('password_change_success')));
            } else {
                $Message = label('please_try_again');
                if (isset($msg[1])) {
                    $Message = $msg[1];
                }
                echo json_encode(array('Status' => 'Error', 'Message' => $Message));
            }
            die();
        }
    }

    public function combobox()
    {
        if ($this->input->get()) {
            $json = array();
            $_POST['Name'] = ($this->input->get('q') == "") ? '' : $this->input->get('q');
            $_POST['Status'] = 1;
            $data = $this->visitor_model->listData(10, 1);
            foreach ($data as $key => $value) {
                if (@$value->Message)
                    break;
                $json[] = ['id' => $value->UserID, 'text' => $value->FirstName . " " . $value->LastName];
            }
            echo json_encode($json);
        }
    }

    public function usercombobox($Type)
    {
        if ($this->input->get()) {
            $json = array();
            $_POST['Name'] = ($this->input->get('q') == "") ? '' : $this->input->get('q');
            $_POST['Status'] = 1;
            $data = $this->visitor_model->UserwiseListData($Type);
            foreach ($data as $key => $value) {
                if (@$value->Message)
                    break;
                $json[] = ['id' => $value->UserID, 'text' => $value->FirstName . " " . $value->LastName];
            }
            echo json_encode($json);
        }
    }

    public function export_to_excel()
    {
        $array = array();
        $fields = array(
            "Rno" => "Sr No",
            "Name" => "Name",
            "LastName" => "Last Name",
            "EmailID" => "Email ID",
            "MobileNo" => "Mobile No",
            "Address" => "Address",
            "CityName" => "CityName"
        );

        $this->load->library('excel');
        $array['data'] = $this->visitor_model->ListData(-1, 1);
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
                ->getStyle($column . "1")->getFont()->setBold(true);
            $col++;
        }
        //Set Headers of Excel
        $row = 2;
        $SerialNo = 1;
        if (!empty($array['data'])) {
            foreach ($array['data'] as $rr => $data) {
                if (@$data->Message) {
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
        $filename = 'visitor.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
}
