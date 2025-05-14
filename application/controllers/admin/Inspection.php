<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inspection extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();

        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",38)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();

        if (empty($this->cur_module)) {
            show_404();
        }

        $this->load->model('admin/inspection_model');
        $this->load->model('admin/question_model');
    }

    public function index()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/inspection/list', $array);
        $data['page_level_js'] = $this->load->view('admin/inspection/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->inspection_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/inspection/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="15" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function add() {
        if(@$this->cur_module->is_insert == 0)
            show_404();
        $data = $res = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('SitesID', 'Site', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $url = site_url("admin/inspection/add");
                $config = array(
                    "max_width" => INSPECTION_MAX_HEIGHT,
                    "max_height" => INSPECTION_MAX_HEIGHT,
                    'max_size' => INSPECTION_MAX_SIZE,
                    'path' => INSPECTION_UPLOAD_PATH,
                    'allowed_types' => INSPECTION_ALLOWED_TYPES,
                    'tpath' => INSPECTION_THUMB_UPLOAD_PATH,
                    'twidth' => INSPECTION_THUMB_MAX_WIDTH,
                    'theight' => INSPECTION_THUMB_MAX_HEIGHT
                );
                $insert_data = $this->input->post();
                $insert_data['Image'] = FileUploadURL("userfile", "editProfilePicture", $config, '', $url);
                $res = $this->inspection_model->Insert($insert_data);
                //if(true) {
                if (@$res->ID) {
                    $answer_data['InspectionID'] = $insert_data['InspectionID'];
                    unset($insert_data['InspectionID']);
                    unset($insert_data['SitesID']);
                    unset($insert_data['FieldOperatorID']);
                    unset($insert_data['QualityManagerID']);
                    unset($insert_data['OperationManagerID']);
                    unset($insert_data['editProfilePicture']);
                    unset($insert_data['Remarks']);
                    unset($insert_data['Status']);
                    unset($insert_data['Image']);
                    foreach($insert_data as $key=>$item) {
                        $answer_data['QuestionID'] = $key;
                        $answer_data['Answer'] = implode(',',$item);
                        $res = $this->inspection_model->InsertAnswer($answer_data);
                    }
                    redirect(site_url( 'admin/inspection'));
                }else{
                    echo "die";
                    die;
                    $msg = label('please_try_again');
                    if(@$res->Message){
                        $arr = explode('~',$res->Message);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url( 'admin/inspection/add'));
                }
            } else {
                echo "error";
                die;
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url( 'admin/inspection/add'));
            }
        }
        $data['sites'] = getSitesComboBox();
        $data['FieldOperator'] = getUserByUsertypeComboBox('FieldOperatorID', 'FieldOperator');
        $data['OperationManager'] = getUserByUsertypeComboBox('QualityManagerID', 'OperationManager');
        $data['QualityManager'] = getUserByUsertypeComboBox('OperationManagerID', 'QualityManager');

        $data['Questions'] = $this->question_model->ListData('-1', 1);
        
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['loading_button'] = getLoadingButton();
    
        $this->load->view('admin/inspection/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/inspection/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data,$res);
    }

    public function item_ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        
        $res['data_array'] = $this->inspection_model->ItemListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/inspection/item_ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="15" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function details($ID = 0)
    {
        $res = $data = array();
        if ($ID == 0) {
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/inspection'));
        }
        $data['InspectionID'] = $ID;
        $data['loading_button'] = getLoadingButton();
        $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/inspection/details', $data);
        $res['page_level_js']  = $this->load->view('admin/inspection/details_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($res, $data);
    }

    function ChangeStatus()
    {
        if ($this->cur_module->is_status == 0) {
            echo json_encode(array('result' => 'error', 'message' => label('not_eligible_for_change')));
            die;
        }
        parent::ChangeStatus();
    }

    public function export_to_excel()
    {
        if ($this->cur_module->is_export == 0)
            show_404();
        $array = array();
        $fields = array(
            "Rno" => "Sr No",
            "Name" => "Name",
            "EmployeeName" => "Employee Name",
            "CompanyName" => "Company Name",
            "EmailID" => "EmailID",
            "MobileNo" => "Mobile No",
            "Location" => "Location",
            "Service" => "Service",
            "WorkingDays" => "Working Days",
            "WorkingHours" => "Working Hours",
            "NoOfPowerRequire" => "No Of Power Require",
            "LeadType" => "Lead Type"
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
        $filename = 'Visitor.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
}
