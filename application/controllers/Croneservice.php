<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Croneservice extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('api/master_model', '', TRUE);
        $this->load->model('admin/visitor_model');
    }

    public function visitorremindernofity()
    {
        $Current = date("Y-m-d H:i");
        $data = $this->master_model->getQueryResult("call usp_A_GetVisitorReminderByTime('-1','1','-1','1','" .
            $Current . "')");
        if (isset($data['0']->VisitorReminderID)) {
            $datastr = '';
            foreach ($data as $key => $value) {
                $datastr .= 'Visitor of ' . $value->VisitorName . ' (' . @$value->MobileNo . ')' . ' has new reminder (' . $value->Message . ')';

                $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                    $value->ReminderBy . "')");

                if (!isset($EmployeeData['0']->Message)) {
                    foreach ($EmployeeData as $key => $devicevalue) {
                        $pushNotificationArr = array(
                            'device_id' => $devicevalue->DeviceTokenID,
                            'message' =>  $datastr,
                            'title' => 'Visitor Reminder',
                            'event' => '',
                            'ActionType' => '',
                            'detail' => ''
                        );
                        $res = sendPushNotification($pushNotificationArr);
                    }
                }
            }
        }
    }
}
