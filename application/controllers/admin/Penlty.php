<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penlty extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();

        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",39)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();

        if (empty($this->cur_module)) {
            show_404();
        }

        $this->load->model('admin/penlty_model');
        $this->load->model('admin/reason_model');
        $this->load->model('admin/employee_model');
    }

    public function index()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['Service'] = getServiceComboBox();
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/penlty/list', $array);
        $data['page_level_js'] = $this->load->view('admin/penlty/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }
    
    public function add() {
        if(@$this->cur_module->is_insert == 0)
            show_404();
        $data = $res = array();
        if ($this->input->post()) {
            //$this->load->library('form_validation');
            // $this->form_validation->set_rules('Reasons', 'Reason', 'trim|required');
            // $this->form_validation->set_rules('Users', 'User', 'trim|required');
            // $this->form_validation->set_rules('Amounts', 'Amount', 'trim|required');
            //if ($this->form_validation->run() == TRUE) {
                $reasons = implode(', ', $this->input->post('Reasons'));
                $penalty = $this->penlty_model->Insert(array(
                    'SiteID' => $this->input->post('SitesID'),
                    'Reason' => $reasons,
                    'PenaltyDate'=>date('d-m-Y'),
                    'Status'    => 'on'
                ));
                
                $PenaltyID = @$penalty->ID;
                //foreach($)
                for($i=0; $i<sizeof($this->input->post('Users')); $i++) {
                    $UserID = $this->input->post('Users')[$i];
                    $Penalty = $this->input->post('Amounts')[$i];
                    $this->penlty_model->InsertItem(array(
                        'PenaltyID' => $PenaltyID,
                        'UserID'    => $UserID,
                        'Penalty'   => $Penalty,
                        'Status'    => 'on'
                    ));

                }
                if (@$penalty->ID) {
                    redirect(site_url( 'admin/penlty'));
                }else{
                    $msg = label('please_try_again');
                    if(@$res->Message){
                        $arr = explode('~',$res->Message);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url( 'admin/penlty/add'));
                }
            /* } else {
                pr($_POST);
                die;
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url( 'admin/penlty/add'));
            } */
        }
        
        $data['reasons'] = $this->reason_model->ListData('-1', 1);
        $data['users'] = $this->employee_model->ListData('-1', 1);
        $data['users_combo'] = getUsertypeComboBox();//$this->employee_model->ListData('-1', 1);
        
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['loading_button'] = getLoadingButton();
    
        $this->load->view('admin/penlty/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/penlty/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data,$res);
    }

    function ChangeStatus() {
        if($this->cur_module->is_status == 0){
            echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
            die;
        }
        parent::ChangeStatus();
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->penlty_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/penlty/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="15" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function item_ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->penlty_model->ItemListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/penlty/item_ajax_listing', $res, TRUE);
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
            redirect(site_url('admin/panlty'));
        }
        $data['PenaltyID'] = $ID;
        $data['loading_button'] = getLoadingButton();
        $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/penlty/details', $data);
        $res['page_level_js']  = $this->load->view('admin/penlty/details_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($res, $data);
    }
    public function addUserView() {
        $data['user_id'] = $this->input->post('user_id');
        $data['user_name'] = $this->input->post('user_name');
        $data['amount'] = $this->input->post('amount');
        $this->load->view('admin/penlty/ajax_dynamic', $data);

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
