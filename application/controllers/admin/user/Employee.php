<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",22)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/employee_model');
    }

    public function index()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['UserType'] = getUsertypeComboBox();
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/user/employee/list', $array);
        $data['page_level_js'] = $this->load->view('admin/user/employee/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->employee_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/employee/ajax_listing', $res, TRUE);
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
            $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
            $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
            $this->form_validation->set_rules('EmailID', 'EmailID', 'trim|required');
            $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
            $this->form_validation->set_rules('Password', 'Password', 'trim|required');
            $this->form_validation->set_rules('Address', 'Address', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();

                $url = site_url("admin/user/employee/add");
                $config = array(
                    "max_width" => USERDOCUMENT_MAX_WIDTH,
                    "max_height" => USERDOCUMENT_MAX_HEIGHT,
                    'max_size' => USERDOCUMENT_MAX_SIZE,
                    'path' => USERDOCUMENT_UPLOAD_PATH,
                    'allowed_types' => USERDOCUMENT_ALLOWED_TYPES,
                    'tpath' => USERDOCUMENT_THUMB_UPLOAD_PATH,
                    'twidth' => USERDOCUMENT_THUMB_MAX_WIDTH,
                    'theight' => USERDOCUMENT_THUMB_MAX_HEIGHT
                );
                $data['Document'] = FileUploadURL("userfile", "editProfilePicture", $config, '', $url);

                $config1 = array(
                    "max_width" => USEROFEERLETTER_MAX_WIDTH,
                    "max_height" => USEROFEERLETTER_MAX_HEIGHT,
                    'max_size' => USEROFEERLETTER_MAX_SIZE,
                    'path' => USEROFEERLETTER_UPLOAD_PATH,
                    'allowed_types' => USEROFEERLETTER_ALLOWED_TYPES,
                    'tpath' => USEROFEERLETTER_THUMB_UPLOAD_PATH,
                    'twidth' => USEROFEERLETTER_THUMB_MAX_WIDTH,
                    'theight' => USEROFEERLETTER_THUMB_MAX_HEIGHT
                );
                $data['OfferLetter'] = FileUploadURL("userfile1", "editProfilePicture1", $config1, '', $url);

                $config2 = array(
                    "max_width" => USER_MAX_WIDTH,
                    "max_height" => USER_MAX_HEIGHT,
                    'max_size' => USER_MAX_SIZE,
                    'path' => USER_UPLOAD_PATH,
                    'allowed_types' => USER_ALLOWED_TYPES,
                    'tpath' => USER_THUMB_UPLOAD_PATH,
                    'twidth' => USER_THUMB_MAX_WIDTH,
                    'theight' => USER_THUMB_MAX_HEIGHT
                );
                $data['ProfilePic'] = FileUploadURL("userfile2", "editProfilePicture2", $config2, '', $url);
                $data['UsertypeID'] = $data['UsertypeID']['0'];
                $res = $this->employee_model->Insert($data);
                if (@$res->ID) {
                    redirect(site_url('admin/user/employee'));
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $add_user['Message']);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/user/employee/add'));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/employee/add'));
            }
        }
        $this->load->view('admin/includes/header');
        $data['UserType'] = getUsertypeComboBox();
        $data['page_name'] = 'add';
        $data['Country'] = getCountryComboBox(101);
        $data['State'] = getStateComboBox(12);
        $data['City'] = getCityComboBox(783);
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/employee/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/employee/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function edit($ID = NULL)
    {
        $data = $res = array();
        $data['data'] = $this->employee_model->GetByID($ID);
        if (@$data['data']->Message) {
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/masters/employee'));
        }
        if ($this->input->post()) {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
            $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
            $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
            $this->form_validation->set_rules('Address', 'Address', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $data['ID'] = $ID;
                $url = site_url("admin/user/employee/add");
                $config = array(
                    "max_width" => USERDOCUMENT_MAX_WIDTH,
                    "max_height" => USERDOCUMENT_MAX_HEIGHT,
                    'max_size' => USERDOCUMENT_MAX_SIZE,
                    'path' => USERDOCUMENT_UPLOAD_PATH,
                    'allowed_types' => USERDOCUMENT_ALLOWED_TYPES,
                    'tpath' => USERDOCUMENT_THUMB_UPLOAD_PATH,
                    'twidth' => USERDOCUMENT_THUMB_MAX_WIDTH,
                    'theight' => USERDOCUMENT_THUMB_MAX_HEIGHT
                );
                $data['Document'] = FileUploadURL("userfile", "editProfilePicture", $config, '', $url);

                $config1 = array(
                    "max_width" => USEROFEERLETTER_MAX_WIDTH,
                    "max_height" => USEROFEERLETTER_MAX_HEIGHT,
                    'max_size' => USEROFEERLETTER_MAX_SIZE,
                    'path' => USEROFEERLETTER_UPLOAD_PATH,
                    'allowed_types' => USEROFEERLETTER_ALLOWED_TYPES,
                    'tpath' => USEROFEERLETTER_THUMB_UPLOAD_PATH,
                    'twidth' => USEROFEERLETTER_THUMB_MAX_WIDTH,
                    'theight' => USEROFEERLETTER_THUMB_MAX_HEIGHT
                );
                $data['OfferLetter'] = FileUploadURL("userfile1", "editProfilePicture1", $config1, '', $url);

                $config2 = array(
                    "max_width" => USER_MAX_WIDTH,
                    "max_height" => USER_MAX_HEIGHT,
                    'max_size' => USER_MAX_SIZE,
                    'path' => USER_UPLOAD_PATH,
                    'allowed_types' => USER_ALLOWED_TYPES,
                    'tpath' => USER_THUMB_UPLOAD_PATH,
                    'twidth' => USER_THUMB_MAX_WIDTH,
                    'theight' => USER_THUMB_MAX_HEIGHT
                );
                $data['ProfilePic'] = FileUploadURL("userfile2", "editProfilePicture2", $config2, '', $url);
                $data['UsertypeID'] = $data['UsertypeID']['0'];
                $res = $this->employee_model->Update($data);
                if (@$res->ID) {
                    redirect(site_url('admin/user/employee'));
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $add_user['Message']);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/user/employee/edit/' . $ID));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/employee/edit/' . $ID));
            }
        }

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'edit/' . $ID;
        $data['UserType'] = getUsertypeComboBox($data['data']->UsertypeID);
        $data['Country'] = getCountryComboBox(101);
        $data['State'] = getStateComboBox(12);
        $data['City'] = getCityComboBox(@$data['data']->CityID);
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/employee/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/employee/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function details($ID = 0)
    {
        $res = $data = array();
        $data['data'] = $this->employee_model->GetByID($ID);
        if ($ID == 0 || @$data['data']->Message) {
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/masters/employee'));
        }
        $data['UserID'] = $ID;
        $this->load->view('admin/includes/header');
        $this->load->view('admin/user/employee/details', $data);
        $res['page_level_js']  = $this->load->view('admin/user/employee/details_js', $data, TRUE);
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
            $res = $this->employee_model->ChangePassword($this->input->post());
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
            $data = $this->employee_model->listData(-1, 1);
            foreach ($data as $key => $value) {
                if (@$value->Message)
                    break;
                $json[] = ['id' => $value->UserID, 'text' => $value->FirstName . " " . $value->LastName];
            }
            echo json_encode($json);
        }
    }

    public function comboboxbydate()
    {
        if ($this->input->post()) {
            $json = array();
            $filter = array(
                'StartDate' => $this->input->post('StartDate'),
                'EndDate' => $this->input->post('EndDate'),
                'Type' => $this->input->post('Type')
            );
            $data = $this->employee_model->ListDataByDate(-1, 1, $filter);
            foreach ($data as $key => $value) {
                if (@$value->Message)
                    break;
                $json[] = ['id' => $value->UserID, 'text' => $value->FirstName . " " . $value->LastName . ' (' . $value->MobileNo . ') - ' . $value->Usertype];
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
            $data = $this->employee_model->UserwiseListData($Type);
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
            "Address" => "Address",
            "Usertype" => "Usertype",
            "JoiningDate" => "JoiningDate",
            "CityName" => "CityName"
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

    public function getUniform($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->employee_model->getUniform($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/employee/uniform_ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function getAdvance($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->employee_model->getAdvance($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/employee/advance_ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function getSalary($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->employee_model->getSalary($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/employee/salary_ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function getRoom($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->employee_model->getRoom($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/employee/room_ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function getTraining($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->employee_model->getTraining($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/employee/training_ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }
    
    public function getAttandance($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->employee_model->getAttandance($PageSize, $CurrentPage);

        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/employee/attendance_ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function getCheckin($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->employee_model->getCheckin($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/employee/checkin_ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function addRoomAllocation($ID = NULL)
    {
        $data = $res = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('RoomNo', 'RoomNo', 'trim|required');
            $this->form_validation->set_rules('RoomAddress', 'RoomAddress', 'trim|required');
            $this->form_validation->set_rules('StartDate', 'StartDate', 'trim|required');
            $this->form_validation->set_rules('EndDate', 'EndDate', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $res = $this->employee_model->addRoomAllocation($this->input->post());

                if (@$res->ID) {
                    redirect(site_url('admin/user/employee/details/' . $this->input->post('UserID') . '/#RoomAllocation'));
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $add_user['Message']);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/user/employee/details/' . $iD));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/employee'));
            }
        }
        $data['UserID'] = $ID;
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'addRoomAllocation';
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/employee/room_allocation_add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/employee/room_allocation_add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }
    public function addUniform($ID = NULL)
    {
        $data = $res = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('UniformDate', 'UniformDate', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $res = $this->employee_model->addUniform($this->input->post());
                if (@$res->ID) {
                    redirect(site_url('admin/user/employee/details/' . $this->input->post('UserID') . '/#Uniform'));
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $add_user['Message']);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/user/employee/details/' . $iD));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/employee'));
            }
        }
        $data['UniformType'] = $this->employee_model->getUniformType();
        $data['UserID'] = $ID;
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'addUniform';
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/employee/uniform_add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/employee/uniform_add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function addTraining($ID = NULL)
    {
        $data = $res = array();
        if ($this->input->post()) {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('TrainingDateTimeID', 'TrainingDateTimeID', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $res = $this->employee_model->addTraining($this->input->post());
                if (@$res->ID) {
                    redirect(site_url('admin/user/employee/details/' . $this->input->post('UserID') . '/#Training'));
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $add_user['Message']);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/user/employee/details/' . $iD));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/employee'));
            }
        }
        $data['TrainingDateTime'] = $this->employee_model->getTrainingDateTime();
        $data['UserID'] = $ID;
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'addTraining';
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/employee/training_add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/employee/training_add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }
}
