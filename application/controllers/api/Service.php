<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(); ini_set('display_errors', 1);

class Service extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('api/master_model', '', TRUE);
        $this->load->model('admin/role_model');
        $this->load->helper("phpmailerautoload");
    }

    // check valid JSON
    function checkvalidjson($json)
    {
        //$obj = json_decode(stripslashes($json), TRUE);
        $obj = json_decode($json, TRUE);
        if (is_null($obj)) {
            $response['error'] = 1;
            $response['data'] = "Invalid Json format";
            echo json_encode($response);
            exit();
            //return $response;
        } else {
            $data = json_decode($json);
            return $data;
        }
    }

    function index()
    {
        header('Content-type: application/json');
        $data = file_get_contents('php://input');

        if ($data != '' && $data != NULL) {
            $data = $this->checkvalidjson($data);
            $method = $data->method;
            $json = $data->body;
        } else {
            $method = $this->input->post('method');
            if ($method == "addCustomerSitesDocument") {
                $json = array(
                    'SitesID' => $this->input->post('SitesID'),
                    'UserID'  => $this->input->post('UserID'),
                    'Title'   => $this->input->post('Title'),
                    'QuotationID'   => $this->input->post('QuotationID')
                );
            } elseif ($method == "editCustomerSitesDocument") {
                $json = array(
                    'CustomerSitesDocumentID' => $this->input->post('CustomerSitesDocumentID'),
                    'UserID'  => $this->input->post('UserID'),
                    'Title'   => $this->input->post('Title')
                );
            } elseif ($method == "addTicket") {
                $json = array(
                    'UserID' => $this->input->post('UserID'),
                    'Title'  => $this->input->post('Title'),
                    'Description'   => $this->input->post('Description'),
                    'Priority'   => $this->input->post('Priority'),
                    'CityID'   => $this->input->post('CityID'),
                    'SubjectID'   => $this->input->post('SubjectID')
                );
            } elseif ($method == "addEmployee") {
                $json = array(
                    'FirstName'  => $this->input->post('FirstName'),
                    'LastName'   => $this->input->post('LastName'),
                    'EmailID'   => $this->input->post('EmailID'),
                    'Password'   => $this->input->post('Password'),
                    'MobileNo'   => $this->input->post('MobileNo'),
                    'Address'   => $this->input->post('Address'),
                    'UsertypeID'   => $this->input->post('UsertypeID'),
                    'Salary'   => $this->input->post('Salary'),
                    'JoiningDate'  => $this->input->post('JoiningDate'),
                    'WorkingHours' => $this->input->post('WorkingHours'),
                    'BankName' => $this->input->post('BankName'),
                    'BranchName' => $this->input->post('BranchName'),
                    'AccountNo' => $this->input->post('AccountNo'),
                    'IFSCCode' => $this->input->post('IFSCCode'),
                    'CityID' => $this->input->post('CityID'),
                    'GSTNo' => $this->input->post('GSTNo'),
                    'RoleID' => $this->input->post('RoleID')
                );
            } elseif ($method == "addInspectionImage") {
                $json = array(
                    'InspectionID' => $this->input->post('InspectionID')
                );
            } elseif ($method == "editInstallation") {
                $json = array(
                    'UserID' => $this->input->post('UserID'),
                    'ChallanItemID' => $this->input->post('ChallanItemID'),
                    'IndoorSrNo' => $this->input->post('IndoorSrNo'),
                    'OutdoorSrNo' => $this->input->post('OutdoorSrNo'),
                    'IndoorImage' => $this->input->post('IndoorImage'),
                    'OutdoorImage' => $this->input->post('OutdoorImage')
                );
            } elseif ($method == "addAcUnit") {
                $json = array(
                    'UserID' => $this->input->post('UserID'),
                    'ChallanItemID' => $this->input->post('ChallanItemID'),
                    'SiteID' => $this->input->post('SiteID'),
                    'ProductID' => $this->input->post('ProductID'),
                    'Rate' => $this->input->post('Rate'),
                    'IndoorSrNo' => $this->input->post('IndoorSrNo'),
                    'OutdoorSrNo' => $this->input->post('OutdoorSrNo'),
                    'IndoorImage' => $this->input->post('IndoorImage'),
                    'OutdoorImage' => $this->input->post('OutdoorImage')
                );
            }
        }

        switch ($method) {
            case 'checkLogin':
                $res = $this->checkLogin($json);
                break;
            case 'changePassword':
                $res = $this->changePassword($json);
                break;
            case 'forgotPassword':
                $res = $this->forgotPassword($json);
                break;
            case 'getConfig':
                $res = $this->getConfig($json);
                break;
            case 'getPage':
                $res = $this->getPage($json);
                break;
            case 'getStates':
                $res = $this->getStates($json);
                break;
            case 'getCities':
                $res = $this->getCities($json);
                break;
            case 'getRole':
                $res = $this->getRole($json);
                break;
            case 'getVisitor':
                $res = $this->getVisitor($json);
                break;
            case 'getEmployee':
                $res = $this->getEmployee($json);
                break;
            case 'getEmployeeTraining':
                $res = $this->getEmployeeTraining($json);
                break;
            case 'getEmployeeUniform':
                $res = $this->getEmployeeUniform($json);
                break;
            case 'getEmployeeRoom':
                $res = $this->getEmployeeRoom($json);
                break;
            case 'getQuotation':
                $res = $this->getQuotation($json);
                break;
            case 'getSitesByTab':
                $res = $this->getSitesByTab($json);
                break;
            case 'getSites':
                $res = $this->getSites($json);
                break;
            case 'getCustomer':
                $res = $this->getCustomer($json);
                break;
            case 'addEmployeeRoom':
                $res = $this->addEmployeeRoom($json);
                break;
            case 'getUniformType':
                $res = $this->getUniformType($json);
                break;
            case 'addEmployeeUniform':
                $res = $this->addEmployeeUniform($json);
                break;
            case 'getTrainingDateTime':
                $res = $this->getTrainingDateTime($json);
                break;
            case 'addEmployeeTraining':
                $res = $this->addEmployeeTraining($json);
                break;
            case 'addVisitor':
                $res = $this->addVisitor($json);
                break;
            case 'addSites':
                $res = $this->addSites($json);
                break;
            case 'editVisitor':
                $res = $this->editVisitor($json);
                break;
            case 'getUsertype':
                $res = $this->getUsertype($json);
                break;
            /* case 'getUsertype':
                $res = $this->getUsertype($json);
                break;
            case 'getUsertype':
                $res = $this->getUsertype($json);
                break; */
            case 'addEmployee':
                $res = $this->addEmployee($json);
                break;
            case 'getCompany':
                $res = $this->getCompany($json);
                break;
            case 'getService':
                $res = $this->getService($json);
                break;
            case 'addQuotation':
                $res = $this->addQuotation($json);
                break;
            case 'resendOtp':
                $res = $this->resendOtp($json);
                break;
            case 'getReason':
                $res = $this->getReason($json);
                break;
            case 'convertToQuotationReject':
                $res = $this->convertToQuotationReject($json);
                break;
            case 'convertToQuotationAccept':
                $res = $this->convertToQuotationAccept($json);
                break;
            case 'verifyQuotationOtp':
                $res = $this->verifyQuotationOtp($json);
                break;
            case 'RejectAppointmentQuotation':
                $res = $this->RejectAppointmentQuotation($json);
                break;
            case 'ConvertToCustomer':
                $res = $this->ConvertToCustomer($json);
                break;
            case 'getQuestion':
                $res = $this->getQuestion($json);
                break;
            case 'addInvoice':
                $res = $this->addInvoice($json);
                break;
            case 'addInstallationInvoice':
                $res = $this->addInstallationInvoice($json);
                break;
            case 'addAMCInvoice':
                $res = $this->addAMCInvoice($json);
                break;
            case 'PrintChallan':
                $res = $this->PrintChallan(5);
                break;
            case 'getInvoice':
                $res = $this->getInvoice($json);
                break;
            case 'getPayment':
                $res = $this->getPayment($json);
                break;
            case 'addPayment':
                $res = $this->addPayment($json);
                break;
            case 'getTeamDefination':
                $res = $this->getTeamDefination($json);
                break;
            case 'getAttendance':
                $res = $this->getAttendance($json);
                break;
            case 'getAvailableEmployee':
                $res = $this->getAvailableEmployee($json);
                break;
            case 'addTeamDefination':
                $res = $this->addTeamDefination($json);
                break;
            case 'editTeamDefination':
                $res = $this->editTeamDefination($json);
                break;
            case 'getaddAttendaneEmployee':
                $res = $this->getaddAttendaneEmployee($json);
                break;
            case 'addAttendance':
                $res = $this->addAttendance($json);
                break;
            case 'addVisitorReminder':
                $res = $this->addVisitorReminder($json);
                break;
            case 'getVisitorReminder':
                $res = $this->getVisitorReminder($json);
                break;
            case 'getAttendanceMenu':
                $res = $this->getAttendanceMenu($json);
                break;
            case 'getEmployeeAttendance':
                $res = $this->getEmployeeAttendance($json);
                break;
            case 'getInvoiceAttendance':
                $res = $this->getInvoiceAttendance($json);
                break;
            case 'getSalaryUserData':
                $res = $this->getSalaryUserData($json);
                break;
            case 'addSalary':
                $res = $this->addSalary($json);
                break;
            case 'getSalary':
                $res = $this->getSalary($json);
                break;
            case 'getTicket':
                $res = $this->getTicket($json);
                break;
            case 'addTicket':
                $res = $this->addTicket($json);
                break;
            case 'getInspection':
                $res = $this->getInspection($json);
                break;
            case 'addInspection':
                $res = $this->addInspection($json);
                break;
            case 'getUserByUserType':
                $res = $this->getUserByUserType($json);
                break;
            case 'addInspectionImage':
                $res = $this->addInspectionImage($json);
                break;
            case 'getDashboard':
                $res = $this->getDashboard($json);
                break;
            case 'getDashboardLead':
                $res = $this->getDashboardLead($json);
                break;
            case 'getDashboardFollowup':
                $res = $this->getDashboardFollowup($json);
                break;
            case 'addPenalty':
                $res = $this->addPenalty($json);
                break;
            case 'getPenalty':
                $res = $this->getPenalty($json);
                break;
            case 'addCustomerSitesDocument':
                $res = $this->addCustomerSitesDocument($json);
                break;
            case 'getCustomerSitesDocument':
                $res = $this->getCustomerSitesDocument($json);
                break;
            case 'removeCustomerSitesDocument':
                $res = $this->removeCustomerSitesDocument($json);
                break;
            case 'editCustomerSitesDocument':
                $res = $this->editCustomerSitesDocument($json);
                break;
            case 'addCheckIN':
                $res = $this->addCheckIN($json);
                break;
            case 'addCheckOUT':
                $res = $this->addCheckOUT($json);
                break;
            case 'getCheckinout':
                $res = $this->getCheckinout($json);
                break;
            case 'getEmployeeForGlobalAttendance':
                $res = $this->getEmployeeForGlobalAttendance($json);
                break;
            case 'editProfile':
                $res = $this->editProfile($json);
                break;
            case 'addAdvance':
                $res = $this->addAdvance($json);
                break;
            case 'getAdvance':
                $res = $this->getAdvance($json);
                break;
            case 'sendReminderSMS':
                $res = $this->sendReminderSMS($json);
                break;
            case 'sendReminderMail':
                $res = $this->sendReminderMail($json);
                break;
            case 'getNotification':
                $res = $this->getNotification($json);
                break;
            case 'getCustomerProcess':
                $res = $this->getCustomerProcess($json);
                break;
            case 'addVisitorReminder':
                $res = $this->addVisitorReminder($json);
                break;
            case 'getNotes':
                $res = $this->getNotes($json);
                break;
            case 'getRoles':
                $res = $this->getRoles($json);
                break;
            case 'getBrands':
                $res = $this->getBrands($json);
                break;
            case 'getProducts':
                $res = $this->getProducts($json);
                break;
            case 'getMaterial':
                $res = $this->getMaterial($json);
                break;
            case 'addChallan':
                $res = $this->addChallan($json);
                break;
            case 'addAcUnit':
                $res = $this->addAcUnit($json);
                break;
            case 'getChallan':
                $res = $this->getChallan($json);
                break;
            case 'getInstallationType':
                $res = $this->getInstallationType($json);
                break;
            case 'getServiceCounts':
                $res = $this->getServiceCounts($json);
                break;
            case 'getPaymentType':
                $res = $this->getPaymentType($json);
                break;
            case 'getServiceType':
                $res = $this->getServiceType($json);
                break;
            case 'getInstallation':
                $res = $this->getInstallation($json);
                break;
            case 'getAvailableInstallation':
                $res = $this->getAvailableInstallation($json);
                break;
            case 'addInstallation':
                $res = $this->addInstallation($json);
                break;
            case 'addServiceReport':
                $res = $this->addServiceReport($json);
                break;
            case 'getServiceReport':
                $res = $this->getServiceReport($json);
                break;
            case 'editInstallation':
                $res = $this->editInstallation($json);
                break;
            case 'PrintReceipt':
                $res = $this->PrintReceipt(1);
                break;
            case 'getQuotationChallan':
                $res = $this->getQuotationChallan($json);
                break;
            case 'InvoicePrintReceipt':
                $res = $this->InvoicePrintReceipt(10);
                break;
            case 'addPaymentReminder':
                $res = $this->addPaymentReminder($json);
                break;
            case 'getPaymentReminder':
                $res = $this->getPaymentReminder($json);
                break;
            case 'getProductService':
                $res = $this->getProductService($json);
                break;
            case 'getWarranty':
                $res = $this->getWarranty($json);
                break;
            case 'printService':
                $res = $this->printService(24);
                break;
            case 'getTimeSlot':
                $res = $this->getTimeSlot($json);
                break;
            case 'addAppointment':
                $res = $this->addAppointment($json);
                break;
            case 'getAppointment':
                $res = $this->getAppointment($json);
                break;
            case 'changeAppointmentStatus':
                $res = $this->changeAppointmentStatus($json);
                break;
            case 'addInstallationQuotation':
                $res = $this->addInstallationQuotation($json);
                break;
            case 'getChallanNew':
                $res = $this->getChallanNew($json);
                break;
            case 'getQuotationNew':
                $res = $this->getQuotationNew($json);
                break;
            case 'getUom':
                $res = $this->getUom($json);
                break;
            // ================= 
            case 'test':
                $res = $this->test($json);
                break;
            default:
                $res = array('default' => array('error' => 400, 'message' => label('api_msg_service_not_found')));
                break;
        }
        echo json_encode($res);
        exit;
    }
    /* START COMMON FUNCTIONS */
    function SplitTime($StartTime, $EndTime, $Duration = "60", $CurrentTime)
    {
        $ReturnArray = array(); // Define output
        $StartTime    = strtotime($StartTime); //Get Timestamp
        $EndTime      = strtotime($EndTime); //Get Timestamp

        $AddMins  = $Duration * 60;

        while ($StartTime < $EndTime) //Run loop
        {
            $ST = date("H:i", $StartTime);
            $StartTime += $AddMins; //Endtime check
            $ET = date("H:i", $StartTime);

            if (strtotime($CurrentTime) > strtotime($ST)) {
                if (strtotime($CurrentTime) < strtotime($ET))
                    $ReturnArray[] = array("Start" => $ST, "End" => $ET, "IsPast" => 0, "IsCurrent" => 1);
                else
                    $ReturnArray[] = array("Start" => $ST, "End" => $ET, "IsPast" => 1, "IsCurrent" => 0);
            } else {

                $ReturnArray[] = array("Start" => $ST, "End" => $ET, "IsPast" => 0, "IsCurrent" => 0);
            }
        }
        return $ReturnArray;
    }
    public function getDeviceData($ID)
    {
        $device = "";
        $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" . $ID . "')");
        if (isset($EmployeeData[0]->DeviceTokenID)) {
            $device = $EmployeeData[0]->DeviceTokenID;
        }
        return $device;
    }
    public function getEmployeeData($ID)
    {
        $name = "An Employee";
        $UserData =  $this->master_model->getQueryResult("call usp_GetEmployeeByID('" . $ID . "')");
        if (isset($UserData[0]->UserID)) {
            $name = $UserData[0]->FirstName . ' ' . $UserData[0]->LastName;
        }
        return $name;
    }
    public function getQuotationMessage($ID, $UserID)
    {
        $device = $this->getDeviceData($UserID);
        $employee = $this->getEmployeeData($UserID);
        if ($device != "") {
            $_result_quotation = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" .
                $ID . "'
            )");
            if (isset($_result_quotation[0]->QuotationID)) {
                $_result_sites = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                    $_result_quotation[0]->SitesID . "'
                )");
                if (isset($_result_sites[0]->SitesID)) {
                    return $notif_text = $employee . " has added a new Quotation of the " . $_result_sites[0]->SiteName . ", Quotation No: " . $_result_quotation[0]->EstimateNo . " on " . $_result_quotation[0]->EstimateDate . ". HH Enterprise.";
                }
            }
        }
    }
    public function getInvoiceMessage($ID, $UserID)
    {
        $device = $this->getDeviceData($UserID);
        $employee = $this->getEmployeeData($UserID);
        if ($device != "") {
            $_result_invoice = $this->master_model->getQueryResult("call usp_A_GetInvoiceByID('" .
                $ID . "'
            )");
            if (isset($_result_invoice[0]->InvoiceID)) {
                $_result_sites = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                    $_result_invoice[0]->SitesID . "'
                )");
                if (isset($_result_sites[0]->SitesID)) {
                    return $notif_text = $employee . " has added a new Invoice of the " . $_result_sites[0]->SiteName . ", Invoice No: " . $_result_invoice[0]->InvoiceNo . " and Amount: " . $_result_invoice[0]->TotalAmount . " on " . date('d-m-Y') . ". HH Enterprise.";
                }
            }
        }
    }
    public function getSiteMessage($ID, $UserID)
    {
        $device = $this->getDeviceData($UserID);
        $employee = $this->getEmployeeData($UserID);
        if ($device != "") {

            $_result_sites = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                $ID . "'
            )");
            if (isset($_result_sites[0]->SitesID)) {
                return $notif_text = $employee . " has added a new Site of the " . $_result_sites[0]->SiteName . " on " . date('d-m-Y') . ". HH Enterprise.";
            }
        }
    }
    public function getLeadMessage($ID, $UserID)
    {
        $device = $this->getDeviceData($UserID);
        $employee = $this->getEmployeeData($UserID);
        if ($device != "") {

            $_result_visitor = $this->master_model->getQueryResult("call usp_A_GetVisitorByID('" .
                $ID . "'
            )");
            if (isset($_result_visitor[0]->VisitorID)) {
                return $employee . " has added a new lead of " . $_result_visitor[0]->Name . " on " . date('d-m-Y') . ". HH Enterprise.";
            }
        }
    }
    public function getPaymentMessage($ID, $UserID)
    {
        $device = $this->getDeviceData($UserID);
        $employee = $this->getEmployeeData($UserID);
        if ($device != "") {
            $_result_payment = $this->master_model->getQueryResult("call usp_A_GetPaymentByID('" .
                $ID . "'
            )");
            if (isset($_result_payment[0]->CustomerPaymentID)) {
                $_result_invoice = $this->master_model->getQueryResult("call usp_A_GetInvoiceByID('" .
                    $_result_payment[0]->InvoiceID . "'
                )");
                if (isset($_result_invoice[0]->InvoiceID)) {
                    $_result_sites = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                        $_result_invoice[0]->SitesID . "'
                    )");
                    if (isset($_result_sites[0]->SitesID)) {
                        return $notif_text = "Dear " . $_result_sites[0]->Name . ", Thanks for making payment of Rs." . $_result_payment[0]->PaymentAmount . " for Invoice No: " . $_result_invoice[0]->InvoiceNo . ". HH Enterprise.";
                    }
                }
            }
        }
    }
    /* END COMMON FUNCTIONS */



    /* START TEST FUNCTION */
    function test($data)
    {
        $device = $this->getDeviceData($data->UserID);
        $employee = $this->getEmployeeData($data->UserID);
        if (@$device != "") {
            if (@$data->Type == "Lead") {
                $notif_text = $this->getQuotationMessage($data->ID, $data->UserID);
                $pushNotificationArr = array(
                    'device_id' => $device,
                    'message' => $notif_text,
                    'title' => label('api_msg_notification_addsite_title'),
                    'event' => NOTIFICATION_ADDLEAD,
                    'ActionType' => '',
                    'detail' => ''
                );
                $res = sendPushNotification($pushNotificationArr);
            } else if (@$data->Type == "Site") {
                $notif_text = $this->getQuotationMessage($data->ID, $data->UserID);
            } else if (@$data->Type == "Quotation") {
                $notif_text = $this->getQuotationMessage($data->ID, $data->UserID);
            } else if (@$data->Type == "Invoice") {
                $notif_text = $this->getQuotationMessage($data->ID, $data->UserID);
            } else if (@$data->Type == "Payment") {
                $notif_text = $this->getQuotationMessage($data->ID, $data->UserID);
            } else {
                $notif_text = $this->getQuotationMessage($data->ID, $data->UserID);
                $pushNotificationArr = array(
                    'device_id' => $device,
                    'message' => $notif_text,
                    'title' => label('api_msg_notification_addsite_title'),
                    'event' => NOTIFICATION_ADDLEAD,
                    'ActionType' => '',
                    'detail' => ''
                );
                $res = sendPushNotification($pushNotificationArr);
            }
        }
    }

    function testODL($data)
    {
        die;
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

        // set font
        $pdf->SetFont('helvetica', '', 9);

        // add a page
        $pdf->AddPage();

        /* 
        <img src="logo/logo-2.png" alt="logo" style=" width: 100px;padding-right: 0">
        <img src="logo/HH_Logo.png" alt="logo" style="width: 157px; height: fit-content;">
         */
        $html = '
            <html> 
            <body>
                <div style="width: 580px; padding: 0px 25px; margin: 0 auto; margin-top: 3px; margin-bottom: 0px;">
                    <div style="display: flex; justify-content: space-between;">
                        <div style="text-align: center;">
                            <span style="font-size: 13px;margin:0;">
                                6, Anisha Complex,<br> Nr. Mahalakshmi Tower, Panchtirth 5 Rasta to <br> Vikasgruh Road, B/s, Allahbad Bank, <br> Paldi, Ahmedabad 380 007.<br> <b>Phone : +91 98250 64676</b>  
                            </span> 
                        </div>
                    </div>
                    <hr/>
                    <span style="text-align: center;font-size: 14px; margin:0;">Regd. Office : 1233 , Unchi Gali, Shamla Ni Pole, Raipur, Ahmedabad 380 001.</span>
                    <br/>   
                    <table>
                        <tr>
                            <td>
                            <h2>Service Call Report</h2>
                            </td>
                            <td style="text-align: right;">
                                <div>
                                    <h4>Compliant No. : <span style="width: 70px;display: inline-block;border-bottom: 1px solid #000000;font-size: 26px;">1500</span></h4>
                                    <h4>Date :<span style=" width: 137px;display: inline-block;border-bottom: 1px solid #000000;margin-top: 25px;font-size: 20px;"></span></h4>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <hr/>
                    <div style="text-align: center;">
                    <b style="font-size: 16px; text-transform: uppercase;">Warranty/preventive/premium</b>
                    </div>
                    <br/>
                    <div style="display: flex;">
                        <label style="margin-right: 5px;">Name :</label>
                        <input type="text" disabled style="border: none;width: 91%;border-bottom: 1px solid #000000;background: #fff;">
                    </div>
                    <div style="display: flex;margin-top: 10px;">
                        <label style="margin-right: 5px;">Address :</label>
                        <input type="text" disabled style="border: none;width: 88.8%;border-bottom: 1px solid #000000; background: #fff;">
                    </div>
                    <input type="text" disabled style="border: none;width: 100%;border-bottom: 1px solid #000000;margin-top:10px;background: #fff;">

                    <div style="display: flex;margin-top: 10px;justify-content: space-between;">
                        <div style="display: flex;margin-top: 10px;width: 63%;">
                            <label style="margin-right: 5px;">Contact No. : (M)</label>
                            <input type="text" disabled style="border: none;width: 68%;border-bottom: 1px solid #000000;background: #fff;">
                        </div>
                        <div style="display: flex;margin-top: 10px;width: 36%;">
                            <label style="margin-right: 5px;">(R)</label>
                            <input type="text" disabled style="border: none;width: 89%;border-bottom: 1px solid #000000;background: #fff;">
                        </div>
                    </div>
                    

                    <div style="width: 100%; margin-top: 30px;">
                        <table style="border-collapse: collapse; width: 100%;">
                            <tr>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 14px;padding: 5px 0;font-weight: 600;">Machin Capacity</td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 14px;padding: 5px 0;font-weight: 600;">Location</td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 14px;padding: 5px 0;font-weight: 600;">Complaint</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                            </tr>
                        </table>
                    </div>

                    <div style="display: flex;margin-top: 15px;">
                        <label style="margin-right: 5px;">Solution :</label>
                        <input type="text" disabled style="border: none;width: 88.5%;border-bottom: 1px solid #000000;background: #fff;">
                    </div>
                    <input type="text" disabled style="border: none;width: 100%;border-bottom: 1px solid #000000;margin-top: 10px;background: #fff;">
                    <input type="text" disabled style="border: none;width: 100%;border-bottom: 1px solid #000000;margin-top: 10px;background: #fff;">

                    <div style="display: flex;margin-top: 15px;">
                        <label style="margin-right: 5px;">Charge :</label>
                        <input type="text" disabled style="border: none;width: 90%;;border-bottom: 1px solid #000000; background: #fff;">
                    </div>

                    <div style="display: flex;margin-top: 10px;justify-content: space-between;">
                        <div style="display: flex;margin-top: 10px;width: 50%;">
                            <label style="margin-right: 5px;">Time In :</label>
                            <input type="text" disabled style="border: none;width: 77%;border-bottom: 1px solid #000000;background: #fff;">
                        </div>
                        <div style="display: flex;margin-top: 10px;width: 50%;">
                            <label style="margin-right: 5px;">Time Out :</label>
                            <input type="text" disabled style="border: none;width: 74%;border-bottom: 1px solid #000000;background: #fff;">
                        </div>
                    </div>

                    <div style="display: flex;margin-top: 10px;justify-content: space-between;">
                        <div style="width: 70%;">
                            <div style="margin-top: 10px;width: 100%;">
                                <label style="margin-right: 13px;">Cust Sign. :</label>
                                <input type="text" disabled style="border: none;width: 77%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                            <div style="margin-top: 10px; width: 100%;">
                                <label style="margin-right: 5px;">Cust Name :</label>
                                <input type="text" disabled style="border: none;width: 74%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                            <div style="margin-top: 10px; width: 100%;">
                                <label style="margin-right: 45px;">Date :</label>
                                <input type="text" disabled style="border: none;width: 74%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                        </div>
                        <div style="margin-top: 10px; width: 30%;text-align: right;">
                            <label style="font-size: 16px; font-weight: 600;border-top: 1px solid #000000;">Service Engineers Sign.</label>
                        </div>
                    </div>   
                    
                </div>
            </body>
            </html>
        ';

        echo $html;
        die;
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
            $structure = 'assets/uploads/service/';
            $File = $ID . '_' . date('dmY') . '.pdf';
            $path = FCPATH . $structure . $File;
        }


        $pdf->Output($path, 'F');
        die;
    }
    /* END TEST FUNCTION */


    function getUom($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->UOMName)) {
                $response['error'] = 102;
                $response['message'] = 'UOMName not found';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_GetUOM('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->UOMName . "','" .
                    1 . "'
                )");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_product_listed_successfully');
                    $response['data'] = $_result;
                    //$response['data']['warranty'] = $_warranty_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getChallanNew($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else {

                $SitesID = (!isset($data->SitesID) || $data->SitesID == 0) ? '-1' : $data->SitesID;
                $VisitorID = (!isset($data->VisitorID) || $data->VisitorID == 0) ? '-1' : $data->VisitorID;
                $CustomerID = (!isset($data->CustomerID) || $data->CustomerID == 0) ? '-1' : $data->CustomerID;
                $ChallanID = (!isset($data->ChallanID) || $data->ChallanID == 0) ? '-1' : $data->ChallanID;
                $Status = (!isset($data->Status) || $data->Status == 0) ? '-1' : $data->Status;
                $QuotationID = (!isset($data->QuotationID) || $data->QuotationID == 0) ? '-1' : $data->QuotationID;

                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $_result = $this->master_model->getQueryResult("call usp_A_GetChallanByStatus('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->SitesID . "','" .
                    $data->VisitorID . "','" .
                    $data->CustomerID . "','" .
                    // $data->QoutationStatus . "','" .
                    $ChallanID . "','" .
                    $CityID . "','" .
                    $QuotationID . "','-1'
                )");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    foreach ($_result as $key => $value) {
                        $_result[$key]->Item['Material'] = $this->master_model->getQueryResult("call usp_A_GetChallanItemByQuotation('-1',1,'" . $QuotationID . "','" . $value->ChallanID . "',-1,1,0)");
                        $_result[$key]->Item['Product'] = $this->master_model->getQueryResult("call usp_A_GetChallanItemByQuotation('-1',1,'" . $QuotationID . "','" . $value->ChallanID . "',-1,0,0)");

                        foreach ($_result[$key]->Item['Product'] as $product_key => $product) {
                            if (isset($product->ChallanItemID)) {
                                $sql = "call usp_A_GetInstallationItem(
                                    '-1','1','-1','" . $product->ChallanItemID . "','-1','-1','-1','-1','-1'
                                )";
                                $_invoice_result = $this->master_model->getQueryResult($sql);
                                if (isset($_invoice_result) && !empty($_invoice_result) && !isset($_invoice_result['0']->Message)) {
                                    $_result[$key]->Item['Product'][$product_key]->installation = $_invoice_result;
                                } else {
                                    $_result[$key]->Item['Product'][$product_key]->installation = array();
                                }
                                //$_result[$key]->Item['Product'] = array_merge($_result[$key]->Item['Product'], $_invoice_result);
                            }
                        }
                    }

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_challan_listed_successfully');
                    $response['data'] = $_result;

                    $Material = $this->master_model->getQueryResult("call usp_A_GetChallanItemByQuotation('-1',1,'" . $QuotationID . "','-1',-1,1,0)");
                    $Product = $this->master_model->getQueryResult("call usp_A_GetChallanItemByQuotation('-1',1,'" . $QuotationID . "','-1',-1,0,0)");

                    $response['Material'] = isset($Material[0]->Message) ? array() : $Material;
                    $response['Product'] = isset($Product[0]->Message) ? array() : $Product;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getQuotationNew($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->QoutationStatus)) {
                $response['error'] = 102;
                $response['message'] = 'Qoutation Status not found';
            } else {
                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $_result = $this->master_model->getQueryResult("call usp_A_GetQuotationByStatus('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->SitesID . "','" .
                    $data->VisitorID . "','" .
                    $data->CustomerID . "','" .
                    $data->QoutationStatus . "','" .
                    $CityID . "'
                )");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    foreach ($_result as $key => $value) {
                        $sql = "call usp_A_GetChallanItemByQuotation('-1',1,'" . $value->QuotationID . "','-1',1,'1','-1')";
                        $_result[$key]->Item['Material'] = $this->master_model->getQueryResult($sql);
                        $sql = "call usp_A_GetChallanItemByQuotation('-1',1,'" . $value->QuotationID . "','-1',1,'0','-1')";
                        $_result[$key]->Item['User'] = $this->master_model->getQueryResult($sql);
                    }
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_quotation_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getProductService($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else {
                $SitesID = '-1'; //(!isset($data->SitesID)||$data->SitesID==0)?'-1':$data->SitesID;
                $VisitorID = (!isset($data->VisitorID) || $data->VisitorID == 0) ? '-1' : $data->VisitorID;
                $CustomerID = '-1'; //(!isset($data->CustomerID)||$data->CustomerID==0)?'-1':$data->CustomerID;
                $ChallanID = (!isset($data->ChallanID) || $data->ChallanID == 0) ? '-1' : $data->ChallanID;
                $Status = '-1'; //(!isset($data->Status)||$data->Status==0)?'-1':$data->Status;
                $QuotationID = '-1'; //(!isset($data->QuotationID)||$data->QuotationID==0)?'-1':$data->QuotationID;
                $CityID = '-1'; //isset($data->CityID) ? $data->CityID :'-1';
                $AppointmentID = !isset($data->AppointmentID) ? '0' : $data->AppointmentID;
                $AppointmentType = !isset($data->AppointmentType) ? '0' : $data->AppointmentType;

                if ($AppointmentType == "Installation" || $AppointmentType == "") {
                    $_result = $this->master_model->getQueryResult("call usp_A_GetChallanByStatus('" .
                        $data->PageSize . "','" .
                        $data->CurrentPage . "','" .
                        $SitesID . "','" .
                        $VisitorID . "','" .
                        $CustomerID . "','" .
                        $ChallanID . "','" .
                        $CityID . "','" .
                        $QuotationID . "','-1'
                    )");
                    if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                        $ServiceID = (!isset($data->ServiceID) || $data->ServiceID == 0) ? '-1' : $data->ServiceID;
                        $InstallationID = (!isset($data->InstallationID) || $data->InstallationID == 0) ? '-1' : $data->InstallationID;
                        $ChallanItemID = (!isset($data->ChallanItemID) || $data->ChallanItemID == 0) ? '-1' : $data->ChallanItemID;
                        $ServiceStatus = "";
                        $VisitorID = "-1"; //!isset($data->VisitorID)?'-1':$data->VisitorID;
                        $sql = "call usp_A_GetProductService('-1', '1','" .
                            $ServiceID . "','" .
                            $InstallationID . "','" .
                            $ChallanItemID . "','" .
                            $ChallanID . "', '" .
                            $VisitorID . "', '" .
                            $ServiceStatus . "'
                        )";
                        $_result[0]->Product = $this->master_model->getQueryResult($sql);

                        $response['error'] = 200;
                        $response['message'] = label('api_msg_product_listed_successfully');
                        $response['data'] = $_result;
                        $response['rowcount'] = (int)$_result['0']->rowcount;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                        $response['data'] = array();
                        $response['rowcount'] = 0;
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_error_occurred');
                    }
                } else {
                    $ServiceID = (!isset($data->ServiceID) || $data->ServiceID == 0) ? '-1' : $data->ServiceID;
                    $InstallationID = (!isset($data->InstallationID) || $data->InstallationID == 0) ? '-1' : $data->InstallationID;
                    $ChallanItemID = (!isset($data->ChallanItemID) || $data->ChallanItemID == 0) ? '-1' : $data->ChallanItemID;
                    $ServiceStatus = "";
                    $VisitorID = "-1"; //!isset($data->VisitorID)?'-1':$data->VisitorID;
                    $sql = "call usp_A_GetProductServiceByAppointment('-1', '1','" .
                        $ServiceID . "','" .
                        $VisitorID . "', '" .
                        $ServiceStatus . "'
                    )";
                    $_result = $this->master_model->getQueryResult($sql);
                    if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                        $response['error'] = 200;
                        $response['message'] = label('api_msg_product_listed_successfully');
                        $response['data'] = $_result;
                        $response['rowcount'] = (int)$_result['0']->rowcount;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                        $response['data'] = array();
                        $response['rowcount'] = 0;
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_error_occurred');
                    }
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getWarranty($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else {
                $SitesID = '-1'; //(!isset($data->SitesID)||$data->SitesID==0)?'-1':$data->SitesID;
                $VisitorID = '-1'; //(!isset($data->VisitorID)||$data->VisitorID==0)?'-1':$data->VisitorID;
                $CustomerID = '-1'; //(!isset($data->CustomerID)||$data->CustomerID==0)?'-1':$data->CustomerID;
                $ChallanID = (!isset($data->ChallanID) || $data->ChallanID == 0) ? '-1' : $data->ChallanID;
                $Status = '-1'; //(!isset($data->Status)||$data->Status==0)?'-1':$data->Status;
                $QuotationID = '-1'; //(!isset($data->QuotationID)||$data->QuotationID==0)?'-1':$data->QuotationID;
                $CityID = '-1'; //isset($data->CityID) ? $data->CityID :'-1';

                $_result = $this->master_model->getQueryResult("call usp_A_GetChallanByStatus('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $SitesID . "','" .
                    $VisitorID . "','" .
                    $CustomerID . "','" .
                    // $data->QoutationStatus . "','" .
                    $ChallanID . "','" .
                    $CityID . "','" .
                    $QuotationID . "','-1'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $WarrantyID = (!isset($data->WarrantyID) || $data->WarrantyID == 0) ? '-1' : $data->WarrantyID;
                    $InstallationID = (!isset($data->InstallationID) || $data->InstallationID == 0) ? '-1' : $data->InstallationID;
                    $ChallanItemID = (!isset($data->ChallanItemID) || $data->ChallanItemID == 0) ? '-1' : $data->ChallanItemID;
                    $sql = "call usp_A_GetWarranty('-1', '1','" .
                        $WarrantyID . "','" .
                        $InstallationID . "','" .
                        $ChallanItemID . "','" .
                        $ChallanID . "'
                    )";
                    $_result[0]->Products = $this->master_model->getQueryResult($sql);

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_product_listed_successfully');
                    $response['data'] = $_result;
                    //$response['data']['warranty'] = $_warranty_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function printService($data)
    {
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

        // set font
        $pdf->SetFont('helvetica', '', 9);

        // add a page
        $pdf->AddPage();

        /* 
        <img src="logo/logo-2.png" alt="logo" style=" width: 100px;padding-right: 0">
        <img src="logo/HH_Logo.png" alt="logo" style="width: 157px; height: fit-content;">
         */
        $html = '
            <html>
            <body>
                <div style="width: 580px; padding: 0px 25px; margin: 0 auto; margin-top: 50px; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between;align-items: center;margin-bottom: 30px;">
                        <h1 style="text-align: center;text-transform: uppercase;font-size: 20px;">Warranty/preventive/premium</h1>
                        
                    </div>
                
                    <div style="display: flex;justify-content: space-between;border-bottom: 2px solid #000000;padding-bottom: 10px;">
                        <div style="width: 49%;">
                            <div style="display: flex;">
                                <label style="margin-right: 5px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">Customer :</label>
                                <input type="text" disabled style="border: none;width: 68%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                            <div style="display: flex;margin-top: 15px;">
                                <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;">Address :</label>
                                <input type="text" disabled style="border: none;width: 65%;border-bottom: 1px solid #000000; background: #fff;">
                            </div>
                            <input type="text" disabled style="border: none;width: 100%;border-bottom: 1px solid #000000;margin-top:15px;background: #fff;">
                            <input type="text" disabled style="border: none;width: 100%;border-bottom: 1px solid #000000;margin-top:15px;background: #fff;">
                            <input type="text" disabled style="border: none;width: 100%;border-bottom: 1px solid #000000;margin-top:15px;background: #fff;">
                            <input type="text" disabled style="border: none;width: 100%;border-bottom: 1px solid #000000;margin-top:15px;background: #fff;">
                
                            <div style="display: flex;margin-top: 15px;">
                                <label style="margin-right: 5px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">Phone  :</label>
                                <input type="text" disabled style="border: none;width: 69%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                
                            <div style="display: flex;margin-top: 15px;">
                                <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">Brand :</label>
                                <input type="text" disabled style="border: none;width: 69%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                
                            <div style="display: flex;margin-top: 15px;">
                                <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">Location :</label>
                                <input type="text" disabled style="border: none;width: 69%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                        </div>
                        <div style="width: 49%;">
                            <div style="display: flex;">
                                <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">Card No. :</label>
                                <input type="text" disabled style="border: none;width: 63%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
            
                            <div style="display: flex;margin-top: 15px;">
                                <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">Customer :</label>
                                <input type="text" disabled style="border: none;width: 63%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
            
                            <div style="display: flex;margin-top: 15px;">
                                <div style="display: flex;justify-content: space-between;">
                                    <div style="display: flex;width: 63%;">
                                        <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">Capacity :</label>
                                        <input type="text" disabled style="border: none;width:41%;border-bottom: 1px solid #000000;background: #fff;">
                                    </div>
                                    <div style="display: flex;width: 36%;">
                                        <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">TR</label>
                                        <input type="text" disabled style="border: none;width: 80%;border-bottom: 1px solid #000000;background: #fff;">
                                    </div>
                                </div>
                            </div>
            
                            <div style="display: flex;margin-top: 15px;">
                                <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">Model No. :</label>
                                <input type="text" disabled style="border: none;width: 63%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                
                            <div style="display: flex;margin-top: 15px;">
                                <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">M/C. SR. No.  :</label>
                                <input type="text" disabled style="border: none;width: 61%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                
                            <div style="display: flex;margin-top: 15px;">
                                <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">COMP. SR. NO. :</label>
                                <input type="text" disabled style="border: none;width:62%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                
                            <div style="display: flex;margin-top: 15px;">
                                <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">IDU. SR. NO. :</label>
                                <input type="text" disabled style="border: none;width: 62%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                            <div style="display: flex;margin-top: 15px;">
                                <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">Invoice No. & :</label>
                                <input type="text" disabled style="border: none;width: 62%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                            <div style="display: flex;margin-top: 15px;">
                                <label style="margin-right: 6px;text-transform: uppercase;font-weight: 600;font-size: 15px;font-size: 14px;">Date:</label>
                                <input type="text" disabled style="border: none;width: 61%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                        </div>
                    </div>
            
                    <div style="width: 100%; margin-top: px;">
                        <h1 style="text-align: center;text-transform: uppercase;font-size: 20px;">Servicing Data</h1>
                        <table style="border-collapse: collapse; width: 610px;">
                            <tr>
                                <td style="border: 1px solid black;text-align:center;font-size:18px;padding:5px ;font-weight: 600; width: 300px;">Check / Item</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;font-weight: 600; width: 57px;">1</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;font-weight: 600; width: 57px;">2</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;font-weight: 600; width: 57px;">3</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;font-weight: 600; width: 57px;">4</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;font-weight: 600; width: 57px;">5</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;font-weight: 600; width: 57px;">6</td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left;font-size:16px;padding:5px 8px;font-weight: 600;">Date :</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left;font-size:14px;padding:5px 8px;">1. Air Filter Cleaning</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left;font-size:14px;padding:5px 8px;">2. Condenser/Cooling Coll Cleaning</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left;font-size:14px;padding:5px 8px;">3. Fan Motor Oiling</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left;font-size:14px;padding:5px 8px;">4. Checking Fasteners</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left;font-size:14px;padding:5px 8px;padding-left: 24px;">(motor and screws)</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left;font-size:14px;padding:5px 8px;">5. Checking Electrical Spares</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left;font-size:14px;padding:5px 8px;">6. Voltage</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left;font-size:14px;padding:5px 8px;">7. Arnpere</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left;font-size:14px;padding:5px 8px;">8. Room temp/Gril Temp</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left; font-size:14px;padding:5px 8px;">9. Mechanic\'s Signature & Date</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
            
                            <tr>
                                <td style="border: 1px solid black;text-align:left; font-size:14px;padding:5px 8px;padding-left: 24px;">Customer\'s Signature</td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                                <td style="border: 1px solid black;text-align:center;font-size:14px;padding:5px 8px;"></td>
                            </tr>
                            
                        </table>
            
                        <p style="font-size: 14px; margin-top: 20px;">1233, Unchi Gali, Shamla Ni Pole, Raipur, Ahmedabad 380 001. </p>
                        <p style="font-size: 14px; margin-top: 10px;">Email: hhsystemssolutions@gmail.com Phone : +91 98250 64676</p>
                    </div>
                </div>
            
            </body>
            </html>
        ';

        echo $html;
        die;
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
            $structure = 'assets/uploads/service/';
            $File = $ID . '_' . date('dmY') . '.pdf';
            $path = FCPATH . $structure . $File;
        }


        $pdf->Output($path, 'F');
        die;
    }
    function getTimeSlot($data)
    {
        try {
            $response = array();
            if (!isset($data->CurrentDate)  || $data->CurrentDate == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentDate not found';
            } else if (!isset($data->CurrentTime)  || $data->CurrentTime == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentTime not found';
            } else {
                if (strtotime($data->CurrentDate) < strtotime(date('d-m-Y'))) {
                    $_result = [];
                } else if (strtotime($data->CurrentDate) == strtotime(date('d-m-Y'))) {
                    $_result = $this->SplitTime("09:00", "18:00", '60', $data->CurrentTime);
                } else {
                    $_result = $this->SplitTime("09:00", "18:00", '60', "00:00:00");
                }

                $response['error'] = 200;
                $response['message'] = label('api_msg_timeslot_listed_successfully');
                $response['data'] = $_result;
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function addAppointment($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->ServiceID)  || $data->ServiceID == '') {
                $response['error'] = 102;
                $response['message'] = 'ServiceID not found';
            } else if (!isset($data->SiteID)  || $data->SiteID == '') {
                $response['error'] = 102;
                $response['message'] = 'SiteID not found';
            } else if (!isset($data->AppointmentStatus)  || !in_array($data->AppointmentStatus, array('New', 'Assigned', 'InProgress', 'Completed', 'Closed', 'Rejected'))) {
                $response['error'] = 102;
                $response['message'] = 'AppointmentStatus not found';
            } else if (!isset($data->StartDate)  || $data->StartDate == '') {
                $response['error'] = 102;
                $response['message'] = 'StartDate not found';
            } else if (!isset($data->TimeSlot)  || $data->TimeSlot == '') {
                $response['error'] = 102;
                $response['message'] = 'TimeSlot not found';
            } else if (!isset($data->Reason)) {
                $response['error'] = 102;
                $response['message'] = 'Reason not found';
            } else if (!isset($data->ActiveStatus) || $data->ActiveStatus == '') {
                $response['error'] = 102;
                $response['message'] = 'ActiveStatus not found';
            } else if (!isset($data->AppointmentType) || $data->AppointmentType == '') {
                $response['error'] = 102;
                $response['message'] = 'AppointmentType not found';
            } else {

                $AppointmentType = isset($data->AppointmentType) ? $data->AppointmentType : "Installation";
                $IP = GetIP();
                $EndDate = $data->StartDate;
                $times = explode('-', $data->TimeSlot);
                $sql = "call usp_A_AddAppointment('" .
                    $data->UserID . "','1','Android','" . $IP . "','" .
                    $data->VisitorID . "','" .
                    $data->ServiceID . "','" .
                    $data->SiteID . "','" .
                    $data->AppointmentStatus . "','" .
                    $data->StartDate . "','" .
                    $times[0] . "','" .
                    $data->Reason . "','" .
                    $EndDate . "','" .
                    $times[1] . "','" .
                    $data->ActiveStatus . "','" .
                    0 . "','" .
                    @$data->Remark . "','" .
                    @$AppointmentType . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    foreach ($data->Item as $key => $value) {
                        $res_item = $this->master_model->getQueryResult("call usp_A_AddAppointmentItem('" .
                            $data->UserID . "','1','Android','" . $IP . "','" .
                            $_result['0']->ID . "','" .
                            $value->ServiceID . "'
                        )");
                    }

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_product_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getAppointment($data)
    {
        try {
            $response = array();
            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->AppointmentID)  || $data->AppointmentID == '') {
                $response['error'] = 102;
                $response['message'] = 'AppointmentID not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->ServiceID)  || $data->ServiceID == '') {
                $response['error'] = 102;
                $response['message'] = 'ServiceID not found';
            } else if (!isset($data->SiteID)  || $data->SiteID == '') {
                $response['error'] = 102;
                $response['message'] = 'SiteID not found';
            } else if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->AppointmentStatus)) {
                $response['error'] = 102;
                $response['message'] = 'AppointmentStatus not found';
            } else {
                $StartDate = !isset($data->StartDate) || $data->StartDate == '' ? '1990-01-01' : $data->StartDate;
                $EndDate = !isset($data->EndDate) || $data->StartDate == '' ? date('2999-m-d') : $data->EndDate;

                $Name = !isset($data->Name) ? '' : $data->Name;
                $MobileNo = !isset($data->MobileNo) ? '' : $data->MobileNo;
                $AppointmentNo = !isset($data->AppointmentNo) ? '' : $data->AppointmentNo;
                $FilterType = !isset($data->FilterType) ? '' : $data->FilterType;
                $sql = "call usp_A_GetAppointment('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    @$data->AppointmentID . "','" .
                    @$data->VisitorID . "','" .
                    @$data->ServiceID . "','" .
                    @$data->SiteID . "','" .
                    @$data->UserID . "','" .
                    @$data->AppointmentStatus . "','" .
                    @$data->ActiveStatus . "','" .
                    @$StartDate . "','" .
                    @$EndDate . "','" .
                    @$Name . "','" .
                    @$MobileNo . "','" .
                    @$AppointmentNo . "','" .
                    @$FilterType . "' 
                )";
                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    foreach ($_result as $key => $value) {
                        /* $sql = "call usp_A_GetAppointmentInvoiceTotal('" .
                            $_result[$key]->AppointmentID . "'
                        )";
                        $_invoice_result = $this->master_model->getQueryResult($sql);
                        $invoice_data = array();
                        if(!isset($_invoice_result[0]->Message)) {
                            foreach($_invoice_result as $item) {
                                if($item->InstallationService != "") { 
                                    $invoice_data[] = array('Title' => $item->InstallationService, 'Qty' => $item->Qty, 'Price' => $item->Qty*$item->Rate);
                                }
                            } 
                        }
                        $_result[$key]->invoice = $invoice_data; */


                        if ($_result[$key]->AppointmentType == "Installation") {
                            $sql = "call usp_A_GetAppointmentInstallationTotal('" .
                                $_result[$key]->AppointmentID . "','-1'
                            )";
                            $_invoice_result = $this->master_model->getQueryResult($sql);
                            $installation_data = array();
                            if (!isset($_invoice_result[0]->Message)) {
                                foreach ($_invoice_result as $item) {
                                    foreach (@$item as $service => $value) {
                                        //if($item->InstallationService != "") { 
                                        $installation_data[$key][$service] = array('Title' => $service, 'Qty' => 1, 'Price' => $value);
                                        //$installation_data[] = $item;//array('Title' => $item->InstallationService, 'Qty' => $item->Qty, 'Price' => $item->Qty*$item->Rate);
                                        //}
                                    }
                                }
                            }
                        } else {
                            $sql = "call usp_A_GetAppointmentServiceTotal('" .
                                $_result[$key]->AppointmentID . "'
                            )";
                            $_invoice_result = $this->master_model->getQueryResult($sql);
                            $installation_data = array();
                            if (!isset($_invoice_result[0]->Message)) {
                                foreach ($_invoice_result as $item) {
                                    foreach (@$item as $service => $value) {
                                        //if($item->InstallationService != "") { 
                                        $installation_data[$key][$service] = array('Title' => $service, 'Qty' => 1, 'Price' => $value);
                                        //$installation_data[] = $item;//array('Title' => $item->InstallationService, 'Qty' => $item->Qty, 'Price' => $item->Qty*$item->Rate);
                                        //}
                                    }
                                }
                            }
                        }
                        $_result[$key]->invoice = $installation_data[$key];


                        $sql = "call usp_A_GetAppointmentUsers('" .
                            -1 . "','" .
                            1 . "','" .
                            -1 . "','1','" .
                            -1 . "','" .
                            -1 . "','" .
                            -1 . "','" .
                            $_result[$key]->AppointmentID . "'
                        )";
                        $item = $this->master_model->getQueryResult($sql);

                        if (isset($item[0]->Message))
                            $_result[$key]->Users = array();
                        else
                            $_result[$key]->Users = $item;
                    }


                    $response['error'] = 200;
                    $response['message'] = label('api_msg_appointment_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function changeAppointmentStatus($data)
    {
        try {
            $response = array();
            if (!isset($data->AppointmentID)  || $data->AppointmentID == '') {
                $response['error'] = 102;
                $response['message'] = 'AppointmentID not found';
            } else if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->AppointmentStatus)  || $data->AppointmentStatus == '') {
                $response['error'] = 102;
                $response['message'] = 'AppointmentStatus not found';
            } else {
                $IP = GetIP();
                $sql = "call usp_A_AppointmentStatusChange('" .
                    $data->UserID . "','1',
                    $data->AppointmentID,'Android','" .
                    $IP . "','" .
                    $data->AppointmentStatus . "','" .
                    $data->Reason . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_appointment_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function addInstallationQuotation($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->CustomerID)) {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->EstimateDate)  || $data->EstimateDate == '') {
                $response['error'] = 102;
                $response['message'] = 'EstimateDate not found';
            } else if (!isset($data->Address)  || $data->Address == '') {
                $response['error'] = 102;
                $response['message'] = 'Address not found';
            } else if (!isset($data->Address2)) {
                $response['error'] = 102;
                $response['message'] = 'Address2 not found';
            } else if (!isset($data->CityID)  || $data->CityID == '') {
                $response['error'] = 102;
                $response['message'] = 'CityID not found';
            } else if (!isset($data->StateID)  || $data->StateID == '') {
                $response['error'] = 102;
                $response['message'] = 'StateID not found';
            } else if (!isset($data->PinCode)) {
                $response['error'] = 102;
                $response['message'] = 'PinCode not found';
            } else if (!isset($data->SubTotal)  || $data->SubTotal == '') {
                $response['error'] = 102;
                $response['message'] = 'SubTotal not found';
            } else if (!isset($data->ServiceID)  || $data->ServiceID == '') {
                $response['error'] = 102;
                $response['message'] = 'ServiceID not found';
            } else if (!isset($data->AppointmentID)  || $data->AppointmentID == '') {
                $response['error'] = 102;
                $response['message'] = 'AppointmentID not found';
            } /*
            else if (!isset($data->CompanyID)  || $data->CompanyID == '') {
                $response['error'] = 102;
                $response['message'] = 'CompanyID not found';
            } else if (!isset($data->CGST)  || $data->CGST == '') {
                $response['error'] = 102;
                $response['message'] = 'CGST not found';
            } else if (!isset($data->SGST)  || $data->SGST == '') {
                $response['error'] = 102;
                $response['message'] = 'SGST not found';
            } else if (!isset($data->IGST)  || $data->IGST == '') {
                $response['error'] = 102;
                $response['message'] = 'IGST not found';
            } else if (!isset($data->StartDate)  || $data->StartDate == '') {
                $response['error'] = 102;
                $response['message'] = 'StartDate not found';
            } else if (!isset($data->EndDate)  || $data->EndDate == '') {
                $response['error'] = 102;
                $response['message'] = 'EndDate not found';
            } */ else {


                $IP = GetIP();

                $data->CGST = $data->SGST = $data->IGST = 0;
                $data->CompanyID = 1;
                $data->EstimateDate = $data->StartDate = $data->EndDate = date('Y-m-d');

                $WRTotal = @$data->SubTotal + @$data->CGST + @$data->SGST + @$data->IGST;
                $Total = round($WRTotal);
                if ($WRTotal > $Total) {
                    $data->Rounding = $WRTotal - $Total;
                } else {
                    $data->Rounding = $Total - $WRTotal;
                }
                $data->Rounding = round($data->Rounding, 2);
                $data->Total = $Total;

                // $this->load->helper('string');
                // $data->OTP = random_string('numeric', 4);
                $digits = 4;
                $data->OTP = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                // $data->StartDate = GetDateInFormat($data->StartDate, DATE_FORMAT, DATABASE_DATE_FORMAT);
                // $data->EndDate = GetDateInFormat($data->EndDate, DATE_FORMAT, DATABASE_DATE_FORMAT);

                $sql = "call usp_A_AddQuotation('" .
                    $data->SitesID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->CompanyID . "','" .
                    $data->EstimateDate . "','" .
                    $data->Address . "','" .
                    $data->Address2 . "','" .
                    $data->CityID . "','" .
                    $data->StateID . "','" .
                    $data->PinCode . "','" .
                    $data->SubTotal . "','" .
                    $data->CGST . "','" .
                    $data->SGST . "','" .
                    $data->IGST . "','" .
                    $data->Rounding . "','" .
                    $WRTotal . "','" . //$data->Total . "','" .
                    $data->ServiceID . "','" .
                    $data->VisitorID . "','" .
                    $data->CustomerID . "','" .
                    str_replace('\n', '', $this->db->escape_str(nl2br($data->Terms))) . "','" .
                    str_replace('\n', '', $this->db->escape_str(nl2br($data->Notes))) . "','" .
                    $this->db->escape_str($data->Remark) . "','" .
                    $data->StartDate . "','" .
                    $data->EndDate . "','" .
                    'Installation' . "','" .
                    $data->OTP . "','" .
                    $data->AppointmentID . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);


                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    //$EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" . $data->UserID . "')");
                    $device = $this->getDeviceData($data->UserID);
                    $employee = $this->getEmployeeData($data->UserID);
                    if (@$device != "") {
                        $notif_text = $this->getQuotationMessage($_result[0]->ID, $data->UserID);
                        $pushNotificationArr = array(
                            'device_id' => $device,
                            'message' => $notif_text,
                            'title' => label('api_msg_notification_addquotation_title'),
                            'event' => NOTIFICATION_ADDQUOTATION,
                            'ActionType' => '',
                            'detail' => ''
                        );
                        $res = sendPushNotification($pushNotificationArr);
                    }
                    $this->load->model('admin/config_model');
                    $this->configdata = $this->config_model->getConfig();

                    foreach ($data->Item as $key => $value) {
                        $res_item = $this->master_model->getQueryResult("call usp_A_AddQuotationitem('" .
                            $_result['0']->ID . "','" .
                            $data->UserID . "','1','Android','" .
                            $IP . "','" .
                            0 . "','" .
                            0 . "','" .
                            $value->Qty . "','" .
                            $value->Rate . "','" .
                            $value->Qty * $value->Rate . "','" .
                            1 . "','" .
                            $value->InstallationService . "','" .
                            @$value->UOM . "'
                        )");
                    }

                    $this->PrintReceipt($_result['0']->ID);



                    $_result_quotation = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" .
                        $_result[0]->ID . "'
                    )");
                    if (isset($_result_quotation) && !empty($_result_quotation) && !isset($_result_quotation['0']->Message)) {
                        $_result_visitor = $this->master_model->getQueryResult("call usp_A_GetVisitorByID('" .
                            $data->VisitorID . "'
                        )");
                        if (isset($_result_visitor) && !empty($_result_visitor) && !isset($_result_visitor['0']->Message)) {
                            $name = $_result_visitor[0]->Name;
                            $estimation_no = $_result_quotation[0]->EstimateNo;
                            $date = $_result_quotation[0]->EstimateDate;
                            $amount = $_result_quotation[0]->Total;
                            $otp = $_result_quotation[0]->OTP;

                            // $msg = "Dear ".$name."\nEstimation No: ".$estimation_no."\nDate:".$date."\nAmount: Rs. ".$amount."\nJust to accept this, pass this OTP:".$otp." to engineers.\nHH Enterprise";
                            $Content = $this->master_model->get_smstemplate(3);
                            $msg = str_replace(array('{name}', '{estimation_no}', '{date}', '{amount}', '{OTP}'), array($name, $estimation_no, $date, $amount, $otp), $Content['SmsMessage']);

                            $_result[0]->OTP = $otp;
                            $response['error'] = 200;
                            $response['message'] = $msg; //label('api_msg_quotation_listed_successfully');
                            $response['data'] = $_result; //array(array('QuotationID' => $_result[0]->QuotationID,'OTP' => $_result[0]->OTP));
                        } else if (isset($_result_visitor['0']->Message) && $_result_visitor['0']->Message != "") {
                            $msg = explode('~', $_result[0]->Message);
                            $response['error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['message'] = $msg[1];
                            $response['data'] = array();
                        } else {
                            $response['error'] = 104;
                            $response['message'] = label('api_msg_error_occurred');
                        }
                    }

                    // $_result[0]->OTP = $data->OTP;
                    // $response['error'] = 200;
                    // $response['message'] = label('api_msg_quotation_added_successfully');
                    // $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    /* ------------------------- */

    function printWarrantyService($data)
    {
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

        // set font
        $pdf->SetFont('helvetica', '', 9);

        // add a page
        $pdf->AddPage();

        /* 
        <img src="logo/logo-2.png" alt="logo" style=" width: 100px;padding-right: 0">
        <img src="logo/HH_Logo.png" alt="logo" style="width: 157px; height: fit-content;">
         */
        $html = '
            <html> 
            <body>
                <div style="width: 580px; padding: 0px 25px; margin: 0 auto; margin-top: 3px; margin-bottom: 0px;">
                    <div style="display: flex; justify-content: space-between;">
                        <div style="text-align: center;">
                            <span style="font-size: 13px;margin:0;">
                                6, Anisha Complex,<br> Nr. Mahalakshmi Tower, Panchtirth 5 Rasta to <br> Vikasgruh Road, B/s, Allahbad Bank, <br> Paldi, Ahmedabad 380 007.<br> <b>Phone : +91 98250 64676</b>  
                            </span> 
                        </div>
                    </div>
                    <hr/>
                    <span style="text-align: center;font-size: 14px; margin:0;">Regd. Office : 1233 , Unchi Gali, Shamla Ni Pole, Raipur, Ahmedabad 380 001.</span>
                    <br/>   
                    <table>
                        <tr>
                            <td>
                            <h2>Service Call Report</h2>
                            </td>
                            <td style="text-align: right;">
                                <div>
                                    <h4>Compliant No. : <span style="width: 70px;display: inline-block;border-bottom: 1px solid #000000;font-size: 26px;">1500</span></h4>
                                    <h4>Date :<span style=" width: 137px;display: inline-block;border-bottom: 1px solid #000000;margin-top: 25px;font-size: 20px;"></span></h4>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <hr/>
                    <div style="text-align: center;">
                    <b style="font-size: 16px; text-transform: uppercase;">Warranty/preventive/premium</b>
                    </div>
                    <br/>
                    <div style="display: flex;">
                        <label style="margin-right: 5px;">Name :</label>
                        <input type="text" disabled style="border: none;width: 91%;border-bottom: 1px solid #000000;background: #fff;">
                    </div>
                    <div style="display: flex;margin-top: 10px;">
                        <label style="margin-right: 5px;">Address :</label>
                        <input type="text" disabled style="border: none;width: 88.8%;border-bottom: 1px solid #000000; background: #fff;">
                    </div>
                    <input type="text" disabled style="border: none;width: 100%;border-bottom: 1px solid #000000;margin-top:10px;background: #fff;">

                    <div style="display: flex;margin-top: 10px;justify-content: space-between;">
                        <div style="display: flex;margin-top: 10px;width: 63%;">
                            <label style="margin-right: 5px;">Contact No. : (M)</label>
                            <input type="text" disabled style="border: none;width: 68%;border-bottom: 1px solid #000000;background: #fff;">
                        </div>
                        <div style="display: flex;margin-top: 10px;width: 36%;">
                            <label style="margin-right: 5px;">(R)</label>
                            <input type="text" disabled style="border: none;width: 89%;border-bottom: 1px solid #000000;background: #fff;">
                        </div>
                    </div>
                    

                    <div style="width: 100%; margin-top: 30px;">
                        <table style="border-collapse: collapse; width: 100%;">
                            <tr>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 14px;padding: 5px 0;font-weight: 600;">Machin Capacity</td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 14px;padding: 5px 0;font-weight: 600;">Location</td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 14px;padding: 5px 0;font-weight: 600;">Complaint</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                                <td style="border: 1px solid black;text-align: center;width: 33.33%;font-size: 18px;padding: 5px 0;height: 21px;"></td>
                            </tr>
                        </table>
                    </div>

                    <div style="display: flex;margin-top: 15px;">
                        <label style="margin-right: 5px;">Solution :</label>
                        <input type="text" disabled style="border: none;width: 88.5%;border-bottom: 1px solid #000000;background: #fff;">
                    </div>
                    <input type="text" disabled style="border: none;width: 100%;border-bottom: 1px solid #000000;margin-top: 10px;background: #fff;">
                    <input type="text" disabled style="border: none;width: 100%;border-bottom: 1px solid #000000;margin-top: 10px;background: #fff;">

                    <div style="display: flex;margin-top: 15px;">
                        <label style="margin-right: 5px;">Charge :</label>
                        <input type="text" disabled style="border: none;width: 90%;;border-bottom: 1px solid #000000; background: #fff;">
                    </div>

                    <div style="display: flex;margin-top: 10px;justify-content: space-between;">
                        <div style="display: flex;margin-top: 10px;width: 50%;">
                            <label style="margin-right: 5px;">Time In :</label>
                            <input type="text" disabled style="border: none;width: 77%;border-bottom: 1px solid #000000;background: #fff;">
                        </div>
                        <div style="display: flex;margin-top: 10px;width: 50%;">
                            <label style="margin-right: 5px;">Time Out :</label>
                            <input type="text" disabled style="border: none;width: 74%;border-bottom: 1px solid #000000;background: #fff;">
                        </div>
                    </div>

                    <div style="display: flex;margin-top: 10px;justify-content: space-between;">
                        <div style="width: 70%;">
                            <div style="margin-top: 10px;width: 100%;">
                                <label style="margin-right: 13px;">Cust Sign. :</label>
                                <input type="text" disabled style="border: none;width: 77%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                            <div style="margin-top: 10px; width: 100%;">
                                <label style="margin-right: 5px;">Cust Name :</label>
                                <input type="text" disabled style="border: none;width: 74%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                            <div style="margin-top: 10px; width: 100%;">
                                <label style="margin-right: 45px;">Date :</label>
                                <input type="text" disabled style="border: none;width: 74%;border-bottom: 1px solid #000000;background: #fff;">
                            </div>
                        </div>
                        <div style="margin-top: 10px; width: 30%;text-align: right;">
                            <label style="font-size: 16px; font-weight: 600;border-top: 1px solid #000000;">Service Engineers Sign.</label>
                        </div>
                    </div>   
                    
                </div>
            </body>
            </html>
        ';

        $ID = "hello";
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
            $structure = 'assets/uploads/service/';
            $File = $ID . '_' . date('dmY') . '.pdf';
            $path = FCPATH . $structure . $File;
        }


        $pdf->Output($path, 'F');
        die;
    }
    function getProducts($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->BrandID)  || $data->BrandID == '') {
                $response['error'] = 102;
                $response['message'] = 'BrandID not found';
            } else {
                $ProductName = !isset($data->ProductName) ? '' : $data->ProductName;
                $DisplayName = !isset($data->DisplayName) ? '' : $data->DisplayName;
                $Model = !isset($data->Model) ? '' : $data->Model;
                $Status = (!isset($data->Status) || $data->Status == 0) ? '-1' : $data->Status;
                $sql = "call usp_A_GetProduct('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $ProductName . "','" .
                    $DisplayName . "','" .
                    $data->BrandID . "','" .
                    $Model . "','" .
                    $Status . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_product_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getBrands($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else {
                $BrandName = !isset($data->BrandName) ? '' : $data->BrandName;
                $Status = (!isset($data->Status) || $data->Status == 0) ? '-1' : $data->Status;
                $sql = "call usp_A_GetBrand('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $BrandName . "','" .
                    $Status . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_brand_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getMaterial($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else {
                $Material = !isset($data->Material) ? '' : $data->Material;
                $Status = (!isset($data->Status) || $data->Status == 0) ? '-1' : $data->Status;
                $sql = "call usp_A_GetMaterial('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $Material . "','" .
                    $Status . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_material_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getChallan($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else {

                $SitesID = (!isset($data->SitesID) || $data->SitesID == 0) ? '-1' : $data->SitesID;
                $VisitorID = (!isset($data->VisitorID) || $data->VisitorID == 0) ? '-1' : $data->VisitorID;
                $CustomerID = (!isset($data->CustomerID) || $data->CustomerID == 0) ? '-1' : $data->CustomerID;
                $ChallanID = (!isset($data->ChallanID) || $data->ChallanID == 0) ? '-1' : $data->ChallanID;
                $Status = (!isset($data->Status) || $data->Status == 0) ? '-1' : $data->Status;
                $QuotationID = (!isset($data->QuotationID) || $data->QuotationID == 0) ? '-1' : $data->QuotationID;

                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $HasChallan = isset($data->HasChallan) ? $data->HasChallan : '-1';
                $sql = "call usp_A_GetChallanByStatus('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->SitesID . "','" .
                    $data->VisitorID . "','" .
                    $data->CustomerID . "','" .
                    // $data->QoutationStatus . "','" .
                    $ChallanID . "','" .
                    $CityID . "','" .
                    $QuotationID . "','" .
                    $HasChallan . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    foreach ($_result as $key => $value) {
                        $HasChallan = isset($data->HasChallan) ? $data->HasChallan : '-1';
                        $_result[$key]->Item['Material'] = $this->master_model->getQueryResult("call usp_A_GetChallanitem('-1',1,'" . $value->ChallanID . "',1,'1','" . $HasChallan . "')");
                        $_result[$key]->Item['Product'] = $this->master_model->getQueryResult("call usp_A_GetChallanitem('-1',1,'" . $value->ChallanID . "',1,'0','" . $HasChallan . "')");

                        foreach ($_result[$key]->Item['Product'] as $product_key => $product) {
                            if (isset($product->ChallanItemID)) {
                                $sql = "call usp_A_GetInstallationItem(
                                    '-1','1','-1','" . $product->ChallanItemID . "','-1','-1','-1','-1','-1'
                                )";
                                // $sql = "call usp_A_GetAppointmentInstallationTotal('" .
                                //     $_result[$key]->AppointmentID . "', '".$product->ChallanItemID."'
                                // )";
                                $_invoice_result = $this->master_model->getQueryResult($sql);
                                /* $installation_data = array();
                                if(!isset($_invoice_result[0]->Message)) {
                                    foreach($_invoice_result as $item) {
                                        foreach(@$item as $service=>$value) {
                                            //if($item->InstallationService != "") { 
                                                $installation_data[] = array('Title' => $service, 'Qty' => 1, 'Price' => $value);
                                                //$installation_data[] = $item;//array('Title' => $item->InstallationService, 'Qty' => $item->Qty, 'Price' => $item->Qty*$item->Rate);
                                            //}
                                        }
                                    } 
                                } */
                                if (isset($_invoice_result) && !empty($_invoice_result) && !isset($_invoice_result['0']->Message)) {
                                    $_result[$key]->Item['Product'][$product_key]->installation = $_invoice_result;
                                } else {
                                    $_result[$key]->Item['Product'][$product_key]->installation = array();
                                }
                                //$_result[$key]->Item['Product'] = array_merge($_result[$key]->Item['Product'], $_invoice_result);
                            }
                        }
                    }

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_challan_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function addChallan($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else {

                $IP = GetIP();

                $_result_products = $this->master_model->getQueryResult("call usp_A_GetChallanItemByQuotation('-1',1,'" . $data->QuotationID . "','-1',-1,0,1)");
                //if atleast one challan has been update after automatic creation
                if (isset($_result_products[0]->ChallanItemID)) {
                    //add new challan now
                    $WRTotal = @$data->SubTotal + @$data->CGST + @$data->SGST + @$data->IGST;
                    $Total = round($WRTotal);
                    if ($WRTotal > $Total) {
                        $data->Rounding = $WRTotal - $Total;
                    } else {
                        $data->Rounding = $Total - $WRTotal;
                    }
                    $data->Rounding = round($data->Rounding, 2);
                    $data->Total = $Total;

                    // $data->StartDate = GetDateInFormat($data->StartDate, DATE_FORMAT, DATABASE_DATE_FORMAT);
                    // $data->EndDate = GetDateInFormat($data->EndDate, DATE_FORMAT, DATABASE_DATE_FORMAT);
                    $DeliveryCharge = (!isset($data->DeliveryCharge) || $data->DeliveryCharge == '') ? '0' : $data->DeliveryCharge;

                    $sql = "call usp_A_AddChallan('" .
                        $data->QuotationID . "','" .
                        $data->UserID . "','1','Android','" .
                        $IP . "','" .
                        $data->ChallanDate . "','" .
                        $data->Address . "','" .
                        $data->Address2 . "','" .
                        $data->CityID . "','" .
                        $data->StateID . "','" .
                        $data->PinCode . "','" .
                        $data->SubTotal . "','" .
                        $data->CGST . "','" .
                        $data->SGST . "','" .
                        $data->IGST . "','" .
                        $data->Rounding . "','" .
                        $data->Total . "','" .
                        $DeliveryCharge . "','" .
                        str_replace('\n', '', $this->db->escape_str(nl2br($data->Terms))) . "','" .
                        str_replace('\n', '', $this->db->escape_str(nl2br($data->Notes))) . "'
                    )";
                    $_result = $this->master_model->getQueryResult($sql);

                    if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                        $this->load->model('admin/config_model');
                        $this->configdata = $this->config_model->getConfig();

                        foreach ($data->Item as $key => $value) {
                            for ($i = 1; $i <= $value->Qty; $i++) {
                                $sql = "call usp_A_AddChallanItem('" .
                                    $_result['0']->ID . "','" .
                                    $data->UserID . "','1','Android','" .
                                    $IP . "','" .
                                    $value->ProductID . "','" .
                                    $value->MaterialID . "','" .
                                    $value->Qty . "','" .
                                    $value->Rate . "','" .
                                    $value->Rate . "','" .
                                    @$value->SrNo . "','" .
                                    @$value->QuotationID . "','1'
                                )";
                                $item_res = $this->master_model->getQueryResult($sql);
                            }
                        }

                        $this->PrintChallan($_result['0']->ID);

                        $response['error'] = 200;
                        $response['message'] = label('api_msg_challan_added_successfully');
                        $response['data'] = $_result;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_error_occurred');
                    }
                } else {
                    //you are updating the challan for the first time, so update the first challan(you have challan id)
                    $WRTotal = @$data->SubTotal + @$data->CGST + @$data->SGST + @$data->IGST;
                    $Total = round($WRTotal);
                    if ($WRTotal > $Total) {
                        $data->Rounding = $WRTotal - $Total;
                    } else {
                        $data->Rounding = $Total - $WRTotal;
                    }
                    $data->Rounding = round($data->Rounding, 2);
                    $data->Total = $Total;

                    // $data->StartDate = GetDateInFormat($data->StartDate, DATE_FORMAT, DATABASE_DATE_FORMAT);
                    // $data->EndDate = GetDateInFormat($data->EndDate, DATE_FORMAT, DATABASE_DATE_FORMAT);
                    $DeliveryCharge = (!isset($data->DeliveryCharge) || $data->DeliveryCharge == '') ? '0' : $data->DeliveryCharge;

                    $sql = "call usp_A_EditChallan('" .
                        $data->UserID . "','1','" .
                        $data->ChallanID . "', 'Android','" .
                        $IP . "','" .
                        $data->QuotationID . "','" .
                        $data->ChallanDate . "','" .
                        $data->Address . "','" .
                        $data->Address2 . "','" .
                        $data->CityID . "','" .
                        $data->StateID . "','" .
                        $data->PinCode . "','" .
                        $data->SubTotal . "','" .
                        $data->CGST . "','" .
                        $data->SGST . "','" .
                        $data->IGST . "','" .
                        $data->Rounding . "','" .
                        $data->Total . "','" .
                        $DeliveryCharge . "','" .
                        str_replace('\n', '', $this->db->escape_str(nl2br($data->Terms))) . "','" .
                        str_replace('\n', '', $this->db->escape_str(nl2br($data->Notes))) . "'
                    )";
                    $_result = $this->master_model->getQueryResult($sql);

                    if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                        $this->load->model('admin/config_model');
                        $this->configdata = $this->config_model->getConfig();

                        foreach ($data->Item as $key => $value) {
                            for ($i = 1; $i <= $value->Qty; $i++) {
                                $sql = "call usp_A_EditChallanItem('" .
                                    $data->UserID . "','1','" .
                                    $value->ChallanItemID . "','Android','" .
                                    $IP . "','" .
                                    $_result['0']->ID . "','" .
                                    $value->ProductID . "','" .
                                    $value->MaterialID . "','" .
                                    '1' . "','" .
                                    $value->Rate . "','" .
                                    $value->Rate . "','" .
                                    @$value->SrNo . "','" .
                                    @$value->IsInstalled . "','" .
                                    1 . "'
                                )";
                                $item_res = $this->master_model->getQueryResult($sql);
                            }
                        }

                        $this->PrintChallan($_result['0']->ID);

                        $response['error'] = 200;
                        $response['message'] = label('api_msg_challan_added_successfully');
                        $response['data'] = $_result;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_error_occurred');
                    }
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function addAcUnit($json)
    {
        $data = (object)$json;
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->ProductID)  || $data->ProductID == '') {
                $response['error'] = 102;
                $response['message'] = 'ProductID not found';
            } else if (!isset($data->Rate)  || $data->Rate == '') {
                $response['error'] = 102;
                $response['message'] = 'Rate not found';
            } else if (!isset($data->SiteID)  || $data->SiteID == '') {
                $response['error'] = 102;
                $response['message'] = 'SiteID not found';
            } else if (!isset($data->IndoorSrNo)  || $data->IndoorSrNo == '') {
                $response['error'] = 102;
                $response['message'] = 'IndoorSrNo not found';
            } else if (!isset($data->OutdoorSrNo)  || $data->OutdoorSrNo == '') {
                $response['error'] = 102;
                $response['message'] = 'OutdoorSrNo not found';
            } else {
                $IP = GetIP();
                $sql = "call usp_A_AddChallanItem('" .
                    '0' . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->ProductID . "','" .
                    '0' . "','" .
                    '1' . "','" .
                    $data->Rate . "','" .
                    $data->Rate . "','" .
                    $value->SrNo . "','1'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $ChallanItemID = (!isset($data->ChallanItemID) ? "0" : $data->ChallanItemID);
                    $SiteID = (!isset($data->SiteID) ? "0" : $data->SiteID);
                    $IndoorSrNo = (!isset($data->IndoorSrNo) ? "" : $data->IndoorSrNo);
                    $OutdoorSrNo = (!isset($data->OutdoorSrNo) ? "" : $data->OutdoorSrNo);
                    $InstallationType = (!isset($data->InstallationType) ? "" : $data->InstallationType);
                    $CopperPiping = (!isset($data->CopperPiping) ? "" : $data->CopperPiping);
                    $Cable = (!isset($data->Cable) ? "" : $data->Cable);
                    $Drain = (!isset($data->Drain) ? "" : $data->Drain);
                    $ZariWork = (!isset($data->ZariWork) ? "" : $data->ZariWork);
                    $CoreCutting = (!isset($data->CoreCutting) ? "" : $data->CoreCutting);
                    $StandType = (!isset($data->StandType) ? "" : $data->StandType);
                    $UnitSetup = (!isset($data->UnitSetup) ? "" : $data->UnitSetup);

                    $CopperPipingPayable = (!isset($data->CopperPipingPayable) ? "0" : $data->CopperPipingPayable);
                    $CablePayable = (!isset($data->CablePayable) ? "0" : $data->CablePayable);
                    $DrainPayable = (!isset($data->DrainPayable) ? "0" : $data->DrainPayable);
                    $ZariWorkPayable = (!isset($data->ZariWorkPayable) ? "0" : $data->ZariWorkPayable);
                    $CoreCuttingPayable = (!isset($data->CoreCuttingPayable) ? "0" : $data->CoreCuttingPayable);
                    $StandTypePayable = (!isset($data->StandTypePayable) ? "0" : $data->StandTypePayable);


                    $CopperPipingRemark = (!isset($data->CopperPipingRemark) ? "" : $data->CopperPipingRemark);
                    $CableRemark = (!isset($data->CableRemark) ? "" : $data->CableRemark);
                    $DrainRemark = (!isset($data->DrainRemark) ? "" : $data->DrainRemark);
                    $ZariWorkRemark = (!isset($data->ZariWorkRemark) ? "" : $data->ZariWorkRemark);
                    $CoreCuttingRemark = (!isset($data->CoreCuttingRemark) ? "" : $data->CoreCuttingRemark);
                    $StandTypeRemark = (!isset($data->StandTypeRemark) ? "" : $data->StandTypeRemark);

                    $Location = (!isset($data->Location) ? "" : $data->Location);

                    $Remark = (!isset($data->Remark) ? "" : $data->Remark);
                    $ImageIndoor = (!isset($data->ImageIndoor) ? "" : $data->ImageIndoor);
                    $ImageOutdoor = (!isset($data->ImageOutdoor) ? "" : $data->ImageOutdoor);
                    $Piping = (!isset($data->Piping) ? "0" : $data->Piping);
                    $installation_sql = "call usp_A_AddInstallation('" .
                        $ChallanItemID . "','" .
                        $SiteID . "','" .
                        $IndoorSrNo . "','" .
                        $OutdoorSrNo . "','" .
                        $InstallationType . "','" .
                        $CopperPiping . "','" .
                        $Cable . "','" .
                        $Drain . "','" .
                        $ZariWork . "','" .
                        $CoreCutting . "','" .
                        $StandType . "','" .

                        $CopperPipingPayable . "','" .
                        $CablePayable . "','" .
                        $DrainPayable . "','" .
                        $ZariWorkPayable . "','" .
                        $CoreCuttingPayable . "','" .
                        $StandTypePayable . "','" .

                        $CopperPipingRemark . "','" .
                        $CableRemark . "','" .
                        $DrainRemark . "','" .
                        $ZariWorkRemark . "','" .
                        $CoreCuttingRemark . "','" .
                        $StandTypeRemark . "','" .

                        $this->db->escape_str($Remark) . "','" .
                        $Location . "','" .
                        $ImageIndoor . "','" .
                        $ImageOutdoor . "','" .

                        $UnitSetup . "','" .
                        $Piping . "','" .

                        $data->UserID . "','1','Android','" .
                        $IP . "'
                    )";

                    if (@$_FILES['IndoorImage']['error'] == 0 && !empty($_FILES['IndoorImage'])) {
                        $pathMain       = INSTALLATION_UPLOAD_PATH;
                        $path           = INSTALLATION_UPLOAD_PATH;
                        $max_size       = INSTALLATION_MAX_SIZE;
                        $allowed_types  = INSTALLATION_ALLOWED_TYPES;

                        $imageNameTime = time();
                        $file_name = $imageNameTime . "_" . $data->UserID;
                        $CV_real_name = @$_FILES['IndoorImage']['name'];

                        $uploadFile = 'IndoorImage';
                        $result = array();
                        $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                        if ($result['status'] == 1) {
                            $uploadedFileName = $result['upload_data']['file_name'];
                        }
                        /* $sql = "call usp_A_EditInstalationIndoorImage('" .
                            $data['ChallanItemID'] . "','" .
                            $uploadedFileName . "','" .
                            $data['UserID'] . "','1','Android','" .
                            $IP . "'
                        )"; */
                        $_result = $this->master_model->getQueryResult($sql);
                        $response['error'] = 200;
                        $response['message'] = 'Indoor Image Updated';
                    }

                    if (@$_FILES['OutdoorImage']['error'] == 0 && !empty($_FILES['OutdoorImage'])) {
                        $pathMain       = INSTALLATION_UPLOAD_PATH;
                        $path           = INSTALLATION_UPLOAD_PATH;
                        $max_size       = INSTALLATION_MAX_SIZE;
                        $allowed_types  = INSTALLATION_ALLOWED_TYPES;

                        $imageNameTime = time();
                        $file_name = $imageNameTime . "_" . $data->UserID;
                        $CV_real_name = @$_FILES['OutdoorImage']['name'];

                        $uploadFile = 'OutdoorImage';
                        $result = array();
                        $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                        if ($result['status'] == 1) {
                            $uploadedFileName = $result['upload_data']['file_name'];
                        }
                        /* $sql = "call usp_A_EditInstalationOutdoorImage('" .
                            $data['ChallanItemID'] . "','" .
                            $uploadedFileName . "','" .
                            $data['UserID'] . "','1','Android','" .
                            $IP . "'
                        )"; */
                        $_result = $this->master_model->getQueryResult($installation_sql);
                        $response['error'] = 200;
                        $response['message'] = 'Indoor Image Updated';
                    }

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_item_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function PrintChallan($ID)
    {
        $result = array();

        $Quotation = $this->master_model->getQueryResult("call usp_A_GetChallanByID('" . $ID . "')");
        $Item_Material = $this->master_model->getQueryResult("call usp_A_GetChallanitem('-1','1','" . $ID . "','1','1','1')");
        $Item_Product = $this->master_model->getQueryResult("call usp_A_GetChallanitem('-1','1','" . $ID . "','1','0','1')");
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

        /*  */
        $html .= '
                    <table>
                        <tr>
                            <td><img src="' . base_url(DEFAULT_WEBSITE_LOGO) . '" style="height:85px;"></td>
                            <td style="text-align:right;"><b><span style="font-size:30px;">Challan</span><br> ' . $Quotation['0']->ChallanNo . '</b></td>
                        </tr>
                    </table>
                    <br/>
                    <br/>
                    <table>
                        <tr>
                            <td><b>' . $Company[0]->CompanyName . '</b></td>
                        </tr>
                    </table>
                    <br/>
                    <br/>
                    <table>
                        <tr>
                            <td>' . wordwrap($Company[0]->Address, 50, "<br/>") . '</td>
                        </tr>
                        <tr>
                            <td>Contact No.: ' . $Company[0]->ContactNo . ', Email ID: ' . $Company[0]->EmailID . '</td>
                        </tr>
                        <tr>
                            <td>' . ($Company[0]->GSTNo != "" ? ("GSTIN :" . $Company[0]->GSTNo) : "") . '</td>
                        </tr>
                    </table>
                    <p style="text-align:center;"><b>OUTWARD CHALLAN</b></p>
                    <br>
                    <table border="1" style="border: 1px solid #aaa" cellpadding="8">
                        <tr>
                            <td>
                                Challan Date: ' . $Quotation[0]->ChallanDate . '<br>
                                ' . $Sites[0]->Name . '<br>
                                ' . $Sites[0]->Address . ' ' . $Sites[0]->Address2 . '<br>
                                ' . $Sites[0]->CityName . ' ' . $Sites[0]->StateName . '<br>
                                ' . $Sites[0]->PinCode . '
                            </td>
                            <td>
                            Challan No. :' . $Quotation[0]->ChallanNo . '<br>
                            GSTIN :' . (($Sites[0]->GSTNo != '') ? $Sites[0]->GSTNo : ('')) . '
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <table border="0.5" style="border: 1px solid #aaa" cellpadding="8">
                        <tr style="background-color:black;color:white;">
                            <th width="70">#</th>
                            <th width="440">Brand - Model Description</th>
                            <th width="50">Qty</th>
                            <th width="70">SrNo</th>
                        </tr>';

        $item_counter = 0;
        if (!isset($Item_Product[0]->Message)) {
            foreach ($Item_Product as $key => $value) {
                $html .= '
                                <tr>
                                    <td>' . (++$item_counter) . '</td>
                                    <td>' . $value->DisplayName . '<br/>' . $value->Model . '</td>
                                    <td>' . $value->Qty . '</td>
                                    <td>' . $value->SrNo . '</td>
                                </tr>';
            }
        }
        if (!isset($Item_Material[0]->Message)) {
            foreach ($Item_Material as $key => $value) {
                $html .= '
                                    <tr>
                                        <td>' . (++$item_counter) . '</td>
                                        <td>' . $value->Material . '</td>
                                        <td>' . $value->Qty . '</td>
                                        <td></td>
                                    </tr>';
            }
        }


        $html .= '
                        <tr>
                            <td colspan="3">
                                Note: ' . str_replace('\n', '<br>', $Quotation[0]->Note) . '
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table border="1" style="border: 1px solid #aaa" cellpadding="8">
                        <tr>
                            <td>
                                TERMS OF SUPPLY<br>
                                GSTIN :' . ($Company[0]->GSTNo != "" ? $Company[0]->GSTNo : "") . '<br>
                                <label>SUBJECT TO AHMEDABAD</label><br>
                                <label>JURIDICTION</label>
                            </td>
                            <td style="text-align: center;">
                                RECEIVER\'S SIGN/NO<br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <b>STAMP</b>
                            </td>
                            <td style="text-align: right;">
                                HH ENTERPRISE<br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <b>Authorised Signatory</b>
                            </td>
                        </tr>
                    </table>';

        $html .= '</body></html>';

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
            $structure = 'assets/uploads/challan/';
            $File = $ID . '_' . date('dmY') . '.pdf';
            $path = FCPATH . $structure . $File;
        }

        $data = array();
        $this->master_model->getQueryResult("call usp_updateChallanPdf('" . $ID . "','" . $File . "')");
        //Close and output PDF document

        $pdf->Output($path, 'F');
        return $path;
    }
    function getInstallationType()
    {
        try {
            $response = array();
            $types = array();
            foreach (INSTALLATION_TYPE as $item) {
                $types[]['Title'] = $item;
            }
            $response['error'] = 200;
            $response['message'] = label('api_msg_installation_type_listed_successfully');
            $response['data'] = $types;

            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getServiceCounts()
    {
        try {
            $response = array();
            $types = array();
            foreach (SERVICES_PER_YEAR as $item) {
                $types[]['Title'] = $item;
            }
            $response['error'] = 200;
            $response['message'] = label('api_msg_service_listed_successfully');
            $response['data'] = $types;

            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getPaymentType()
    {
        try {
            $response = array();
            $types = array();
            foreach (PAYMENT_TYPE as $item) {
                $types[]['Title'] = $item;
            }
            $response['error'] = 200;
            $response['message'] = label('api_msg_payment_type_listed_successfully');
            $response['data'] = $types;

            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getServiceType()
    {
        try {
            $response = array();
            $types = array();
            foreach (SERVICE_TYPE as $item) {
                $types[]['Title'] = $item;
            }
            $response['error'] = 200;
            $response['message'] = label('api_msg_service_type_listed_successfully');
            $response['data'] = $types;

            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getInstallation($data)
    {
        try {
            $response = array();

            if (!isset($data->InstallationID)  || $data->InstallationID == '') {
                $response['error'] = 102;
                $response['message'] = 'InstallationID not found';
            } else {
                $InstallationID = !isset($data->InstallationID) ? '0' : $data->InstallationID;
                $QuotationID = !isset($data->QuotationID) ? '-1' : $data->QuotationID;
                $VisitorID = !isset($data->VisitorID) ? '-1' : $data->VisitorID;
                $SiteID = !isset($data->SiteID) ? '-1' : $data->SiteID;
                $AppointmentID = !isset($data->AppointmentID) ? '-1' : $data->AppointmentID;

                $PageSize = !isset($data->PageSize) ? '-1' : $data->PageSize;
                $CurrentPage = !isset($data->CurrentPage) ? '1' : $data->CurrentPage;
                $sql = "call usp_A_GetAppointmentByID('" . $AppointmentID . "')";
                $_result = $this->master_model->getQueryResult($sql);
                if ($_result[0]->AppointmentType == "Installation") {
                    $sql = "call usp_A_GetInstallationItem('" .
                        $PageSize . "','" .
                        $CurrentPage . "','" .
                        $InstallationID . "','-1','-1','" . $QuotationID . "','" . $VisitorID . "','" . $SiteID . "','" . $AppointmentID . "'
                    )";
                    $_result = $this->master_model->getQueryResult($sql);
                } else {
                    $ServiceReportID = "-1";
                    $ServiceID = "-1";
                    $sql = "call usp_A_GetServiceReport('" .
                        $PageSize . "','" .
                        $CurrentPage . "','" .
                        $ServiceReportID . "','" .
                        $AppointmentID . "','" .
                        $ServiceID . "'
                    )";
                    $_result = $this->master_model->getQueryResult($sql);
                }
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_installation_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getAvailableInstallation($data)
    {
        try {
            $response = array();

            if (!isset($data->SiteID)  || $data->SiteID == '') {
                $response['error'] = 102;
                $response['message'] = 'SiteID not found';
            } else {
                $InstallationID = !isset($data->InstallationID) ? '-1' : $data->InstallationID;
                $QuotationID = !isset($data->QuotationID) ? '-1' : $data->QuotationID;
                $VisitorID = !isset($data->VisitorID) ? '-1' : $data->VisitorID;
                $SiteID = !isset($data->SiteID) ? '-1' : $data->SiteID;
                $AppointmentID = !isset($data->AppointmentID) ? '-1' : $data->AppointmentID;
                $PageSize = !isset($data->PageSize) ? '-1' : $data->PageSize;
                $CurrentPage = !isset($data->CurrentPage) ? '1' : $data->CurrentPage;
                $SrNo = !isset($data->SrNo) ? '' : $data->SrNo;

                $sql = "call usp_A_GetAvailableProductService('" .
                    $PageSize . "','" .
                    $CurrentPage . "','" .
                    $InstallationID . "','-1','-1','" . $QuotationID . "','" . $VisitorID . "','" . $SiteID . "','" . $AppointmentID . "','" . $SrNo . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_installation_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function addInstallation($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->ChallanItemID)  || $data->ChallanItemID == '') {
                $response['error'] = 102;
                $response['message'] = 'ChallanItemID not found';
            } else if (!isset($data->IndoorSrNo)  || $data->IndoorSrNo == '') {
                $response['error'] = 102;
                $response['message'] = 'IndoorSrNo not found';
            } else if (!isset($data->OutdoorSrNo)  || $data->OutdoorSrNo == '') {
                $response['error'] = 102;
                $response['message'] = 'OutdoorSrNo not found';
            } else if (!isset($data->InstallationType)) {
                $response['error'] = 102;
                $response['message'] = 'InstallationType not found';
            } else if (!isset($data->SiteID)  || $data->SiteID == '') {
                $response['error'] = 102;
                $response['message'] = 'SiteID not found';
            } else {
                $IP = GetIP();

                $ChallanItemID = (!isset($data->ChallanItemID) ? "0" : $data->ChallanItemID);
                $SiteID = (!isset($data->SiteID) ? "0" : $data->SiteID);
                $IndoorSrNo = (!isset($data->IndoorSrNo) ? "" : $data->IndoorSrNo);
                $OutdoorSrNo = (!isset($data->OutdoorSrNo) ? "" : $data->OutdoorSrNo);
                $InstallationType = (!isset($data->InstallationType) ? "" : $data->InstallationType);
                $CopperPiping = (!isset($data->CopperPiping) ? "" : $data->CopperPiping);
                $Cable = (!isset($data->Cable) ? "" : $data->Cable);
                $Drain = (!isset($data->Drain) ? "" : $data->Drain);
                $ZariWork = (!isset($data->ZariWork) ? "" : $data->ZariWork);
                $CoreCutting = (!isset($data->CoreCutting) ? "" : $data->CoreCutting);
                $StandType = (!isset($data->StandType) ? "" : $data->StandType);
                $UnitSetup = (!isset($data->UnitSetup) ? "" : $data->UnitSetup);

                $CopperPipingPayable = (!isset($data->CopperPipingPayable) ? "0" : $data->CopperPipingPayable);
                $CablePayable = (!isset($data->CablePayable) ? "0" : $data->CablePayable);
                $DrainPayable = (!isset($data->DrainPayable) ? "0" : $data->DrainPayable);
                $ZariWorkPayable = (!isset($data->ZariWorkPayable) ? "0" : $data->ZariWorkPayable);
                $CoreCuttingPayable = (!isset($data->CoreCuttingPayable) ? "0" : $data->CoreCuttingPayable);
                $StandTypePayable = (!isset($data->StandTypePayable) ? "0" : $data->StandTypePayable);


                $CopperPipingRemark = (!isset($data->CopperPipingRemark) ? "" : $data->CopperPipingRemark);
                $CableRemark = (!isset($data->CableRemark) ? "" : $data->CableRemark);
                $DrainRemark = (!isset($data->DrainRemark) ? "" : $data->DrainRemark);
                $ZariWorkRemark = (!isset($data->ZariWorkRemark) ? "" : $data->ZariWorkRemark);
                $CoreCuttingRemark = (!isset($data->CoreCuttingRemark) ? "" : $data->CoreCuttingRemark);
                $StandTypeRemark = (!isset($data->StandTypeRemark) ? "" : $data->StandTypeRemark);


                $Piping = (!isset($data->Piping) ? "0" : $data->Piping);

                $Location = (!isset($data->Location) ? "" : $data->Location);

                $Remark = (!isset($data->Remark) ? "" : $data->Remark);
                $sql = "call usp_A_AddInstallation('" .
                    $ChallanItemID . "','" .
                    $SiteID . "','" .
                    $IndoorSrNo . "','" .
                    $OutdoorSrNo . "','" .
                    $InstallationType . "','" .
                    $CopperPiping . "','" .
                    $Cable . "','" .
                    $Drain . "','" .
                    $ZariWork . "','" .
                    $CoreCutting . "','" .
                    $StandType . "','" .

                    $CopperPipingPayable . "','" .
                    $CablePayable . "','" .
                    $DrainPayable . "','" .
                    $ZariWorkPayable . "','" .
                    $CoreCuttingPayable . "','" .
                    $StandTypePayable . "','" .

                    $CopperPipingRemark . "','" .
                    $CableRemark . "','" .
                    $DrainRemark . "','" .
                    $ZariWorkRemark . "','" .
                    $CoreCuttingRemark . "','" .
                    $StandTypeRemark . "','" .

                    $this->db->escape_str($data->Remark) . "','" .
                    $data->Location . "','','','" .

                    $UnitSetup . "','" .
                    $Piping . "','" .

                    $data->UserID . "','1','Android','" .
                    $IP . "'
                )";



                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $InstallationID = $_result[0]->ID;
                    $res = $this->master_model->getQueryResult("call usp_A_GetProductByChallanItemID('" . $ChallanItemID . "')");
                    if (!isset($res[0]->Message)) {
                        $service = $res[0]->Service;
                        $ServiceYear = $res[0]->ServiceYear;
                        $warranty = $res[0]->Warranty;
                        $service_days = floor(365 * $ServiceYear / $service);
                        $date = date('Y-m-d');
                        $warranty_date = date('Y-m-d', strtotime($date . ' + ' . $warranty . ' days'));
                        $sql = "call usp_A_AddproductWarranty('" .
                            $data->UserID . "','1','Android','" . $IP . "','" .
                            $ChallanItemID . "','" .
                            $InstallationID . "','" .
                            $warranty_date . "','" .
                            1 . "'
                        )";
                        $res = $this->master_model->getQueryResult($sql);
                        for ($i = 0; $i < $service; $i++) {
                            $date = date('Y-m-d', strtotime($date . ' + ' . $service_days . ' days'));

                            $ServiceStatus = "Pending";
                            $ServiceType = "Free";

                            $IP = GetIP();
                            $sql = "call usp_A_AddproductService('" .
                                $data->UserID . "','1','Android','" . $IP . "','" .
                                $ChallanItemID . "','" .
                                $InstallationID . "','" .
                                $date . "','" .
                                $ServiceStatus . "','" .
                                $ServiceType . "'
                            )";
                            $res = $this->master_model->getQueryResult($sql);
                        }
                    }
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_installation_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function addServiceReport($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->AppointmentID)  || $data->AppointmentID == '') {
                $response['error'] = 102;
                $response['message'] = 'AppointmentID not found';
            } else {
                $IP = GetIP();

                $ServiceReportID = (!isset($data->ServiceReportID) ? "0" : $data->ServiceReportID);
                $ServiceID = (!isset($data->ServiceID) ? "0" : $data->ServiceID);
                $AppointmentID = (!isset($data->AppointmentID) ? "0" : $data->AppointmentID);

                $AirFilterCleaning = (!isset($data->AirFilterCleaning) ? "0" : $data->AirFilterCleaning);
                $CondenserCleaning = (!isset($data->CondenserCleaning) ? "0" : $data->CondenserCleaning);
                $FanMotorOling = (!isset($data->FanMotorOling) ? "0" : $data->FanMotorOling);
                $CheckFastener = (!isset($data->CheckFastener) ? "0" : $data->CheckFastener);
                $CheckElectricalSpares = (!isset($data->CheckElectricalSpares) ? "0" : $data->CheckElectricalSpares);
                $Voltage = (!isset($data->Voltage) ? "0" : $data->Voltage);
                $Arnpere = (!isset($data->Arnpere) ? "0" : $data->Arnpere);
                $RoomTemp = (!isset($data->RoomTemp) ? "0" : $data->RoomTemp);

                $AirFilterCleaningPayable = (!isset($data->AirFilterCleaningPayable) ? "0" : $data->AirFilterCleaningPayable);
                $CondenserCleaningPayable = (!isset($data->CondenserCleaningPayable) ? "0" : $data->CondenserCleaningPayable);
                $FanMotorOlingPayable = (!isset($data->FanMotorOlingPayable) ? "0" : $data->FanMotorOlingPayable);
                $CheckFastenerPayable = (!isset($data->CheckFastenerPayable) ? "0" : $data->CheckFastenerPayable);
                $CheckElectricalSparesPayable = (!isset($data->CheckElectricalSparesPayable) ? "0" : $data->CheckElectricalSparesPayable);
                $VoltagePayable = (!isset($data->VoltagePayable) ? "0" : $data->VoltagePayable);
                $ArnperePayable = (!isset($data->ArnperePayable) ? "0" : $data->ArnperePayable);
                $RoomTempPayable = (!isset($data->RoomTempPayable) ? "0" : $data->RoomTempPayable);

                $AirFilterCleaningRemark = (!isset($data->AirFilterCleaningRemark) ? "" : $data->AirFilterCleaningRemark);
                $CondenserCleaningRemark = (!isset($data->CondenserCleaningRemark) ? "" : $data->CondenserCleaningRemark);
                $FanMotorOlingRemark = (!isset($data->FanMotorOlingRemark) ? "" : $data->FanMotorOlingRemark);
                $CheckFastenerRemark = (!isset($data->CheckFastenerRemark) ? "" : $data->CheckFastenerRemark);
                $CheckElectricalSparesRemark = (!isset($data->CheckElectricalSparesRemark) ? "" : $data->CheckElectricalSparesRemark);
                $VoltageRemark = (!isset($data->VoltageRemark) ? "" : $data->VoltageRemark);
                $ArnpereRemark = (!isset($data->ArnpereRemark) ? "" : $data->ArnpereRemark);
                $RoomTempRemark = (!isset($data->RoomTempRemark) ? "" : $data->RoomTempRemark);

                $AdditionalMaterial = (!isset($data->AdditionalMaterial) ? "0" : $data->AdditionalMaterial);
                $ServiceCharge = (!isset($data->ServiceCharge) ? "0" : $data->ServiceCharge);

                $sql = "call usp_A_AddServiceReport('" .
                    $ServiceReportID . "','" .
                    $ServiceID . "','" .
                    $AppointmentID . "','" .
                    $AirFilterCleaning . "','" .
                    $CondenserCleaning . "','" .
                    $FanMotorOling . "','" .
                    $CheckFastener . "','" .
                    $CheckElectricalSpares . "','" .
                    $Voltage . "','" .
                    $Arnpere . "','" .
                    $RoomTemp . "','" .
                    $AirFilterCleaningPayable . "','" .
                    $CondenserCleaningPayable . "','" .
                    $FanMotorOlingPayable . "','" .
                    $CheckFastenerPayable . "','" .
                    $CheckElectricalSparesPayable . "','" .
                    $VoltagePayable . "','" .
                    $ArnperePayable . "','" .
                    $RoomTempPayable . "','" .
                    $AirFilterCleaningRemark . "','" .
                    $CondenserCleaningRemark . "','" .
                    $FanMotorOlingRemark . "','" .
                    $CheckFastenerRemark . "','" .
                    $CheckElectricalSparesRemark . "','" .
                    $VoltageRemark . "','" .
                    $ArnpereRemark . "','" .
                    $RoomTempRemark . "','" .
                    $AdditionalMaterial . "','" .
                    $ServiceCharge . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "'
                )";

                $_result = $this->master_model->getQueryResult($sql);
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_installation_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getServiceReport($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->ServiceReportID)  || $data->ServiceReportID == '') {
                $response['error'] = 102;
                $response['message'] = 'ServiceReportID not found';
            } else if (!isset($data->ServiceID)  || $data->ServiceID == '') {
                $response['error'] = 102;
                $response['message'] = 'ServiceID not found';
            } else if (!isset($data->AppointmentID)  || $data->AppointmentID == '') {
                $response['error'] = 102;
                $response['message'] = 'AppointmentID not found';
            } else {
                $IP = GetIP();

                $ServiceReportID = (!isset($data->ServiceReportID) ? "0" : $data->ServiceReportID);
                $ServiceID = (!isset($data->ServiceID) ? "0" : $data->ServiceID);
                $AppointmentID = (!isset($data->AppointmentID) ? "0" : $data->AppointmentID);

                $sql = "call usp_A_GetServiceReport('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $ServiceReportID . "','" .
                    $AppointmentID . "','" .
                    $ServiceID . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    if ($ServiceReportID != "0" && $ServiceReportID != "-1" && $ServiceReportID != 0 && $ServiceReportID != -1) {
                        $data = $_result;
                        $_result = array();
                        foreach ($data as $item) {
                            if ($item->ServiceReportID == $ServiceReportID) {
                                $_result[] = $item;
                            }
                        }
                    }
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_installation_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = isset($msg[1]) ? $msg[1] : label('api_msg_no_data');
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function editInstallation($data)
    {
        //echo json_encode(array("data"=>$data, "files"=>$_FILES));
        //die;
        try {
            $response = array();
            $response['error'] = 102;
            $response['message'] = 'Valid Input not found';

            $IP = GetIP();
            if (isset($data['IndoorSrNo']) && $data['IndoorSrNo'] != '') {
                $sql = "call usp_A_EditInstalationIndoorSrNo('" .
                    $data['ChallanItemID'] . "','" .
                    $data['IndoorSrNo'] . "','" .
                    $data['UserID'] . "','1','Android','" .
                    $IP . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);
                $response['error'] = 200;
                $response['message'] = 'Indoor SrNo. Updated';
            }
            if (isset($data['OutdoorSrNo']) && $data['OutdoorSrNo'] != '') {

                $sql = "call usp_A_EditInstalationOutdoorSrNo('" .
                    $data['ChallanItemID'] . "','" .
                    $data['OutdoorSrNo'] . "','" .
                    $data['UserID'] . "','1','Android','" .
                    $IP . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);
                $response['error'] = 200;
                $response['message'] = 'Outdoor SrNo. Updated';
            }

            if (@$_FILES['IndoorImage']['error'] == 0 && !empty($_FILES['IndoorImage'])) {
                $pathMain       = INSTALLATION_UPLOAD_PATH;
                $path           = INSTALLATION_UPLOAD_PATH;
                $max_size       = INSTALLATION_MAX_SIZE;
                $allowed_types  = INSTALLATION_ALLOWED_TYPES;

                $imageNameTime = time();
                $file_name = $imageNameTime . "_" . $data['UserID'];
                $CV_real_name = @$_FILES['IndoorImage']['name'];

                $uploadFile = 'IndoorImage';
                $result = array();
                $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                if ($result['status'] == 1) {
                    $uploadedFileName = $result['upload_data']['file_name'];
                }
                $sql = "call usp_A_EditInstalationIndoorImage('" .
                    $data['ChallanItemID'] . "','" .
                    $uploadedFileName . "','" .
                    $data['UserID'] . "','1','Android','" .
                    $IP . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);
                $response['error'] = 200;
                $response['message'] = 'Indoor Image Updated';
            }

            if (@$_FILES['OutdoorImage']['error'] == 0 && !empty($_FILES['OutdoorImage'])) {
                $pathMain       = INSTALLATION_UPLOAD_PATH;
                $path           = INSTALLATION_UPLOAD_PATH;
                $max_size       = INSTALLATION_MAX_SIZE;
                $allowed_types  = INSTALLATION_ALLOWED_TYPES;

                $imageNameTime = time();
                $file_name = $imageNameTime . "_" . $data['UserID'];
                $CV_real_name = @$_FILES['OutdoorImage']['name'];

                $uploadFile = 'OutdoorImage';
                $result = array();
                $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                if ($result['status'] == 1) {
                    $uploadedFileName = $result['upload_data']['file_name'];
                }
                $sql = "call usp_A_EditInstalationOutdoorImage('" .
                    $data['ChallanItemID'] . "','" .
                    $uploadedFileName . "','" .
                    $data['UserID'] . "','1','Android','" .
                    $IP . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);
                $response['error'] = 200;
                $response['message'] = 'Outdoor Image Updated';
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function PrintInstallation($ID)
    {
        $result = array();
        $Challan = $this->master_model->getQueryResult("call usp_A_GetChallanByID('" . $ID . "')");
        $Quotation = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" . $Challan[0]->QuotationID . "')");
        $Item = $this->master_model->getQueryResult("call usp_A_GetInstallationItem('-1','1','-1','-1','" . $ID . "','-1','-1','-1','-1')");
        $Sites = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" . $Quotation[0]->SitesID . "')");
        $Company = $this->master_model->getQueryResult("call usp_A_GetCompanyByID('" . $Quotation[0]->CompanyID . "')");
        $Visitor = $this->master_model->getQueryResult("call usp_A_GetVisitorByID('" . $Sites[0]->VisitorID . "')");

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

        /*  */
        $html .= '
                    <table>
                        <tr>
                            <td><img src="' . base_url(DEFAULT_WEBSITE_LOGO) . '" style="height:85px;"></td>
                            <td style="text-align:right;"><b><span style="font-size:30px;">No</span><br> #' . $Challan['0']->ChallanID . '</b></td>
                        </tr>
                    </table>
                    <br/>
                    <br/>
                    <table>
                        <tr>
                            <td><b>' . $Company[0]->CompanyName . '</b></td>
                        </tr>
                    </table>
                    <br/>
                    <br/>
                    <table>
                        <tr>
                            <td>' . wordwrap($Company[0]->Address, 50, "<br/>") . '</td>
                        </tr>
                        <tr>
                            <td>Contact No.: ' . $Company[0]->ContactNo . ', Email ID: ' . $Company[0]->EmailID . '</td>
                        </tr>
                        <tr>
                            <td>' . ($Company[0]->GSTNo != "" ? ("GSTIN :" . $Company[0]->GSTNo) : "") . '</td>
                        </tr>
                    </table>
                    <p style="text-align:center;"><b>Installation Report</b></p>
                    <br>
                    <table border="1" style="border: 1px solid #aaa" cellpadding="8">
                        <tr>
                            <td>
                                Customer Name: ' . $Sites[0]->Name . '<br>
                                Customer Address: ' . $Sites[0]->Address . ' ' . $Sites[0]->Address2 . ', ' . $Sites[0]->CityName . ' ' . $Sites[0]->StateName . ' - ' . $Sites[0]->PinCode . '<br>
                                Purchase Date: ' . $Quotation[0]->EstimateDate . '<br>
                                DCNo. :' . $Challan[0]->ChallanNo . '<br>
                                Installer Name :_______________________<br>
                            </td>
                            <td>
                            
                            DSP Name: ' . $Challan[0]->ChallanDate . '<br>
                            Mobile No.: ' . $Visitor[0]->MobileNo . '<br>
                            DSP Name: _____________________<br>
                            Installer No. :_______________________<br>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <table border="0.5" style="border: 1px solid #aaa" cellpadding="8">
                        <tr style="background-color:black;color:white;">
                            <th width="70">#</th>
                            <th width="492">Brand - Model Description</th>
                            <th width="70">Qty</th>
                        </tr>';

        $html .= '
                            <tr>
                                <td>' . (++$item_counter) . '</td>
                                <td>' . $value->DisplayName . '<br/>' . $value->Model . '</td>
                                <td>' . $value->Qty . '</td>
                            </tr>';

        /* $item_counter = 0;
                        foreach (@$Item as $key => $value) {
                            $html .= '
                            <tr>
                                <td>' . (++$item_counter) . '</td>
                                <td>' . $value->DisplayName . '<br/>' . $value->Model . '</td>
                                <td>' . $value->Qty . '</td>
                            </tr>';
                        } */
        /* 
                $html .= '
                        <tr>
                            <td colspan="3">
                                Note: '.str_replace('\n', '<br>', $Quotation[0]->Note).'
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table border="1" style="border: 1px solid #aaa" cellpadding="8">
                        <tr>
                            <td>
                                TERMS OF SUPPLY<br>
                                GSTIN :'. ($Company[0]->GSTNo!=""?$Company[0]->GSTNo:"").'<br>
                                <label>SUBJECT TO AHMEDABAD</label><br>
                                <label>JURIDICTION</label>
                            </td>
                            <td style="text-align: center;">
                                RECEIVER\'S SIGN/NO<br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <b>STAMP</b>
                            </td>
                            <td style="text-align: right;">
                                HH ENTERPRISE<br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <b>Authorised Signatory</b>
                            </td>
                        </tr>
                    </table>'; */
        $html .= "</table>";

        $html .= '<table border="1" style="border: 1px solid #aaa" cellpadding="8">
                        <tr>
                            <td width="52px">1</td>
                            <td width="250px">Time taken for installation</td>
                            <td width="330px">_____Hrs. _____Min.</td>
                        </tr>
                        <tr>
                            <td width="52px">2</td>
                            <td width="250px">Has installation person explained about product usage?</td>
                            <td width="330px">______Yes &nbsp;&nbsp;&nbsp; ______No</td>
                        </tr>
                        <tr>
                            <td width="52px">3</td>
                            <td width="250px">How was the installation Engineer\'s attitude?</td>
                            <td width="330px">______Good &nbsp;&nbsp;&nbsp; ______Avg &nbsp;&nbsp;&nbsp; ______Bad</td>
                        </tr>
                        <tr>
                            <td width="52px">4</td>
                            <td width="250px">Overall Satisfaction</td>
                            <td width="330px">______Excellent &nbsp;&nbsp;&nbsp;______Good &nbsp;&nbsp;&nbsp; ______Avg &nbsp;&nbsp;&nbsp; ______Bad &nbsp;&nbsp;&nbsp; ______Poor</td>
                        </tr>
                    </table>';
        $html .= '</body></html>';

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
            $structure = 'assets/uploads/installation/files/';
            $File = $ID . '_' . date('dmY') . '.pdf';
            $path = FCPATH . $structure . $File;
        }

        $data = array();
        //$this->master_model->getQueryResult("call usp_updateChallanPdf('" . $ID . "','" . $File . "')");
        //Close and output PDF document

        $pdf->Output($path, 'F');
        return $path;
    }



    function addPaymentReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->InvoiceID)  || $data->InvoiceID == '') {
                $response['error'] = 102;
                $response['message'] = 'InvoiceID not found';
            } else if (!isset($data->Message)  || $data->Message == '') {
                $response['error'] = 102;
                $response['message'] = 'Message not found';
            } else if (!isset($data->ReminderDate)  || $data->ReminderDate == '') {
                $response['error'] = 102;
                $response['message'] = 'Reminder Date not found';
            } else if (!isset($data->PastDate)  || $data->PastDate == '') {
                $response['error'] = 102;
                $response['message'] = 'Past Date not found';
            } else {

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_AddPaymentReminder('" .
                    $data->InvoiceID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->Message . "','" .
                    $data->ReminderDate . "','" .
                    $data->PastDate . "'
                    )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_paymentreminder_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getPaymentReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->InvoiceID)  || $data->InvoiceID == '') {
                $response['error'] = 102;
                $response['message'] = 'InvoiceID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetPaymentReminder('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->InvoiceID . "','1'
                        )");

                if (isset($_result) && !empty($_result) && isset($_result['0']->PaymentReminderID)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_paymentremindar_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }


    function getAdvance($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetAdvance('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->UserID . "','1'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_advance_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function addAdvance($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->Amount)  || $data->Amount == '') {
                $response['error'] = 102;
                $response['message'] = 'Amount not found';
            } else if (!isset($data->AdvanceDate)  || $data->AdvanceDate == '') {
                $response['error'] = 102;
                $response['message'] = 'Advance Date not found';
            } else if (!isset($data->Type)  || $data->Type == '') {
                $response['error'] = 102;
                $response['message'] = 'Type not found';
            } else {
                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_AddAdvance('" .
                    $data->EmployeeID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->Amount . "','" .
                    $data->AdvanceDate . "','" .
                    $data->Type . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_advance_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function editProfile($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->FirstName)  || $data->FirstName == '') {
                $response['error'] = 102;
                $response['message'] = 'FirstName not found';
            } else if (!isset($data->LastName)  || $data->LastName == '') {
                $response['error'] = 102;
                $response['message'] = 'LastName not found';
            } else if (!isset($data->MobileNo)  || $data->MobileNo == '') {
                $response['error'] = 102;
                $response['message'] = 'MobileNo not found';
            } else if (!isset($data->Address)  || $data->Address == '') {
                $response['error'] = 102;
                $response['message'] = 'Address not found';
            } else if (!isset($data->UsertypeID)  || $data->UsertypeID == '') {
                $response['error'] = 102;
                $response['message'] = 'UsertypeID not found';
            } else if (!isset($data->Salary)  || $data->Salary == '') {
                $response['error'] = 102;
                $response['message'] = 'Salary not found';
            } else {
                $IP = GetIP();
                $_result = $this->master_model->getQueryResult("call usp_M_EditEmployee('" .
                    $data->UserID . "','" .
                    $data->FirstName . "','" .
                    $data->LastName . "','" .
                    $data->MobileNo  . "','" .
                    $data->Address . "','" .
                    $data->UserID . "','Android','" .
                    $IP . "'
                        )");

                $_profile = (array) $this->master_model->getQueryResult("call usp_GetProfileByID('" . $_result[0]->ID . "','" . base_url() . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_edit_employee_successfully');
                    $response['data'] =  $_profile[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getEmployeeForGlobalAttendance($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->CityID)  || $data->CityID == '') {
                $response['error'] = 102;
                $response['message'] = 'CityID not found';
            } else if (!isset($data->AttendanceDate)  || $data->AttendanceDate == '') {
                $response['error'] = 102;
                $response['message'] = 'AttendanceDate not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_GetEmployeeForGlobalAttendance('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->CityID . "','" .
                    $data->AttendanceDate . "'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_employee_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getCheckinout($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetCheckincheckout('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->UserID . "','1'
                        )");
                $Checkintime = '';
                $Checkouttime = '';

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $data_response = array();
                    foreach ($_result as $key => $value) {
                        if (trim(substr($value->Checkintime, 0, strpos($value->Checkintime, ' '))) == date('d-m-Y')) {
                            //unset($_result[$key]);
                            $Checkintime = $value->Checkintime;
                            $Checkouttime = $value->Checkouttime;
                            //break;
                        } else {
                            //$data_response[$key] = $value;
                            $data_response[] = $value;
                        }
                    }

                    //$data_response['Checkintime'] = $Checkintime;
                    //$data_response['Checkouttime'] = $Checkouttime;

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_checkinout_listed_successfully');
                    $response['Checkintime'] = $Checkintime;
                    $response['Checkouttime'] = $Checkouttime;
                    $response['data'] = $data_response;
                    $response['rowcount'] = sizeof($_result) - 2; //(int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['Checkintime'] = $Checkintime;
                    $response['Checkouttime'] = $Checkouttime;
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addCheckOUT($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->CheckincheckoutID)  || $data->CheckincheckoutID == '') {
                $response['error'] = 102;
                $response['message'] = 'CheckincheckoutID not found';
            } else if (!isset($data->Checkouttime)  || $data->Checkouttime == '') {
                $response['error'] = 102;
                $response['message'] = 'Checkouttime not found';
            } else if (!isset($data->Outlatitude)  || $data->Outlatitude == '') {
                $response['error'] = 102;
                $response['message'] = 'Outlatitude not found';
            } else if (!isset($data->Outlongitude)  || $data->Outlongitude == '') {
                $response['error'] = 102;
                $response['message'] = 'Outlongitude not found';
            } else {
                $IP = GetIP();
                $_result = $this->master_model->getQueryResult("call usp_A_AddCheckout('" .
                    $data->Checkouttime . "','" .
                    $data->UserID . "','1','" .
                    $data->CheckincheckoutID . "','Android','" .
                    $IP . "','" .
                    $data->Outlatitude . "','" .
                    $data->Outlongitude . "','" .
                    $data->OutAddress . "'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_checkout_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addCheckIN($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->Checkintime)  || $data->Checkintime == '') {
                $response['error'] = 102;
                $response['message'] = 'Checkintime not found';
            } else if (!isset($data->Inlatitude)  || $data->Inlatitude == '') {
                $response['error'] = 102;
                $response['message'] = 'Inlatitude not found';
            } else if (!isset($data->Inlongitude)  || $data->Inlongitude == '') {
                $response['error'] = 102;
                $response['message'] = 'Inlongitude not found';
            } else {
                $IP = GetIP();
                $_result = $this->master_model->getQueryResult("call usp_A_AddCheckin('" .
                    $data->UserID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->Checkintime . "','" .
                    $data->Inlatitude . "','" .
                    $data->Inlongitude . "','" .
                    $data->InAddress . "'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_checkin_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function editCustomerSitesDocument($data = array())
    {

        $response           = $_result              = $result           = array();
        $CustomerSitesDocumentID   = $data['CustomerSitesDocumentID'];
        $UserID    = $data['UserID'];
        $Title    = $data['Title'];

        if (!isset($UserID) || $UserID == '') {
            $response['Error']      = 102;
            $response['Message']    = label('api_msg_user_not_found');
        } else {

            if (@$_FILES['ImageData']['error'] == 0 && !empty($_FILES['ImageData'])) {

                $pathMain       = DOCUMENT_UPLOAD_PATH;
                $path           = DOCUMENT_UPLOAD_PATH;
                $max_size       = DOCUMENT_MAX_SIZE;
                $allowed_types  = DOCUMENT_ALLOWED_TYPES;

                $imageNameTime = time();
                $file_name = $imageNameTime . "_" . $data['UserID'];
                $CV_real_name = @$_FILES['ImageData']['name'];

                $uploadFile = 'ImageData';
                $result = array();
                $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                if (isset($result['error']) && @$result['error'] != '') {
                    $result['error'] = str_replace('<p>', '', $result['error']);
                    $result['error'] = str_replace('</p>', '', $result['error']);
                }

                if ($result['status'] == 1) {
                    $uploadedFileName = $result['upload_data']['file_name'];
                }

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_EditCustomerSitesDocument(
                        '" . $data['Title'] . "',
                        '" . $data['UserID'] . "','1',
                        '" . $data['CustomerSitesDocumentID'] . "','Android',
                        '" . $IP . "',
                        '" . $uploadedFileName . "'
                    )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_document_update_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    //$response['data'] = array();
                    $response['data'] = json_decode("{}");
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            } else {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_error_occurred');
            }
        }

        return $response;
    }

    function removeCustomerSitesDocument($data)
    {
        try {
            $response = array();

            if (!isset($data->CustomerSitesDocumentID)  || $data->CustomerSitesDocumentID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerSitesDocumentID not found';
            } else if (!isset($data->UserID) || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_ChangeStatus('
                            ss_customersitesdocument','
                            CustomerSitesDocumentID','" .
                    $data->CustomerSitesDocumentID . "','0','" .
                    $data->UserID . "'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_document_remove_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getCustomerSitesDocument($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetCustomerSitesDocument('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->SitesID . "','1','" .
                    $data->CustomerID . "'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_document_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addCustomerSitesDocument($data = array())
    {

        $response           = $_result              = $result           = array();
        $SitesID   = $data['SitesID'];
        $UserID    = $data['UserID'];
        $Title    = $data['Title'];

        if (!isset($UserID) || $UserID == '') {
            $response['Error']      = 102;
            $response['Message']    = label('api_msg_user_not_found');
        } else {

            if (@$_FILES['ImageData']['error'] == 0 && !empty($_FILES['ImageData'])) {

                $pathMain       = DOCUMENT_UPLOAD_PATH;
                $path           = DOCUMENT_UPLOAD_PATH;
                $max_size       = DOCUMENT_MAX_SIZE;
                $allowed_types  = DOCUMENT_ALLOWED_TYPES;

                $imageNameTime = time();
                $file_name = $imageNameTime . "_" . $data['UserID'];
                $CV_real_name = @$_FILES['ImageData']['name'];

                $uploadFile = 'ImageData';
                $result = array();
                $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                if (isset($result['error']) && @$result['error'] != '') {
                    $result['error'] = str_replace('<p>', '', $result['error']);
                    $result['error'] = str_replace('</p>', '', $result['error']);
                }
                $uploadedFileName = '';
                if ($result['status'] == 1) {
                    $uploadedFileName = $result['upload_data']['file_name'];
                }
                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_AddCustomerSitesDocument(
                        '" . $data['SitesID'] . "',
                        '" . $data['UserID'] . "','1','Android',
                        '" . $IP . "',
                        '" . $data['Title'] . "',
                        '" . $uploadedFileName . "'
                    )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_document_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    //$response['data'] = array();
                    $response['data'] = json_decode("{}");
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            } else {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_error_occurred');
            }
        }

        return $response;
    }


    function getPenalty($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else {
                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $_result = $this->master_model->getQueryResult("call usp_A_GetPenalty('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','1', '" .
                    $CityID . "'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    foreach ($_result as $key => $value) {
                        $_result[$key]->Item = $this->master_model->getQueryResult("call usp_A_GetPenaltyEmployeeByID('" . $value->PenaltyID . "')");

                        if (isset($_result[$key]->Item) && !empty($_result[$key]->Item) && !isset($_result[$key]->Item['0']->Message)) {
                        } else {
                            $_result[$key]->Item = array();
                        }
                    }

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_penalty_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addPenalty($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } elseif (!isset($data->PenaltyDate)  || $data->PenaltyDate == '') {
                $response['error'] = 102;
                $response['message'] = 'Penalty Date not found';
            } elseif (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } elseif (!isset($data->Reason)  || $data->Reason == '') {
                $response['error'] = 102;
                $response['message'] = 'Reason not found';
            } else {

                $IP = GetIP();


                $_result = $this->master_model->getQueryResult("call usp_A_AddPenalty('" .
                    $data->PenaltyDate . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->SitesID . "','" .
                    $data->Reason . "'
                            )");


                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    foreach ($data->Item as $key => $value) {

                        $_resultitem = $this->master_model->getQueryResult("call usp_A_AddPenaltyitem('" .
                            $_result['0']->ID . "','" .
                            $data->UserID . "','1','Android','" .
                            $IP . "','" .
                            $value->EmployeeID . "','" .
                            $value->Penalty . "'
                            )");
                    }

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_penalty_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getDashboardFollowup($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->UserID) || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->FilterType)  || $data->FilterType == '') {
                $response['error'] = 102;
                $response['message'] = 'FilterType not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_MA_DashboardVisitorFollowUpReport('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->FilterType . "','" .
                    $data->UserID . "'
                )");

                if (isset($_result) && !empty($_result) && isset($_result['0']->VisitorReminderID)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_data_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 101;
                    $response['message'] = label('data_not_found');
                    $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getDashboardLead($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->UserID) || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->FilterType)  || $data->FilterType == '') {
                $response['error'] = 102;
                $response['message'] = 'FilterType not found';
            } else {

                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $UserID = "-1"; //isset($data->UserID) ? $data->UserID :'-1';
                $_result = $this->master_model->getQueryResult("call usp_MA_DashboardVisitorReport('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->FilterType . "','" .
                    $UserID . "','" .
                    $CityID . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_data_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 101;
                    $response['message'] = label('data_not_found');
                    $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getDashboard($data)
    {
        try {
            $response = array();

            if (!isset($data->FilterType)  || $data->FilterType == '') {
                $response['error'] = 102;
                $response['message'] = 'FilterType not found';
            } else if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else {

                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $UserID = "-1"; //isset($data->UserID) ? $data->UserID :'-1';
                $sql = "call usp_MA_Dashboard('Web','" .
                    $data->FilterType . "','" .
                    $UserID . "','" .
                    $CityID . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                $response['data'] = array();
                $i = 0;
                foreach ($_result['0'] as $key => $value) {
                    $title = trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', $key));

                    $response['data'][$title] = array('Title' => $title, 'Count' => $value);
                    $i++;
                }

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_dashboard_listed_successfully');
                    //$response['data'] = $test;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 101;
                    $response['message'] = label('data_not_found');
                    $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addInspectionImage($data = array())
    {

        $response           = $_result              = $result           = array();

        if (!isset($data['InspectionID'])  || $data['InspectionID'] == '') {
            $response['error'] = 102;
            $response['message'] = 'InspectionID not found';
        } else {

            if (@$_FILES['ImageData']['error'] == 0 && !empty($_FILES['ImageData'])) {

                $pathMain       = INSPECTION_UPLOAD_PATH;
                $path           = INSPECTION_UPLOAD_PATH;
                $max_size       = INSPECTION_MAX_SIZE;
                $allowed_types  = INSPECTION_ALLOWED_TYPES;

                $imageNameTime = time();
                $file_name = $imageNameTime . "_" . $data['InspectionID'];
                $CV_real_name = @$_FILES['ImageData']['name'];

                $uploadFile = 'ImageData';
                $result = array();
                $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                if (isset($result['error']) && @$result['error'] != '') {
                    $result['error'] = str_replace('<p>', '', $result['error']);
                    $result['error'] = str_replace('</p>', '', $result['error']);
                }

                if ($result['status'] == 1) {
                    $uploadedFileName = $result['upload_data']['file_name'];
                }

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_inspectionimage('" .
                    $data['InspectionID'] . "','" .
                    $uploadedFileName . "'
                    )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_image_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            } else {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_error_occurred');
            }
        }
        return $response;
    }

    function getUserByUserType($data)
    {
        try {
            $response = array();

            if (!isset($data->UserType)  || $data->UserType == '') {
                $response['error'] = 102;
                $response['message'] = 'UserType not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_GetUser_ComboBox('" .
                    $data->UserType . "'
                        )");

                if (isset($_result['0']->UserID)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_user_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 101;
                    $response['message'] = label('data_not_found');
                    $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addInspection($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else {

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_AddInspection('" .
                    $data->UserID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->SitesID . "','" .
                    $data->FieldOperatorID . "','" .
                    $data->QualityManagerID . "','" .
                    $data->OperationManagerID . "','" .
                    $data->Remarks . "',''
                )");


                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    foreach ($data->Item as $key => $value) {

                        $_resultitem = $this->master_model->getQueryResult("call usp_A_AddInspectionAnswer('" .
                            $_result['0']->ID . "','" .
                            $data->UserID . "','1','Android','" .
                            $IP . "','" .
                            $value->QuestionID . "','" .
                            $value->Answer . "')");
                    }

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_inspection_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getInspection($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->UserID) || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else {

                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $_result = $this->master_model->getQueryResult("call usp_A_GetInspection('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->UserID . "','1','" .
                    $CityID . "'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    foreach ($_result as $key => $value) {
                        $_result[$key]->Item = $this->master_model->getQueryResult("call usp_A_GetInspectionAnswer('-1','1','" . $value->InspectionID . "')");

                        if (isset($_result[$key]->Item) && !empty($_result[$key]->Item) && !isset($_result[$key]->Item['0']->Message)) {
                        } else {
                            $_result[$key]->Item = array();
                        }
                    }

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_inspection_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }


    function addTicket($data = array())
    {

        $response           = $_result              = $result           = array();

        if (!isset($data['UserID'])  || $data['UserID'] == '') {
            $response['error'] = 102;
            $response['message'] = 'UserID not found';
        } else if (!isset($data['Title'])  || $data['Title'] == '') {
            $response['error'] = 102;
            $response['message'] = 'Title not found';
        } else if (!isset($data['Description'])  || $data['Description'] == '') {
            $response['error'] = 102;
            $response['message'] = 'Description not found';
        } else if (!isset($data['Priority'])  || $data['Priority'] == '') {
            $response['error'] = 102;
            $response['message'] = 'Priority not found';
        } else {

            if (1) {

                $pathMain       = TICKET_UPLOAD_PATH;
                $path           = TICKET_UPLOAD_PATH;
                $max_size       = TICKET_MAX_SIZE;
                $allowed_types  = TICKET_ALLOWED_TYPES;

                $imageNameTime = time();
                $file_name = $imageNameTime . "_" . $data['UserID'];
                $CV_real_name = @$_FILES['ImageData']['name'];

                $uploadFile = 'ImageData';
                $result = array();
                $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                if (isset($result['error']) && @$result['error'] != '') {
                    $result['error'] = str_replace('<p>', '', $result['error']);
                    $result['error'] = str_replace('</p>', '', $result['error']);
                }

                if ($result['status'] == 1) {
                    $uploadedFileName = $result['upload_data']['file_name'];
                } else {
                    $uploadedFileName = '';
                }

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_AddTicket('" .
                    $data['UserID'] . "','" .
                    $data['UserID'] . "','1','Android','" .
                    $IP . "','" .
                    $data['Title'] . "','" .
                    $data['Description'] . "','" .
                    $data['Priority'] . "','" .
                    $uploadedFileName . "','" .
                    $data['SubjectID'] . "','" .
                    $data['CityID'] . "'
                    )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_ticket_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            } else {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_error_occurred');
            }
        }

        return $response;
    }

    function getTicket($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->UserID) || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else {
                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $_result = $this->master_model->getQueryResult("call usp_A_GetTicket('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->UserID . "','1','" .
                    $data->Name . "','" .
                    $CityID . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_ticket_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getSalary($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetSalary('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->UserID . "','1'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_attendance_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addSalary($data)
    {
        try {
            $response = array();

            if (!isset($data->SalaryDate)  || $data->SalaryDate == '') {
                $response['error'] = 102;
                $response['message'] = 'SalaryDate not found';
            } else if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->StartDate)  || $data->StartDate == '') {
                $response['error'] = 102;
                $response['message'] = 'StartDate not found';
            } else if (!isset($data->EmployeeID)  || $data->EmployeeID == '') {
                $response['error'] = 102;
                $response['message'] = 'EmployeeID not found';
            } else {

                $IP = GetIP();

                $CurrentDate = date('Y-m-d');

                $_result = $this->master_model->getQueryResult("call usp_A_AddSalary('" .
                    $data->EmployeeID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $CurrentDate . "','" .
                    $data->StartDate . "','" .
                    $data->EndDate . "','" .
                    $data->Present . "','" .
                    $data->Absent . "','" .
                    $data->HalfDay . "','" .
                    $data->HalfOverTime . "','" .
                    $data->FullOverTime . "','" .
                    $data->Rate . "','" .
                    $data->Penalty . "','" .
                    $data->PayAmount . "'
                )");

                if ($data->Type != 'None') {
                    $this->master_model->getQueryResult("call usp_A_AddAdvance('" .
                        $data->EmployeeID . "','" .
                        $data->UserID . "','1','Android','" .
                        $IP . "','" .
                        $data->Amount . "','" .
                        $CurrentDate . "','" .
                        $data->Type . "'
                    )");
                }

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_salary_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getSalaryUserData($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->StartDate)  || $data->StartDate == '') {
                $response['error'] = 102;
                $response['message'] = 'StartDate not found';
            } else if (!isset($data->EndDate)  || $data->EndDate == '') {
                $response['error'] = 102;
                $response['message'] = 'EndDate not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetEmployeeAttendanceByFromToDateByUserID('" .
                    $data->StartDate . "','" .
                    $data->EndDate . "','" .
                    $data->UserID . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    if ($_result[0]->Advance < 0) {
                        $_result[0]->Advance = $_result[0]->Advance * -1;
                        $_result[0]->AdvanceType = "Employee Credit";
                    } else {
                        $_result[0]->AdvanceType = "Employee Debit";
                    }
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_data_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getInvoiceAttendance($data)
    {
        try {
            $response = array();

            if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else if (!isset($data->StartDate)  || $data->StartDate == '') {
                $response['error'] = 102;
                $response['message'] = 'StartDate not found';
            } else if (!isset($data->EndDate)  || $data->EndDate == '') {
                $response['error'] = 102;
                $response['message'] = 'EndDate not found';
            } else {
                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $sql = "call usp_A_GetInvoiceAttendanceWithMaterial('" .
                    $data->QuotationID . "','" .
                    $data->StartDate . "','" .
                    $data->EndDate . "','" .
                    $CityID . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                $data = array();
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    foreach ($_result as $item) {
                        if ($item->IsMaterial) {
                            $data['material'][] = $item;
                        } else {
                            $data['user'][] = $item;
                        }
                    }
                }

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_invoiceitem_listed_successfully');
                    $response['data'] = $data;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getEmployeeAttendance($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetEmployeeAttendance('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->UserID . "','1'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_attendance_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getAttendanceMenu($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->StartDate)  || $data->StartDate == '') {
                $response['error'] = 102;
                $response['message'] = 'StartDate not found';
            } else if (!isset($data->EndDate)  || $data->EndDate == '') {
                $response['error'] = 102;
                $response['message'] = 'EndDate not found';
            } else {

                $SitesID = isset($data->SiteID) ? $data->SiteID : "-1";
                $CityID = isset($data->CityID) ? $data->CityID : "-1";
                $_result = $this->master_model->getQueryResult("call usp_A_GetEmployeeAttendanceByFromToDate('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->StartDate . "','" .
                    $data->EndDate . "','" .
                    $SitesID . "','" .
                    $CityID . "'
                        )");


                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_attendance_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getVisitorReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetVisitorReminder('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->VisitorID . "','1'
                        )");

                if (isset($_result) && !empty($_result) && isset($_result['0']->VisitorReminderID)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_visitorremindar_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addAttendance($data)
    {
        try {
            $response = array();

            if (!isset($data->AttendanceDate)  || $data->AttendanceDate == '') {
                $response['error'] = 102;
                $response['message'] = 'AttendanceDate not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else {

                $IP = GetIP();

                if ($data->SitesID == "0") {
                    $data->SitesID = 2;
                }
                foreach ($data->Item as $key => $value) {
                    $_result = $this->master_model->getQueryResult("call usp_A_AddEmployeeAttendance('" .
                        $value->EmployeeID . "','" .
                        $data->UserID . "','1','Android','" .
                        $IP . "','" .
                        $data->AttendanceDate . "','" .
                        $value->Attendance . "','" .
                        $data->SitesID . "','" .
                        $data->QuotationID . "','" .
                        $value->Overtime . "'
                    )");
                }

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_employee_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getaddAttendaneEmployee($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetTeamDefinitionByDate('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->SitesID . "','1','" .
                    $data->QuotationID . "','" .
                    $data->CustomerID . "','" .
                    $data->AttendanceDate . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_employee_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addTeamDefination($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->VisitorID)) {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->ServiceID)) {
                $response['error'] = 102;
                $response['message'] = 'ServiceID not found';
            } else if (!isset($data->StartDate)) {
                $response['error'] = 102;
                $response['message'] = 'StartDate not found';
            } else if (!isset($data->EndDate)) {
                $response['error'] = 102;
                $response['message'] = 'EndDate not found';
            } else if (!isset($data->ActiveStatus)) {
                $response['error'] = 102;
                $response['message'] = 'ActiveStatus not found';
            } else if (!isset($data->ChallanID)) {
                $response['error'] = 102;
                $response['message'] = 'ChallanID not found';
            } else if (!isset($data->TimeSlot)) {
                $response['error'] = 102;
                $response['message'] = 'TimeSlot not found';
            } else if (!isset($data->ChallanID)) {
                $response['error'] = 102;
                $response['message'] = 'ChallanID not found';
            } else if (!isset($data->Remark)) {
                $response['error'] = 102;
                $response['message'] = 'Remark not found';
            } /* else if (!isset($data->AppointmentType) || $data->AppointmentType == '') {
                $response['error'] = 102;
                $response['message'] = 'AppointmentType not found';
            }  */ else {

                $IP = GetIP();

                $times = explode('-', $data->TimeSlot);
                $StartTime = $times[0];
                $EndTime = $times[1];
                $AppointmentStatus = "Assigned";
                $Reason = '';

                $ChallanID = isset($data->ChallanID) ? $data->ChallanID : "0";
                $AppointmentID = isset($data->AppointmentID) ? $data->AppointmentID : 0;
                $AppointmentType = isset($data->AppointmentType) ? $data->AppointmentType : "Installation";
                if ($AppointmentID == 0) {
                    $sql = "call usp_A_AddAppointment('" .
                        $data->UserID . "','1','Android','" . $IP . "','" .
                        $data->VisitorID . "','" .
                        $data->ServiceID . "','" .
                        $data->SitesID . "','" .
                        $AppointmentStatus . "','" .
                        $data->StartDate . "','" .
                        $StartTime . "','" .
                        $Reason . "','" .
                        $data->EndDate . "','" .
                        $EndTime . "','" .
                        $data->ActiveStatus . "','" .
                        $ChallanID . "','" .
                        $data->Remark . "','" .
                        $AppointmentType . "'
                    )";
                    $_result = $this->master_model->getQueryResult($sql);
                    if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                        $AppointmentID = isset($_result['0']->ID) ? $_result['0']->ID : "0";
                        foreach ($data->UserList as $key => $value) {
                            $_result = $this->master_model->getQueryResult("call usp_A_AddTeamdefination('" .
                                $value->EmployeeID . "','" .
                                $data->UserID . "','1','Android','" .
                                $IP . "','" .
                                $data->SitesID . "','" .
                                $data->QuotationID . "','" .
                                $ChallanID . "','" .
                                $AppointmentID . "','" .
                                $data->StartDate . "','" .
                                $StartTime . "','" .
                                $data->EndDate . "','" .
                                $EndTime . "','" .
                                $data->Type . "'
                            )");
                        }
                    }
                } else {
                    $AppointmentStatus = "Assigned";
                    $sql = "call usp_A_AppointmentStatusChange('" .
                        $data->UserID . "','1',
                        $AppointmentID,'Android','" .
                        $IP . "','" .
                        $AppointmentStatus . "','" .
                        $Reason . "'
                    )";
                    $_result = $this->master_model->getQueryResult($sql);
                    foreach ($data->UserList as $key => $value) {
                        $_result = $this->master_model->getQueryResult("call usp_A_AddTeamdefination('" .
                            $value->EmployeeID . "','" .
                            $data->UserID . "','1','Android','" .
                            $IP . "','" .
                            $data->SitesID . "','" .
                            $data->QuotationID . "','" .
                            $ChallanID . "','" .
                            $AppointmentID . "','" .
                            $data->StartDate . "','" .
                            $StartTime . "','" .
                            $data->EndDate . "','" .
                            $EndTime . "','" .
                            $data->Type . "'
                        )");
                    }
                }
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_teamdefination_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function editTeamDefination($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->VisitorID)) {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->ServiceID)) {
                $response['error'] = 102;
                $response['message'] = 'ServiceID not found';
            } else if (!isset($data->StartDate)) {
                $response['error'] = 102;
                $response['message'] = 'StartDate not found';
            } else if (!isset($data->EndDate)) {
                $response['error'] = 102;
                $response['message'] = 'EndDate not found';
            } else if (!isset($data->ActiveStatus)) {
                $response['error'] = 102;
                $response['message'] = 'ActiveStatus not found';
            } else if (!isset($data->ChallanID)) {
                $response['error'] = 102;
                $response['message'] = 'ChallanID not found';
            } else if (!isset($data->TimeSlot)) {
                $response['error'] = 102;
                $response['message'] = 'TimeSlot not found';
            } else if (!isset($data->TimeSlot)) {
                $response['error'] = 102;
                $response['message'] = 'TimeSlot not found';
            } else if (!isset($data->Reason)) {
                $response['error'] = 102;
                $response['message'] = 'Reason not found';
            } else if (!isset($data->Remark)) {
                $response['error'] = 102;
                $response['message'] = 'Remark not found';
            } else {

                $IP = GetIP();

                $times = explode('-', $data->TimeSlot);
                $StartTime = $times[0];
                $EndTime = $times[1];
                $AppointmentStatus = "Assigned";

                $sql = "call usp_A_RescheduleAppointment('" .
                    $data->UserID . "','1','Android','" . $IP . "','" .
                    $data->AppointmentID . "','" .
                    $data->Reason . "','" .
                    $AppointmentStatus . "','" .
                    $data->StartDate . "','" .
                    $StartTime . "','" .
                    $data->EndDate . "','" .
                    $EndTime . "','" .
                    $data->Remark . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $ChallanID = isset($data->ChallanID) ? $data->ChallanID : "0";
                    $AppointmentID = isset($_result['0']->ID) ? $_result['0']->ID : "0";

                    $_result = $this->master_model->getQueryResult("call usp_A_EditTeamDefinationStatus('" .
                        $data->UserID . "','0','Android','" . $IP . "','" .
                        $AppointmentID . "'
                    )");

                    foreach ($data->UserList as $key => $value) {
                        $_result = $this->master_model->getQueryResult("call usp_A_AddTeamdefination('" .
                            $value->EmployeeID . "','" .
                            $data->UserID . "','1','Android','" .
                            $IP . "','" .
                            $data->SitesID . "','" .
                            $data->QuotationID . "','" .
                            $ChallanID . "','" .
                            $AppointmentID . "','" .
                            $data->StartDate . "','" .
                            $StartTime . "','" .
                            $data->EndDate . "','" .
                            $EndTime . "','" .
                            $data->Type . "'
                        )");
                    }

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_teamdefination_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }


    function getAvailableEmployee($data)
    {
        try {
            $response = array();

            if (!isset($data->StartDate)  || $data->StartDate == '') {
                $response['error'] = 102;
                $response['message'] = 'StartDate not found';
            } else if (!isset($data->EndDate)  || $data->EndDate == '') {
                $response['error'] = 102;
                $response['message'] = 'EndDate not found';
            } else if (!isset($data->Type)  || $data->Type == '') {
                $response['error'] = 102;
                $response['message'] = 'Type not found';
            } else {

                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                if ($data->Type == 'Shuffle') {
                    $_result = $this->master_model->getQueryResult("call usp_GetEmployee(-1,1,'','','-1','-1','-1')");
                } else {
                    $_result = $this->master_model->getQueryResult("call usp_A_GetEmployeeByAvailable('-1','1','" .
                        $data->StartDate . "','" .
                        $data->EndDate . "','" .
                        $CityID . "'
                    )");
                }

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_employee_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getAttendance($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetAttendanceByAttendance('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->SitesID . "','1','" .
                    $data->QuotationID . "','" .
                    $data->CustomerID . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_attendance_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }


    function getTeamDefination($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else if (!isset($data->ChallanID)  || $data->ChallanID == '') {
                $response['error'] = 102;
                $response['message'] = 'ChallanID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetTeamDefinition('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->SitesID . "','1','" .
                    $data->QuotationID . "','" .
                    $data->CustomerID . "','" .
                    $data->ChallanID . "','" .
                    -1 . "'
                )");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $name = "";
                    foreach ($_result as $key => $item) {
                        if ($key == 0)
                            $name .= $item->EmployeeName;
                        else {
                            $name .= ", " . $item->EmployeeName;
                            unset($_result[$key]);
                        }
                    }
                    $name = str_replace('START, ', '', $name);
                    $_result[0]->EmployeeName = $name;
                    //pr($_result[0]->EmployeeName);
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_teamdefination_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addPayment($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->InvoiceID)  || $data->InvoiceID == '') {
                $response['error'] = 102;
                $response['message'] = 'InvoiceID not found';
            } else {

                $IP = GetIP();

                $sql = "call usp_A_AddCustomerPayment('" .
                    $data->InvoiceID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    @$data->PaymentAmount . "','" .
                    @$data->GSTAmount . "','" .
                    @$data->AmountType . "','" .
                    @$data->PaymentDate . "','" .
                    @$data->PaymentMode . "','" .
                    @$data->ChequeNo . "','" .
                    @$data->IFCCode . "','" .
                    @$data->AccountNo . "','" .
                    @$data->HolderName . "','" .
                    @$data->BankName . "','" .
                    @$data->BranchName . "','" .
                    @$data->Remark . "','" .
                    @$data->AppointmentID . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $device = $this->getDeviceData($data->UserID);
                    $employee = $this->getEmployeeData($data->UserID);
                    if (@$device != "") {
                        $notif_text = $this->getPaymentMessage($_result[0]->ID, $data->UserID);
                        $pushNotificationArr = array(
                            'device_id' => $device,
                            'message' => $notif_text,
                            'title' => label('api_msg_notification_addpayment_title'),
                            'event' => NOTIFICATION_ADDPAYMENT,
                            'ActionType' => '',
                            'detail' => ''
                        );
                        $res = sendPushNotification($pushNotificationArr);
                    }
                    $response['error'] = 200;
                    $response['message'] = $notif_text; //label('api_msg_payment_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getPayment($data)
    {
        try {
            $response = array();
            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->InvoiceID)  || $data->InvoiceID == '') {
                $response['error'] = 102;
                $response['message'] = 'InvoiceID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->StartDate)) {
                $response['error'] = 102;
                $response['message'] = 'Start Date not found';
            } else if (!isset($data->EndDate)) {
                $response['error'] = 102;
                $response['message'] = 'End Date not found';
            } else if (!isset($data->InvoiceNumber)) {
                $response['error'] = 102;
                $response['message'] = 'InvoiceNumber not found';
            } else if (!isset($data->SiteName)) {
                $response['error'] = 102;
                $response['message'] = 'Site Name not found';
            } else if (!isset($data->AppointmentID)) {
                $response['error'] = 102;
                $response['message'] = 'AppointmentID not found';
            } else {

                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $AppointmentID = isset($data->AppointmentID) ? $data->AppointmentID : '-1';
                $sql = "call usp_A_GetPayment('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->InvoiceID . "','1','" .
                    $data->CustomerID . "','" .
                    $data->StartDate . "','" .
                    $data->EndDate . "','" .
                    $data->InvoiceNumber . "','" .
                    $data->SiteName . "','" .
                    $CityID . "','" .
                    $AppointmentID . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    for ($i = 0; $i < sizeof($_result); $i++) {
                        if ($_result[$i]->AmountType == 0) {
                            $_result[$i]->AmountType = "Including GST";
                        } else if ($_result[$i]->AmountType == 1) {
                            $_result[$i]->AmountType = "Excluding GST";
                        } else if ($_result[$i]->AmountType == 2) {
                            $_result[$i]->AmountType = "Only GST";
                        } else {
                            $_result[$i]->AmountType = "None";
                        }
                    }
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_payment_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getInvoice($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->FilterStatus)) {
                $response['error'] = 102;
                $response['message'] = 'Filter Status not found';
            } else {

                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $AppointmentID = isset($data->AppointmentID) ? $data->AppointmentID : '-1';
                $sql = "call usp_A_GetInvoiceByPaid('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->SitesID . "','1','" .
                    $data->QuotationID . "','" .
                    $data->CustomerID . "','" .
                    $data->FilterStatus . "','" .
                    $CityID . "','" .
                    $AppointmentID . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_invoice_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addInvoice($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->CustomerID)) {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->CompanyID)  || $data->CompanyID == '') {
                $response['error'] = 102;
                $response['message'] = 'CompanyID not found';
            } else {

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_AddInvoice('" .
                    $data->CustomerID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->CompanyID . "','" .
                    $data->SitesID . "','" .
                    $data->QuotationID . "','" .
                    $data->StartDate . "','" .
                    $data->EndDate . "','" .
                    $data->TotalAmount . "','" .
                    $data->CGST . "','" .
                    $data->SGST . "','" .
                    $data->IGST . "','" .
                    str_replace('\n', '', $this->db->escape_str(nl2br($data->Notes))) . "','" .
                    str_replace('\n', '', $this->db->escape_str(nl2br($data->Terms))) . "','" .
                    $data->InvoiceDate . "','" .
                    $data->SubTotal . "','" .
                    '0' . "','" .
                    @$data->CurrentLocation . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $device = $this->getDeviceData($data->UserID);
                    $employee = $this->getEmployeeData($data->UserID);
                    if (@$device != "") {
                        $notif_text = $this->getInvoiceMessage($_result[0]->ID, $data->UserID);
                        $pushNotificationArr = array(
                            'device_id' => $device,
                            'message' => $notif_text,
                            'title' => label('api_msg_notification_addinvoice_title'),
                            'event' => NOTIFICATION_ADDINVOICE,
                            'ActionType' => '',
                            'detail' => ''
                        );
                        $res = sendPushNotification($pushNotificationArr);
                    }
                    $this->load->model('admin/config_model');
                    $this->configdata = $this->config_model->getConfig();

                    foreach ($data->Item as $key => $value) {
                        $sql = "call usp_A_AddInvoiceItem('" .
                            $_result['0']->ID . "','" .
                            $data->UserID . "','1','Android','" .
                            $IP . "','" .
                            $value->MaterialID . "','" .
                            $value->ProductID . "','" .
                            $value->Qty . "','" .
                            $value->Rate . "','" .
                            $value->Qty * $value->Rate . "','" .
                            '' . "','" .
                            @$value->UOM . "'
                        )";
                        $res_item = $this->master_model->getQueryResult($sql);
                    }

                    $this->InvoicePrintReceipt($_result['0']->ID);

                    $id = $_result[0]->ID;
                    $visitor_id = $data->VisitorID;
                    $_result_invoice = $this->master_model->getQueryResult("call usp_A_GetInvoiceByID('" .
                        $id . "'
                    )");
                    if (isset($_result_invoice) && !empty($_result_invoice) && !isset($_result_invoice['0']->Message)) {
                        $_result_site = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                            $_result_invoice[0]->SitesID . "'
                        )");
                        if (isset($_result_site) && !empty($_result_site) && !isset($_result_site['0']->Message)) {
                            $name = $_result_site[0]->Name;
                            $service_name = $_result_site[0]->ServiceName;
                            $InvoiceNo = $_result_invoice[0]->InvoiceNo;
                            $date = $_result_invoice[0]->InvoiceDate;
                            $amount = $_result_invoice[0]->TotalAmount;

                            // $msg = "Dear ".$name."\nEstimation No: ".$estimation_no."\nDate:".$date."\nAmount: Rs. ".$amount."\nJust to accept this, pass this OTP:".$otp." to engineers.\nHH Enterprise";
                            $Content = $this->master_model->get_smstemplate(4);

                            $msg = str_replace(
                                array('{name}', '{service_name}', '{invoice_no}', '{invoice_date}', '{amount}'),
                                array($name, $service_name, $InvoiceNo, $date, $amount),
                                $Content['SmsMessage']
                            );

                            $response['error'] = 200;
                            $response['message'] = $msg;
                            $response['data'] = $_result;
                        } else if (isset($_result_site['0']->Message) && $_result_site['0']->Message != "") {
                            $msg = explode('~', $_result[0]->Message);
                            $response['error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['message'] = $msg[1];
                            $response['data'] = array();
                        } else {
                            $response['error'] = 104;
                            $response['message'] = label('api_msg_error_occurred');
                        }
                    }

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_invoice_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addInstallationInvoice($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->CustomerID)) {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else if (!isset($data->StartDate)  || $data->StartDate == '') {
                $response['error'] = 102;
                $response['message'] = 'StartDate not found';
            } else if (!isset($data->EndDate)  || $data->EndDate == '') {
                $response['error'] = 102;
                $response['message'] = 'EndDate not found';
            } else if (!isset($data->TotalAmount)  || $data->TotalAmount == '') {
                $response['error'] = 102;
                $response['message'] = 'TotalAmount not found';
            } else if (!isset($data->CGST)  || $data->CGST == '') {
                $response['error'] = 102;
                $response['message'] = 'CGST not found';
            } else if (!isset($data->SGST)  || $data->SGST == '') {
                $response['error'] = 102;
                $response['message'] = 'SGST not found';
            } else if (!isset($data->IGST)  || $data->IGST == '') {
                $response['error'] = 102;
                $response['message'] = 'IGST not found';
            } else if (!isset($data->Notes)  || $data->Notes == '') {
                $response['error'] = 102;
                $response['message'] = 'Notes not found';
            } else if (!isset($data->Terms)  || $data->Terms == '') {
                $response['error'] = 102;
                $response['message'] = 'Terms not found';
            } else if (!isset($data->InvoiceDate)  || $data->InvoiceDate == '') {
                $response['error'] = 102;
                $response['message'] = 'InvoiceDate not found';
            } else if (!isset($data->SubTotal)  || $data->SubTotal == '') {
                $response['error'] = 102;
                $response['message'] = 'SubTotal not found';
            } else if (!isset($data->AppointmentID)  || $data->AppointmentID == '') {
                $response['error'] = 102;
                $response['message'] = 'AppointmentID not found';
            } else if (!isset($data->CompanyID)  || $data->CompanyID == '') {
                $response['error'] = 102;
                $response['message'] = 'CompanyID not found';
            } else {
                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_AddInvoice('" .
                    $data->CustomerID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->CompanyID . "','" .
                    $data->SitesID . "','" .
                    $data->QuotationID . "','" .
                    $data->StartDate . "','" .
                    $data->EndDate . "','" .
                    $data->TotalAmount . "','" .
                    $data->CGST . "','" .
                    $data->SGST . "','" .
                    $data->IGST . "','" .
                    str_replace('\n', '', $this->db->escape_str(nl2br($data->Notes))) . "','" .
                    str_replace('\n', '', $this->db->escape_str(nl2br($data->Terms))) . "','" .
                    $data->InvoiceDate . "','" .
                    $data->SubTotal . "','" .
                    $data->AppointmentID . "','" .
                    @$data->CurrentLocation . "'
                )");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    $device = $this->getDeviceData($data->UserID);
                    $employee = $this->getEmployeeData($data->UserID);
                    if (@$device != "") {
                        $notif_text = $this->getInvoiceMessage($_result[0]->ID, $data->UserID);
                        $pushNotificationArr = array(
                            'device_id' => $device,
                            'message' => $notif_text,
                            'title' => label('api_msg_notification_addinvoice_title'),
                            'event' => NOTIFICATION_ADDINVOICE,
                            'ActionType' => '',
                            'detail' => ''
                        );
                        $res = sendPushNotification($pushNotificationArr);
                    }
                    $AppointmentID = $data->AppointmentID;
                    $sql = "call usp_A_EditAppointmentStatus(
                        'Completed','1', $AppointmentID,'Android','" . $IP . "'
                    )";
                    $_result_appointment = $this->master_model->getQueryResult($sql);

                    $this->load->model('admin/config_model');
                    $this->configdata = $this->config_model->getConfig();

                    foreach ($data->Item as $key => $value) {
                        $sql = "call usp_A_AddInvoiceItem('" .
                            $_result['0']->ID . "','" .
                            $data->UserID . "','1','Android','" .
                            $IP . "','" .
                            0 . "','" .
                            0 . "','" .
                            $value->Qty . "','" .
                            $value->Rate . "','" .
                            $value->Qty * $value->Rate . "','" .
                            $value->InstallationService . "','" .
                            @$value->UOM . "'
                        )";
                        $res_item = $this->master_model->getQueryResult($sql);
                    }
                    $this->InvoicePrintReceipt($_result['0']->ID);



                    $id = $_result[0]->ID;
                    $visitor_id = $data->VisitorID;
                    $_result_invoice = $this->master_model->getQueryResult("call usp_A_GetInvoiceByID('" .
                        $id . "'
                    )");
                    if (isset($_result_invoice) && !empty($_result_invoice) && !isset($_result_invoice['0']->Message)) {
                        $_result_site = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                            $_result_invoice[0]->SitesID . "'
                        )");
                        if (isset($_result_site) && !empty($_result_site) && !isset($_result_site['0']->Message)) {
                            $name = $_result_site[0]->Name;
                            $service_name = $_result_site[0]->ServiceName;
                            $InvoiceNo = $_result_invoice[0]->InvoiceNo;
                            $date = $_result_invoice[0]->InvoiceDate;
                            $amount = $_result_invoice[0]->TotalAmount;

                            // $msg = "Dear ".$name."\nEstimation No: ".$estimation_no."\nDate:".$date."\nAmount: Rs. ".$amount."\nJust to accept this, pass this OTP:".$otp." to engineers.\nHH Enterprise";
                            $Content = $this->master_model->get_smstemplate(4);

                            $msg = str_replace(
                                array('{name}', '{service_name}', '{invoice_no}', '{invoice_date}', '{amount}'),
                                array($name, $service_name, $InvoiceNo, $date, $amount),
                                $Content['SmsMessage']
                            );

                            $response['error'] = 200;
                            $response['message'] = $notif_text;
                            $response['data'] = $_result_appointment;
                        } else if (isset($_result_site['0']->Message) && $_result_site['0']->Message != "") {
                            $msg = explode('~', $_result[0]->Message);
                            $response['error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['message'] = $msg[1];
                            $response['data'] = array();
                        } else {
                            $response['error'] = 104;
                            $response['message'] = label('api_msg_error_occurred');
                        }
                    }

                    // $response['error'] = 200;
                    // $response['message'] = label('api_msg_invoice_added_successfully');
                    // $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addAMCInvoice($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->CustomerID)) {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else if (!isset($data->TotalAmount)  || $data->TotalAmount == '') {
                $response['error'] = 102;
                $response['message'] = 'TotalAmount not found';
            } else if (!isset($data->CGST)  || $data->CGST == '') {
                $response['error'] = 102;
                $response['message'] = 'CGST not found';
            } else if (!isset($data->SGST)  || $data->SGST == '') {
                $response['error'] = 102;
                $response['message'] = 'SGST not found';
            } else if (!isset($data->IGST)  || $data->IGST == '') {
                $response['error'] = 102;
                $response['message'] = 'IGST not found';
            } else if (!isset($data->Notes)  || $data->Notes == '') {
                $response['error'] = 102;
                $response['message'] = 'Notes not found';
            } else if (!isset($data->Terms)  || $data->Terms == '') {
                $response['error'] = 102;
                $response['message'] = 'Terms not found';
            } else if (!isset($data->InvoiceDate)  || $data->InvoiceDate == '') {
                $response['error'] = 102;
                $response['message'] = 'InvoiceDate not found';
            } else if (!isset($data->SubTotal)  || $data->SubTotal == '') {
                $response['error'] = 102;
                $response['message'] = 'SubTotal not found';
            } else if (!isset($data->CompanyID)  || $data->CompanyID == '') {
                $response['error'] = 102;
                $response['message'] = 'CompanyID not found';
            } else {
                $IP = GetIP();

                $SiteIds = array();
                $StartDates = array();
                $EndDates = array();
                foreach ($data->Item as $key => $value) {
                    $SiteIds[] = $value->SitesID;
                    $StartDates[] = $value->StartDate;
                    //$EndDates[] = $value->EndDate;
                }
                asort($StartDates);
                $Dates = array();
                foreach ($StartDates as $date) {
                    $Dates[] = $date;
                }
                $startdate = isset($Dates[0]) ? $Dates[0] : date('Y-m-d');
                $enddate = isset($Dates[sizeof($Dates) - 1]) ? $Dates[sizeof($Dates) - 1] : date('Y-m-d');
                $SitesID = implode(",", array_unique($SiteIds));
                $AppointmentID = isset($data->AppointmentID) ? $data->AppointmentID : 0;
                $CurrentLocation = isset($data->CurrentLocation) ? $data->CurrentLocation : '';
                $sql = "call usp_A_AddInvoice('" .
                    $data->CustomerID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->CompanyID . "','" .
                    $SitesID . "','" .
                    $data->QuotationID . "','" .
                    $startdate . "','" .
                    $enddate . "','" .
                    $data->TotalAmount . "','" .
                    $data->CGST . "','" .
                    $data->SGST . "','" .
                    $data->IGST . "','" .
                    str_replace('\n', '', $this->db->escape_str(nl2br($data->Notes))) . "','" .
                    str_replace('\n', '', $this->db->escape_str(nl2br($data->Terms))) . "','" .
                    $data->InvoiceDate . "','" .
                    $data->SubTotal . "','" .
                    $AppointmentID . "','" .
                    $CurrentLocation . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    $device = $this->getDeviceData($data->UserID);
                    $employee = $this->getEmployeeData($data->UserID);
                    if (@$device != "") {
                        $notif_text = $this->getInvoiceMessage($_result[0]->ID, $data->UserID);
                        $pushNotificationArr = array(
                            'device_id' => $device,
                            'message' => $notif_text,
                            'title' => label('api_msg_notification_addinvoice_title'),
                            'event' => NOTIFICATION_ADDINVOICE,
                            'ActionType' => '',
                            'detail' => ''
                        );
                        $res = sendPushNotification($pushNotificationArr);
                    }
                    $this->load->model('admin/config_model');
                    $this->configdata = $this->config_model->getConfig();

                    foreach ($data->Item as $key => $value) {
                        $sql = "call usp_A_AddInvoiceItem('" .
                            $_result['0']->ID . "','" .
                            $data->UserID . "','1','Android','" .
                            $IP . "','" .
                            0 . "','" .
                            0 . "','" .
                            1 . "','" .
                            $value->Rate . "','" .
                            $value->Rate . "','" .
                            @$value->InstallationService . "','" .
                            @$value->UOM . "','" .
                            @$value->Services . "','" .
                            @$value->StartDate . "'
                        )";
                        $res_item = $this->master_model->getQueryResult($sql);

                        $service_days = floor(365 / $value->Services);
                        $date = date('Y-m-d');
                        for ($i = 0; $i < $value->Services; $i++) {
                            $date = date('Y-m-d', strtotime($date . ' + ' . $service_days . ' days'));
                            $ServiceStatus = "Pending";
                            $ServiceType = "AMC";
                            $sql = "call usp_A_AddproductService('" .
                                $data->UserID . "','1','Android','" . $IP . "','" .
                                $value->ChallanItemID . "','" .
                                $value->InstallationID . "','" .
                                $date . "','" .
                                $ServiceStatus . "','" .
                                $ServiceType . "'
                            )";
                            $res_product_service = $this->master_model->getQueryResult($sql);
                        }
                    }
                    $this->AMCInvoicePrintReceipt($_result['0']->ID);

                    $id = $_result[0]->ID;
                    $visitor_id = $data->VisitorID;
                    $_result_invoice = $this->master_model->getQueryResult("call usp_A_GetInvoiceByID('" .
                        $id . "'
                    )");
                    if (isset($_result_invoice) && !empty($_result_invoice) && !isset($_result_invoice['0']->Message)) {
                        $_result_site = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                            $_result_invoice[0]->SitesID . "'
                        )");
                        if (isset($_result_site) && !empty($_result_site) && !isset($_result_site['0']->Message)) {
                            $name = $_result_site[0]->Name;
                            $service_name = $_result_site[0]->ServiceName;
                            $InvoiceNo = $_result_invoice[0]->InvoiceNo;
                            $date = $_result_invoice[0]->InvoiceDate;
                            $amount = $_result_invoice[0]->TotalAmount;

                            // $msg = "Dear ".$name."\nEstimation No: ".$estimation_no."\nDate:".$date."\nAmount: Rs. ".$amount."\nJust to accept this, pass this OTP:".$otp." to engineers.\nHH Enterprise";
                            $Content = $this->master_model->get_smstemplate(4);

                            $msg = str_replace(
                                array('{name}', '{service_name}', '{invoice_no}', '{invoice_date}', '{amount}'),
                                array($name, $service_name, $InvoiceNo, $date, $amount),
                                $Content['SmsMessage']
                            );

                            $response['error'] = 200;
                            $response['message'] = $notif_text;
                            $response['data'] = $_result;
                        } else if (isset($_result_site['0']->Message) && $_result_site['0']->Message != "") {
                            $msg = explode('~', $_result[0]->Message);
                            $response['error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['message'] = $msg[1];
                            $response['data'] = array();
                        } else {
                            $response['error'] = 104;
                            $response['message'] = label('api_msg_error_occurred');
                        }
                    }

                    // $response['error'] = 200;
                    // $response['message'] = label('api_msg_invoice_added_successfully');
                    // $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    public function AMCInvoicePrintReceipt($ID)
    {
        $result = array();

        $Invoice = $this->master_model->getQueryResult("call usp_A_GetInvoiceByID('" . $ID . "')");
        //$Quotation = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" . $Invoice['0']->QuotationID . "')");
        $Item = $this->master_model->getQueryResult("call usp_A_GetInvoiceItem('-1','1','" . $ID . "','1')");
        $Sites = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" . $Invoice['0']->SitesID . "')");
        $Company = $this->master_model->getQueryResult("call usp_A_GetCompanyByID('" . $Invoice['0']->CompanyID . "')");

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
                                    
                                </td>
                            </tr>
                        </table>';


        $html .= '<table border="1" cellpadding="8">
                        <tr style="background-color:black;color:white;">
                            <th width="50">#</th>
                            <th width="210">Item</th>
                            <th width="100">HSN/SAC </th>
                            <th width="70">Qty</th>
                            <th width="100">Rate</th>
                            <th width="100">Amount</th>
                        </tr>';
        $item_counter = 1;
        if (!isset($Item[0]->Message)) {
            foreach ($Item as $key => $value) {
                if ($value->ProductID != 0) {
                    $html .= '
                                    <tr>
                                        <td>' . ($item_counter++) . '</td>
                                        <td>' . $value->DisplayName . '<br/>' . $value->Model . '</td>
                                        <td>' . $value->PHSNNo . '</td>
                                        <td>' . $value->Qty . '</td>
                                        <td style="text-align: right">Rs.' . $value->Rate . '</td>
                                        <td style="text-align: right">Rs.' . $value->Qty * $value->Rate . '</td>
                                    </tr>';
                } else if ($value->MaterialID != 0) {
                    $html .= '
                                    <tr>
                                        <td>' . ($item_counter++) . '</td>
                                        <td>' . $value->Material . '</td>
                                        <td>' . $value->HSNNo . '</td>
                                        <td>' . $value->Qty . '</td>
                                        <td style="text-align: right">Rs.' . $value->Rate . '</td>
                                        <td style="text-align: right">Rs.' . $value->Qty * $value->Rate . '</td>
                                    </tr>';
                } else {
                    $html .= '
                                    <tr>
                                        <td>' . ($item_counter++) . '</td>
                                        <td>' . $value->InstallationService . '</td>
                                        <td>' . 'N/A' . '</td>
                                        <td>' . $value->Qty . '</td>
                                        <td style="text-align: right">Rs.' . $value->Rate . '</td>
                                        <td style="text-align: right">Rs.' . $value->Qty * $value->Rate . '</td>
                                    </tr>';
                }
            }
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
                                <br/><br/> BILL ' . date('M Y') . '<br/>
                                ' . $Invoice['0']->Notes . '<br/>
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
                                <td>For, HH Enterprise<br/><br/><br/><br/><br/><br/>Authorized Signature
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
    public function InvoicePrintReceipt($ID)
    {
        $result = array();

        $Invoice = $this->master_model->getQueryResult("call usp_A_GetInvoiceByID('" . $ID . "')");
        $Quotation = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" . $Invoice['0']->QuotationID . "')");
        $Item = $this->master_model->getQueryResult("call usp_A_GetInvoiceItem('-1','1','" . $ID . "','1')");
        $Sites = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" . $Invoice['0']->SitesID . "')");
        $Company = $this->master_model->getQueryResult("call usp_A_GetCompanyByID('" . $Invoice['0']->CompanyID . "')");

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


        $html .= '<table border="1" cellpadding="8">
                        <tr style="background-color:black;color:white;">
                            <th width="50">#</th>
                            <th width="210">Item</th>
                            <th width="100">HSN/SAC </th>
                            <th width="70">Qty</th>
                            <th width="100">Rate</th>
                            <th width="100">Amount</th>
                        </tr>';
        $item_counter = 1;
        if (!isset($Item[0]->Message)) {
            foreach ($Item as $key => $value) {
                if ($value->ProductID != 0) {
                    $html .= '
                                    <tr>
                                        <td>' . ($item_counter++) . '</td>
                                        <td>' . $value->DisplayName . '<br/>' . $value->Model . '</td>
                                        <td>' . $value->PHSNNo . '</td>
                                        <td>' . $value->Qty . '</td>
                                        <td style="text-align: right">Rs.' . $value->Rate . '</td>
                                        <td style="text-align: right">Rs.' . $value->Qty * $value->Rate . '</td>
                                    </tr>';
                } else if ($value->MaterialID != 0) {
                    $html .= '
                                    <tr>
                                        <td>' . ($item_counter++) . '</td>
                                        <td>' . $value->Material . '</td>
                                        <td>' . $value->HSNNo . '</td>
                                        <td>' . $value->Qty . '</td>
                                        <td style="text-align: right">Rs.' . $value->Rate . '</td>
                                        <td style="text-align: right">Rs.' . $value->Qty * $value->Rate . '</td>
                                    </tr>';
                } else {
                    $html .= '
                                    <tr>
                                        <td>' . ($item_counter++) . '</td>
                                        <td>' . $value->InstallationService . '</td>
                                        <td>' . 'N/A' . '</td>
                                        <td>' . $value->Qty . '</td>
                                        <td style="text-align: right">Rs.' . $value->Rate . '</td>
                                        <td style="text-align: right">Rs.' . $value->Qty * $value->Rate . '</td>
                                    </tr>';
                }
            }
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
                                <br/><br/>' . $Quotation['0']->Service . ' BILL ' . date('M Y') . '<br/>
                                ' . $Invoice['0']->Notes . '<br/>
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
                                <td>For, HH Enterprise<br/><br/><br/><br/><br/><br/>Authorized Signature
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

    function getQuestion($data)
    {
        try {
            $response = array();
            $ServiceID = isset($data->ServiceID) ? $data->ServiceID : '-1';
            $_result = $this->master_model->getQueryResult("call usp_A_GetQuestion('-1','1','','1', '" . $ServiceID . "')");
            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['error'] = 200;
                $response['message'] = label('api_msg_question_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                $response['message'] = label('api_msg_no_data'); //$msg[1];
                $response['data'] = array();
            } else {
                $response['error'] = 104;
                $response['message'] = label('api_msg_error_occurred');
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function ConvertToCustomer($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else {

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_ConvertToCustomer('" .
                    $data->UserID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->VisitorID . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_customer_convert_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function convertToQuotationAccept($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else {

                $IP = GetIP();

                if ($data->CustomerID == 0) {
                    $_res = $this->master_model->getQueryResult("call usp_A_ConvertToCustomer('" .
                        $data->UserID . "','" .
                        $data->UserID . "','1','Android','" .
                        $IP . "','" .
                        $data->VisitorID . "'
                    )");
                    $data->CustomerID = $_res['0']->ID;
                } else {
                    $data->CustomerID = $data->CustomerID;
                }

                $sql = "call usp_A_ConvertToQuotationAccept('" .
                    $data->StartDate . "','" .
                    $data->UserID . "','1','" .
                    $data->QuotationID . "','Android','" .
                    $IP . "','" .
                    $data->EndDate . "','" .
                    $data->StartTime . "','" .
                    $data->EndTime . "','" .
                    $data->CustomerID . "'
                )";
                $_result = $this->master_model->getQueryResult($sql);

                //now add challan from quotation

                //fetch current quotation
                $ID = $data->QuotationID;
                $_result_quotation = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" .
                    $ID . "'
                )");
                if (isset($_result_quotation) && !empty($_result_quotation) && !isset($_result_quotation['0']->Message)) {
                    $quotation_data = $_result_quotation[0];

                    $ChallanDate = date('Y-m-d');
                    $Term = "";
                    $Note = "";
                    $sql = "call usp_A_AddChallan('" .
                        $quotation_data->QuotationID . "','" .
                        $data->UserID . "','0','Android','" .
                        $IP . "','" .
                        // '1' . "','1','Android','" .
                        // '1' . "','" .
                        $ChallanDate . "','" .
                        $quotation_data->Address . "','" .
                        $quotation_data->Address2 . "','" .
                        $quotation_data->CityID . "','" .
                        $quotation_data->StateID . "','" .
                        $quotation_data->PinCode . "','" .
                        $quotation_data->SubTotal . "','" .
                        $quotation_data->CGST . "','" .
                        $quotation_data->SGST . "','" .
                        $quotation_data->IGST . "','" .
                        $quotation_data->Rounding . "','" .
                        $quotation_data->Total . "','" .
                        0 . "','" .
                        $Term . "','" .
                        $Note . "'
                    )";
                    $_result_challan = $this->master_model->getQueryResult($sql);
                    if (isset($_result_challan) && !empty($_result_challan) && !isset($_result_challan['0']->Message)) {
                        //challan created. now add quotation item to challan
                        $Item = $this->master_model->getQueryResult("call usp_A_GetQuotationitem('-1','1','" . $ID . "','1','-1','-1')");
                        foreach ($Item as $key => $value) {
                            if ($value->MaterialID == 0 && $value->ProductID != 0) {
                                for ($i = 1; $i <= $value->Qty; $i++) {
                                    $sql = "call usp_A_AddChallanItem('" .
                                        $_result_challan['0']->ID . "','" .
                                        $data->UserID . "','1','Android','" .
                                        $IP . "','" .
                                        $value->ProductID . "','" .
                                        $value->MaterialID . "','" .
                                        '1' . "','" .
                                        $value->Rate . "','" .
                                        $value->Rate . "','" .
                                        @$value->SrNo . "','" .
                                        @$value->QuotationID . "','0'
                                    )";
                                    $item_res = $this->master_model->getQueryResult($sql);
                                }
                            } else {
                                $sql = "call usp_A_AddChallanItem('" .
                                    $_result_challan['0']->ID . "','" .
                                    $data->UserID . "','1','Android','" .
                                    $IP . "','" .
                                    $value->ProductID . "','" .
                                    $value->MaterialID . "','" .
                                    $value->Qty . "','" .
                                    $value->Rate . "','" .
                                    $value->Rate . "','" .
                                    @$value->SrNo . "','" .
                                    @$value->QuotationID . "','0'
                                )";
                                $item_res = $this->master_model->getQueryResult($sql);
                            }
                        }

                        $this->PrintChallan($_result_challan[0]->ID);
                    }
                }


                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_quotation_accept_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    //send sms to the customer 
    public function resendOtp($data)
    {
        try {
            $response = array();

            if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" .
                    $data->QuotationID . "'
                )");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $_result_visitor = $this->master_model->getQueryResult("call usp_A_GetVisitorByID('" .
                        $_result[0]->VisitorID . "'
                    )");
                    if (isset($_result_visitor) && !empty($_result_visitor) && !isset($_result_visitor['0']->Message)) {
                        $name = $_result_visitor[0]->Name;
                        $estimation_no = $_result[0]->EstimateNo;
                        $date = $_result[0]->EstimateDate;
                        $amount = $_result[0]->Total;
                        $OTP = $_result[0]->OTP;
                        $msg = "Dear " . $name . "\nEstimation No: " . $estimation_no . "\nDate:" . $date . "\nAmount: Rs. " . $amount . "\nJust to accept this, pass this OTP:" . $OTP . " to engineers.\nHH Enterprise";
                        $response['error'] = 200;
                        $response['message'] = $msg; //label('api_msg_quotation_listed_successfully');
                        $response['data'] = $_result; //array(array('QuotationID' => $_result[0]->QuotationID,'OTP' => $_result[0]->OTP));
                    } else if (isset($_result_visitor['0']->Message) && $_result_visitor['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_error_occurred');
                    }
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    //verify the otp
    function verifyQuotationOtp($data)
    {
        try {
            $response = array();

            if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else if (!isset($data->OTP)  || $data->OTP == '') {
                $response['error'] = 102;
                $response['message'] = 'OTP not found';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" .
                    $data->QuotationID . "'
                )");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    if ($_result[0]->OTP == $data->OTP) {
                        if ($_result[0]->AppointmentID != 0) {
                            $AppointmentID = $_result[0]->AppointmentID;
                            $IP = GetIP();
                            $_result = $this->master_model->getQueryResult("call usp_A_EditAppointmentStatus(
                                'InProgress','1', $AppointmentID,'Android','" . $IP . "'
                            )");
                        }

                        $response['error'] = 200;
                        $response['message'] = label('api_msg_quotation_verified_successfully');
                        $response['data'] = array(array('QuotationID' => $data->QuotationID, 'OTP' => $data->OTP));
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_wrong_otp');
                        $response['data'] = array();
                    }
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function RejectAppointmentQuotation($data)
    {
        try {
            $response = array();

            if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" .
                    $data->QuotationID . "'
                )");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    if ($_result[0]->AppointmentID != 0) {
                        $AppointmentID = $_result[0]->AppointmentID;
                        $IP = GetIP();
                        $_result = $this->master_model->getQueryResult("call usp_A_EditAppointmentStatus(
                                'Rejected','1', $AppointmentID,'Android','" . $IP . "'
                            )");
                    }
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_quotation_rejected_successfully');
                    $response['data'] = array(array('QuotationID' => $data->QuotationID));
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function convertToQuotationReject($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->QuotationID)  || $data->QuotationID == '') {
                $response['error'] = 102;
                $response['message'] = 'QuotationID not found';
            } else {

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_ConvertToQuotationReject('" .
                    $data->ReasonID . "','" .
                    $data->UserID . "','1','" .
                    $data->QuotationID . "','Android','" .
                    $IP . "'
                                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_quotation_reject_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addQuotation($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->CustomerID)) {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else {

                $IP = GetIP();

                $WRTotal = @$data->SubTotal + @$data->CGST + @$data->SGST + @$data->IGST;
                $Total = round($WRTotal);
                if ($WRTotal > $Total) {
                    $data->Rounding = $WRTotal - $Total;
                } else {
                    $data->Rounding = $Total - $WRTotal;
                }
                $data->Rounding = round($data->Rounding, 2);
                $data->Total = $Total;


                // $this->load->helper('string');
                // $data->OTP = random_string('numeric', 4);
                $digits = 4;
                $data->OTP = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                // $data->StartDate = GetDateInFormat($data->StartDate, DATE_FORMAT, DATABASE_DATE_FORMAT);
                // $data->EndDate = GetDateInFormat($data->EndDate, DATE_FORMAT, DATABASE_DATE_FORMAT);

                $sql = "call usp_A_AddQuotation('" .
                    $data->SitesID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->CompanyID . "','" .
                    $data->EstimateDate . "','" .
                    $data->Address . "','" .
                    $data->Address2 . "','" .
                    $data->CityID . "','" .
                    $data->StateID . "','" .
                    $data->PinCode . "','" .
                    $data->SubTotal . "','" .
                    $data->CGST . "','" .
                    $data->SGST . "','" .
                    $data->IGST . "','" .
                    $data->Rounding . "','" .
                    $WRTotal . "','" . //$data->Total . "','" .
                    $data->ServiceID . "','" .
                    $data->VisitorID . "','" .
                    $data->CustomerID . "','" .
                    str_replace('\n', '', $this->db->escape_str(nl2br($data->Terms))) . "','" .
                    '' . "','" .
                    str_replace('\n', '', $this->db->escape_str(nl2br($data->Notes))) . "','" .
                    $data->StartDate . "','" .
                    $data->EndDate . "','" .
                    'Product' . "','" .
                    $data->OTP . "','0'
                )";

                $_result = $this->master_model->getQueryResult($sql);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    $device = $this->getDeviceData($data->UserID);
                    $employee = $this->getEmployeeData($data->UserID);
                    if (@$device != "") {
                        $notif_text = $this->getQuotationMessage($_result[0]->ID, $data->UserID);
                        $pushNotificationArr = array(
                            'device_id' => $device,
                            'message' => $notif_text,
                            'title' => label('api_msg_notification_addquotation_title'),
                            'event' => NOTIFICATION_ADDQUOTATION,
                            'ActionType' => '',
                            'detail' => ''
                        );
                        $res = sendPushNotification($pushNotificationArr);
                    }

                    $this->load->model('admin/config_model');
                    $this->configdata = $this->config_model->getConfig();

                    foreach ($data->Item as $key => $value) {
                        $res_item = $this->master_model->getQueryResult("call usp_A_AddQuotationitem('" .
                            $_result['0']->ID . "','" .
                            $data->UserID . "','1','Android','" .
                            $IP . "','" .
                            $value->ProductID . "','" .
                            $value->MaterialID . "','" .
                            $value->Qty . "','" .
                            $value->Rate . "','" .
                            $value->Qty * $value->Rate * $value->Days . "','" .
                            $value->Days . "','" .
                            '' . "','" .
                            @$value->UOM . "'
                        )");
                    }

                    $this->PrintReceipt($_result['0']->ID);


                    $_result_quotation = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" .
                        $_result[0]->ID . "'
                    )");
                    if (isset($_result_quotation) && !empty($_result_quotation) && !isset($_result_quotation['0']->Message)) {
                        $_result_visitor = $this->master_model->getQueryResult("call usp_A_GetVisitorByID('" .
                            $data->VisitorID . "'
                        )");
                        if (isset($_result_visitor) && !empty($_result_visitor) && !isset($_result_visitor['0']->Message)) {
                            $name = $_result_visitor[0]->Name;
                            $estimation_no = $_result_quotation[0]->EstimateNo;
                            $date = $_result_quotation[0]->EstimateDate;
                            $amount = $_result_quotation[0]->Total;
                            $OTP = $_result_quotation[0]->OTP;
                            $msg = "Dear " . $name . "\nEstimation No: " . $estimation_no . "\nDate:" . $date . "\nAmount: Rs. " . $amount . "\nJust to accept this, pass this OTP:" . $OTP . " to engineers.\nHH Enterprise";
                            $response['error'] = 200;
                            $response['message'] = $msg; //label('api_msg_quotation_listed_successfully');
                            $response['data'] = $_result; //array(array('QuotationID' => $_result[0]->QuotationID,'OTP' => $_result[0]->OTP));
                        } else if (isset($_result_visitor['0']->Message) && $_result_visitor['0']->Message != "") {
                            $msg = explode('~', $_result[0]->Message);
                            $response['error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['message'] = $msg[1];
                            $response['data'] = array();
                        } else {
                            $response['error'] = 104;
                            $response['message'] = label('api_msg_error_occurred');
                        }
                    }

                    // $response['error'] = 200;
                    // $response['message'] = label('api_msg_quotation_added_successfully');
                    // $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    public function PrintReceipt($ID)
    {

        $this->load->model('admin/config_model');
        $this->configdata = $this->config_model->getConfig();
        $result = array();

        $Quotation = $this->master_model->getQueryResult("call usp_A_GetQuotationByID('" . $ID . "')");
        $Item_Material = $this->master_model->getQueryResult("call usp_A_GetQuotationitem('-1','1','" . $ID . "','1','1','-1')");
        $Item_Product = $this->master_model->getQueryResult("call usp_A_GetQuotationitem('-1','1','" . $ID . "','1','0','-1')");
        $Item_Service = $this->master_model->getQueryResult("call usp_A_GetQuotationitem('-1','1','" . $ID . "','1','-1','-1')");

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
                        ' . wordwrap($Company[0]->Address, 50, "<br/>")  . '<br>
                        GSTIN ' . $Company['0']->GSTNo . '
                    </div><br>
                    <table border="1" cellpadding="8">
                        <tr>
                            <td>
                                Bill To<br>
                                <b>' . $Sites['0']->Name . '</b><br>
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table>
                        <tr>
                            <td>Place Of Supply: ' . $Sites['0']->StateName . ' (' . $Sites['0']->GSTCode . ')<br/></td>
                            <td style="text-align:right;">Estimate Date : ' . $Quotation['0']->EstimateDate . '<br/></td>
                        </tr>
                    </table><br>
                    <table border="1" cellpadding="8">
                        <tr style="background-color:black;color:white;">
                            <th width="50">#</th>
                            <th width="310">Item</th>
                            <th width="100">Rate</th>
                            <th width="70">Qty</th>
                            <th width="100">Amount</th>
                        </tr>';

        if ($Quotation['0']->AppointmentID == 0) {
            $item_counter = 1;
            foreach (@$Item_Product as $key => $value) {
                $html .= '
                                <tr>
                                    <td>' . ($item_counter++) . '</td>
                                    <td>' . $value->DisplayName . '<br/>' . $value->Model . '</td>
                                    <td style="text-align: right">Rs.' . $value->Rate . '</td>
                                    <td>' . $value->Qty . '</td>
                                    <td style="text-align: right">Rs.' . $value->Qty * $value->Rate * $value->Days . '</td>
                                </tr>';
            }
            foreach (@$Item_Material as $key => $value) {
                $html .= '
                                    <tr>
                                        <td>' . ($item_counter++) . '</td>
                                        <td>' . $value->Material . '</td>
                                        <td style="text-align: right">Rs.' . $value->Rate . '</td>
                                        <td>' . $value->Qty . '</td>
                                        <td style="text-align: right">Rs.' . $value->Qty * $value->Rate * $value->Days . '</td>
                                    </tr>';
            }
        } else {
            $item_counter = 1;
            foreach (@$Item_Service as $key => $value) {
                $html .= '
                                    <tr>
                                        <td>' . ($item_counter++) . '</td>
                                        <td>' . $value->InstallationService . '</td>
                                        <td style="text-align: right">Rs.' . $value->Rate . '</td>
                                        <td>' . $value->Qty . '</td>
                                        <td style="text-align: right">Rs.' . $value->Qty * $value->Rate * $value->Days . '</td>
                                    </tr>';
            }
        }


        $html .= '<tr>
                            <td colspan="2" style="border-bottom: 0 solid white;"></td>
                            <td colspan="2">Sub Total</td>
                            <td style="text-align: right">Rs.' . $Quotation['0']->SubTotal . '</td>
                        </tr>';

        if ($Quotation['0']->IGST == '' || $Quotation['0']->IGST == 0) {
            $html .= '<tr>
                                <td colspan="2" style="border-bottom: 0 solid white;"></td>
                                <td colspan="2">CGST </td>
                                <td style="text-align: right">Rs.' .  (float)$Quotation['0']->CGST . '</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-bottom: 0 solid white;"></td>
                                <td colspan="2">SGST </td>
                                <td style="text-align: right">Rs.' . (float)$Quotation['0']->SGST . '</td>
                            </tr>';
        } else {
            $html .= '<tr>
                                <td colspan="2" style="border-bottom: 0 solid white;"></td>
                                <td colspan="2">IGST </td>
                                <td style="text-align: right">Rs.' .  (float)$Quotation['0']->IGST . '</td>
                            </tr>';
        }
        $html .= '<tr>
                            <td colspan="2" style="border-bottom: 0 solid white;"></td>
                            <td colspan="2">Rounding</td>
                            <td style="text-align: right">Rs.' . $Quotation['0']->Rounding . '</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-bottom: 1 solid white;"></td>
                            <td colspan="2"><b>Total</b></td>
                            <td style="text-align: right"><b>Rs. ' . ((float)$Quotation['0']->Total) . '</b></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-transform: uppercase"><b>Total In Words: </b>' . numberTowords((int)((float)$Quotation['0']->Total)) . '</td>
                        </tr>
                    </table><br>
                    <div>
                       <b>Notes</b><br>
                       ' . $Quotation[0]->Note . '
                   </div><br>
                   <div>
                       <b>Terms & Conditions</b><br>
                       ' . $Quotation[0]->Term . '
                   </div><br>
                   <div>
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
            $structure = 'assets/uploads/estimation/';
            $File = $ID . '_' . date('dmY') . '.pdf';
            $path = FCPATH . $structure . $File;
        }

        $data = array();
        $this->master_model->getQueryResult("call usp_updatequotationpdf('" . $ID . "','" . $File . "')");
        //Close and output PDF document

        $pdf->Output($path, 'F');
        return $path;
    }

    function getService($data)
    {
        try {
            $response = array();
            $_result = $this->master_model->getQueryResult("call usp_A_GetService('-1','1','','1')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['error'] = 200;
                $response['message'] = label('api_msg_service_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                $response['message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['error'] = 104;
                $response['message'] = label('api_msg_error_occurred');
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getCompany($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_A_GetCompany('-1','1','','1'
                    )");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['error'] = 200;
                $response['message'] = label('api_msg_company_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                $response['message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['error'] = 104;
                $response['message'] = label('api_msg_error_occurred');
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }


    function addEmployee($data = array())
    {

        $response           = $_result              = $result           = array();

        if (!isset($data['FirstName'])  || $data['FirstName'] == '') {
            $response['error'] = 102;
            $response['message'] = 'FirstName not found';
        } else if (!isset($data['LastName'])  || $data['LastName'] == '') {
            $response['error'] = 102;
            $response['message'] = 'LastName not found';
        } else if (!isset($data['MobileNo'])  || $data['MobileNo'] == '') {
            $response['error'] = 102;
            $response['message'] = 'MobileNo not found';
        } else if (!isset($data['Address'])  || $data['Address'] == '') {
            $response['error'] = 102;
            $response['message'] = 'Address not found';
        } else if (!isset($data['UsertypeID'])  || $data['UsertypeID'] == '') {
            $response['error'] = 102;
            $response['message'] = 'UsertypeID not found';
        } else if (!isset($data['Salary'])  || $data['Salary'] == '') {
            $response['error'] = 102;
            $response['message'] = 'Salary not found';
        } else if (!isset($data['JoiningDate'])  || $data['JoiningDate'] == '') {
            $response['error'] = 102;
            $response['message'] = 'Joining Date not found';
        } else if (!isset($data['WorkingHours'])  || $data['WorkingHours'] == '') {
            $response['error'] = 102;
            $response['message'] = 'Working Hours not found';
        } else {

            if (@$_FILES['ImageData']['error'] == 0 && !empty($_FILES['ImageData'])) {

                $pathMain       = USER_UPLOAD_PATH;
                $path           = USER_UPLOAD_PATH;
                $max_size       = USER_MAX_SIZE;
                $allowed_types  = USER_ALLOWED_TYPES;

                $imageNameTime = time();
                $file_name = $imageNameTime;
                $CV_real_name = @$_FILES['ImageData']['name'];

                $uploadFile = 'ImageData';
                $result = array();
                $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                if (isset($result['error']) && @$result['error'] != '') {
                    $result['error'] = str_replace('<p>', '', $result['error']);
                    $result['error'] = str_replace('</p>', '', $result['error']);
                }


                $uploadedFileName = $result['upload_data']['file_name'];


                $pathMain       = USERDOCUMENT_UPLOAD_PATH;
                $path           = USERDOCUMENT_UPLOAD_PATH;
                $max_size       = USERDOCUMENT_MAX_SIZE;
                $allowed_types  = USERDOCUMENT_ALLOWED_TYPES;

                $imageNameTime = time();
                $file_name = $imageNameTime;
                $CV_real_name = @$_FILES['DocumentImageData']['name'];

                $uploadFile = 'DocumentImageData';
                $result_document = array();
                $result_document = do_upload($uploadFile, $allowed_types, $path, $file_name);

                if (isset($result_document['error']) && @$result_document['error'] != '') {
                    $result_document['error'] = str_replace('<p>', '', $result_document['error']);
                    $result_document['error'] = str_replace('</p>', '', $result_document['error']);
                }

                $documentUploadedFileName = $result_document['upload_data']['file_name'];



                $pathMain       = USEROFEERLETTER_UPLOAD_PATH;
                $path           = USEROFEERLETTER_UPLOAD_PATH;
                $max_size       = USEROFEERLETTER_MAX_SIZE;
                $allowed_types  = USEROFEERLETTER_ALLOWED_TYPES;

                $imageNameTime = time();
                $file_name = $imageNameTime;
                $CV_real_name = @$_FILES['OfferletterData']['name'];

                $uploadFile = 'OfferletterData';
                $result_document = array();
                $result_document = do_upload($uploadFile, $allowed_types, $path, $file_name);

                if (isset($result_document['error']) && @$result_document['error'] != '') {
                    $result_document['error'] = str_replace('<p>', '', $result_document['error']);
                    $result_document['error'] = str_replace('</p>', '', $result_document['error']);
                }

                $offerLetterFileName = $result_document['upload_data']['file_name'];

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_M_AddEmployee('" .
                    $data['FirstName'] . "','" .
                    $data['LastName'] . "','" .
                    $data['EmailID'] . "','" .
                    fnEncrypt($data['Password']) . "','" .
                    $data['MobileNo'] . "','" .
                    $data['Address'] . "','1','Android','" .
                    $IP . "','" .
                    $data['UsertypeID'] . "','" .
                    $data['Salary'] . "','" .
                    $data['JoiningDate'] . "','" .
                    $data['WorkingHours'] . "','" .
                    $documentUploadedFileName . "','" .
                    $uploadedFileName . "','" .
                    $offerLetterFileName . "','" .
                    $data['BankName'] . "','" .
                    $data['BranchName'] . "','" .
                    $data['AccountNo'] . "','" .
                    $data['IFSCCode'] . "','" .
                    $data['CityID'] . "','" .
                    $data['GSTNo'] . "','" .
                    $data['RoleID'] . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_employee_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            } else {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_error_occurred');
            }
        }

        return $response;
    }

    function getUsertype($data)
    {
        try {
            $response = array();
            $is_material = isset($data->IsMaterial) ? $data->IsMaterial : '0';
            $IsUserType = isset($data->IsUserType) ? $data->IsUserType : '-1';
            $ServiceID = isset($data->ServiceID) ? $data->ServiceID : '-1';
            $_result = $this->master_model->getQueryResult("call usp_A_GetUsertype('-1','1','','" . $is_material . "','" . $ServiceID . "','" . $IsUserType . "','1')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['error'] = 200;
                $response['message'] = label('api_msg_usertype_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                $response['message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['error'] = 104;
                $response['message'] = label('api_msg_error_occurred');
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function editVisitor($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->Name)  || $data->Name == '') {
                $response['error'] = 102;
                $response['message'] = 'Name not found';
            } else if (!isset($data->MobileNo)  || $data->MobileNo == '') {
                $response['error'] = 102;
                $response['message'] = 'MobileNo not found';
            } else if (!isset($data->EmailID)) {
                $response['error'] = 102;
                $response['message'] = 'EmailID not found';
            } else if (!isset($data->Address)) {
                $response['error'] = 102;
                $response['message'] = 'Address not found';
            } else if (!isset($data->CityID)  || $data->CityID == '') {
                $response['error'] = 102;
                $response['message'] = 'CityID not found';
            } else if (!isset($data->StateID)  || $data->StateID == '') {
                $response['error'] = 102;
                $response['message'] = 'StateID not found';
            } else if (!isset($data->PinCode)) {
                $response['error'] = 102;
                $response['message'] = 'PinCode not found';
            } else if (!isset($data->LeadType)  || $data->LeadType == '') {
                $response['error'] = 102;
                $response['message'] = 'LeadType not found';
            } else {

                $this->load->helper('databasetable');
                $Table = 'Visitor';
                $array = GetDatabaseTableArray($Table);
                $array['ID'] = $data->VisitorID;
                $array['DataValue'] = $data->MobileNo;
                $res = $this->common_model->CheckDuplicate($array);

                if (@$res->Count == 0) {
                    $IP = GetIP();

                    $_result = $this->master_model->getQueryResult("call usp_A_EditVisitor('" .
                        $data->Name . "','" .
                        $data->UserID . "','1',
                        $data->VisitorID,'Android','" .
                        $IP . "','" .
                        $data->EmailID . "','" .
                        $data->MobileNo . "','" .
                        $data->Address . "','" .
                        $data->StateID . "','" .
                        $data->CityID . "','" .
                        $data->PinCode . "','" .
                        $data->LeadType . "'
                    )");

                    if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                        $response['error'] = 200;
                        $response['message'] = label('api_msg_visitor_update_successfully');
                        $response['data'] = $_result;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_error_occurred');
                    }
                } else {
                    $response['error'] = 101;
                    $response['message'] = label('api_msg_mobile_no_already_exist');
                    $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addSites($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->SiteName)  || $data->SiteName == '') {
                $response['error'] = 102;
                $response['message'] = 'SiteName not found';
            } else {

                $IP = GetIP();

                $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" . $data->UserID . "')");
                if (isset($data->SiteID) && $data->SiteID == '-1') {
                    $service_id = isset($data->ServiceID) ? $data->ServiceID : '0';
                    $_result = $this->master_model->getQueryResult("call usp_A_AddSites('" .
                        $data->UserID . "','" .
                        $data->UserID . "','1','Android','" .
                        $IP . "','" .
                        $data->VisitorID . "','" .
                        $data->CustomerID . "','" .
                        $data->SiteName . "','" .
                        $data->SiteName . "','" .
                        $data->SiteType . "','" .
                        $data->Address . "','" .
                        $data->WorkingHours . "','" .
                        $data->WorkingDays . "','" .
                        $data->ProposedDate . "','" .
                        $data->StartDate . "','" .
                        $data->EndDate . "','" .
                        $data->GSTNo . "','" .
                        $data->Address2 . "','" .
                        $data->CityID . "','" .
                        $data->StateID . "','" .
                        $data->PinCode . "','" .
                        $service_id . "'
                    )");
                    if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                        $device = $this->getDeviceData($data->UserID);
                        $employee = $this->getEmployeeData($data->UserID);
                        if (@$device != "") {
                            $notif_text = $this->getSiteMessage($_result[0]->ID, $data->UserID);
                            $pushNotificationArr = array(
                                'device_id' => $device,
                                'message' => $notif_text,
                                'title' => label('api_msg_notification_addsite_title'),
                                'event' => NOTIFICATION_ADDSITE,
                                'ActionType' => '',
                                'detail' => ''
                            );
                            $res = sendPushNotification($pushNotificationArr);
                        }
                        $data = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                            $_result['0']->ID . "'
                        )");
                        $response['error'] = 200;
                        $response['message'] = label('api_msg_sites_added_successfully');
                        $response['data'] = $data;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_error_occurred');
                    }
                } else {

                    $data->Status = getStringClean((isset($data->Status) && $data->Status == 'on') ? ACTIVE : INACTIVE);
                    $data->ModifiedBy = '1';
                    $data->UserType = 'Android';
                    $data->IPAddress = GetIP();

                    $_result = $this->master_model->getQueryResult("call usp_A_EditSites('" .
                        $data->SiteName . "','" .
                        $data->ModifiedBy . "','" .
                        $data->Status . "','" .
                        $data->SiteID . "','" .
                        $data->UserType . "','" .
                        $data->IPAddress . "','" .
                        $data->SiteName . "','" .
                        $data->SiteType . "','" .
                        $data->Address . "','" .
                        $data->WorkingHours . "','" .
                        $data->WorkingDays . "','" .
                        $data->ProposedDate . "','" .
                        $data->StartDate . "','" .
                        $data->EndDate . "','" .
                        $data->GSTNo . "','" .
                        $data->Address2 . "','" .
                        $data->CityID . "','" .
                        $data->StateID . "','" .
                        $data->PinCode . "')");

                    if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                        $data = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                            $_result['0']->ID . "'
                        )");
                        $response['error'] = 200;
                        $response['message'] = label('api_msg_sites_added_successfully');
                        $response['data'] = $data;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_error_occurred');
                    }
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addVisitor($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->Name)  || $data->Name == '') {
                $response['error'] = 102;
                $response['message'] = 'Name not found';
            } else if (!isset($data->MobileNo)  || $data->MobileNo == '') {
                $response['error'] = 102;
                $response['message'] = 'MobileNo not found';
            } else if (!isset($data->EmailID)) {
                $response['error'] = 102;
                $response['message'] = 'EmailID not found';
            } else if (!isset($data->Address)) {
                $response['error'] = 102;
                $response['message'] = 'Address not found';
            } else if (!isset($data->CityID)  || $data->CityID == '') {
                $response['error'] = 102;
                $response['message'] = 'CityID not found';
            } else if (!isset($data->StateID)  || $data->StateID == '') {
                $response['error'] = 102;
                $response['message'] = 'StateID not found';
            } else if (!isset($data->PinCode)) {
                $response['error'] = 102;
                $response['message'] = 'PinCode not found';
            } else if (!isset($data->LeadType)  || $data->LeadType == '') {
                $response['error'] = 102;
                $response['message'] = 'LeadType not found';
            } else if (!isset($data->SiteName)  || $data->SiteName == '') {
                $response['error'] = 102;
                $response['message'] = 'SiteName not found';
            } else if (!isset($data->StartDate)  || $data->StartDate == '') {
                $response['error'] = 102;
                $response['message'] = 'StartDate not found';
            } else if (!isset($data->EndDate)  || $data->EndDate == '') {
                $response['error'] = 102;
                $response['message'] = 'EndDate not found';
            } else if (!isset($data->ProposedDate)  || $data->ProposedDate == '') {
                $response['error'] = 102;
                $response['message'] = 'ProposedDate not found';
            } else if (!isset($data->SiteType)  || $data->SiteType == '') {
                $response['error'] = 102;
                $response['message'] = 'Type not found';
            } else if (!isset($data->GSTNo)) {
                $response['error'] = 102;
                $response['message'] = 'GSTNo not found';
            } else if (!isset($data->SiteID)) {
                $response['error'] = 102;
                $response['message'] = 'SiteID not found';
            } else {
                $this->load->helper('databasetable');
                $Table = 'Visitor';
                $array = GetDatabaseTableArray($Table);
                $array['ID'] = 0;
                $array['DataValue'] = $data->MobileNo;
                $res = $this->common_model->CheckDuplicate($array);

                $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" . $data->UserID . "')");
                if (@$res->Count == 0) {
                    $IP = GetIP();
                    //$address = $data->Address.', '.$data->Address2;
                    $sql = "call usp_A_AddVisitor('" .
                        $data->UserID . "','" .
                        $data->UserID . "','1','Android','" .
                        $IP . "','" .
                        $data->Name . "','" .
                        $data->EmailID . "','" .
                        $data->MobileNo . "','" .
                        $data->Address . "','" .
                        $data->Address2 . "','" .
                        $data->StateID . "','" .
                        $data->CityID . "','" .
                        $data->PinCode . "','" .
                        $data->LeadType . "'
                    )";
                    $_result = $this->master_model->getQueryResult($sql);
                    if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                        $device = $this->getDeviceData($data->UserID);
                        $employee = $this->getEmployeeData($data->UserID);
                        if (@$device != "") {
                            $notif_text = $this->getLeadMessage($_result[0]->ID, $data->UserID);
                            $pushNotificationArr = array(
                                'device_id' => $device,
                                'message' => $notif_text,
                                'title' => label('api_msg_notification_addsite_title'),
                                'event' => NOTIFICATION_ADDLEAD,
                                'ActionType' => '',
                                'detail' => ''
                            );
                            $res = sendPushNotification($pushNotificationArr);
                        }
                        if ($data->SiteID == '-1') {
                            $id = $_result[0]->ID;
                            $user_id = 1;
                            $customer_id = 0;
                            $working_hours = 1;
                            $working_days = 1;
                            $ServiceID = isset($data->ServiceID) ? $data->ServiceID : '0';
                            $_result_site = $this->master_model->getQueryResult("call usp_A_AddSites('" .
                                $user_id . "','" .
                                $user_id . "','1','Android','" .
                                $IP . "','" .
                                $id . "','" .
                                $customer_id . "','" .
                                $data->SiteName . "','" .
                                $data->Name . "','" .
                                $data->SiteType . "','" .
                                $data->Address . "','" .
                                $working_hours . "','" .
                                $working_days . "','" .
                                $data->ProposedDate . "','" .
                                $data->StartDate . "','" .
                                $data->EndDate . "','" .
                                $data->GSTNo . "','" .
                                $data->Address2 . "','" .
                                $data->CityID . "','" .
                                $data->StateID . "','" .
                                $data->PinCode . "','" .
                                $ServiceID . "'
                                )");
                            if (isset($_result_site) && !empty($_result_site) && !isset($_result_site['0']->Message)) {
                                $device = $this->getDeviceData($data->UserID);
                                $employee = $this->getEmployeeData($data->UserID);
                                if (@$device != "") {
                                    $notif_text = $this->getSiteMessage($_result_site[0]->ID, $data->UserID);
                                    $pushNotificationArr = array(
                                        'device_id' => $device,
                                        'message' => $notif_text,
                                        'title' => label('api_msg_notification_addsite_title'),
                                        'event' => NOTIFICATION_ADDSITE,
                                        'ActionType' => '',
                                        'detail' => ''
                                    );
                                    $res = sendPushNotification($pushNotificationArr);
                                }
                                $data = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                                    $_result_site['0']->ID . "'
                                )");

                                $response['error'] = 200;
                                $response['message'] = label('api_msg_visitor_added_successfully');
                                $response['data'] = $data; //$_result;
                                //$response['date'] = $_result_site;
                            } else if (isset($_result_site['0']->Message) && $_result_site['0']->Message != "") {
                                $msg = explode('~', $_result_site[0]->Message);
                                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                                $response['message'] = $msg[1];
                                $response['data'] = array();
                            } else {
                                $response['error'] = 104;
                                $response['message'] = label('api_msg_error_occurred');
                            }
                        } else {
                            $data = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                                $data->SiteID . "'
                            )");
                            $response['data'] = $data;
                            $response['error'] = 200;
                            $response['message'] = label('api_msg_visitor_added_successfully');
                        }
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_error_occurred');
                    }
                } else {
                    $IP = GetIP();
                    $visitor = $this->master_model->getQueryResult("call usp_A_GetVisitorByMobileNo('" . $data->MobileNo . "')");
                    $visitor_id = $visitor[0]->VisitorID;

                    //$address = $data->Address.', '.$data->Address2;
                    $_result = $this->master_model->getQueryResult("call usp_A_EditVisitor('" .
                        $data->Name . "','" .
                        $data->UserID . "','1',
                        $visitor_id,'Android','" .
                        $IP . "','" .
                        $data->EmailID . "','" .
                        $data->MobileNo . "','" .
                        $data->Address . "','" .
                        $data->Address2 . "','" .
                        $data->StateID . "','" .
                        $data->CityID . "','" .
                        $data->PinCode . "','" .
                        $data->LeadType . "'
                    )");
                    $ServiceID = isset($data->ServiceID) ? $data->ServiceID : '0';
                    $id = $_result[0]->ID;
                    $user_id = 1;
                    $customer_id = 0;
                    $working_hours = 1;
                    $working_days = 1;
                    if ($data->SiteID == '-1') {
                        $_result_site = $this->master_model->getQueryResult("call usp_A_AddSites('" .
                            $user_id . "','" .
                            $user_id . "','1','Android','" .
                            $IP . "','" .
                            $id . "','" .
                            $customer_id . "','" .
                            $data->SiteName . "','" .
                            $data->Name . "','" .
                            $data->SiteType . "','" .
                            $data->Address . "','" .
                            $working_hours . "','" .
                            $working_days . "','" .
                            $data->ProposedDate . "','" .
                            $data->StartDate . "','" .
                            $data->EndDate . "','" .
                            $data->GSTNo . "','" .
                            $data->Address2 . "','" .
                            $data->CityID . "','" .
                            $data->StateID . "','" .
                            $data->PinCode . "','" .
                            $ServiceID . "'
                            )");
                        if (isset($_result_site) && !empty($_result_site) && !isset($_result_site['0']->Message)) {
                            $device = $this->getDeviceData($data->UserID);
                            $employee = $this->getEmployeeData($data->UserID);
                            if (@$device != "") {
                                $notif_text = $this->getSiteMessage($_result_site[0]->ID, $data->UserID);
                                $pushNotificationArr = array(
                                    'device_id' => $device,
                                    'message' => $notif_text,
                                    'title' => label('api_msg_notification_addsite_title'),
                                    'event' => NOTIFICATION_ADDSITE,
                                    'ActionType' => '',
                                    'detail' => ''
                                );
                                $res = sendPushNotification($pushNotificationArr);
                            }
                            $data = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                                $_result_site['0']->ID . "'
                            )");

                            $response['error'] = 200;
                            $response['message'] = label('api_msg_visitor_added_successfully');
                            $response['data'] = $data; //$_result;
                            //$response['date'] = $_result_site;
                        } else if (isset($_result_site['0']->Message) && $_result_site['0']->Message != "") {
                            $msg = explode('~', $_result_site[0]->Message);
                            $response['error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['message'] = $msg[1];
                            $response['data'] = array();
                        } else {
                            $response['error'] = 104;
                            $response['message'] = label('api_msg_error_occurred');
                        }
                    } else {
                        $MobileNo = isset($data->MobileNo) ? $data->MobileNo : '';
                        $res_sites = $this->master_model->getQueryResult("call usp_A_GetSites(
                            '-1',
                            '1',
                            '','" .
                            $visitor_id . "',
                            '-1','" .
                            '' . "','" .
                            '' . "','" .
                            '' . "',
                            $ServiceID,'" .
                            $data->CityID . "','" .
                            $MobileNo . "'
                        )");
                        if (isset($res_sites[0]->Message)) {
                            $_result_site = $this->master_model->getQueryResult("call usp_A_AddSites('" .
                                $user_id . "','" .
                                $user_id . "','1','Android','" .
                                $IP . "','" .
                                $id . "','" .
                                $customer_id . "','" .
                                $data->SiteName . "','" .
                                $data->Name . "','" .
                                $data->SiteType . "','" .
                                $data->Address . "','" .
                                $working_hours . "','" .
                                $working_days . "','" .
                                $data->ProposedDate . "','" .
                                $data->StartDate . "','" .
                                $data->EndDate . "','" .
                                $data->GSTNo . "','" .
                                $data->Address2 . "','" .
                                $data->CityID . "','" .
                                $data->StateID . "','" .
                                $data->PinCode . "','" .
                                $ServiceID . "'
                            )");
                            if (isset($_result_site) && !empty($_result_site) && !isset($_result_site['0']->Message)) {
                                $device = $this->getDeviceData($data->UserID);
                                $employee = $this->getEmployeeData($data->UserID);
                                if (@$device != "") {
                                    $notif_text = $this->getSiteMessage($_result_site[0]->ID, $data->UserID);
                                    $pushNotificationArr = array(
                                        'device_id' => $device,
                                        'message' => $notif_text,
                                        'title' => label('api_msg_notification_addsite_title'),
                                        'event' => NOTIFICATION_ADDSITE,
                                        'ActionType' => '',
                                        'detail' => ''
                                    );
                                    $res = sendPushNotification($pushNotificationArr);
                                }
                                $data = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                                    $_result_site['0']->ID . "'
                                )");

                                $response['error'] = 200;
                                $response['message'] = label('api_msg_visitor_added_successfully');
                                $response['data'] = $data; //$_result;
                                //$response['date'] = $_result_site;
                            } else if (isset($_result_site['0']->Message) && $_result_site['0']->Message != "") {
                                $msg = explode('~', $_result_site[0]->Message);
                                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                                $response['message'] = $msg[1];
                                $response['data'] = array();
                            } else {
                                $response['error'] = 104;
                                $response['message'] = label('api_msg_error_occurred');
                            }
                        } else {
                            $data = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                                $data->SiteID . "'
                            )");
                            $response['data'] = $data;
                            $response['error'] = 200;
                            $response['message'] = label('api_msg_visitor_added_successfully');
                        }
                    }

                    /* if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                        $response['error'] = 200;
                        $response['message'] = label('api_msg_visitor_update_successfully');
                        $res_sites = $this->master_model->getQueryResult("call usp_A_GetSitesByID('" .
                            $_result[0]->ID . "'
                        )");
                        $response['data'] = $res_sites;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_error_occurred');
                    } */
                    // $response['error'] = 101;
                    // $response['message'] = label('api_msg_mobile_no_already_exist');
                    // $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addEmployeeTraining($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->TrainingDateTimeID)  || $data->TrainingDateTimeID == '') {
                $response['error'] = 102;
                $response['message'] = 'TrainingDateTimeID not found';
            } else if (!isset($data->EmployeeID)  || $data->EmployeeID == '') {
                $response['error'] = 102;
                $response['message'] = 'EmployeeID not found';
            } else {

                $IP = GetIP();

                $this->load->helper('databasetable');
                $Table = 'EmployeeTraining';
                $array = GetDatabaseTableArray($Table);
                $array['ID'] = 0;
                $array['DataValue'] = $data->TrainingDateTimeID;
                $array['SecondDataValue'] = $data->EmployeeID;
                $res = $this->common_model->CheckDuplicateDouble($array);

                if (@$res->Count == 0) {

                    $_result = $this->master_model->getQueryResult("call usp_A_AddEmployeeTraining('" .
                        $data->TrainingDateTimeID . "','" .
                        $data->UserID . "','1','Android','" .
                        $IP . "','" .
                        $data->EmployeeID . "'
                        )");

                    if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                        $response['error'] = 200;
                        $response['message'] = label('api_msg_employeetraining_added_successfully');
                        $response['data'] = $_result;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['error'] = 104;
                        $response['message'] = label('api_msg_error_occurred');
                    }
                } else {
                    $response['error'] = 101;
                    $response['message'] = label('api_msg_employee_training_already_exist');
                    $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getTrainingDateTime($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_M_GetTrainingDateTime('-1','1','1'
                    )");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['error'] = 200;
                $response['message'] = label('api_msg_trainingdatetime_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                $response['message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['error'] = 104;
                $response['message'] = label('api_msg_error_occurred');
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addEmployeeUniform($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->UniformTypeID)  || $data->UniformTypeID == '') {
                $response['error'] = 102;
                $response['message'] = 'UniformTypeID not found';
            } else if (!isset($data->UniformDate)  || $data->UniformDate == '') {
                $response['error'] = 102;
                $response['message'] = 'UniformDate not found';
            } else {

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_AddEmployeeUniform('" .
                    $data->UserID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->UniformTypeID . "','" .
                    $data->UniformDate . "'
                    )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_uniform_added_successfully');
                    $response['data'] = $_result;
                } else {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getUniformType($data)
    {
        try {
            $response = array();
            $_result = $this->master_model->getQueryResult("call usp_A_GetUniformtype('-1','1','','1')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['error'] = 200;
                $response['message'] = label('api_msg_uniformtype_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                $response['message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['error'] = 104;
                $response['message'] = label('api_msg_error_occurred');
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addEmployeeRoom($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->RoomNo)  || $data->RoomNo == '') {
                $response['error'] = 102;
                $response['message'] = 'Room No not found';
            } else if (!isset($data->RoomAddress)  || $data->RoomAddress == '') {
                $response['error'] = 102;
                $response['message'] = 'Room Address not found';
            } else if (!isset($data->StartDate)  || $data->StartDate == '') {
                $response['error'] = 102;
                $response['message'] = 'Start Date not found';
            } else if (!isset($data->EndDate)  || $data->RoomAddress == '') {
                $response['error'] = 102;
                $response['message'] = 'End Date not found';
            } else {

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_AddEmployeeRoom('" .
                    $data->UserID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->RoomNo . "','" .
                    $data->RoomAddress . "','" .
                    $data->StartDate . "','" .
                    $data->EndDate . "'
                    )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_room_added_successfully');
                    $response['data'] = $_result;
                } else {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getCustomer($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->Name)) {
                $response['error'] = 102;
                $response['message'] = 'Name not found';
            } else if (!isset($data->EmailID)) {
                $response['error'] = 102;
                $response['message'] = 'EmailID not found';
            } else if (!isset($data->CityID)  || $data->CityID == '') {
                $response['error'] = 102;
                $response['message'] = 'CityID not found';
            } else if (!isset($data->LeadType)) {
                $response['error'] = 102;
                $response['message'] = 'LeadType not found';
            } else {

                //$LeadType = $data->LeadType == '' ? 'All' : $data->LeadType;
                $_result = $this->master_model->getQueryResult("call usp_A_GetCustomer('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->Name . "','" .
                    $data->EmailID . "','1','" .
                    $data->LeadType . "','" .
                    $data->CityID . "','" .
                    783 . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    foreach ($_result as $key => $item) {
                        $sql = "call usp_A_GetInstallationItem(
                            '-1','1','-1','-1','-1','-1','" . $_result[$key]->VisitorID . "','-1','-1'
                        )";
                        $_invoice_result = $this->master_model->getQueryResult($sql);
                        if (isset($_invoice_result) && !empty($_invoice_result) && !isset($_invoice_result['0']->Message)) {
                            $_result[$key]->installation = $_invoice_result;
                        } else {
                            $_result[$key]->installation = array();
                        }
                        //$_result[$key]->Item['Product'] = array_merge($_result[$key]->Item['Product'], $_invoice_result);
                    }

                    $response['error'] = 200;
                    $response['message'] = label('api_msg_customer_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int) $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }


    function getQuotation($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->QoutationStatus)) {
                $response['error'] = 102;
                $response['message'] = 'Qoutation Status not found';
            } else {
                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $_result = $this->master_model->getQueryResult("call usp_A_GetQuotationByStatus('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->SitesID . "','" .
                    $data->VisitorID . "','" .
                    $data->CustomerID . "','" .
                    $data->QoutationStatus . "','" .
                    $CityID . "'
                )");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    foreach ($_result as $key => $value) {
                        $sql = "call usp_A_GetQuotationitem('-1',1,'" . $value->QuotationID . "',1,'1','-1')";
                        $_result[$key]->Item['Material'] = $this->master_model->getQueryResult($sql);
                        $sql = "call usp_A_GetQuotationitem('-1',1,'" . $value->QuotationID . "',1,'0','-1')";
                        $_result[$key]->Item['User'] = $this->master_model->getQueryResult($sql);
                    }
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_quotation_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    //use this for invoice items. invoice need only those items which are in challan and also installed
    function getQuotationChallan($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->SitesID)  || $data->SitesID == '') {
                $response['error'] = 102;
                $response['message'] = 'SitesID not found';
            } else if (!isset($data->QoutationStatus)) {
                $response['error'] = 102;
                $response['message'] = 'Qoutation Status not found';
            } else {

                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $_result = $this->master_model->getQueryResult("call usp_A_GetQuotationByStatus('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->SitesID . "','" .
                    $data->VisitorID . "','" .
                    $data->CustomerID . "','" .
                    $data->QoutationStatus . "','" .
                    $CityID . "'
                )");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    foreach ($_result as $key => $value) {
                        $sql = "call usp_A_GetQuotationChallanitem('-1',1,'" . $value->QuotationID . "',1,'1','1')";
                        $_result[$key]->Item['Material'] = $this->master_model->getQueryResult($sql);
                        $sql = "call usp_A_GetQuotationChallanitem('-1',1,'" . $value->QuotationID . "',1,'0','1')";
                        $_result[$key]->Item['User'] = $this->master_model->getQueryResult($sql);
                    }
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_quotation_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }


    function getSites($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->SiteName)) {
                $response['error'] = 102;
                $response['message'] = 'SiteName not found';
            } else {
                $ServiceID = isset($data->ServiceID) ? $data->ServiceID : '-1';
                $CityID = isset($data->CityID) ? $data->CityID : '-1';
                $MobileNo = isset($data->MobileNo) ? $data->MobileNo : '';

                $_result = $this->master_model->getQueryResult("call usp_A_GetSites('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->SiteName . "','" .
                    $data->VisitorID . "','" .
                    $data->CustomerID . "','" .
                    '' . "','" .
                    '' . "','" .
                    '' . "','" .
                    $ServiceID . "','" .
                    $CityID . "','" .
                    $MobileNo . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_sites_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
    function getSitesByTab($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else if (!isset($data->SiteName)) {
                $response['error'] = 102;
                $response['message'] = 'SiteName not found';
            } else if (!isset($data->StartDate)) {
                $response['error'] = 102;
                $response['message'] = 'Proposed Start Date not found';
            } else if (!isset($data->EndDate)) {
                $response['error'] = 102;
                $response['message'] = 'Proposed End Date not found';
            } else if (!isset($data->SiteType)) {
                $response['error'] = 102;
                $response['message'] = 'Proposed End Date not found';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_A_GetService('-1','1','','1')");
                $response_data = array();
                $counter = 0;
                foreach ($_result as $key => $value) {
                    $sites = array();
                    $ServiceID = isset($value->ServiceID) ? $value->ServiceID : '-1';
                    $MobileNo = isset($data->MobileNo) ? $data->MobileNo : '';
                    $result = $this->master_model->getQueryResult("call usp_A_GetSites('" .
                        $data->PageSize . "','" .
                        $data->CurrentPage . "','" .
                        $data->SiteName . "','" .
                        $data->VisitorID . "','" .
                        $data->CustomerID . "','" .
                        $data->StartDate . "','" .
                        $data->EndDate . "','" .
                        $data->SiteType . "','" .
                        $ServiceID . "','" .
                        $data->CityID . "','" .
                        $MobileNo . "'
                    )");
                    if (!isset($result[0]->Message)) {
                        $sites = $result;
                    }
                    $response_data[] = array('Title' => $value->Service, "Sites" => $sites);
                    $counter++;
                }
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_sites_listed_successfully');
                    $response['data'] = $response_data;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getEmployeeRoom($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->EmployeeID)  || $data->EmployeeID == '') {
                $response['error'] = 102;
                $response['message'] = 'EmployeeID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetEmployeeRoom('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->EmployeeID . "','1'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_employeeroom_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int) $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getEmployeeUniform($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->EmployeeID)  || $data->EmployeeID == '') {
                $response['error'] = 102;
                $response['message'] = 'EmployeeID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetEmployeeUniform('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->EmployeeID . "','1'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_employeeuniform_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getEmployeeTraining($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->EmployeeID)  || $data->EmployeeID == '') {
                $response['error'] = 102;
                $response['message'] = 'EmployeeID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetEmployeeTraining('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->EmployeeID . "','1'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_employeetraining_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getEmployee($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->Name)) {
                $response['error'] = 102;
                $response['message'] = 'Name not found';
            } else if (!isset($data->EmailID)) {
                $response['error'] = 102;
                $response['message'] = 'EmailID not found';
            } else if (!isset($data->CityID)  || $data->CityID == '') {
                $response['error'] = 102;
                $response['message'] = 'CityID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_GetEmployee('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->Name . "','" .
                    $data->EmailID . "','-1','" .
                    $data->CityID . "','" .
                    $data->UsertypeID . "'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_employee_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getVisitor($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->Name)) {
                $response['error'] = 102;
                $response['message'] = 'Name not found';
            } else if (!isset($data->EmailID)) {
                $response['error'] = 102;
                $response['message'] = 'EmailID not found';
            } else if (!isset($data->LeadType)) {
                $response['error'] = 102;
                $response['message'] = 'LeadType not found';
            } else if (!isset($data->CityID)  || $data->CityID == '') {
                $response['error'] = 102;
                $response['message'] = 'CityID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetVisitor('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->Name . "','" .
                    $data->EmailID . "',
                    '1','" .
                    $data->LeadType . "','" .
                    $data->CityID . "'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_visitor_listed_successfully');
                    $response['data'] = $_result;

                    $ServiceID = isset($data->ServiceID) ? $data->ServiceID : '-1';
                    $MobileNo = isset($data->MobileNo) ? $data->MobileNo : '';
                    $response_sites = $this->master_model->getQueryResult("call usp_A_GetSites(
                        '-1',
                        '-1',
                        '','" .
                        $_result['0']->VisitorID . "',
                        '-1','" .
                        '' . "','" .
                        '' . "','" .
                        '' . "','" .
                        $ServiceID . "','" .
                        $data->CityID . "','" .
                        $MobileNo . "'
                    )");

                    if (isset($response_sites) && !empty($response_sites) && !isset($response_sites['0']->Message)) {
                        $response['sites'] = $response_sites;
                    } else {
                        $response['sites'] = array();
                    }

                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }


    function getRole($data)
    {
        try {
            $response = array();

            if (!isset($data->RoleID)  || $data->RoleID == '') {
                $response['error'] = 102;
                $response['message'] = 'RoleID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_M_GetChildModules('" .
                    $data->RoleID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_role_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $response['error'] = 101;
                    $response['message'] = 'Data Not Found';
                    $response['data'] = array();
                } else {
                    $response['error'] = 101;
                    $response['message'] = 'Data Not Found';
                    $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getReason($data)
    {
        try {
            $response = array();

            if (!isset($data->ReasonType)  || $data->ReasonType == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_A_GetReason('-1','1','','" . $data->ReasonType . "','1')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_reason_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getDesignation($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_GetDesignation('-1','1','','1')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['error'] = 200;
                $response['message'] = label('api_msg_designation_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                $response['message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['error'] = 104;
                $response['message'] = label('api_msg_error_occurred');
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getStates($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_M_GetStateCombobox('101')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['error'] = 200;
                $response['message'] = label('api_msg_state_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                $response['message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['error'] = 104;
                $response['message'] = label('api_msg_error_occurred');
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getCities($data)
    {
        try {
            $response = array();

            if ($data->StateID == '') {
                $response['error'] = 102;
                $response['message'] = 'State not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_GetCity_Combobox('-1','1','','" . $data->StateID . "','-1','1')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_cities_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function checkLogin($data)
    {
        $response = array();
        if (@$data->EmailID == '') {
            $response['error'] = 102;
            $response['message'] = label('api_msg_email_not_found');
        } else if ($data->Password == '') {
            $response['error'] = 102;
            $response['message'] = label('api_msg_password_not_found');
        } else {

            if (!isset($data->NotificationToken)) $data->NotificationToken = '';
            if (!isset($data->DeviceUID)) $data->DeviceUID = '';
            if (!isset($data->DeviceName)) $data->DeviceName = '';
            if (!isset($data->OSVersion)) $data->OSVersion = '';
            if (!isset($data->DeviceType)) $data->DeviceType = '';

            $data->DeviceName = getStringClean($data->DeviceName);

            $_result = $this->master_model->getQueryResult("call usp_CheckLogin('" . $data->EmailID . "','" . fnEncrypt($data->Password) . "')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                $_device = $this->master_model->getInlineQuery("SELECT Fn_M_AddDevice('" .
                    $data->DeviceName . "','" .
                    $data->DeviceUID . "','" .
                    $data->OSVersion . "','" .
                    $data->DeviceTokenID . "','" .
                    $data->DeviceType . "','" .
                    $_result[0]->ID . "','" .
                    $data->DeviceOS . "','" .
                    $data->UserType . "')");

                $response['error'] = 200;
                $response['message'] = label('api_msg_login_successfully');

                $_profile = (array) $this->master_model->getQueryResult("call usp_GetProfileByID('" . $_result[0]->ID . "','" . base_url() . "')");
                $response['data'] = $_profile[0];
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['error'] = ($msg[0] && $msg[0] != 0) ? $msg[0] : '103';
                $response['message'] = @$msg[1];
                $response['data'] = json_decode("{}"); //array(); 
            } else {
                $response['error'] = 104;
                $response['message'] = label('api_msg_error_occurred');
            }
        }
        return $response;
    }

    // Change password for all type of user
    function changePassword($data)
    {
        try {
            $response = array();
            if (@$data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = label('api_msg_user_not_found');
            } elseif (@$data->OldPassword == '') {
                $response['error'] = 102;
                $response['message'] = label('api_msg_old_password_not_found');
            } elseif (@$data->Password == '') {
                $response['error'] = 102;
                $response['message'] = label('api_msg_password_not_found');
            } else {
                $_result = $this->master_model->getQueryResult("call usp_ChangePassword('" . $data->UserID . "','" . fnEncrypt($data->OldPassword) . "','" . fnEncrypt($data->Password) . "')");

                if (isset($_result[0]->Message)) {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = @$msg[1];
                    $response['Password'] = fnEncrypt($data->Password);
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_something_went_wrong');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    // Forgot password for all type of user
    function forgotPassword($data)
    {
        try {
            $response = array();
            if (@$data->EmailID == '') {
                $response['error'] = 102;
                $response['message'] = label('api_msg_email_not_found');
            } else {
                $random_string = str_replace('=', '', base64_encode(date('dHs')));
                $data->random_string = $random_string;
                $forgot_password_result = $this->master_model->getQueryResult("call usp_ForgotPassword('" . $data->EmailID . "')");

                if (isset($forgot_password_result['0']->Password) && $forgot_password_result['0']->Password != '' && isset($forgot_password_result['0']->ID) && $forgot_password_result['0']->ID > 0) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_new_password_send_by_mail');

                    $_profile = (array) $this->master_model->getQueryResult("call usp_GetProfileByID('" . $forgot_password_result[0]->ID . "' ,'" . base_url() . "')");
                    $response['data'] = $_profile['0'];

                    $Content = $this->master_model->get_emailtemplate($id = 1);

                    $array['to'] = $data->EmailID;
                    $array['subject']  = label('msg_lbl_site_title_name') . '- ' . $Content['EmailSubject'];
                    $array['Body'] = $Content['Content'];

                    $array['AltBody'] = '';

                    $image_path = base_url() . DEFAULT_EMAIL_IMAGE . 'login-logo.png';
                    $back_image_path = ''; //base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';  

                    $data1 = array('{site_name}', '{logo}', '{first_name}', '{last_name}', '{back_image}', '{created_password}');

                    $datavalue = array(label('msg_lbl_site_title_name'), $image_path, $_profile['0']->FirstName, $_profile['0']->LastName, $back_image_path, fnDecrypt($_profile['0']->Password));

                    $array['Body'] = str_replace($data1, $datavalue, $array['Body']);

                    $res = CustomMail($array);

                    if ($res == 1) {
                        //Success
                    }
                } elseif (isset($forgot_password_result['0']->Message)) {
                    $msg = explode('~', $forgot_password_result['0']->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_something_went_wrong');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getConfig($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_GetConfig()");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['error'] = 200;
                $response['message'] = label('api_msg_get_config_successfully');
                unset($_result[0]->EmailPassword);
                $response['data'] = $_result[0];
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                $response['message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['error'] = 104;
                $response['message'] = label('api_msg_error_occurred');
            }
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
        }
        return $response;
    }


    function getPage($data)
    {
        try {
            $response = array();

            if (!isset($data->PageName)  || $data->PageName == '') {
                $response['error'] = 102;
                $response['message'] = 'PageName not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_GetCMSPage('','" . $data->PageName . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_customerprocess_listed_successfully');
                    $response['data'] = $_result[0]->Content;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getPageOld()
    {
        $response = array();
        $PageID = @$_GET['PageID'];
        $PageName = @$_GET['PageName'];

        if ($PageID == '' && $PageName == '') {
            $response['error'] = 102;
            $response['message'] = label('api_msg_page_not_found');
        } else {
            $PageID = ($PageID == 0) ? '' : $PageID;

            if ((!isset($PageID) && !isset($PageName)) || ($PageID == '' && $PageName == '')) {
                $PageID = 1;
            }
            if (!isset($PageName)) {
                $PageName = '';
            }

            $page_result = $this->master_model->getQueryResult("call usp_GetCMSPage('" . $PageID . "','" . $PageName . "')");
            if (isset($page_result[0]->CMSID) && $page_result[0]->CMSID > 0  && $page_result[0]->Content != '') {
                echo htmlentities($page_result[0]->Content);
                die;
            }
        }
        echo json_encode($response);
        exit();
    }
    /*** End Api ***/

    function getCustomerProcess($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->CustomerID)  || $data->CustomerID == '') {
                $response['error'] = 102;
                $response['message'] = 'CustomerID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetCustomerProcess('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->CustomerID . "','" .
                    $data->VisitorID . "','1'
                        )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_customerprocess_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function sendReminderMail($data)
    {
        try {
            $response = array();

            if (!isset($data->EmailID)  || $data->EmailID == '') {
                $response['error'] = 102;
                $response['message'] = 'EmailID not found';
            } else if (!isset($data->Subject) || $data->Subject == '') {
                $response['error'] = 102;
                $response['message'] = 'Subject not found';
            } else if (!isset($data->Message) || $data->Message == '') {
                $response['error'] = 102;
                $response['message'] = 'Message not found';
            } else {

                $array['to'] = $data->EmailID;
                $array['subject']  = $data->Subject;
                $array['Body'] = $data->Message;

                $array['AltBody'] = '';

                $_result = CustomMail($array);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_mail_send_successfully');
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function sendReminderSMS($data)
    {
        try {
            $response = array();

            if (!isset($data->MobileNo)  || $data->MobileNo == '') {
                $response['error'] = 102;
                $response['message'] = 'MobileNo not found';
            } else if (!isset($data->Message) || $data->Message == '') {
                $response['error'] = 102;
                $response['message'] = 'Message not found';
            } else {

                $_result = sendSMS($data->MobileNo, $data->Message);
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_message_send_successfully');
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getNotification($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize)  || $data->PageSize == '') {
                $response['error'] = 102;
                $response['message'] = 'PageSize not found';
            } else if (!isset($data->CurrentPage)  || $data->CurrentPage == '') {
                $response['error'] = 102;
                $response['message'] = 'CurrentPage not found';
            } else if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetNotification('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->UserID . "','1'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_notification_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = (int)$_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                    $response['rowcount'] = 0;
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function addVisitorReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID)  || $data->UserID == '') {
                $response['error'] = 102;
                $response['message'] = 'UserID not found';
            } else if (!isset($data->VisitorID)  || $data->VisitorID == '') {
                $response['error'] = 102;
                $response['message'] = 'VisitorID not found';
            } else if (!isset($data->Message)  || $data->Message == '') {
                $response['error'] = 102;
                $response['message'] = 'Message not found';
            } else if (!isset($data->ReminderDate)  || $data->ReminderDate == '') {
                $response['error'] = 102;
                $response['message'] = 'Reminder Date not found';
            } else if (!isset($data->PastDate)  || $data->PastDate == '') {
                $response['error'] = 102;
                $response['message'] = 'Past Date not found';
            } else {

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_A_AddVisitorReminder('" .
                    $data->VisitorID . "','" .
                    $data->UserID . "','1','Android','" .
                    $IP . "','" .
                    $data->Message . "','" .
                    $data->ReminderDate . "','" .
                    $data->PastDate . "'
                    )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_visitorreminder_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getNotes($data)
    {
        try {
            $response = array();

            if (!isset($data->Type)  || $data->Type == '') {
                $response['error'] = 102;
                $response['message'] = 'Type not found';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_A_Notes('" .
                    $data->Type . "','-1'
                )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['error'] = 200;
                    $response['message'] = label('api_msg_notification_listed_successfully');
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['error'] = 104;
                    $response['message'] = label('api_msg_error_occurred');
                }
            }
            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }

    function getRoles($data)
    {
        try {
            $response = array();
            $_result = $this->master_model->getQueryResult("call usp_GetRoles('-1', '1', '')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['error'] = 200;
                $response['message'] = label('api_msg_role_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['error'] = ($msg[0]) ? $msg[0] : '103';
                $response['message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['error'] = 104;
                $response['message'] = label('api_msg_error_occurred');
            }

            return $response;
        } catch (Exception $e) {
            $response['error'] = 104;
            $response['message'] = label('api_msg_something_went_wrong');
            return $response;
        }
    }
}
