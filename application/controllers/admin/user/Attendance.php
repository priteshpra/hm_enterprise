<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attendance extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",36)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/teamdefination_model');
        $this->load->model('admin/quotation_model');
        $this->load->model('admin/attandance_model');
    }

    public function list()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/user/attendance/list', $array);
        $data['page_level_js'] = $this->load->view('admin/user/attendance/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function menuajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->attandance_model->MenuListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/attendance/menuajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="16" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->attandance_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/attendance/ajax_listing', $res, TRUE);
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


                $dataval = array();
                $dataval['QuotationID'] = $data['QuotationID'];
                $dataval['SitesID'] = $data['SitesID'];
                $dataval['CustomerID'] = $data['CustomerID'];
                $dataval['AttendanceDate'] = $data['AttendanceDate'];
                $dataval['Status'] = $data['Status'];

                unset($data['QuotationID']);
                unset($data['SitesID']);
                unset($data['CustomerID']);
                unset($data['AttendanceDate']);
                unset($data['Status']);

                foreach ($data as $key => $value) {
                    if ($key > 0) {
                        $dataval['UserID'] = $key;
                        $dataval['Attendance'] = $value;
                        $dataval['Overtime'] = (@$data['OverTime_' . $key] != '') ? @$data['OverTime_' . $key] : 0;;
                        $res = $this->attandance_model->Insert($dataval);
                    }
                }

                if (@$res->ID) {
                    redirect(site_url('admin/user/customer/details/' . $dataval['CustomerID'] . '#Attendance'));
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
        $_POST['QuotationID'] = $ID;
        $data['user'] = $this->attandance_model->ListDataByDate(-1, 1);
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/attendance/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/attendance/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function addGlobal($ID = NULL)
    {
        $data = $res = array();
        $data['data'] = $this->quotation_model->GetByID($ID);
        if ($this->input->post()) {
            $data = $this->input->post();

            $dataval = array();
            $dataval['QuotationID'] = @$data['QuotationID'];
            $dataval['SitesID'] = @$data['SitesID'];
            $dataval['CustomerID'] = @$data['CustomerID'];
            $dataval['AttendanceDate'] = $data['AttendanceDate'];
            $dataval['Status'] = $data['Status'];

            unset($data['QuotationID']);
            unset($data['SitesID']);
            unset($data['CustomerID']);
            unset($data['AttendanceDate']);
            unset($data['Status']);

            foreach ($data as $key => $value) {
                if ($key > 0) {
                    $dataval['UserID'] = $key;
                    $dataval['Attendance'] = $value;
                    $dataval['Overtime'] = (@$data['OverTime_' . $key] != '') ? @$data['OverTime_' . $key] : 0;;
                    $res = $this->attandance_model->Insert($dataval);
                }
            }

            if (@$res->ID) {
                redirect(site_url('admin/user/attendance/list'));
            } else {
                $msg = label('please_try_again');
                if (@$res->Message) {
                    $arr = explode('~', $res['Message']);
                    $msg = @$arr[1];
                }
                $this->session->set_flashdata('posterror', $msg);
                redirect(site_url('admin/user/attendance/addGlobal'));
            }
        }

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'addGlobal';
        $_POST['QuotationID'] = $ID;
        $data['user'] = $this->attandance_model->ListGlobalDataByDate(-1, 1);
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/attendance/globaladd_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/attendance/globaladd_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function export_to_excel()
    {
        $array = array();
        $fields = array(
            "Rno" => "Sr No",
            "EmployeeName" => "Employee Name",
            "MobileNo" => "MobileNo",
            "StartDate" => "Start Date",
            "EndDate" => "End Date",
            "PresentCount" => "Present Count",
            "AbsentCount" => "Absent Count",
            "HalfDayCount" => "Half Day Count",
            "HalfOverTime" => "Half Over Time Count",
            "FullOverTime" => "Full Over Time Count"
        );

        $this->load->library('excel');
        $array['data'] = $this->attandance_model->MenuListData(-1, 1);
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
        $filename = 'Attendance.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
}
