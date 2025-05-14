<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trainingdatetime_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $TrainingData = getStringClean(($this->input->post('TrainingData') != '') ? $this->input->post('TrainingData') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetTrainingDateTime( '$PageSize' , '$CurrentPage','$TrainingData','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['TrainingID'] = getStringClean((isset($array['TrainingID'])) ? $array['TrainingID'] : '');
        $array['TrainingDate']   = ($array['TrainingDate'] != '') ? GetDateInFormat($array['TrainingDate'],DATE_FORMAT,DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['TrainingTime'] = getStringClean((isset($array['TrainingTime'])) ? $array['TrainingTime'] : '');
        $array['CityID'] = getStringClean((isset($array['CityID'])) ? $array['CityID'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddTrainingDateTime('" .
                $array['TrainingID'] . "','" .
                $array['TrainingDate'] . "','" .
                $array['TrainingTime'] . "','" .
                $array['CityID'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['TrainingID'] = getStringClean((isset($array['TrainingID'])) ? $array['TrainingID'] : '');
        $array['TrainingDate']   = ($array['TrainingDate'] != '') ? GetDateInFormat($array['TrainingDate'],DATE_FORMAT,DATABASE_DATE_FORMAT) : DEFAULT_DATE;
        $array['TrainingTime'] = getStringClean((isset($array['TrainingTime'])) ? $array['TrainingTime'] : '');
        $array['CityID'] = getStringClean((isset($array['CityID'])) ? $array['CityID'] : '');
        $array['StateID'] = (isset($array['StateID'])) ? $array['StateID'] : 0;
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_A_EditTrainingDateTime('" .
                $array['TrainingID'] . "','" .
                $array['TrainingDate'] . "','" .
                $array['TrainingTime'] . "','" .
                $array['CityID'] . "','" .
                $array['ModifiedBy'] . "','" .
                $array['Status'] . "','" .
                $array['ID'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_A_GetTrainingDateTimeByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
}
