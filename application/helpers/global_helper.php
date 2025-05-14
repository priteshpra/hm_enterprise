<?php

/**
 * Page        : Global Helper 
 * Description : For Common helper function
 * Author      : Kunden Dadheech
 **/
/** --1
 * upload image
 * 
 * @access  public
 *  
 * @param string $path Upload directory path
 * @param int $max_size Maximum file size
 * @param int $max_width Maximum file width
 * @param int $max_height Maximum file height
 * @param int $file_name file name to store in database
 * 
 * @return array upload_data
 * @return boolean status 
 * @return boolean error (if exists)
 **/
if (!function_exists('do_upload')) {
    function do_upload($uploadFile, $allowed_types, $path, $file_name, $max_size = '-1', $max_width = '5500', $max_height = '5500')
    {
        $CI = &get_instance();
        $config['file_name'] = $file_name; //time();

        $config['upload_path'] = $path;
        $config['allowed_types'] = $allowed_types;

        $config['max_size'] = $max_size;
        $config['max_width'] = $max_width;
        $config['max_height'] = $max_height;
        $filepath = $path . $file_name;
        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload($uploadFile)) {
            return array('error' => $CI->upload->display_errors(), 'status' => 0);
        } else {
            $upload_data = $CI->upload->data();

            $fullfilename = $upload_data['full_path'];
            return array('status' => 1, 'upload_data' => $CI->upload->data());
        }
    }
}

/** 
 * Purpose : Compress Image
 **/
function compress_image($source_url, $destination_url, $quality)
{
    $info = getimagesize($source_url);
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source_url);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source_url);
    imagejpeg($image, $destination_url, $quality);
    return $destination_url;
}

/** 
 * Purpose : Resize Image Propotionally
 **/
function resize_image_propotinal($SourcePath, $DesPath, $max_width, $max_height, $file_ext)
{

    error_reporting(E_ERROR);
    $exif = exif_read_data($SourcePath);
    if (!empty($exif['Orientation'])) {
        switch (strtolower(trim(trim($file_ext, '.')))) {
            case 'jpeg':
            case 'jpg':
            case 'JPG':
                $imageResource = imagecreatefromjpeg($SourcePath);
                break;
            case 'png':
            case 'PNG':
                $imageResource = imagecreatefrompng($SourcePath);
                break;
            case 'gif':
                $imageResource = imagecreatefromgif($SourcePath);
                break;
            default:
                return false; //exit('Unsupported type: ' . $file_ext);
        } // provided that the image is jpeg. Use relevant function otherwise
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($imageResource, 180, 0);
                break;
            case 6:
                $image = imagerotate($imageResource, -90, 0);
                break;
            case 8:
                $image = imagerotate($imageResource, 90, 0);
                break;
            default:
                $image = $imageResource;
        }
    } else {
        //$image = imagecreatefromjpeg($SourcePath);
        switch (strtolower(trim(trim($file_ext, '.')))) {
            case 'jpeg':
            case 'jpg':
            case 'JPG':
                $image = imagecreatefromjpeg($SourcePath);
                break;
            case 'png':
            case 'PNG':
                $image = imagecreatefrompng($SourcePath);
                break;
            case 'gif':
                $image = imagecreatefromgif($SourcePath);
                break;
            default:
                return false; //exit('Unsupported type: ' . $file_ext);
        }
    }
    imagejpeg($image, $SourcePath, 90);

    //Change orientation

    list($w, $h, $type, $attr) = getimagesize($SourcePath);
    //echo $w.'-'.$h;exit;
    if (!(($w <= $max_width) && ($h <= $max_height))) {
        $ratio = $max_width / $w;
        $new_w = $max_width;
        $new_h = $h * $ratio;

        //if that didn't work
        if ($new_h > $max_height) {
            $ratio = $max_height / $h;
            $new_h = $max_height;
            $new_w = $w * $ratio;
        }
    } else {
        $new_w = $w;
        $new_h = $h;
    }
    $new_image = imagecreatetruecolor($new_w, $new_h);
    $type = explode('.', $SourcePath);
    $pathList = count($type);
    switch (strtolower($type[($pathList - 1)])) {
        case 'jpeg':
        case 'jpg':
        case 'JPG':
            $image = imagecreatefromjpeg($SourcePath);
            break;
        case 'png':
        case 'PNG':
            $image = imagecreatefrompng($SourcePath);
            break;
        case 'gif':
            $image = imagecreatefromgif($SourcePath);
            break;
        default:
            exit('Unsupported type: ' . $SourcePath);
    }
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
    // output
    imagejpeg($new_image, $DesPath, 90);

    return true;
    //resize_image($source_path, $thumb_path, $thumb_width, $thumb_height);
}

// -----------------------------------------------------------------------------------------------------------
/**
 * creates thumbnail image
 * 
 * @access public
 * @param string $sourcePath Uploaded Image path
 * @param string $desPath Path for thumbnail image
 * @param int $width
 * @param int $height
 * 
 * @return  boolean
 */
if (!function_exists('resize_image')) {

    function resize_image($sourcePath, $desPath, $width = '100', $height = '100', $maintain_ratio = FALSE, $extension = "")
    {
        $CI = &get_instance();
        $CI->load->library('image_lib');
        $CI->image_lib->clear();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = $maintain_ratio;
        $config['thumb_marker'] = '';
        $config['width'] = $width;
        $config['height'] = $height;
        $config['overwrite'] = TRUE;
        $config['quality'] = '100';
        $CI->image_lib->initialize($config);

        if ($CI->image_lib->resize()) {
            resize_image_propotinal($sourcePath, $desPath, $width, $height, $extension);
            return true;
        } else {
            echo $CI->image_lib->display_errors();
        }
        return false;
    }
}

/**
 * Purpose : File Upload With Thumb and compress code
 * Parameters :
 **/
if (!function_exists('FileUploadURL')) {

    function FileUploadURL($filename, $input_file, $config, $file_new_name, $url = '', $OldFile = "")
    {

        $CI = &get_instance();

        if ($_FILES[$filename]['name'] != "") {
            $file_new_name = ($file_new_name == '') ? date("YmdHis") . "_" : $file_new_name;
            $file_upload_return = array();
            $file_upload_return = do_upload($filename, $config['allowed_types'], $config['path'], $file_new_name, -1, -1, -1);
            if ($file_upload_return['status'] == 0) {
                if ($url == '') {
                    return '';
                }
                $CI->session->set_flashdata('posterror', getStringClean($file_upload_return['error']));
                redirect($url);
            } else {
                $data = $file_upload_return['upload_data'];
                $file_ = $file_new_name . $data['file_ext'];
                chmod(BASEPATH . '../' . $config['path'] . $file_, 0777);
                $extension_ = str_replace('.', '', $data['file_ext']);
                if ($OldFile != "" && (file_exists(BASEPATH . '../' . $config['path'] . $OldFile))) {
                    unlink(BASEPATH . '../' . $config['path'] . $OldFile);
                }
                if ($data['file_size'] > $config['max_size']) {
                    $tmp_log = ($data['file_size'] / $config['max_size']);
                    if ($tmp_log > 1) {
                        $quality = (100 - $tmp_log);
                        compress_image($source_path, $source_path, $quality);
                    }
                }
                if (in_array($extension_, array('png', 'jpg', 'jpeg')) && isset($config['path'])) {
                    $source_path = $config['path'] . $file_;
                    $thumb_path = $config['tpath'] . $file_;
                    $thumb_width = $config['twidth'];
                    $thumb_height = $config['theight'];
                    if ($OldFile != "" && (file_exists(BASEPATH . '../' . $config['tpath'] . $OldFile))) {
                        unlink($config['tpath'] . $OldFile);
                    }
                    resize_image_propotinal($source_path, $thumb_path, $thumb_width, $thumb_height, $data['file_ext']);
                    chmod(BASEPATH . '../' . $config['tpath'] . $file_, 0777);
                }
                return $file_;
            }
        } else {
            return $CI->input->post($input_file);
        }
    }
}

/**
 * Purpose : For performing the encryption.
 * Parameters :
 *      $sValue = value of text box.
 *      $sSecretKey = secret key to perform encryption
 **/
if (!function_exists('fnEncrypt')) {

    function fnEncrypt($sValue, $sSecretKey = NULL)
    {
        $CI = &get_instance();
        $sSecretKey = ($sSecretKey) ? $sSecretKey : $CI->config->item('sSecretKey');
        return openssl_encrypt($sValue, "AES-128-ECB", $sSecretKey);
    }
}

/**
 * Purpose : For performing the decryption.
 * Parameters :
 *      $sValue = value of text box.
 *      $sSecretKey = secret key to perform decryption
 **/
if (!function_exists('fnDecrypt')) {

    function fnDecrypt($sValue, $sSecretKey = NULL)
    {
        $CI = &get_instance();
        $sSecretKey = ($sSecretKey) ? $sSecretKey : $CI->config->item('sSecretKey');
        return openssl_decrypt($sValue, "AES-128-ECB", $sSecretKey);
    }
}

/**
 * Purpose : Mail
 * Parameters : Array (From Email Id, From Name, Reply Email Id, Replay Name, Subject , Body, AltBody)
 * Required: Load phpmailerautoload_helper helper
 **/
if (!function_exists('SendMail')) {
    function SendMail($array)
    {
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = "localhost";
        // $mail->Host = "ssl://smtp.gmail.com";
        $mail->SMTPAuth = false;
        $mail->Username = "";  // if SMTPAuth is true
        $mail->Password = ""; // if SMTPAuth is true
        $mail->setFrom($array['FromEmailID'], $array['FromName']); // if SMTPAuth is false;
        $mail->addReplyTo($array['ReplyEmailID'], $array['ReplayName']);
        $mail->addAddress($array['ToEmailID']); //, 'John Doe'
        $mail->Subject = $array['Subject'];
        $mail->Body = $array['Body'];
        $mail->AltBody = $array['AltBody'];
        $mail->IsHTML(true);
        if (!$mail->send()) {
            return 0;
        } else {
            return 1;
        }
    }
}

/**
 * Purpose : Generate PDF 
 * Parameters : $array("Title","Html","FileName")
 * Required: Load Pdf library 
 **/
if (!function_exists('GeneratePDF')) {
    function GeneratePDF($array)
    {
        $CI = &get_instance();
        $CI->load->library("Pdf");
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(PDF_AUTHOR);
        $pdf->SetTitle($array['Title']);
        $pdf->SetSubject($array['Title']);
        $pdf->SetKeywords('');

        // set default header data
        $pdf->SetHeaderData('', '', $array['Title'], '', array(43, 45, 55), array(219, 171, 131));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('helvetica', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        // Set some content to print
        $html = $array['Html'];

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------    
        $name = $array['FileName'] . time() . ".pdf";
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output($name, 'D');
    }
}

/**
 * Purpose : Clear String, input From user.
 * Parameters : String
 * Return : String
 **/
if (!function_exists('getStringClean')) {

    function getStringClean($string)
    {
        $CI = &get_instance();
        $string = $CI->db->escape_str($string);
        return $string;
    }
}

/**
 * Purpose : Get User Agent Details
 * Parameters : 
 * Return : Json Format
 **/
if (!function_exists('getUserAgent')) {

    function getUserAgent()
    {
        $CI = &get_instance();
        $array = array();
        $array['ip_address'] = $CI->input->server("REMOTE_ADDR");
        $array['User_detail'] = $CI->input->server("HTTP_USER_AGENT");
        $array['Query_string'] = $CI->input->server("QUERY_STRING");
        $array['Real_ip'] = @$CI->input->server("HTTP_X_REAL_IP");
        return json_encode($array);
    }
}

/**
 * Purpose : To get detail about record like createdBy, modifiedBy, modifiedDate and createdDate
 * Parameters :
 *      $ID = ID of particular record
 *      $Table = name of the table
 *      $Field = field name in the table
 **/
if (!function_exists('getRecordTrack')) {

    function getRecordTrack($ID, $Table, $Field)
    {
        $CI = &get_instance();

        $sql = "SELECT 
        (Fn_A_ChangeDateTimeFormat(t.CreatedDate)) as CreatedDate, 
        (Fn_A_ChangeDateTimeFormat(t.ModifiedDate)) as ModifiedDate, 
        (Fn_GetUserNameByUserID(t.CreatedBy)) AS CreatedBy, 
        (Fn_GetUserNameByUserID(t.ModifiedBy)) AS ModifiedBy
        FROM $Table t
        WHERE t.$Field = $ID";
        $query = $CI->db->query($sql);
        return $query->row();
    }
}
/**
 * Purpose : To print_r
 * Parameters :
 *      $array_variable = name of array variable
 *      $exit = after it do exit or not
 **/
if (!function_exists('pr')) {

    function pr($array_variable = null, $exit = 0)
    {
        echo '<pre>';
        print_r($array_variable);
        echo '</pre>';

        if ($exit) {
            exit;
        }
    }
}

if (!function_exists('getLoadingButton')) {

    function getLoadingButton()
    {
        $CI = &get_instance();
        return $CI->load->view('common_view_files/submit_button_loading', NULL, TRUE);
    }
}
/**
 * Purpose : lang_translate
 * Parameters :
 *      label
 **/
if (!function_exists('label')) {
    function label($label)
    {
        $CI = &get_instance();
        $CI->session->set_userdata('language', 'english');
        $language = @$CI->session->userdata('language');
        if ($language == 'gujarati') {
            $CI->lang->load('common_lang', 'gujarati');
        } else {
            $CI->lang->load('common_lang', 'english');
        }
        $return = $CI->lang->line($label);
        if ($return)
            return $return;
        else {
            if ($language == 'gujarati') {
                $CI->lang->load('message_lang', 'gujarati');
            } else {
                $CI->lang->load('message_lang', 'english');
            }
            $return = $CI->lang->line($label);
            if ($return) {
                return $return;
            } else {
                $CI->lang->load('api_message_lang', 'english');

                $return = $CI->lang->line($label);
                if ($return) {
                    return $return;
                } else {
                    return str_replace("_", " ", $label);
                }
            }
        }
    }
}
/**
 * Purpose : To GetIP
 * Parameters :
 *      $array_variable = name of array variable
 *      $exit = after it do exit or not    
 **/
if (!function_exists('GetIP')) {

    function GetIP()
    {
        $CI = &get_instance();
        return $CI->input->server("REMOTE_ADDR");
    }
}

/**
 * Purpose : generate OTP
 * Parameters :
 *      label
 **/
function generateOTP($length = 4)
{
    $characters = '123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    if (strlen($randomString) != $length)
        generateOTP($length);
    //return $randomString;
    return str_pad($randomString, 4, '0', STR_PAD_RIGHT);
}

/**
 * Purpose : generate random string for Password / etc
 **/
if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 6)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

/**
 * This function will make the actuall curl request to firebase server
 * and then the message is sent 
 **/
if (!function_exists('sendPushNotification')) {
    //Define sendPushNotification function
    function sendPushNotification($dataArr)
    {
        // POST values
        $token= $dataArr['device_id'];
        $title= $dataArr['title'];
        $message= $dataArr['message'];
        $actionType = $dataArr['ActionType'];
        $event = $dataArr['event'];
        $detail= $dataArr['detail'];

        $token = htmlspecialchars($token,ENT_COMPAT);
        $title = htmlspecialchars($title,ENT_COMPAT);
        $message = htmlspecialchars($message,ENT_COMPAT);
        $actionType = htmlspecialchars($actionType,ENT_COMPAT);
        $event = htmlspecialchars($event,ENT_COMPAT);
        $detail = htmlspecialchars($detail,ENT_COMPAT);

        $info_data = array(
            "title" => "$title", 
            "message" => "$message",
            "event" => "$event",
            "id" => "0",
            "text" => "",
            "actionType" => "$actionType",
            "detail" => "$detail"
        );
        // Push Data's
        $data = array(
            "to" => "$token",
            /* "notification" => array(
                "title" => "$title", 
                "body" => "$message", 
                "icon" => base_url(DEFAULT_WEBSITE_FAVICON),
                //this data is not working but it is stll there....
                "click_action" => "$event"
            ), */
            /* "android" => array(
                "notification"=> array(
                    "click_action" => "$event"
                )
            ), */
            "data" => $info_data
        );
        // FCM API Token URL
        $url = "https://fcm.googleapis.com/fcm/send";

        //Curl Headers
        $headers = array
        (
            'Authorization: key=' . FIREBASE_API_KEY, 
            'Content-Type: application/json'
        );  

        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, $url);                                                                 
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($data));                                                                  
                                                                                                                            
        // Variable for Print the Result
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}


if (!function_exists('sendPushNotification111')) {
    //Define sendPushNotification function
    function sendPushNotification111($dataArr)
    {

        $url        = 'http://fcm.googleapis.com/fcm/send'; //Google URL

        $registrationIds = array($dataArr['device_id']); //Fcm Device ids array

        $detail             = $dataArr;
        $detail['message']  = $dataArr['message'];
        $detail['title']    = $dataArr['title'];
        $detail['ActionType'] = $dataArr['ActionType'];
        $fields = array(
            'registration_ids'  => $registrationIds,
            'data'      => array('data' => $detail),
            'priority'          => 'high',
            'content_available' => true
        );

        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        curl_close($ch); //Now close the connection

        return $result; //and return the result 
    }
}


/**
 * This function will make the actuall curl request to firebase server
 * and then the message is sent 
 **/
if (!function_exists('sendSMS')) {
    function sendSMS($MobileNo, $MsgText)
    {

        $url = "http://sms.sms4u.co.in/sendurlcomma.aspx?user=20090993&pwd=k44r6i&senderid=ABC&mobileno=" . $MobileNo . "&msgtext=" . urlencode($MsgText);

        $headers = array(
            // 'Authorization: key=' . FIREBASE_API_KEY,
            // 'Content-Type: application/json'
        );

        $fields = array();

        //Initializing curl to open a connection
        $ch = curl_init();

        //Setting the curl url
        curl_setopt($ch, CURLOPT_URL, $url);
        //setting the method as post
        curl_setopt($ch, CURLOPT_POST, true);

        //adding headers 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //disabling ssl support
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //adding the fields in json format 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        //finally executing the curl request 
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return array('Status' => 0, 'Message' => 'Curl failed: ' . curl_error($ch));
            // die('Curl failed: ' . curl_error($ch)); 
        }

        curl_close($ch); //Now close the connection

        return array('Status' => 1, 'data' => $result); //and return the result 
    }
}

/**
 * Purpose : For Date Time
 * Parameters :
 *      @Selected = (optional) pass this parameter if any date needs to be pre-selected
 **/
if (!function_exists('GetDateTimeInFormat')) {
    function GetDateTimeInFormat($Date, $CurDateFormay = DATABASE_DATE_TIME_FORMAT, $Convert_Format = DATE_TIME_FORMAT)
    {
        $r_date = DateTime::createFromFormat($CurDateFormay, $Date);
        $n_date = $r_date->format($Convert_Format);
        return $n_date;
    }
}

/**
 * Purpose : For Date
 * Parameters :
 *      @Selected = (optional) pass this parameter if any date needs to be pre-selected*
 **/
if (!function_exists('GetDateInFormat')) {
    function GetDateInFormat($Date, $CurDateFormay = DATABASE_DATE_FORMAT, $Convert_Format = DATE_FORMAT)
    {
        $r_date = DateTime::createFromFormat($CurDateFormay, $Date);
        $n_date = $r_date->format($Convert_Format);
        return $n_date;
    }
}

/**
 * Purpose : Remove Space
 * Parameters : String
 **/
if (!function_exists('RemoveSpace')) {
    function RemoveSpace($String)
    {
        return str_replace(" ", "_", $String);
    }
}
/**
 * Purpose : For Salary(Comma)
 * Parameters :
 *      @Selected = (optional) pass this parameter if any salary needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('SalaryComma')) {
    function SalaryComma($Salary)
    {
        setlocale(LC_MONETARY, 'en_IN');
        // $Salary = money_format('%!.0i', $Salary);
        $Salary = moneyFormatIndia($Salary);
        return $Salary;
    }
}
function moneyFormatIndia($num)
{
    $explrestunits = "";
    if (strlen($num) > 3) {
        $lastthree = substr($num, strlen($num) - 3, strlen($num));
        $restunits = substr($num, 0, strlen($num) - 3); // extracts the last three digits
        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for ($i = 0; $i < sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if ($i == 0) {
                $explrestunits .= (int) $expunit[$i] . ","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i] . ",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}
if (!function_exists('getExtensionFromFile')) {
    function getExtensionFromFile($Str)
    {
        $pos = strrpos('index.php', '.');
        $ext = substr('index.php', $pos);
        return $ext;
    }
}

/* Number to word */
if (!function_exists('numberTowords')) {
    function numberTowords($number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'ONE', 2 => 'TWO',
            3 => 'THREE', 4 => 'FOUR', 5 => 'FIVE', 6 => 'SIX',
            7 => 'SEVEN', 8 => 'EIGHT', 9 => 'NINE',
            10 => 'TEN', 11 => 'ELEVEN', 12 => 'TWELVE',
            13 => 'THIRTEEN', 14 => 'FOURTEEN', 15 => 'FIFTEEN',
            16 => 'SIXTEEN', 17 => 'SEVENTEEN', 18 => 'EIGHTEEN',
            19 => 'NINETEEN', 20 => 'TWENTY', 30 => 'THIRTY',
            40 => 'FORTY', 50 => 'FIFTY', 60 => 'SIXTY',
            70 => 'SEVENTY', 80 => 'EIGHTY', 90 => 'NINETY');
        $digits = array('', 'HUNDRED','THOUSAND','LAKH', 'CRORE');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 'S' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' AND ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' PAISE' : '';
        return ($Rupees ? $Rupees . 'RUPEES ' : '') . $paise . ' ONLY';
        /*
        $ones = array(
            0 => "ZERO",
            1 => "ONE",
            2 => "TWO",
            3 => "THREE",
            4 => "FOUR",
            5 => "FIVE",
            6 => "SIX",
            7 => "SEVEN",
            8 => "EIGHT",
            9 => "NINE",
            10 => "TEN",
            11 => "ELEVEN",
            12 => "TWELVE",
            13 => "THIRTEEN",
            14 => "FOURTEEN",
            15 => "FIFTEEN",
            16 => "SIXTEEN",
            17 => "SEVENTEEN",
            18 => "EIGHTEEN",
            19 => "NINETEEN",
            "014" => "FOURTEEN"
        );
        $tens = array(
            0 => "ZERO",
            1 => "TEN",
            2 => "TWENTY",
            3 => "THIRTY",
            4 => "FORTY",
            5 => "FIFTY",
            6 => "SIXTY",
            7 => "SEVENTY",
            8 => "EIGHTY",
            9 => "NINETY"
        );
        $hundreds = array(
            "HUNDRED",
            "THOUSAND",
            "MILLION",
            "BILLION",
            "TRILLION",
            "QUARDRILLION"
        );
        $num = number_format($num, 2, ".", ",");
        $num_arr = explode(".", $num);
        $wholenum = $num_arr[0];
        $decnum = $num_arr[1];
        $whole_arr = array_reverse(explode(",", $wholenum));
        krsort($whole_arr, 1);
        $rettxt = "";
        
        foreach ($whole_arr as $key => $i) {

            while (substr($i, 0, 1) == "0")
                $i = substr($i, 1, 5);
            if ($i < 20) {
                $rettxt .= $ones[$i];
            } elseif ($i < 100) {
                if (substr($i, 0, 1) != "0")  $rettxt .= $tens[substr($i, 0, 1)];
                if (substr($i, 1, 1) != "0") $rettxt .= " " . $ones[substr($i, 1, 1)];
            } else {
                if (substr($i, 0, 1) != "0") $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
                if (substr($i, 1, 1) != "0") $rettxt .= " " . $tens[substr($i, 1, 1)];
                if (substr($i, 2, 1) != "0") $rettxt .= " " . $ones[substr($i, 2, 1)];
            }
            if ($key > 0) {
                $rettxt .= " " . $hundreds[$key] . " ";
            }
        }
        if ($decnum > 0) {
            $rettxt .= " and ";
            if ($decnum < 20) {
                $rettxt .= $ones[$decnum];
            } elseif ($decnum < 100) {
                $rettxt .= $tens[substr($decnum, 0, 1)];
                $rettxt .= " " . $ones[substr($decnum, 1, 1)];
            }
        }
        return $rettxt;
        */
    }
}
