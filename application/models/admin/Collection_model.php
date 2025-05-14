<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Collection_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($array=array()) {
        $FECode = (@$array['FECode'] != '') ? @$array['FECode'] : '';
        $CenterName = (@$array['CenterName'] != '') ? @$array['CenterName'] : '';
        $CenterID = (@$array['CenterID'] != '') ? @$array['CenterID'] : '';
        $LoanID = (@$array['LoanID'] != '') ? @$array['LoanID'] : '';
        $ClientID = (@$array['ClientID'] != '') ? @$array['ClientID'] : '';
        $ClientName = (@$array['ClientName'] != '') ? @$array['ClientName'] : '';
        $CollectionType = (@$array['CollectionType'] != '') ? @$array['CollectionType'] : 'All';
        $Status = (@$array['Status'] != '') ? @$array['Status'] : -1;
        
        $PageSize = (@$array['PageSize'] != '') ? @$array['PageSize'] : '-1';
        $CurrentPage = (@$array['CurrentPage'] != '') ? @$array['CurrentPage'] : '1';
        $sql = "call usp_A_GetCollection('$PageSize', '$CurrentPage','$FECode','$CenterName','$CenterID','$LoanID','$ClientID','$ClientName','$CollectionType','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    
    public function getCenters($array=array()) {
        $Status = (@$array['Status'] != '') ? $array['Status'] : -1;
        $Type = (@$array['Type'] != '') ? $array['Type'] : 'All';

        /* if($Type=="Collected") {
            $sql = "SELECT CenterName FROM ss_collection C WHERE C.OriginalDemand = C.OriginalCollection ORDER BY C.CenterName ASC";    
        } else if($Type=="Pending") {
            $sql = "SELECT CenterName FROM ss_collection C WHERE C.OriginalCollection = 0 ORDER BY C.CenterName ASC";    
        } else if($Type=="Partialy") {
            $sql = "SELECT CenterName FROM ss_collection C WHERE (C.OriginalCollection > 0 AND C.OriginalCollection < OriginalDemand) ORDER BY C.CenterName ASC";    
        } else { // if($Type=="All") {
            $sql = "SELECT CenterName FROM ss_collection C WHERE C.OriginalDemand = C.OriginalCollection ORDER BY C.CenterName ASC";
        }
        echo $sql; */
        $sql = "call usp_A_GetCollectionCenter('$Status','$Type')";
        $query = $this->db->query($sql);
        //$query->next_result();
        return $query->result();
    }
    
    public function getFECollection($array=array()) {
        $FECode = (@$array['FECode'] != '') ? @$array['FECode'] : '';
        $CollectionType = (@$array['CollectionType'] != '') ? @$array['CollectionType'] : '';
        $StartDate = (@$array['StartDate'] != '') ? @$array['StartDate'] : date('Y-m-01');
        $EndDate = (@$array['EndDate'] != '') ? @$array['EndDate'] : date('Y-m-d');
        $Status = (@$array['Status'] != '') ? @$array['Status'] : -1;
        
        $sql = "call usp_A_GetFETarget('$FECode','$Status','$CollectionType','$StartDate','$EndDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    
    public function getFECollectionSummery($array=array()) {
        $FECode = (@$array['FECode'] != '') ? $array['FECode'] : '';
        $StartDate = (@$array['StartDate'] != '') ? @$array['StartDate'] : '';
        $EndDate = (@$array['EndDate'] != '') ? @$array['EndDate'] : '';
        $Status = (@$array['Status'] != '') ? $array['Status'] : -1;
        $CollectionType = (@$array['CollectionType'] != '') ? $array['CollectionType'] : 'All';
        $sql = "call usp_A_GetFETarget('$FECode','$Status','$CollectionType','$StartDate','$EndDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    
    public function getFECollectionSummeryInverted($array=array()) {
        $FECode = (@$array['FECode'] != '') ? @$array['FECode'] : '';
        $Status = (@$array['Status'] != '') ? @$array['Status'] : -1;
        $FieldType = (@$array['FieldType'] != '') ? @$array['FieldType'] : '';
        $sql = "call usp_A_GetFETargetInverted('$FECode','$Status','$FieldType')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function getFECollectionSummeryInvertedClient($array=array()) {
        $FECode = (@$array['FECode'] != '') ? @$array['FECode'] : '';
        $Status = (@$array['Status'] != '') ? $array['Status'] : -1;
        $FieldType = (@$array['FieldType'] != '') ? $array['FieldType'] : 'All';
        
        /* echo $sql = "SELECT
            (SELECT count(ClientID) FROM ss_collection WHERE C.CurrentDemand = 0 WHERE C.FECode = '".$FECode."' GROUP BY C.FECode) AS Collected,
            (SELECT count(ClientID) FROM ss_collection WHERE C.OriginalCollection = 0 WHERE C.FECode = '".$FECode."' GROUP BY C.FECode) AS Pending,
            (SELECT count(ClientID) FROM ss_collection WHERE (C.OriginalCollection > 0 AND C.OriginalCollection < OriginalDemand) WHERE C.FECode = '".$FECode."' GROUP BY C.FECode) AS Partialy,
            (SELECT count(ClientID) FROM ss_collection) AS Total,
            'Client' as Title
        FROM ss_collection C";
        die; */
    }
    
    public function getFECollectionChart($array=array()) {
        $FECode = (@$array['FECode'] != '') ? $array['FECode'] : '';
        $Status = (@$array['Status'] != '') ? $array['Status'] : -1;
        $Date = (@$array['Date'] != '') ? $array['Date'] : 'All';
        $sql = "call usp_A_GetFECollectionChart('$FECode','$Status','$Date')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    
    public function updateCollection($array=array()) {
        $PaymentDate = date(DATABASE_DATE_FORMAT, strtotime($array['PaymentDate']));
        //$PaymentDate = (isset($array['PaymentDate'])) ? GetDateTimeInFormat($array['PaymentDate'], DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;

        $TodaysCollection = ($array['TodaysCollection'] != '') ? $array['TodaysCollection'] : '';
        $TotalCollection = ($array['TotalCollection'] != '') ? $array['TotalCollection'] : '';
        $RegularCollection = ($array['RegularCollection'] != '') ? $array['RegularCollection'] : '';
        $AdvanceCollection = ($array['AdvanceCollection'] != '') ? $array['AdvanceCollection'] : '';
        $Pending = ($array['Pending'] != '') ? $array['Pending'] : '';
        $Percentage = ($array['Percentage'] != '') ? $array['Percentage'] : '';
        //$PaymentDate = ($array['PaymentDate'] != '') ? $array['PaymentDate'] : '';
        $Remark = ($array['Remark'] != '') ? $array['Remark'] : '';
        $Reason = ($array['Reason'] != '') ? $array['Reason'] : '';
        $PaymentReceivedType = ($array['PaymentReceivedType'] != '') ? $array['PaymentReceivedType'] : '';
        $CollectionID = ($array['CollectionID'] != '') ? $array['CollectionID'] : '';
        
        $Status = ACTIVE;
        $ModifiedBy = '1';
        $UserType = 'Android';
        $IPAddress = GetIP();

        $sql = "call usp_EditCollection('$TodaysCollection', '$TotalCollection','$RegularCollection','$AdvanceCollection','$Pending','$Percentage','$PaymentDate','$Remark','$Reason','$PaymentReceivedType','$CollectionID','$ModifiedBy','$Status','$UserType','$IPAddress')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function Insert($array) {
        $array['FECode'] = getStringClean((isset($array['FECode'])) ? $array['FECode'] : '');
        $array['FEName'] = getStringClean((isset($array['FEName'])) ? $array['FEName'] : '');
        $array['Branch'] = getStringClean((isset($array['Branch'])) ? $array['Branch'] : '');
        $array['CenterName'] = getStringClean((isset($array['CenterName'])) ? $array['CenterName'] : '');
        $array['CenterID'] = getStringClean((isset($array['CenterID'])) ? $array['CenterID'] : '');
        $array['LoanID'] = getStringClean((isset($array['LoanID'])) ? $array['LoanID'] : '');
        $array['ClientID'] = getStringClean((isset($array['ClientID'])) ? $array['ClientID'] : '');
        $array['ClientName'] = getStringClean((isset($array['ClientName'])) ? $array['ClientName'] : '');
        $array['DueDate'] = getStringClean((isset($array['DueDate'])) ? $array['DueDate'] : '');
        $array['OriginalDemand'] = getStringClean((isset($array['OriginalDemand'])) ? $array['OriginalDemand'] : '');
        $array['CurrentDemand'] = getStringClean((isset($array['CurrentDemand'])) ? $array['CurrentDemand'] : '');
        $array['OriginalCollection'] = getStringClean((isset($array['OriginalCollection'])) ? $array['OriginalCollection'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . 'Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddCollection('" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['FECode'] . "','" .
                $array['FEName'] . "','" .
                $array['Branch'] . "','" .
                $array['CenterName'] . "','" .
                $array['CenterID'] . "','" .
                $array['LoanID'] . "','" .
                $array['ClientID'] . "','" .
                $array['ClientName'] . "','" .
                $array['DueDate'] . "','" .
                $array['OriginalDemand'] . "','" .
                $array['CurrentDemand'] . "','" .
                $array['OriginalCollection'] . "')";
        $query = $this->db->query($sql);
        $query->next_result(); 
        return $query->row();
    }

    function Truncate() {
        $this->db->truncate('ss_collection');
    }
}