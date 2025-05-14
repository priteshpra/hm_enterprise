    <?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Subject_model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        function ListData($PageSize = 10, $CurrentPage = 1) {
            $Subject = getStringClean(($this->input->post('Subject') != '') ? $this->input->post('Subject') : '');
            $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
            $sql = "call usp_A_GetSubject( '$PageSize','$CurrentPage','$Subject','$Status' )";
            $query = $this->db->query($sql);
            $query->next_result();
            return $query->result();
        }

        function Insert($array) {
            $array['Subject'] = getStringClean((isset($array['Subject'])) ? $array['Subject'] : '');
            $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
            $array['CreatedBy'] = $this->session->userdata['UserID'];
            $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
            $array['IPAddress'] = GetIP();
            $sql = "call usp_A_AddSubject('" .
                    $array['Subject'] . "','" .
                    $array['CreatedBy'] . "','" .
                    $array['Status'] . "','".
                    $array['UserType']."','".
                    $array['IPAddress']."')";
            $query = $this->db->query($sql);
            $query->next_result();
            return $query->row();
        }

        public function Update($array) {
            $array['Subject'] = getStringClean((isset($array['Subject'])) ? $array['Subject'] : '');
            $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
            $array['ModifiedBy'] = $this->session->userdata['UserID'];
            $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
            $array['IPAddress'] = GetIP();
            $sql ="call usp_A_EditSubject('" .
                    $array['Subject'] . "','" .
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
            $sql = "call usp_A_GetSubjectByID('$ID')";
            $query = $this->db->query($sql);
            $query->next_result();
            return $query->row();
        }   
    }
