<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quotation extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",46)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/quotation_model');
        $this->load->model('admin/sites_model');
        $this->load->model('api/master_model');
        $this->load->model('admin/reason_model');
        $this->load->model('admin/config_model');
        $this->load->model('admin/visitor_model');
        $this->load->model('admin/notes_model');
        $this->configdata = $this->config_model->getConfig();
    }

    public function index()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/user/quotation/list', $array);
        $data['page_level_js'] = $this->load->view('admin/user/quotation/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function menuajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->quotation_model->MenuListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/quotation/ajax_listing', $res, TRUE);
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
        $res['data_array'] = $this->quotation_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/quotation/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="16" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function add($ID = NULL)
    {
        $data = $res = array();
        $Sites = $this->sites_model->GetByID($ID);
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('CompanyID', 'CompanyID', 'trim|required');
            $this->form_validation->set_rules('Address', 'Address', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $data['SubTotal'] = $data['SubTotal'];
                $WRTotal = @$data['SubTotal'] + @$data['CGST'] + @$data['SGST'] + @$data['IGST'];
                $Total = round($WRTotal);
                if ($WRTotal > $Total) {
                    $Rounding = $WRTotal - $Total;
                } else {
                    $Rounding = $Total - $WRTotal;
                }
                $data['Rounding'] = round($Rounding, 2);
                $data['Total'] = $Total;

                $res = $this->quotation_model->Insert($data);

                if (@$res->ID) {

                    $item = array();
                    $item['QuotationID'] = @$res->ID;
                    for ($i = 0; $i < count($data['UsertypeID']); $i++) {
                        $item['UsertypeID'] = $data['UsertypeID'][$i];
                        $item['HSN_SAC'] = $data['HSN_SAC'][$i];
                        $item['Qty'] = $data['Qty'][$i];
                        $item['Rate'] = $data['Rate'][$i];
                        $item['Days'] = $data['Days'][$i];
                        $item['Amount'] = $item['Days'] * $item['Qty'] * $item['Rate'];
                        $this->quotation_model->InsertItem($item);
                    }

                    $this->PrintReceipt(@$res->ID);

                    if ($data['CustomerID'] > 0) {
                        redirect(site_url('admin/user/customer/details/' . $data['CustomerID'] . '#Quotation'));
                    } else {
                        redirect(site_url('admin/user/visitor/details/' . $data['VisitorID'] . '#Quotation'));
                    }
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
        $data['Notes'] = $this->notes_model->GetByType('Quotation');
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['CustomerID'] = $Sites->CustomerID;
        $data['VisitorID'] = $Sites->VisitorID;
        $data['SitesID'] = $ID;

        $data['Company'] = getCompanyComboBox();
        //$data['Usertype'] = getUsertypeComboBox();
        $data['Usertype'] = getUsertypeComboBox(0, 1);
        $data['UsertypeMaterial'] = getUsertypeMaterialComboBox(0, 1);
        $data['Country'] = getCountryComboBox(101);
        $data['State'] = getStateComboBox(@$Sites->StateID);
        $data['City'] = getCityComboBox(@$Sites->CityID);

        $data['Service'] = getServiceComboBox();

        $data['Sites'] = $Sites;
        $data['Visitor'] = $this->visitor_model->GetByID($Sites->VisitorID);

        $data['CGST'] = $this->configdata->CGST;
        $data['SGST'] = $this->configdata->SGST;
        $data['IGST'] = $this->configdata->IGST;

        if (@$Sites->StateID == 12) {
            $data['ISIGST'] = 'No';
        } else {
            $data['ISIGST'] = 'Yes';
        }


        $data['data'] = $Sites;
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/quotation/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/quotation/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function ajax_userclone($ID = 1)
    {
        $data['ID'] = $ID;
        $data['Usertype'] = getUsertypeComboBox();
        $this->load->view('admin/user/quotation/ajax_dynamic', $data);
    }

    public function reject($ID = 0)
    {
        $data = $res = array();
        if ($this->input->post()) {
            $data = $this->input->post();
            $res = $this->quotation_model->convertToReject($data);
            if (@$res->ID) {
                redirect(site_url('admin/user/visitor/details/' . $data['VisitorID'] . "#Quotation"));
            } else {
                $msg = label('please_try_again');
                if (@$res->Message) {
                    $arr = explode('~', $res['Message']);
                    $msg = @$arr[1];
                }
                $this->session->set_flashdata('posterror', $msg);
                redirect(site_url('admin/user/quotation/reject/' . $ID));
            }
        }
        $this->load->view('admin/includes/header');
        $data['dataq'] = $this->quotation_model->GetByID($ID);
        $data['reason_array'] = $this->reason_model->ListData(-1, 1);
        $data['page_name'] = 'reassign';
        $data['loading_button'] = getLoadingButton();
        $data['ID'] = $ID;
        $this->load->view('admin/user/quotation/rejectadd_edit', $data);
        $array['page_level_js'] = $this->load->view('admin/user/quotation/rejectadd_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $array);
    }

    public function accept($ID = 0)
    {
        $data = $res = array();

        if ($this->input->post()) {
            $data = $this->input->post();

            if ($data['CustomerID'] == 0) {
                $customer = $this->quotation_model->convertToCustomer($data);
                $data['CustomerID'] = $customer->ID;
            }

            $res = $this->quotation_model->convertToAccept($data);

            if (@$res->ID) {
                redirect(site_url('admin/user/visitor/details/' . $data['VisitorID'] . "#Quotation"));
            } else {
                $msg = label('please_try_again');
                if (@$res->Message) {
                    $arr = explode('~', $res['Message']);
                    $msg = @$arr[1];
                }
                $this->session->set_flashdata('posterror', $msg);
                redirect(site_url('admin/user/quotation/accept/' . $ID));
            }
        }

        $this->load->view('admin/includes/header');
        $data['dataq'] = $this->quotation_model->GetByID($ID);
        $data['page_name'] = 'accept';
        $data['loading_button'] = getLoadingButton();
        $data['ID'] = $ID;
        $this->load->view('admin/user/quotation/acceptadd_edit', $data);
        $array['page_level_js'] = $this->load->view('admin/user/quotation/acceptadd_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $array);
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
            "EstimateNo" => "Estimate No",
            "CompanyName" => "Company Name",
            "Service" => "Service",
            "SiteName" => "Site Name",
            "Name" => "Name",
            "Total" => "Total",
            "CGST" => "CGST",
            "SGST" => "SGST",
            "IGST" => "IGST",
            "QuotationStatus" => "QuotationStatus",
        );

        $this->load->library('excel');
        $array['data'] = $this->quotation_model->ListData(-1, 1);
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
        $filename = 'Quotation.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    public function PrintReceipt($ID)
    {
        $result = array();

        $Quotation = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" . $ID . "')");
        $Item = $this->master_model->getQueryResult("call usp_A_GetQuotationitem('-1','1','" . $ID . "','1','-1')");
        $Sites = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" . $Quotation['0']->SitesID . "')");
        $Company = $this->master_model->getQueryResult("call usp_A_GetCompanyByID('" . $Quotation['0']->CompanyID . "')");

        ob_start();
        require_once BASEPATH . "tcpdf/tcpdf.php";
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetKeywords('TCPDF, PDF');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $path = '';

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(BASEPATH . 'tcpdf/examples/lang/eng.php')) {
            require_once(BASEPATH . 'tcpdf/examples/lang/eng.php');
            if (!isset($l) || empty($l)) {
                $l = array();
                $l['a_meta_charset'] = 'UTF-8';
                $l['a_meta_dir'] = 'ltr';
                $l['a_meta_language'] = 'en';
                $l['w_page'] = 'page';
            }
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('helvetica', '', 9);

        // add a page
        $pdf->AddPage();

        $html = '';

        $html .= '<!DOCTYPE html>
            <html>
            <head>
                <title>Estimation</title>
            </head>
            <body>';

        $html .= '
                    <div>
                        <table>
                            <tr>
                                <td><img src="' . base_url(DEFAULT_WEBSITE_LOGO) . '" style="height:85px;"></td>
                                <td style="text-align:right;"><b><span style="font-size:30px;">Estimate</span><br> ' . $Quotation['0']->EstimateNo . '</b></td>
                            </tr>
                        </table><br>
                        <div style="font-size:12px;">
                            <b>' . $Company['0']->CompanyName . '</b><br>
                            ' . $Company['0']->Address . '<br>
                            GSTIN ' . $Company['0']->GSTNo . '
                        </div><br>
                        <table>
                            <tr>
                                <td style="width: 400px;">
                                    Bill To<br>
                                    <b>' . $Sites['0']->Name . '</b><br>
                                    ' . $Sites['0']->Address . ' ' . $Sites['0']->Address2 . '<br>
                                    ' . $Sites['0']->CityName . ' ' . $Sites['0']->StateName . '<br>
                                    ' . $Sites['0']->PinCode . '<br>
                                    ' . (($Sites['0']->GSTNo!='')?('GSTIN '.$Sites['0']->GSTNo):('')). '
                                </td>
                                <td>
                                Ship To<br>
                                <b>' . $Quotation['0']->Address . ' ' . $Quotation['0']->Address2 . '</b><br>
                                ' . $Quotation['0']->CityName . ' ' . $Quotation['0']->StateName . '<br>
                                ' . $Quotation['0']->PinCode . '
                                </td>
                            </tr>
                        </table><br><br>
                        <table>
                            <tr>
                                <td>Place Of Supply: ' . $Sites['0']->StateName . ' (' . $Sites['0']->GSTCode . ')<br/></td>
                                <td style="text-align:right;">Estimate Date : ' . $Quotation['0']->EstimateDate . '<br/></td>
                            </tr>
                        </table><br>
                        <table border="1" cellpadding="8">
                            <tr style="background-color:black;color:white;">
                                <th>#</th>
                                <th>Item</th>
                                <th>HSN/SAC </th>
                                <th>Qty</th>
                                <th>Days</th>
                                <th>Rate</th>
                                <th>Amount</th>
                            </tr>';

        foreach ($Item as $key => $value) {
            $html .= '
                                <tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td>' . $value->Usertype . '</td>
                                    <td>' . $value->HSNNo . '</td>
                                    <td>' . $value->Qty . '</td>
                                    <td>' . $value->Days . '</td>
                                    <td>' . $value->Rate . '</td>
                                    <td>' . $value->Qty * $value->Rate * $value->Days. '</td>
                                </tr>';
        }


        $html .=     '<tr>
                                <td colspan="4"></td>
                                <td colspan="2">Sub Total</td>
                                <td>' . $Quotation['0']->SubTotal . '</td>
                            </tr>';

        if ($Quotation['0']->IGST == '' || $Quotation['0']->IGST == 0) {
            $html .=            '<tr>
                                <td colspan="4"></td>
                                <td colspan="2">CGST (' . $this->configdata->CGST . '%)</td>
                                <td>' .  (float)$Quotation['0']->CGST . '</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td colspan="2">SGST (' . $this->configdata->SGST . '%)</td>
                                <td>' . (float)$Quotation['0']->SGST . '</td>
                            </tr>';
        } else {
            $html .=        '<tr>
                                <td colspan="4"></td>
                                <td colspan="2">IGST (' . $this->configdata->IGST . '%)</td>
                                <td>' .  (float)$Quotation['0']->IGST . '</td>
                            </tr>
                            ';
        }


        $html .=            '<tr>
                                <td colspan="4"></td>
                                <td colspan="2">Rounding</td>
                                <td>' . $Quotation['0']->Rounding . '</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td colspan="2"><b>Total</b></td>
                                <td><b>Rs. ' . ((float)$Quotation['0']->Total) . '</b></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Total In Words: </b></td>
                                <td colspan="5" style="text-transform: uppercase;">' . numberTowords((float)$Quotation['0']->Total) . '</td>
                            </tr>
                        </table><br>
                        <div>
                            <b>Notes</b><br>
                            '.$Quotation['0']->Note.'
                        </div><br>
                        <div>
                            <b>Terms & Conditions</b><br/>
                            '.$Quotation['0']->Term.'<br/><br/><br/>
                            <b>Authorized Signature _________________________________</b>
                        </div>
                    </div>';

        $html .= '    </body>
            </html>';

        // output the HTML content
        /*$pdf->StartTransform();
        $pdf->Rotate(-10);*/
        $pdf->writeHTML($html, true, false, true, false, '');
        /*$pdf->StopTransform();*/

        // reset pointer to the last page
        $pdf->lastPage();
        $File = '';
        // ---------------------------------------------------------
        if ($path == '') {
            $structure = './assets/uploads/estimation/';
            $File = $ID . '_' . date('dmY') . '.pdf';
            $path = FCPATH . $structure . $File;
        }

        $data = array();
        $this->master_model->getQueryResult("call usp_updatequotationpdf('" . $ID . "','" . $File . "')");
        //Close and output PDF document

        $pdf->Output($path, 'F');
        return $path;
    }
}
