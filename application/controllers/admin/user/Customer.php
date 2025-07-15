<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",33)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/customer_model');
        $this->load->model('admin/config_model');
        $this->load->model('admin/sites_model');
        $this->configdata = $this->config_model->getConfig();
    }

    public function index()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/user/customer/list', $array);
        $data['page_level_js'] = $this->load->view('admin/user/customer/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->customer_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/customer/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function sitecombobox()
    {
        if ($this->input->get()) {
            $json = array();
            //$_POST['UsertypeData'] = ($this->input->get('q')=="")?'':$this->input->get('q');
            $data = $this->sites_model->ListData(-1, 1);
            foreach ($data as $key => $value) {
                if (@$value->Message)
                    break;
                $json[] = ['id' => $value->SitesID, 'text' => $value->SiteName];
            }

            echo json_encode($json);
        }
    }

    public function details($ID = 0)
    {
        $res = $data = array();
        $data['data'] = $this->customer_model->GetByID($ID);

        if ($ID == 0 || @$data['data']->Message) {
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/user/customer'));
        }
        $data['CustomerID'] = $ID;
        $data['VisitorID'] = $data['data']->VisitorID;
        $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/user/customer/details', $data);
        $res['page_level_js']  = $this->load->view('admin/user/customer/details_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($res, $data);
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
        $array['data'] = $this->customer_model->ListData(-1, 1);
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
        $filename = 'Customer.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
}
