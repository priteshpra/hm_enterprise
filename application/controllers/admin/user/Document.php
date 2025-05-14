<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Document extends Admin_Controller
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
        $this->load->model('admin/document_model');
        $this->load->model('admin/sites_model');
    }


    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->document_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/document/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function add($ID = NULL)
    {
        $data = $res = array();
        $data['SiteID'] = $ID;
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('Title', 'Name', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();

                $url = site_url("admin/user/document/add");
                $config = array(
                    "max_width" => DOCUMENT_MAX_WIDTH,
                    "max_height" => DOCUMENT_MAX_HEIGHT,
                    'max_size' => DOCUMENT_MAX_SIZE,
                    'path' => DOCUMENT_UPLOAD_PATH,
                    'allowed_types' => DOCUMENT_ALLOWED_TYPES,
                    'tpath' => DOCUMENT_THUMB_UPLOAD_PATH,
                    'twidth' => DOCUMENT_THUMB_MAX_WIDTH,
                    'theight' => DOCUMENT_THUMB_MAX_HEIGHT
                );
                $data['Document'] = FileUploadURL("userfile", "editProfilePicture", $config, '', $url);

                $res = $this->document_model->Insert($data);
                if (@$res->ID) {
                    redirect(site_url('admin/user/customer/details/' . $data['CustomerID'] . '#Document'));
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $res['Message']);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/user/document/add/' . $ID));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/document/add/' . $ID));
            }
        }

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['data'] = $this->sites_model->GetByID($ID);
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/document/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/document/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function edit($ID = NULL)
    {
        $data = $res = array();
        $data['data'] = $this->document_model->GetByID($ID);
        if (@$data['data']->Message) {
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/masters/sites'));
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('Title', 'Title', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $data['ID'] = $ID;


                $url = site_url("admin/user/document/add");
                $config = array(
                    "max_width" => DOCUMENT_MAX_WIDTH,
                    "max_height" => DOCUMENT_MAX_HEIGHT,
                    'max_size' => DOCUMENT_MAX_SIZE,
                    'path' => DOCUMENT_UPLOAD_PATH,
                    'allowed_types' => DOCUMENT_ALLOWED_TYPES,
                    'tpath' => DOCUMENT_THUMB_UPLOAD_PATH,
                    'twidth' => DOCUMENT_THUMB_MAX_WIDTH,
                    'theight' => DOCUMENT_THUMB_MAX_HEIGHT
                );
                $data['Document'] = FileUploadURL("userfile", "editProfilePicture", $config, '', $url);
                $res = $this->document_model->Update($data);
                if (@$res->ID) {
                    redirect(site_url('admin/customer/details/' . $data['SiteID'] . '#Sites'));
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $res['Message']);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/customer/details/' . $data['SiteID'] . '#Sites'));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/user/document/edit/' . $ID));
            }
        }

        $this->load->view('admin/includes/header');
        $data['SiteID'] = $data['data']->SitesID;
        $data['page_name'] = 'edit/' . $ID;
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/document/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/document/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function ChangeStatus()
    {
        parent::ChangeStatus();
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
        $array['data'] = $this->document_model->ListData(-1, 1);
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
        $filename = 'sites.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
}
