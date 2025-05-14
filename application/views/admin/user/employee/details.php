<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo site_url('admin/user/employee/'); ?>"><?php echo $data->FirstName . " " . $data->LastName; ?></a></h5>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->
    <!--start container-->
    <div class="container">
        <div class="section">
            <div class="listing-page">
                <div class="card-panel">
                    <div class="col s12">
                        <ul class="tabs customer-details-tab-box">
                            <li class="tab col s6 m3"><a class="active tabclick" href="#Details" title="Employee Details" data-div="Details">Employee Details</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#CheinIn" title="Check In-Out" data-div="CheinIn">Check In-Out</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Training" title="Training" data-div="Training">Training</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Uniform" title="Uniform" data-div="Uniform">Uniform</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Attendance" title="Attendance" data-div="Attendance">Attendance</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#RoomAllocation" title="Room Allocation" data-div="RoomAllocation">Room Allocation</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Salary" title="Salary" data-div="Salary">Salary</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Advance" title="Advance Salary" data-div="Advance">Advance Salary</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#ChangePassword" title="Change Password" data-div="ChangePassword">Change Password</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#ActivityLog" title="Activity Log" data-div="ActivityLog">Activity Log</a></li>
                        </ul>
                    </div>
                    <!-- Employee Details Start -->
                    <div id="Details" class="col s12">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="input-field col s12 m6">
                                            <input type="text" value="<?php echo $data->FirstName ?>" readonly>
                                            <label class="active"><?php echo label('msg_lbl_firstname') ?></label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <input type="text" value="<?php echo $data->LastName ?>" readonly>
                                            <label class="active"><?php echo label('msg_lbl_lastname') ?></label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <input type="text" value="<?php echo $data->EmailID ?>" readonly>
                                            <label class="active"><?php echo label('msg_lbl_email') ?></label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <input type="text" value="<?php echo $data->MobileNo ?>" readonly>
                                            <label class="active"><?php echo label('msg_lbl_mobileno') ?></label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <input type="text" value="<?php echo $data->Address ?>" readonly>
                                            <label class="active"><?php echo label('msg_lbl_address') ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Employee Details End -->
                    <!-- Change Password Start -->
                    <div id="ChangePassword" class="col s12">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="input-field col s12 m6">
                                            <input id="new_password" class="empty_validation_class" name="new_password" type="password" maxlength="32">
                                            <label for="new_password"><?php echo label('msg_lbl_new_password'); ?></label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <input id="confirm_password" class="empty_validation_class" name="confirm_password" type="password" maxlength="32">
                                            <label for="confirm_password"><?php echo label('msg_lbl_confirm_password'); ?></label>
                                        </div>
                                        <div class="input-field col s12 m6 right">
                                            <button class="btn waves-effect waves-light right" id="button_change_password" name="button_change_password" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Change Password End -->
                    <!-- Activity Log Start -->
                    <div id="ActivityLog">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="ActivityLog">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="ActivityLog">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="ActivityLog">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l3 m4 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="ActivityLog" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/employee/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                                <div class="row m-b-0">
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivitylogName" id="ActivitylogName" value="" class="form-control LetterOnly" maxlength="250">
                                                        <label name="ActivitylogName" class=""><?php echo label('msg_lbl_activitylog'); ?></label>
                                                    </div>
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivityDate" id="ActivityDate" class="datepicker">
                                                        <label name="ActivityDate"><?php echo label('msg_lbl_activitydate'); ?></label>
                                                    </div>
                                                </div>
                                                <div class="row right">
                                                    <a class="clear-all ClearAllFilter" data-div="ActivityLog">Cancel</a>
                                                    <button class="btn waves-effect waves-light SearchSubmit" type="button" data-div="ActivityLog"><?php echo label('msg_lbl_submit'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="display">
                                            <thead>
                                                <tr>
                                                    <th class="width_200"><?php echo label('msg_lbl_activitylogname'); ?></th>
                                                    <th class="width_500"><?php echo label('msg_lbl_description'); ?></th>
                                                    <th class="width_200"><?php echo label('msg_lbl_date_time'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="TableBody"></tbody>
                                        </table>
                                    </div>
                                    <div class="PaginationDiv"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Activity Log End -->
                    <!-- CheinIn Start -->
                    <div id="CheinIn">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="CheinIn">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="CheinIn">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="CheinIn">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/employee/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                                <div class="row m-b-0">
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivitylogName" id="ActivitylogName" value="" class="form-control LetterOnly" maxlength="250">
                                                        <label name="ActivitylogName" class=""><?php echo label('msg_lbl_activitylog'); ?></label>
                                                    </div>
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivityDate" id="ActivityDate" class="datepicker">
                                                        <label name="ActivityDate"><?php echo label('msg_lbl_activitydate'); ?></label>
                                                    </div>
                                                </div>
                                                <div class="row right">
                                                    <a class="clear-all ClearAllFilter" data-div="ActivityLog">Cancel</a>
                                                    <button class="btn waves-effect waves-light SearchSubmit" type="button" data-div="ActivityLog"><?php echo label('msg_lbl_submit'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="display">
                                            <thead>
                                                <tr>
                                                    <th><?php echo label('msg_lbl_checkin'); ?></th>
                                                    <th><?php echo label('msg_lbl_checkout'); ?></th>
                                                    <th><?php echo label('msg_lbl_inaddress'); ?></th>
                                                    <th><?php echo label('msg_lbl_outaddress'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="TableBody">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="PaginationDiv"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CheinIn End -->
                    <!-- Training Start -->
                    <div id="Training">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="Training">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="Training">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="Training">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Training" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                    <a class="btn-floating  waves-effect waves-light green accent-6" href="<?php echo site_url("admin/user/employee/addTraining/" . $UserID); ?>">
                                                        <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/employee/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                                <div class="row m-b-0">
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivitylogName" id="ActivitylogName" value="" class="form-control LetterOnly" maxlength="250">
                                                        <label name="ActivitylogName" class=""><?php echo label('msg_lbl_activitylog'); ?></label>
                                                    </div>
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivityDate" id="ActivityDate" class="datepicker">
                                                        <label name="ActivityDate"><?php echo label('msg_lbl_activitydate'); ?></label>
                                                    </div>
                                                </div>
                                                <div class="row right">
                                                    <a class="clear-all ClearAllFilter" data-div="ActivityLog">Cancel</a>
                                                    <button class="btn waves-effect waves-light SearchSubmit" type="button" data-div="ActivityLog"><?php echo label('msg_lbl_submit'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="display">
                                            <thead>
                                                <tr>
                                                    <th><?php echo label('msg_lbl_trainingname'); ?></th>
                                                    <th><?php echo label('msg_lbl_trainingdatetime'); ?></th>
                                                    <!-- <th><?php //echo label('msg_lbl_actions');
                                                                ?></th> -->
                                                </tr>
                                            </thead>
                                            <tbody class="TableBody">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="PaginationDiv"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Training End -->
                    <!-- Uniform Start -->
                    <div id="Uniform">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="Uniform">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="Uniform">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="Uniform">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Uniform" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                    <a class="btn-floating  waves-effect waves-light green accent-6" href="<?php echo site_url("admin/user/employee/addUniform/" . $UserID); ?>">
                                                        <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/employee/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                                <div class="row m-b-0">
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivitylogName" id="ActivitylogName" value="" class="form-control LetterOnly" maxlength="250">
                                                        <label name="ActivitylogName" class=""><?php echo label('msg_lbl_activitylog'); ?></label>
                                                    </div>
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivityDate" id="ActivityDate" class="datepicker">
                                                        <label name="ActivityDate"><?php echo label('msg_lbl_activitydate'); ?></label>
                                                    </div>
                                                </div>
                                                <div class="row right">
                                                    <a class="clear-all ClearAllFilter" data-div="ActivityLog">Cancel</a>
                                                    <button class="btn waves-effect waves-light SearchSubmit" type="button" data-div="ActivityLog"><?php echo label('msg_lbl_submit'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="display">
                                            <thead>
                                                <tr>
                                                    <th><?php echo label('msg_lbl_uniformtype'); ?></th>
                                                    <th><?php echo label('msg_lbl_uniformdatetime'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="TableBody">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="PaginationDiv"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Uniform End -->
                    <!-- Attendance Start -->
                    <div id="Attendance">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="Attendance">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="Attendance">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="Attendance">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l3 m4 s12 list-page-right-top-icon center hide">
                                                    <a class="btn-floating waves-effect waves-light grey">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Attendance" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/employee/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                                <div class="row m-b-0">
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivitylogName" id="ActivitylogName" value="" class="form-control LetterOnly" maxlength="250">
                                                        <label name="ActivitylogName" class=""><?php echo label('msg_lbl_activitylog'); ?></label>
                                                    </div>
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivityDate" id="ActivityDate" class="datepicker">
                                                        <label name="ActivityDate"><?php echo label('msg_lbl_activitydate'); ?></label>
                                                    </div>
                                                </div>
                                                <div class="row right">
                                                    <a class="clear-all ClearAllFilter" data-div="ActivityLog">Cancel</a>
                                                    <button class="btn waves-effect waves-light SearchSubmit" type="button" data-div="ActivityLog"><?php echo label('msg_lbl_submit'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="display">
                                            <thead>
                                                <tr>
                                                    <th><?php echo label('msg_lbl_namecompanyname'); ?></th>
                                                    <th><?php echo label('msg_lbl_attendancedatetime'); ?></th>
                                                    <th><?php echo label('msg_lbl_attendancestatus'); ?></th>
                                                    <th><?php echo label('msg_lbl_overtime'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="TableBody">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="PaginationDiv"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Attendance End -->
                    <!-- Room Allocation Start -->
                    <div id="RoomAllocation">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="RoomAllocation">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="RoomAllocation">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="RoomAllocation">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="RoomAllocation" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                    <a class="btn-floating  waves-effect waves-light green accent-6" href="<?php echo site_url("admin/user/employee/addRoomAllocation/" . $UserID); ?>">
                                                        <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/employee/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                                <div class="row m-b-0">
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivitylogName" id="ActivitylogName" value="" class="form-control LetterOnly" maxlength="250">
                                                        <label name="ActivitylogName" class=""><?php echo label('msg_lbl_activitylog'); ?></label>
                                                    </div>
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivityDate" id="ActivityDate" class="datepicker">
                                                        <label name="ActivityDate"><?php echo label('msg_lbl_activitydate'); ?></label>
                                                    </div>
                                                </div>
                                                <div class="row right">
                                                    <a class="clear-all ClearAllFilter" data-div="ActivityLog">Cancel</a>
                                                    <button class="btn waves-effect waves-light SearchSubmit" type="button" data-div="ActivityLog"><?php echo label('msg_lbl_submit'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="display">
                                            <thead>
                                                <tr>
                                                    <th><?php echo label('msg_lbl_roomno'); ?></th>
                                                    <th><?php echo label('msg_lbl_address'); ?></th>
                                                    <th><?php echo label('msg_lbl_startdate'); ?></th>
                                                    <th><?php echo label('msg_lbl_enddate'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="TableBody">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="PaginationDiv"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Room Allocation End -->
                    <!-- Advance Start -->
                    <div id="Advance">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="Advance">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="Advance">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="Advance">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Advance" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                    <a class="btn-floating  waves-effect waves-light green accent-6" href="<?php echo site_url("admin/salary/addAdvance/" . $UserID); ?>">
                                                        <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/employee/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                                <div class="row m-b-0">
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivitylogName" id="ActivitylogName" value="" class="form-control LetterOnly" maxlength="250">
                                                        <label name="ActivitylogName" class=""><?php echo label('msg_lbl_activitylog'); ?></label>
                                                    </div>
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivityDate" id="ActivityDate" class="datepicker">
                                                        <label name="ActivityDate"><?php echo label('msg_lbl_activitydate'); ?></label>
                                                    </div>
                                                </div>
                                                <div class="row right">
                                                    <a class="clear-all ClearAllFilter" data-div="ActivityLog">Cancel</a>
                                                    <button class="btn waves-effect waves-light SearchSubmit" type="button" data-div="ActivityLog"><?php echo label('msg_lbl_submit'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="display">
                                            <thead>
                                                <tr>
                                                    <th><?php echo label('msg_lbl_date'); ?></th>
                                                    <th><?php echo label('msg_lbl_amount'); ?></th>
                                                    <th><?php echo label('msg_lbl_type'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="TableBody">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="PaginationDiv"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Advance End -->
                    <!-- Salary Start -->
                    <div id="Salary">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="Salary">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="Salary">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="Salary">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Salary" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                    <!-- <a class="btn-floating  waves-effect waves-light green accent-6" href="<?php echo site_url("admin/user/employee/addSalary/" . $UserID); ?>">
                                                        <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                                                    </a> -->
                                                </div>

                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/employee/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                                <div class="row m-b-0">
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivitylogName" id="ActivitylogName" value="" class="form-control LetterOnly" maxlength="250">
                                                        <label name="ActivitylogName" class=""><?php echo label('msg_lbl_activitylog'); ?></label>
                                                    </div>
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="ActivityDate" id="ActivityDate" class="datepicker">
                                                        <label name="ActivityDate"><?php echo label('msg_lbl_activitydate'); ?></label>
                                                    </div>
                                                </div>
                                                <div class="row right">
                                                    <a class="clear-all ClearAllFilter" data-div="ActivityLog">Cancel</a>
                                                    <button class="btn waves-effect waves-light SearchSubmit" type="button" data-div="ActivityLog"><?php echo label('msg_lbl_submit'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="display">
                                            <thead>
                                                <tr>
                                                    <th><?php echo label('msg_lbl_salarydate'); ?></th>
                                                    <th><?php echo label('msg_lbl_startdate'); ?></th>
                                                    <th><?php echo label('msg_lbl_enddate'); ?></th>
                                                    <th><?php echo label('msg_lbl_present'); ?></th>
                                                    <th><?php echo label('msg_lbl_absent'); ?></th>
                                                    <th><?php echo label('msg_lbl_halfday'); ?></th>
                                                    <th><?php echo label('msg_lbl_halfovertime'); ?></th>
                                                    <th><?php echo label('msg_lbl_fullovertime'); ?></th>
                                                    <th><?php echo label('msg_lbl_penlty'); ?></th>
                                                    <th><?php echo label('msg_lbl_payamount'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="TableBody">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="PaginationDiv"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Salary End -->
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo @$view_modal_popup; ?>
<!-- END CONTENT-->