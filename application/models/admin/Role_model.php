<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $RoleName = getStringClean(($this->input->post('RoleName') != '') ? $this->input->post('RoleName') : '');
        $sql = "call usp_GetRoles( '$PageSize' , '$CurrentPage','$RoleName')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['Name'] = getStringClean(isset($array['Name']) ? $array['Name'] : NULL);
        $array['Description'] = getStringClean(isset($array['Description']) ? $array['Description'] : NULL);
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $sql = "CALL usp_AddRoles('" . 
            $array['Name'] . "','" . 
            $array['Description'] . "','" . 
            $array['CreatedBy'] . "','".
            $array['UserType']."','".
            $array['IPAddress']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        $result = $query->row();
        $roleid = $result->ID;
        $parent_modules = $this->getParentModules();
        $array['query'] = "";
        foreach ($parent_modules as $parent) {
            $sub_modules = $this->getSubModules($parent->ModuleID);
            
            if ($this->input->post("master_" . $parent->ModuleID)) {
                $child_q = "";
                $cnt = $this->input->post("cnt_" . $parent->ModuleID);
                $flag = 0;
                foreach ($sub_modules as $child) {
                    $insert = $edit = $status = $export = 0;
                    $view = 1;
                    //echo $child->ModuleID;exit;
                    if ($this->input->post("m_" . $child->ModuleID)) {
                       if ($this->input->post("insert" . $child->ModuleID)) {
                            $insert = 1;
                        }
                        if ($this->input->post("edit" . $child->ModuleID)) {
                            $edit = 1;
                        }
                        if ($this->input->post("status" . $child->ModuleID)) {
                            $status = 1;
                        }
                        if ($this->input->post("export" . $child->ModuleID)) {
                            $export = 1;
                        }
                        if ($edit == 1 && $status == 1 && $export == 1) {
                            $flag++;
                        }
                        $child_q .= "($roleid,$child->ModuleID,$view,$insert,$edit,$status,$export," . $array['CreatedBy'] . "),";
                    }
                }
                if ($child_q != "") {
                    if ($flag == $cnt) {
                        $flag = 1;
                    } else {
                        $flag = 0;
                    }
                    $child_q = "($roleid,$parent->ModuleID,1,$flag,0,0,0," . $array['CreatedBy'] . ")," . $child_q;
                }
                $array['query'] .= $child_q;
            }
        }
        $array['query'] = trim($array['query'], ',');
        $sql = "CALL usp_AddRoleMapping('" . 
                    $array['query'] . "', " . 
                    $array['CreatedBy'] . ",'".
                    $array['UserType']."','".
                    $array['IPAddress'].
                    "',$roleid)";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function Update($array) {
        $array['Name'] = getStringClean(isset($array['Name']) ? $array['Name'] : NULL);
        $array['Description'] = getStringClean(isset($array['Description']) ? $array['Description'] : NULL);
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "CALL usp_EditRoles('" . 
                    $array['Name'] . "','" . 
                    $array['Description'] . "','" . 
                    $array['ModifiedBy'] . "','1','" . 
                    $array['ID'] . "','".
                    $array['UserType']."','".
                    $array['IPAddress']."');";
        $query = $this->db->query($sql);
        $query->next_result();
        $result = $query->row();
        $roleid = $result->ID;
        $parent_modules = $this->getParentModules();

        $array['query'] = "";
        foreach ($parent_modules as $parent) {
            $sub_modules = $this->getSubModules($parent->ModuleID);
            if ($this->input->post("master_" . $parent->ModuleID)) {
                $child_q = "";
                $cnt = $this->input->post("cnt_" . $parent->ModuleID);
                $flag = 0;
                foreach ($sub_modules as $child) {
                    $insert = $edit = $status = $export = 0;
                    $view = 1;
                    if ($this->input->post("m_" . $child->ModuleID)) {
                        if ($this->input->post("insert" . $child->ModuleID)) {
                            $insert = 1;
                        }
                        if ($this->input->post("edit" . $child->ModuleID)) {
                            $edit = 1;
                        }
                        if ($this->input->post("status" . $child->ModuleID)) {
                            $status = 1;
                        }
                        if ($this->input->post("export" . $child->ModuleID)) {
                            $export = 1;
                        }
                        if ($edit == 1 && $status == 1 && $export == 1) {
                            $flag++;
                        }
                        $child_q .= "($roleid,$child->ModuleID,$view,$insert,$edit,$status,$export," . $array['ModifiedBy'] . "),";
                    }
                }
                if ($child_q != "") {
                    if ($flag == $cnt) {
                        $flag = 1;
                    } else {
                        $flag = 0;
                    }
                    $child_q = "($roleid,$parent->ModuleID,1,$flag,0,0,0," . $array['ModifiedBy'] . ")," . $child_q;
                }
                $array['query'] .= $child_q;
            }
        }
        $array['query'];
        $usertype = $this->session->userdata['UserType'] . 'Web';
        $IPAddress = GetIP();
        $array['query'] = trim($array['query'], ',');
        $query = "CALL usp_AddRoleMapping('" . 
                    $array['query'] . "', " . 
                    $array['ModifiedBy'] . ",". 
                    $array['ID'] . ",'".
                    $array['UserType']."','".
                    $array['IPAddress']."')";
        $query = $this->db->query($query);
        $query->next_result();
        return $query->row();
    }

    function GetByID($id = null) {
        $query = $this->db->query("CALL usp_GetRolesByID($id)");
        $query->next_result();
        return $query->row();
    }

    function getParentModules($id = -1) {
        $sql = "call usp_GetParentModules('$id')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function getSubModules($parent_id = Null) {
        $sql = "call usp_GetSubModules('" . $parent_id . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function getChildModules($id = -1) {
        $sql = "call usp_GetChildModules('$id')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    function listRoleMapping($PageSize = 10, $CurrentPage = 1) {
        $RoleID = ($this->input->post('RoleID') != '') ? $this->input->post('RoleID') : -1;
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_GetRoleListing( '$PageSize' , '$CurrentPage','$RoleID','$Status' )";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRoleComboBox() {
        $query = $this->db->query("call usp_GetRole_ComboBox()");
        $query->next_result();
        return $query->result();
    }

}
