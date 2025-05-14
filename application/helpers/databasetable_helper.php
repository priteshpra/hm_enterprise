<?php

/**
 * Purpose : Get Database Table Details
 * Parameters :
 *      @Selected = (optional) pass this parameter if any page needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('GetDatabaseTableArray')) {

    function GetDatabaseTableArray($Name)
    {
        $Database = array(
            "Page" => array(
                "TableName" => "ss_page",
                "UniqueField" => "PageID",
                "DuplicateField" => "PageName",
                "PageName" => "PageName"
            ),
            "Emailttemplate" => array(
                "TableName" => "ss_emailtemplate",
                "UniqueField" => "  EmailTemplateID",
                "DuplicateField" => "EmailTemplateTitle",
                "EmailTemplateTitle" => "EmailTemplateTitle",
                "Content" => "Content"
            ),
            "Employee" => array(
                "TableName" => "ss_user",
                "UniqueField" => "UserID",
                "DuplicateField" => "EmailID",
                "SecondDuplicateField" => "MobileNo",
                "EmailID" => "EmailID",
                "MobileNo" => "MobileNo"
            ),
            "Role" => array(
                "TableName" => "ss_role",
                "UniqueField" => "RoleID",
                "DuplicateField" => "RoleName",
            ),
            "CMS" => array(
                "TableName" => "ss_cms",
                "UniqueField" => "CMSID",
                "PageID" => "PageID",
                "Content" => "Content"
            ),
            "Skill" => array(
                "TableName" => "ssd_skill",
                "UniqueField" => "SkillID",
                "DuplicateField" => "SkillName"
            ),
            "Smstemplate" => array(
                "TableName" => "ss_smstemplate",
                "UniqueField" => "  SMSTemplateID",
                "DuplicateField" => "SmsTemplateTitle",
                "SmsTemplateTitle" => "SmsTemplateTitle"
            ),
            "Reason" => array(
                "TableName" => "ssd_reason",
                "UniqueField" => "ReasonID",
                "DuplicateField" => "Reason",
                "Reason" => "Reason"
            ),
            "Subject" => array(
                "TableName" => "ss_subject",
                "UniqueField" => "SubjectID",
                "DuplicateField" => "Subject",
                "Subject" => "Subject"
            ),
            "Banner" => array(
                "TableName" => "ss_banner",
                "UniqueField" => "BannerID",
                "DuplicateField" => "SequenceNo ",
                "SequenceNo " => "SequenceNo "
            ),
            "Country" => array(
                "TableName" => "ss_country",
                "UniqueField" => "CountryID",
                "DuplicateField" => "CountryName",
                "CountryName" => "CountryName",
                "SortName" => "SortName",
                "MobileCode" => "MobileCode"
            ),
            "State" => array(
                "TableName" => "ss_state",
                "UniqueField" => "StateID",
                "DuplicateField" => "StateName",
                "SecondDuplicateField" => "CountryID",
                "StateName" => "StateName",
                "CountryID" => "CountryID"
            ),
            "City" => array(
                "TableName" => "ss_cities",
                "UniqueField" => "CityID",
                "DuplicateField" => "CityName",
                "SecondDuplicateField" => "StateID",
                "CityName" => "CityName",
                "StateID" => "StateID"
            ),
            "Category" => array(
                "TableName" => "ss_category",
                "UniqueField" => "CategoryID",
                "DuplicateField" => "Category"
            ),
            "SubCategory" => array(
                "TableName" => "ss_subcategory",
                "UniqueField" => "SubCategoryID",
                "DuplicateField" => "SubCategoryName",
                "SubCategoryName" => "SubCategoryName"
            ),
            "Service" => array(
                "TableName" => "ss_service",
                "UniqueField" => "ServiceID",
                "DuplicateField" => "Service",
                "SecondDuplicateField" => "Qty",
                "Service" => "Service",
                "Qty" => "Qty"
            ),
            "Visitor" => array(
                "TableName" => "ss_visitor",
                "UniqueField" => "VisitorID",
                "DuplicateField" => "MobileNo",
                "MobileNo" => "MobileNo"
            ),
            "VisitorReminder" => array(
                "TableName" => "ss_visitorreminder",
                "UniqueField" => "VisitorReminderID"
            ),
            "Usertype" => array(
                "TableName" => "ss_usertype",
                "UniqueField" => "UsertypeID",
                "DuplicateField" => "Usertype"
            ),
            "EmployeeTraining" => array(
                "TableName" => "ss_employeetraining",
                "UniqueField" => "TrainingEmployeeID",
                "DuplicateField" => "TrainingDateTimeID",
                "SecondDuplicateField" => "EmployeeID",
                "TrainingDateTimeID" => "TrainingDateTimeID",
                "EmployeeID" => "EmployeeID"
            ),
            "Customer" => array(
                "TableName" => "ss_customer",
                "UniqueField" => "CustomerID",
                "DuplicateField" => "MobileNo",
                "MobileNo" => "MobileNo"
            ),
            "Sites" => array(
                "TableName" => "ss_sites",
                "UniqueField" => "SitesID"
            ),
            "Document" => array(
                "TableName" => "ss_customersitesdocument",
                "UniqueField" => "CustomerSitesDocumentID"
            ),
            "Quotation" => array(
                "TableName" => "ss_quotation",
                "UniqueField" => "QuotationID"
            ),
            "Training" => array(
                "TableName" => "ss_training",
                "UniqueField" => "TrainingID",
                "DuplicateField" => "Training"
            ),
            "TrainingDateTime" => array(
                "TableName" => "ss_trainingdatetime",
                "UniqueField" => "TrainingDateTimeID"
            ),
            "Penlty" => array(
                "TableName" => "ss_penalty",
                "UniqueField" => "PenaltyID"
            ),
            "PenltyEmployee" => array(
                "TableName" => "ss_penaltyemployee",
                "UniqueField" => "PenaltyEmployeeID"
            ),
            "Inspection" => array(
                "TableName" => "ss_inspection",
                "UniqueField" => "InspectionID"
            ),
            "InspectionAnswer" => array(
                "TableName" => "ss_inspectionanswer",
                "UniqueField" => "InspectionAnswerID"
            ),
            "Ticket" => array(
                "TableName" => "ss_ticket",
                "UniqueField" => "TicketID"
            ),
            "Salary" => array(
                "TableName" => "ss_salary",
                "UniqueField" => "SalaryID"
            ),
        );
        return $Database[$Name];
    }
}
