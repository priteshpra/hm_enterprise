<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

//define('BASEPATH');
define('ACTIVE', 1);
define('INACTIVE', 0);
define('PER_PAGE_RECORD', 30);
define('ADMIN', 1);

define('MALE', "Male");
define('FEMALE', "Female");
/* classes */
define('CHANGE_STATUS',    'status_change');
define('ACTIVE_ICON_CLASS', 'mdi-navigation-check status_change active_status_icon');
define('INACTIVE_ICON_CLASS', 'mdi-navigation-close status_change inactive_status_icon');
define('AACTIVE_ICON_CLASS', 'mdi-navigation-check active_status_icon');
define('AINACTIVE_ICON_CLASS', 'mdi-navigation-close inactive_status_icon');
define('LOADING_ICON_CLASS', 'fa fa-spinner fa-spin fa-fw margin-bottom loading_status_icon');
define('EDIT_ICON_CLASS', 'mdi-editor-mode-edit');
define('DELETE_ICON_CLASS', 'mdi-action-delete');
define('DOWNLOAD_ICON_CLASS', 'mdi-file-file-download');
define('VIEW_ICON_CLASS', 'mdi-action-visibility');
define('GROUP_ICON_CLASS', 'mdi-action-account-child');
define('DOCUMENT_ICON_CLASS', 'mdi-av-my-library-books');
define('CANCELLED_ICON_CLASS', 'mdi-content-clear');

define('INFO_ICON_CLASS', 'mdi-action-info');
define('PLUS_ICON_CLASS', 'fa fa-plus');
define('DEFAULT_IMAGE', 'assets/admin/img/noimage.gif');
define('DATE_TIME_FORMAT', 'd-m-Y H:i:s');
define('TIME_FORMAT', 'H:i:s');
define('WEB_TIME_FORMAT', 'H:i');
define('DATE_FORMAT', 'd-m-Y');
define('DEFAULT_DATE_TIME', '1000-01-01 00:00:00');
define('DEFAULT_TIME', '00:00:00');
define('DEFAULT_DATE', '1000-01-01');
define('DATABASE_DATE_TIME_FORMAT', 'Y-m-d H:i:s');
define('DATABASE_DATE_FORMAT', 'Y-m-d');

define('DEFAULT_ADMIN_EMAIL', 'shripa.saggisoftsolutions@gmail.com'); //'hairartist@virtualtryon.biz');
define('DEFAULT_ADMIN_EMAIL_PASSWORD', 'Shripa@1234');
define('DEFAULT_FROM_NAME', 'info');

define('DEFAULT_WEBSITE_LOGO', 'assets/admin/img/logo.png');
define('DEFAULT_WEBSITE_FAVICON', 'assets/admin/img/favicon.png');
define('DEFAULT_EMAIL_IMAGE', 'assets/front/images/email/');

/* For DUMMY Image*/
define('DUMMY_MAX_HEIGHT',    768);
define('DUMMY_MAX_WIDTH',    1024);
define('DUMMY_MAX_SIZE',    102400);
define('DUMMY_ALLOWED_TYPES',    'jpg|png|jpeg');
define('DUMMY_UPLOAD_PATH',    './assets/uploads/dummy/');

define('DUMMY_THUMB_MAX_WIDTH',    250);
define('DUMMY_THUMB_MAX_HEIGHT',    250);
define('DUMMY_THUMB_UPLOAD_PATH',    './assets/uploads/dummy/thumbnail/');
/* For DUMMY Image*/
define('DUMMY_ARRAY', serialize(array('dummy 1', 'dummy 2', 'dummy 3', 'dummy 4', 'dummy 5')));

/* For DUMMY Image*/
define('REPORT_MAX_HEIGHT',    768);
define('REPORT_MAX_WIDTH',    1024);
define('REPORT_MAX_SIZE',    102400);
define('REPORT_ALLOWED_TYPES',    'jpg|png|jpeg|pdf');
define('REPORT_UPLOAD_PATH',    './assets/uploads/report/');
define('REPORT_THUMB_MAX_WIDTH',    250);
define('REPORT_THUMB_MAX_HEIGHT',    250);
define('REPORT_THUMB_UPLOAD_PATH',    './assets/uploads/report/');

/*------------ Quickblox Info Start -----------------*/

DEFINE('APPLICATION_ID', 75831);
DEFINE('AUTH_KEY', "Sy9wJuTThtR9U7P");
DEFINE('AUTH_SECRET', "CAMRMWPOETa--ey");
DEFINE('USER_LOGIN', "upexa.saggisoftsolutions@gmail.com");
DEFINE('USER_PASSWORD', "Property@123");
DEFINE('ALLUSER_PASSWORD', "Property@123");

/*------------ Quickblox Info End -------------------*/

/* ----------- User Image Start ---------------------*/
define('USER_MAX_HEIGHT',    768);
define('USER_MAX_WIDTH',    1024);
define('USER_MAX_SIZE',    1024000);
define('USER_ALLOWED_TYPES', 'jpg|png|jpeg|png|PNG');
define('USER_UPLOAD_PATH',    './assets/uploads/user/');
define('USER_THUMB_MAX_WIDTH',    250);
define('USER_THUMB_MAX_HEIGHT',    250);
define('USER_THUMB_UPLOAD_PATH', './assets/uploads/user/thumbnail');
/* ---------- User Image End ------------------------*/

/* ----------- Banner Image Start ---------------------*/
define('BANNER_MAX_HEIGHT',    768);
define('BANNER_MAX_WIDTH',    1024);
define('BANNER_MAX_SIZE',    1024000);
define('BANNER_ALLOWED_TYPES', 'jpg|png|jpeg|png|PNG');
define('BANNER_UPLOAD_PATH',    './assets/uploads/banner/');
define('BANNER_THUMB_MAX_WIDTH',    250);
define('BANNER_THUMB_MAX_HEIGHT',    250);
define('BANNER_THUMB_UPLOAD_PATH', './assets/uploads/banner/thumbnail/');
/* ---------- Banner Image End ------------------------*/

/* ----------- Customer Sites Document Start ---------------------*/
define('PROJECT_DOCUMENT_MAX_HEIGHT',        -1);
define('PROJECT_DOCUMENT_MAX_WIDTH',        -1);
define('PROJECT_DOCUMENT_MAX_SIZE',            102400);
define('PROJECT_DOCUMENT_ALLOWED_TYPES',    'gif|jpg|png|jpeg|pdf|doc|docx');
define('PROJECT_DOCUMENT_UPLOAD_PATH',        './assets/uploads/document/');
/* ----------- Customer Sites Document End ---------------------*/

/* ----------- Ticket Image Start ---------------------*/
define('TICKET_MAX_HEIGHT',    768);
define('TICKET_MAX_WIDTH',    1024);
define('TICKET_MAX_SIZE',    1024000);
define('TICKET_ALLOWED_TYPES', 'jpg|png|jpeg|png|PNG');
define('TICKET_UPLOAD_PATH',    './assets/uploads/ticket/');
define('TICKET_THUMB_MAX_WIDTH',    250);
define('TICKET_THUMB_MAX_HEIGHT',    250);
define('TICKET_THUMB_UPLOAD_PATH', './assets/uploads/ticket/thumbnail/');
/* ---------- Ticket Image End ------------------------*/

/* ----------- User Document Image Start ---------------------*/
define('USERDOCUMENT_MAX_HEIGHT',    768);
define('USERDOCUMENT_MAX_WIDTH',    1024);
define('USERDOCUMENT_MAX_SIZE',    1024000);
define('USERDOCUMENT_ALLOWED_TYPES', 'jpg|png|jpeg|png|PNG');
define('USERDOCUMENT_UPLOAD_PATH',    './assets/uploads/userdocument/');
define('USERDOCUMENT_THUMB_MAX_WIDTH',    250);
define('USERDOCUMENT_THUMB_MAX_HEIGHT',    250);
define('USERDOCUMENT_THUMB_UPLOAD_PATH', './assets/uploads/userdocument/thumbnail/');
/* ---------- User Document Image End ------------------------*/

/* ----------- User Document Image Start ---------------------*/
define('USEROFEERLETTER_MAX_HEIGHT',    768);
define('USEROFEERLETTER_MAX_WIDTH',    1024);
define('USEROFEERLETTER_MAX_SIZE',    1024000);
define('USEROFEERLETTER_ALLOWED_TYPES', 'jpg|png|jpeg|png|PNG|pdf');
define('USEROFEERLETTER_UPLOAD_PATH',    './assets/uploads/userofeerletter/');
define('USEROFEERLETTER_THUMB_MAX_WIDTH',    250);
define('USEROFEERLETTER_THUMB_MAX_HEIGHT',    250);
define('USEROFEERLETTER_THUMB_UPLOAD_PATH', './assets/uploads/userofeerletter/thumbnail/');
/* ---------- User Document Image End ------------------------*/

/* ----------- Inspection Image Start ---------------------*/
define('INSPECTION_MAX_HEIGHT',    768);
define('INSPECTION_MAX_WIDTH',    1024);
define('INSPECTION_MAX_SIZE',    1024000);
define('INSPECTION_ALLOWED_TYPES', 'jpg|png|jpeg|png|PNG');
define('INSPECTION_UPLOAD_PATH',    './assets/uploads/inspection/');
define('INSPECTION_THUMB_MAX_WIDTH',    250);
define('INSPECTION_THUMB_MAX_HEIGHT',    250);
define('INSPECTION_THUMB_UPLOAD_PATH', './assets/uploads/inspection/thumbnail/');
/* ---------- Inspection Image End ------------------------*/

/* ----------- Document Image Start ---------------------*/
define('DOCUMENT_MAX_HEIGHT',    768);
define('DOCUMENT_MAX_WIDTH',    1024);
define('DOCUMENT_MAX_SIZE',    1024000);
define('DOCUMENT_ALLOWED_TYPES', 'jpg|png|jpeg|PNG|pdf|doc|docx|xls|xlsx|ppt');
define('DOCUMENT_UPLOAD_PATH',    './assets/uploads/document/');
define('DOCUMENT_THUMB_MAX_WIDTH',    250);
define('DOCUMENT_THUMB_MAX_HEIGHT',    250);
define('DOCUMENT_THUMB_UPLOAD_PATH', './assets/uploads/document/thumbnail/');
/* ---------- Document Image End ------------------------*/



/* ----------- Customer Sites Document Start ---------------------*/
define('INSTALLATION_MAX_HEIGHT',        -1);
define('INSTALLATION_MAX_WIDTH',        -1);
define('INSTALLATION_MAX_SIZE',            102400);
define('INSTALLATION_ALLOWED_TYPES',    'gif|jpg|png|jpeg');
define('INSTALLATION_UPLOAD_PATH',        './assets/uploads/installation/');
/* ----------- Customer Sites Document End ---------------------*/

define('NOTIFICATION_ADDSITE', "AddSite");
define('NOTIFICATION_ADDLEAD', "AddLead");
define('NOTIFICATION_ADDQUOTATION', "AddQuotation");
define('NOTIFICATION_ADDINVOICE', "AddInvoice");
define('NOTIFICATION_ADDPAYMENT', "AddPayment");

define('INSTALLATION_TYPE', array("Tpey-1", "Type-2", "Type-3"));
define('PAYMENT_TYPE', array("Cash", "Cheque", "Bank Transfer","Kasar","Other"));
define('SERVICE_TYPE', array("Installation", "Free Service", "Paid Service", "Re-Installation"));
define('SERVICES_PER_YEAR', array("2", "3", "4", "6"));