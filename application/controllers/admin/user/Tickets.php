<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tickets extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",40)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/tickets_model');
        $this->load->library('session');
    }

    public function index()
    {

        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/tickets/list', $array);
        $data['page_level_js'] = $this->load->view('admin/tickets/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }



    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();

        $SiteName = $this->input->post('RoleName');

        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->tickets_model->ListData($PageSize, $CurrentPage, 'SiteName');
        //print_r($res['data_array']);exit;
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/tickets/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }


    public function add()
    {
        $data = $res = array();
        if ($this->input->post()) {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('Name', 'required');
            //if ($this->form_validation->run() == TRUE) {
            $data = $this->input->post();
            $url = site_url("admin/user/tickets/add");
            $config = array(
                "max_width" => TICKET_MAX_WIDTH,
                "max_height" => TICKET_MAX_HEIGHT,
                'max_size' => TICKET_MAX_SIZE,
                'path' => TICKET_UPLOAD_PATH,
                'allowed_types' => TICKET_ALLOWED_TYPES,
                'tpath' => TICKET_THUMB_UPLOAD_PATH,
                'twidth' => TICKET_THUMB_MAX_WIDTH,
                'theight' => TICKET_THUMB_MAX_HEIGHT
            );
            $data['Image'] = FileUploadURL("Image", "editProfilePicture", $config, '', $url);
            $res = $this->tickets_model->Insert($data);
            $this->session->set_flashdata('postsuccess', $msg);
            redirect(site_url('admin/user/tickets/'));
            /*} else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/tickets/add/' . $VisitorID));
            }*/
        }
        $data['Country'] = getCountryComboBox(101);
        $data['State'] = getStateComboBox(12);
        $data['City'] = getCityComboBox(783);
        $data['Subject'] = getSubjectComboBox();
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['loading_button'] = getLoadingButton();
        $data['users'] = getUser();
        $this->load->view('admin/tickets/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/tickets/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function edit($TicketID = 0)
    {
        //echo $TicketID;exit;
        $data = $res = array();
        $data['ticket'] = $this->tickets_model->GetByID($TicketID);
        if ($this->input->post()) {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('Name', 'required');
            //if ($this->form_validation->run() == TRUE) {
            $data = $this->input->post();
            $url = site_url("admin/user/tickets/edit");
            $config = array(
                "max_width" => TICKET_MAX_WIDTH,
                "max_height" => TICKET_MAX_HEIGHT,
                'max_size' => TICKET_MAX_SIZE,
                'path' => TICKET_UPLOAD_PATH,
                'allowed_types' => TICKET_ALLOWED_TYPES,
                'tpath' => TICKET_THUMB_UPLOAD_PATH,
                'twidth' => TICKET_THUMB_MAX_WIDTH,
                'theight' => TICKET_THUMB_MAX_HEIGHT
            );
            $data['Image'] = FileUploadURL("Image", "editProfilePicture", $config, '', $url);
            $res = $this->tickets_model->Update($data);


            $this->session->set_flashdata('postsuccess', $msg);
            redirect(site_url('admin/user/tickets/'));
            /*} else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/tickets/add/' . $VisitorID));
            }*/
        }
        $data['Country'] = getCountryComboBox(101);
        $data['State'] = getStateComboBox(12);
        $data['City'] = getCityComboBox(@$data['ticket']->CityID);
        $data['Subject'] = getSubjectComboBox(@$data['ticket']->SubjectID);
        //print_r($data['ticket']->UserID);exit;
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'edit';
        $data['TicketID'] = $TicketID;
        $data['loading_button'] = getLoadingButton();
        $data['users'] = getUser($data['ticket']->UserID);
        $this->load->view('admin/tickets/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/tickets/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    function ChangeStatus()
    {
        if ($this->cur_module->is_status == 0) {
            echo json_encode(array('result' => 'error', 'message' => label('not_eligible_for_change')));
            die;
        }
        if ($this->input->post()) {
            $res = $this->tickets_model->changeStatus($this->input->post());
            // var_dump($res);exit();             
            if ($res) {
                $message = ($this->input->post('status') == 1) ? label('status_active') : label('status_inactive');
                echo json_encode(array('result' => 'success', 'message' => $message));
            } else {
                echo json_encode(array('result' => 'error', label('please_try_again')));
            }
        }
        // parent::ChangeStatus();
    }

    public function combobox()
    {
        if ($this->input->get()) {
            $json = array();
            $_POST['Name'] = ($this->input->get('q') == "") ? '' : $this->input->get('q');
            $_POST['Status'] = 1;
            $data = $this->employee_model->listData(10, 1);
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
            "FirstName" => "First Name",
            "LastName" => "Last Name",
            "EmailID" => "Email ID",
            "MobileNo" => "Mobile No",
            "Address" => "Address"
        );

        $this->load->library('excel');
        $array['data'] = $this->employee_model->ListData(-1, 1);
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
        $filename = 'Employee.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
}
