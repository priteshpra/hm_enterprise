<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo site_url('admin/user/customer/'); ?>"><?php echo $data->Name; ?></a></h5>
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
                            <li class="tab col s6 m3"><a class="active tabclick" href="#Details" title="Visitor Details" data-div="Details">Customer Details</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Sites" title="Sites" data-div="Sites">Sites</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Quotation" title="Quotation" data-div="Quotation">Quotation</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Teamdefination" title="Teamdefination" data-div="Teamdefination">Team Defination</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Invoice" title="Invoice" data-div="Invoice">Invoice</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Payment" title="Payment" data-div="Payment">Payment</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Attendance" title="Attendance" data-div="Attendance">Attendance</a></li>

                            <li class="tab col s6 m3"><a class="tabclick" href="#Document" title="Document" data-div="Document">Document</a></li>
                        </ul>
                    </div>
                    <!-- Visitor Details Start -->
                    <div id="Details" class="col s12">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="input-field col s12 m6">
                                            <input type="text" value="<?php echo $data->Name ?>" readonly>
                                            <label class="active"><?php echo label('msg_lbl_name') ?></label>
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
                                            <input type="text" value="<?php echo $data->CityName ?>" readonly>
                                            <label class="active"><?php echo label('msg_lbl_city') ?></label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <input type="text" value="<?php echo $data->PinCode ?>" readonly>
                                            <label class="active"><?php echo label('msg_lbl_pincode') ?></label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <input type="text" value="<?php echo $data->Address ?>" readonly>
                                            <label class="active"><?php echo label('msg_lbl_address') ?></label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <input type="text" value="<?php echo $data->LeadType ?>" readonly>
                                            <label class="active"><?php echo label('msg_lbl_leadtype') ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Visitor Details End -->
                    <!-- Sites Start -->
                    <div id="Sites">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="Sites">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="Sites">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="Sites">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Sites" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                    <a class="btn-floating  waves-effect waves-light green accent-6" href="<?php echo site_url("admin/user/sites/add/" . $VisitorID); ?>">
                                                        <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/sites/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                                <div class="row m-b-0">
                                                    <div class="input-field col s12 m6">
                                                        <input type="text" name="SiteName" id="SiteName" value="" class="form-control" maxlength="250">
                                                        <label name="SiteName" class=""><?php echo label('msg_lbl_sitename'); ?></label>
                                                    </div>
                                                </div>
                                                <div class="row right">
                                                    <a class="clear-all ClearAllFilter" data-div="Sites">Cancel</a>
                                                    <button class="btn waves-effect waves-light SearchSubmit" type="button" data-div="Sites"><?php echo label('msg_lbl_submit'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="display">
                                            <thead>
                                                <tr>
                                                    <th><?php echo label('msg_lbl_sitesname'); ?></th>
                                                    <th><?php echo label('msg_lbl_namecompanyname'); ?></th>
                                                    <th><?php echo label('msg_lbl_sitetype'); ?></th>
                                                    <th><?php echo label('msg_lbl_workinghours'); ?></th>
                                                    <th><?php echo label('msg_lbl_workingdays'); ?></th>
                                                    <th><?php echo label('msg_lbl_proposeddate'); ?></th>
                                                    <th><?php echo label('msg_lbl_startdate'); ?></th>
                                                    <th><?php echo label('msg_lbl_enddate'); ?></th>
                                                    <th><?php echo label('msg_lbl_gstno'); ?></th>
                                                    <th class="width_300"><?php echo label('msg_lbl_address'); ?></th>
                                                    <th class="width_100 actions center"><?php echo label('msg_lbl_status'); ?></th>
                                                    <th class="width_200 center"><?php echo label('msg_lbl_actions'); ?></th>
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
                    <!-- Sites End -->
                    <!-- Quotation Start -->
                    <div id="Quotation">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="Quotation">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="Quotation">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="Quotation">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Quotation" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/quotation/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
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
                                                    <th><?php echo label('msg_lbl_estimateno'); ?></th>
                                                    <th><?php echo label('msg_lbl_namecompanyname'); ?></th>
                                                    <th><?php echo label('msg_lbl_address'); ?></th>
                                                    <th><?php echo label('msg_lbl_service'); ?></th>
                                                    <th><?php echo label('msg_lbl_companyname'); ?></th>
                                                    <th><?php echo label('msg_lbl_sitename'); ?></th>
                                                    <th><?php echo label('msg_lbl_subtotal'); ?></th>
                                                    <th><?php echo label('msg_lbl_cgst'); ?></th>
                                                    <th><?php echo label('msg_lbl_sgst'); ?></th>
                                                    <th><?php echo label('msg_lbl_igst'); ?></th>
                                                    <th><?php echo label('msg_lbl_total'); ?></th>
                                                    <th><?php echo label('msg_lbl_quotationsstatus'); ?></th>
                                                    <th class="width_200 center"><?php echo label('msg_lbl_actions'); ?></th>
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
                    <!-- Quotation End -->
                    <!-- Team Defination Start -->
                    <div id="Teamdefination">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="Teamdefination">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="Teamdefination">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="Teamdefination">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Teamdefination" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/teamdefination/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
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
                                                    <th><?php echo label('msg_lbl_estimateno'); ?></th>
                                                    <th><?php echo label('msg_lbl_name'); ?></th>
                                                    <th><?php echo label('msg_lbl_startdatetime'); ?></th>
                                                    <th><?php echo label('msg_lbl_enddatetime'); ?></th>
                                                    <th><?php echo label('msg_lbl_namecompanyname'); ?></th>
                                                    <th><?php echo label('msg_lbl_type'); ?></th>
                                                    <th><?php echo label('msg_lbl_availablestatus'); ?></th>
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
                    <!-- Quotation End -->
                    <!-- Invoice Start -->
                    <div id="Invoice">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="Invoice">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="Invoice">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="Invoice">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Invoice" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/invoice/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
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
                                                    <th><?php echo label('msg_lbl_estimateno'); ?></th>
                                                    <th><?php echo label('msg_lbl_invoiceno'); ?></th>
                                                    <th><?php echo label('msg_lbl_namecompanyname'); ?></th>
                                                    <th><?php echo label('msg_lbl_invoicedate'); ?></th>
                                                    <th><?php echo label('msg_lbl_total'); ?></th>
                                                    <th><?php echo label('msg_lbl_subtotal'); ?></th>
                                                    <th><?php echo label('msg_lbl_cgst'); ?></th>
                                                    <th><?php echo label('msg_lbl_sgst'); ?></th>
                                                    <th><?php echo label('msg_lbl_igst'); ?></th>
                                                    <th><?php echo label('msg_lbl_reminderpayment'); ?></th>
                                                    <th><?php echo label('msg_lbl_remindergst'); ?></th>
                                                    <th><?php echo label('msg_lbl_notes'); ?></th>
                                                    <th><?php echo label('msg_lbl_terms'); ?></th>
                                                    <th class="width_100 center"><?php echo label('msg_lbl_actions'); ?></th>
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
                    <!-- Invoice End -->
                    <!-- Payment Start -->
                    <div id="Payment">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="Payment">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="Payment">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="Payment">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Payment" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/Payment/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
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
                                                    <th><?php echo label('msg_lbl_invoiceno'); ?></th>
                                                    <th><?php echo label('msg_lbl_namecompanyname'); ?></th>
                                                    <th><?php echo label('msg_lbl_paymentdate'); ?></th>
                                                    <th><?php echo label('msg_lbl_paymentmode'); ?></th>
                                                    <th><?php echo label('msg_lbl_amounttype'); ?></th>
                                                    <th><?php echo label('msg_lbl_paymentamount'); ?></th>
                                                    <th><?php echo label('msg_lbl_gstamount'); ?></th>
                                                    <th><?php echo label('msg_lbl_chequeno'); ?></th>
                                                    <th><?php echo label('msg_lbl_ifsccode'); ?></th>
                                                    <th><?php echo label('msg_lbl_accountno'); ?></th>
                                                    <th><?php echo label('msg_lbl_bankname'); ?></th>
                                                    <th><?php echo label('msg_lbl_branchname'); ?></th>
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
                    <!-- Payment End -->
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
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Attendance" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/attendance/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
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
                                                    <th><?php echo label('msg_lbl_estimateno'); ?></th>
                                                    <th><?php echo label('msg_lbl_namecompanyname'); ?></th>
                                                    <th><?php echo label('msg_lbl_date'); ?></th>
                                                    <th><?php echo label('msg_lbl_presentcount'); ?></th>
                                                    <th><?php echo label('msg_lbl_halfleavecount'); ?></th>
                                                    <th><?php echo label('msg_lbl_absentcount'); ?></th>
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
                    <!-- Document Start -->
                    <div id="Document">
                        <div class="section">
                            <div class="listing-page">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row m-b-0">
                                                <div class="input-field col l2 m2 s12">
                                                    <select id="PageSize" class="PageSize select_materialize" data-div="Document">
                                                        <option value="10" selected>10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col l7 m6 s12 center hide">
                                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked" data-div="Document">
                                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" data-div="Document">
                                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                                </div>
                                                <div class="col l10 m10 s12 list-page-right-top-icon center">
                                                    <a class="btn-floating waves-effect waves-light grey hide">
                                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Document" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="ExportForm" action="<?php echo site_url('admin/user/document/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                            <div class="row card-panel">
                                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
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
                                                    <th><?php echo label('msg_lbl_title'); ?></th>
                                                    <th><?php echo label('msg_lbl_document'); ?></th>
                                                    <th class="width_100 actions center"><?php echo label('msg_lbl_status'); ?></th>
                                                    <th class="width_200 center"><?php echo label('msg_lbl_actions'); ?></th>
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
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo @$view_modal_popup; ?>
<!-- END CONTENT-->