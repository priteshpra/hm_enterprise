<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_GetRoleMappingByID(" . $this->UserRoleID . ",37)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/quotation_model');
        $this->load->model('api/master_model');
        $this->load->model('admin/invoice_model');
        $this->load->model('admin/sites_model');
        $this->load->model('admin/config_model');
        $this->configdata = $this->config_model->getConfig();
    }

    public function index()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/user/invoice/list', $array);
        $data['page_level_js'] = $this->load->view('admin/user/invoice/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['PageSize'] = $PageSize;
        $res['CurrentPage'] = $CurrentPage;
        $res['data_array'] = $this->invoice_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['TotalRecords'] = 0;
        else
            $res['TotalRecords'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['TotalRecords'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/user/invoice/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="15" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function add($ID = NULL)
    {
        // print_r($this->input->post());
        // die;
        $data = $res = array();
        $data['data'] = $this->quotation_model->GetByID($ID);
        // $Sites = $this->sites_model->GetByID($data['data']->SitesID);
        $Sites = $this->sites_model->GetByID($this->input->post('SitesID'));

        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('SitesID', 'SitesID', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $res = $this->invoice_model->Insert($data);
                if (@$res->ID) {

                    $item = array();
                    $item['InvoiceID'] = @$res->ID;
                    if ($data['UsertypeID'] != 0) {
                        for ($i = 0; $i < count($data['UsertypeID']); $i++) {
                            $item['UsertypeID'] = $data['UsertypeID'][$i];
                            $item['HSN_SAC'] = $data['HSN_SAC'][$i];
                            $item['Qty'] = $data['Qty'][$i];
                            $item['Rate'] = $data['Rate'][$i];
                            $item['Amount'] = $item['Qty'] * $item['Rate'];
                            $this->invoice_model->InsertItem($item);
                        }
                    }

                    $this->PrintReceipt(@$res->ID);
                    redirect(site_url('admin/user/customer/details/' . $data['CustomerID'] . '#Invoice'));
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

        $_POST['QuotationID'] = $ID;
        $_POST['Status'] = 1;
        $data['item'] = $this->quotation_model->ItemListData(-1, 1);
        $data['CGST'] = $this->configdata->CGST;
        $data['SGST'] = $this->configdata->SGST;
        $data['IGST'] = $this->configdata->IGST;

        if (@$Sites->StateID == 12) {
            $data['ISIGST'] = 'No';
        } else {
            $data['ISIGST'] = 'Yes';
        }
        $data['ID'] = $ID;

        $data['Usertype'] = getUsertypeComboBox();

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/invoice/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/invoice/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function addwithoutfixcost($ID = NULL)
    {
        $data = $res = array();
        $data['data'] = $this->quotation_model->GetByID($ID);

        $Sites = $this->sites_model->GetByID($data['data']->SitesID);

        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('SitesID', 'SitesID', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $res = $this->invoice_model->Insert($data);
                if (@$res->ID) {

                    $item = array();
                    $item['InvoiceID'] = @$res->ID;

                    for ($i = 0; $i < count($data['UsertypeID']); $i++) {
                        $item['UsertypeID'] = $data['UsertypeID'][$i];
                        $item['HSN_SAC'] = $data['HSN_SAC'][$i];
                        $item['Qty'] = $data['Qty'][$i];
                        $item['Rate'] = $data['Rate'][$i];
                        $item['Amount'] = $item['Qty'] * $item['Rate'];
                        $this->invoice_model->InsertItem($item);
                    }

                    $this->PrintReceipt(@$res->ID);
                    //redirect(site_url('admin/user/customer/details/' . $data['CustomerID'] . '#Invoice'));
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

        $_POST['QuotationID'] = $ID;
        $_POST['Status'] = 1;

        $data['ID'] = $ID;

        $data['CGST'] = $this->configdata->CGST;
        $data['SGST'] = $this->configdata->SGST;
        $data['IGST'] = $this->configdata->IGST;

        if (@$Sites->StateID == 12) {
            $data['ISIGST'] = 'No';
        } else {
            $data['ISIGST'] = 'Yes';
        }

        $data['Usertype'] = getUsertypeComboBox();

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/user/invoice/addwithoutfixcost_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/user/invoice/addwithoutfixcost_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function getUserDataByDate()
    {
        $_POST['QuotationID'] = $this->input->post('id');
        $_POST['StartDate'] = $this->input->post('startdate');
        $_POST['EndDate'] = $this->input->post('enddate');
        $data['item'] = $this->invoice_model->ListInvoiceAttendance(-1, 1);
        //$data['material'] = $this->invoice_model->ListInvoiceMaterial(-1, 1);
        $this->load->view('admin/user/invoice/ajax_item_withoutfixcost', $data);
    }
    public function getMaterialDataByDate()
    {
        $_POST['QuotationID'] = $this->input->post('id');
        $_POST['StartDate'] = $this->input->post('startdate');
        $_POST['EndDate'] = $this->input->post('enddate');
        //$data['item'] = $this->invoice_model->ListInvoiceAttendance(-1, 1);
        $data['material'] = $this->invoice_model->ListInvoiceMaterial(-1, 1);
        $this->load->view('admin/user/invoice/ajax_item_withoutfixcost_material', $data);
    }
    public function ajax_userclone($ID = 1)
    {
        $data['ID'] = $ID;
        $data['Usertype'] = getUsertypeComboBox();
        $this->load->view('admin/user/invoice/ajax_dynamic', $data);
    }
    public function ajax_materialclone($ID = 1)
    {
        $data['ID'] = $ID;
        $data['Usertype'] = getUsertypeMaterialComboBox();
        $this->load->view('admin/user/invoice/ajax_dynamic', $data);
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
            "InvoiceNo" => "InvoiceNo",
            "SiteUserFrindlyName" => "Company Name/Individual Name",
            "InvoiceDate" => "Invoice Date",
            "TotalAmount" => "Total Amount",
            "SubTotal" => "Sub Total",
            "CGST" => "CGST",
            "SGST" => "SGST",
            "IGST" => "IGST",
            "Notes" => "Notes",
            "Terms" => "Terms"
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
        $filename = 'Invoice.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    public function PrintReceipt($ID)
    {
        $result = array();

        $Invoice = $this->master_model->getQueryResult("call usp_A_GetInvoiceByID('" . $ID . "')");
        $Quotation = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" . $Invoice['0']->QuotationID . "')");
        $Item = $this->master_model->getQueryResult("call usp_A_GetInvoiceItem('-1','1','" . $ID . "','1')");
        $Sites = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" . $Invoice['0']->SitesID . "')");
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

        $html .= '  <div>
                        <div style="border:1px solid #c3c3c3;">
                            <table>
                                <tr>
                                    <td><img src="' . base_url(DEFAULT_WEBSITE_LOGO) . '" style="height:85px;"></td>
                                    <td style="text-align:left;">
                                        <div style="font-size:12px; ">
                                            <b>' . $Company['0']->CompanyName . '</b><br>
                                            ' . $Company['0']->Address . '<br>
                                            GSTIN ' . $Company['0']->GSTNo . '
                                        </div>
                                    </td>
                                    <td>
                                        <span style="text-align:right;font-size:25px;"><br/><br/>TAX INVOICE </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                            <table cellpadding="4" style="font-size:12px;">
                                <tr>
                                    <td style="border-left:1px solid #c3c3c3;border-top:1px solid #c3c3c3;border-bottom:1px solid #c3c3c3;">
                                        <table>
                                            <tr>
                                                <td>Invoice No. </td>
                                                <td style="border-right:1px solid #c3c3c3;"><b>: ' . $Invoice['0']->InvoiceNo . '</b></td>
                                            </tr>
                                            <tr>
                                                <td>Invoice Date </td>
                                                <td style="border-right:1px solid #c3c3c3;"><b>: ' . $Invoice['0']->InvoiceDate  . '</b></td>
                                            </tr>
                                            <tr>
                                                <td>Terms </td>
                                                <td style="border-right:1px solid #c3c3c3;"><b>:  ' . $Invoice['0']->Terms . '</b></td>
                                            </tr>
                                            <tr>
                                                <td>Due Date </td>
                                                <td style="border-right:1px solid #c3c3c3;"><b>: ' . date('d-m-Y', strtotime($Invoice['0']->InvoiceDate . ' + 5 days')) . '</b></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="border-right:1px solid #c3c3c3;border-top:1px solid #c3c3c3;border-bottom:1px solid #c3c3c3;">
                                        <table>
                                              <tr>
                                                <td>Place of Supply</td>
                                                <td><b>: ' . $Sites['0']->StateName . ' (' . $Sites['0']->GSTCode . ')</b></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table style="font-size:12px;" cellpadding="4">
                                <tr >
                                    <td style="border:1px solid #c3c3c3;background-color: #e0e0e0;"><b>Bill To</b></td>
                                    <td style="border:1px solid #c3c3c3;background-color: #e0e0e0;"><b>Ship To</b></td>
                                </tr>
                                <tr>
                                    <td style="border-left:1px solid #c3c3c3;border-top:1px solid #c3c3c3;border-bottom:1px solid #c3c3c3;">
                                        <table>
                                            <tr>
                                                <td style="border-right:1px solid #c3c3c3;">
                                                    <b>' . $Sites['0']->Name . '</b><br>
                                                    ' . $Sites['0']->Address . ' ' . $Sites['0']->Address2 . '<br>
                                                    ' . $Sites['0']->CityName . ' ' . $Sites['0']->StateName . '<br>
                                                    ' . $Sites['0']->PinCode . '<br>
                                                    GSTIN ' . $Sites['0']->GSTNo . '
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="border-right:1px solid #c3c3c3;border-top:1px solid #c3c3c3;border-bottom:1px solid #c3c3c3;">
                                        <table>
                                            <tr>
                                                <td>' . $Quotation['0']->Address . ' ' . $Quotation['0']->Address2 . '<br>
                                                ' . $Quotation['0']->CityName . ' ' . $Quotation['0']->StateName . '<br>
                                                ' . $Quotation['0']->PinCode . '</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>';
        $html .= '
                <table style="border:1px solid #c3c3c3;font-size:12px;"  cellpadding="4">
                    <tr>
                        <td style="border:1px solid #c3c3c3; width: 25px;"><b>#</b></td>
                        <td style="border:1px solid #c3c3c3; width: 250px;"><b>Item & Description</b></td>
                        <td style="border:1px solid #c3c3c3; width: 100px;"><b>HSN/SAC</b></td>
                        <td style="border:1px solid #c3c3c3; width: 75px; text-align:right;"><b>Qty</b></td>
                        <td style="border:1px solid #c3c3c3; width: 94px; text-align:right;"><b>Rate</b></td>
                        <td style="border:1px solid #c3c3c3; width: 94px; text-align:right;"><b>Amount</b></td>
                    </tr>';
        foreach ($Item as $key => $value) {
            $html .= '
                <tr>
                    <td style="border:1px solid #c3c3c3; width: 25px;font-size:12px;">' . ($key + 1) . '</td>
                    <td style="border:1px solid #c3c3c3;">
                        ' . $value->Usertype . '
                    </td>
                    <td style="border:1px solid #c3c3c3;">' . $value->HSNNo . '</td>
                    <td style="border:1px solid #c3c3c3; text-align:right;">' . $value->Qty . ' <br> NO.</td>
                    <td style="border:1px solid #c3c3c3; text-align:right;">' . $value->Rate . '</td>
                    <td style="border:1px solid #c3c3c3; text-align:right;">' . $value->Qty * $value->Rate . '</td>
                </tr>
            ';
        }
        $html .= '</table>    
        ';

        $html .= '
            <table cellpadding="4" style="font-size:12px;">
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td>
                                <br/><br/>Total In Words<br/>
                                    <b>' . numberTowords((int)($Invoice['0']->TotalAmount)) . '</b>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="border:1px solid #c3c3c3;">
                        <table style="text-align:right;">
                            <tr>
                                <td>Sub Total</td>
                                <td>' . $Invoice['0']->SubTotal . '</td>
                            </tr>';

        if ($Invoice['0']->IGST == '' || $Invoice['0']->IGST == 0) {
            $html .= '<tr>
                                <td>CGST' . $this->configdata->CGST . ' (' . $this->configdata->CGST . '%)</td>
                                <td>' . $Invoice['0']->CGST . '</td>
                            </tr>
                            <tr>
                                <td>SGST' . $this->configdata->SGST . ' (' . $this->configdata->SGST . '%)</td>
                                <td>' . $Invoice['0']->SGST . '</td>
                            </tr>';
        } else {
            $html .= '
                            <tr>
                                <td>IGST' . $this->configdata->IGST . ' (' . $this->configdata->IGST . '%)</td>
                                <td>' . $Invoice['0']->IGST . '</td>
                            </tr>
                            ';
        }

        $html .= '<tr>
                                <td><b>Total</b></td>
                                <td><b>' . $Invoice['0']->TotalAmount . '</b></td>
                            </tr>
                            <tr>
                                <td><b>Balance Due</b></td>
                                <td><b>' . $Invoice['0']->TotalAmount . '</b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td>
                                <br/><br/>' . $Quotation['0']->Service . ' BILL (' . date('M Y') . ')<br/><br/>
                                ' . $Invoice['0']->Notes . '<br/><br/>
                                BANK A/C DETAILS :<br/>
                                ' . $Company['0']->CompanyName . '<br/>
                                ACC : ' . $Company['0']->AccountNo . '<br/>
                                IFSC : ' . $Company['0']->IFSCCode . '<br/>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="border:1px solid #c3c3c3;">
                        <table style="text-align:center;">
                            <tr>
                                <td>For, GROWTHIFY COMPANY<br/><br/><br/><br/><br/><br/>Authorized Signature
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>';

        $html .= '</div>';

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
            $structure = './assets/uploads/invoice/';
            $File = $ID . '_' . date('dmY') . '.pdf';
            $path = FCPATH . $structure . $File;
        }

        $data = array();
        $this->master_model->getQueryResult("call usp_updateinvoicepdf('" . $ID . "','" . $File . "')");
        //Close and output PDF document

        $pdf->Output($path, 'F');
        return $path;
    }
}
