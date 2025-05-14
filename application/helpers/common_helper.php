<?php

/**
 * Purpose : drop-down box of Pages
 * Parameters :
 *      @Selected = (optional) pass this parameter if any page needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getPageCombobox')) {

    function getPageCombobox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/page_model');
            $res = $CI->page_model->GetByID($Selected);
            $data['SelectedName'] = $res->PageName;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/page_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of User
 * Parameters :
 *      @Selected = (optional) pass this parameter if any user needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getUser')) {

    function getUser($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/employee_model');
            $res = $CI->employee_model->GetByID($Selected);
            $data['SelectedName'] = $res->FirstName . " " . $res->LastName;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/user_combo_box', $data, TRUE);
    }
}
if (!function_exists('getUserByDate')) {
    function getUserByDate($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/employee_model');
            $res = $CI->employee_model->GetByID($Selected);
            $data['SelectedName'] = $res->FirstName . " " . $res->LastName;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/user_by_date_combo_box', $data, TRUE);
    }
}
/**
 * Purpose : drop-down box of Role
 * Parameters :
 *      @Selected = (optional) pass this parameter if any role needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getRoleComboBox')) {

    function getRoleComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/role_model');
            $res = $CI->role_model->GetByID($Selected);
            $data['SelectedName'] = $res->RoleName;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/roles_combo_box', $data, TRUE);
    }
}


/**
 * Purpose : drop-down box of Skill
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Skill needs to be pre-selected
 * Developer : Upexa
 */

if (!function_exists('getSkillComboBox')) {
    function getSkillComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/skill_model');
            $res = $CI->skill_model->GetByID($Selected);
            $data['SelectedName'] = $res->SkillName;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/doctor_skill_combo_box', $data, TRUE);
    }
}

if (!function_exists('getCountryComboBox')) {
    function getCountryComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/country_model');
            $res = $CI->country_model->GetByID($Selected);
            $data['SelectedName'] = $res->CountryName;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/country_combo_box', $data, TRUE);
    }
}

if (!function_exists('getStateComboBox')) {
    function getStateComboBox($Selected = 0, $CountryID = 0, $OnlyCombo = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/state_model');
            $res = $CI->state_model->GetByID($Selected);
            $data['SelectedName'] = $res->StateName;
        }
        $data['Selected'] = $Selected;
        $data['OnlyCombo'] = $OnlyCombo;
        return $CI->load->view('common_view_files/state_combo_box', $data, TRUE);
    }
}

if (!function_exists('getCityComboBox')) {
    function getCityComboBox($Selected = 0, $StateID = 0, $OnlyCombo = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/city_model');
            $res = $CI->city_model->GetByID($Selected);
            $data['SelectedName'] = $res->CityName;
        }
        $data['Selected'] = $Selected;
        $data['OnlyCombo'] = $OnlyCombo;
        return $CI->load->view('common_view_files/city_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Category
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Category needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getCategoryComboBox')) {
    function getCategoryComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/category_model');
            $res = $CI->category_model->GetByID($Selected);
            $data['SelectedName'] = $res->Category;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/category_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Sub Category
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Sub Category needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getSubCategoryComboBox')) {
    function getSubCategoryComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/subcategory_model');
            $res = $CI->subcategory_model->GetByID($Selected);
            $data['SelectedName'] = $res->SubCategoryName;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/subcategory_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Service
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Service needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getServiceComboBox')) {
    function getServiceComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/service_model');
            $res = $CI->service_model->GetByID($Selected);
            $data['SelectedName'] = $res->Service;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/service_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Company
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Company needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getCompanyComboBox')) {
    function getCompanyComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/company_model');
            $res = $CI->company_model->GetByID($Selected);
            $data['SelectedName'] = $res->CompanyName;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/company_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Usertype
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Usertype needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getSubjectComboBox')) {
    function getSubjectComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/subject_model');
            $res = $CI->subject_model->GetByID($Selected);
            $data['SelectedName'] = $res->Subject;
        }
        $data['Selected'] = $Selected;

    return $CI->load->view('common_view_files/subject_combo_box', $data, TRUE);
    }
}
if (!function_exists('getUsertypeComboBox')) {
    function getUsertypeComboBox($Selected = 0, $isMaterial=0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/usertype_model');
            $res = $CI->usertype_model->GetByID($Selected);
            $data['SelectedName'] = $res->Usertype;
            $data['Rate'] = @$res->Rate;
            $data['HSNNo'] = @$res->HSNNo;
        }
        $data['Selected'] = $Selected;

        return $CI->load->view('common_view_files/usertype_combo_box', $data, TRUE);
    }
}
if (!function_exists('getUsertypeMaterialComboBox')) {
    function getUsertypeMaterialComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/usertype_model');
            $res = $CI->usertype_model->GetByID($Selected);
            $data['SelectedName'] = $res->Usertype;
            $data['Rate'] = @$res->Rate;
            $data['HSNNo'] = @$res->HSNNo;
        }
        $data['Selected'] = $Selected;

        return $CI->load->view('common_view_files/usertype_material_combo_box', $data, TRUE);
    }
}
if (!function_exists('getUserComboBox')) {
    function getUserComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/employee_model');
            $res = $CI->employee_model->GetByID($Selected);
            $data['SelectedName'] = $res->Usertype;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/user_combo_box_single', $data, TRUE);
    }
}
/**
 * Purpose : drop-down box of User By UserType
 * Parameters :
 *      @Selected = (optional) pass this parameter if any  User By UserType needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getUserByUsertypeComboBox')) {
    function getUserByUsertypeComboBox($ID, $Type, $Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/employee_model');
            $res = $CI->employee_model->GetByID($Selected);
            $data['SelectedName'] = $res->FirstName . " " . $res->LastName;
        }
        $data['ID'] = $ID;
        $data['Type'] = $Type;
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/userbyusertype_combo_box', $data, TRUE);
    }
}
/**
 * Purpose : drop-down box of Customer
 * Parameters :
 *      @Selected = (optional) pass this parameter if any  Customer needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getCustomerComboBox')) {
    function getCustomerComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/customer_model');
            $res = $CI->customer_model->GetByID($Selected);
            $data['SelectedName'] = $res->Name;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/customer_combo_box', $data, TRUE);
    }
}
/**
 * Purpose : drop-down box of Sites
 * Parameters :
 *      @Selected = (optional) pass this parameter if any  Sites needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getSitesComboBox')) {
    function getSitesComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/site_model');
            $res = $CI->site_model->GetByID($Selected);
            $data['SelectedName'] = $res->SitesName;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/site_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Quotation
 * Parameters :
 *      @Selected = (optional) pass this parameter if any  Quotation needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getQuotationComboBox')) {
    function getQuotationComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        if ($Selected != 0) {
            $CI->load->model('admin/quotation_model');
            $res = $CI->quotation_model->GetByID($Selected);
            $data['SelectedName'] = $res->QuotationName;
        }
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/quotation_combo_box', $data, TRUE);
    }
}
