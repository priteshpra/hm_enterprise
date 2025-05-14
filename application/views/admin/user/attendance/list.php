<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo site_url('admin/user/attendance/list'); ?>"><?php echo label('msg_lbl_attendance'); ?></a></h5>
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
                    <div class="row">
                        <div class="col s12">
                            <div class="row m-b-0">
                                <div class="input-field col l2 m2 s12">
                                    <select id="PageSize" class="PageSize select_materialize">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col l7 m6 s12 center">
                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter">
                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter" checked="checked">
                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                </div>
                                <div class="col l3 m4 s12 list-page-right-top-icon center">
                                    <a class="btn-floating waves-effect waves-light grey">
                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                    </a>

                                    <a class="btn-floating  waves-effect waves-light export-excel" href="javascript:void(0);">
                                        <i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i>
                                    </a>
                                    <a class="btn-floating  waves-effect waves-light green accent-6" href="<?php echo site_url("admin/user/attendance/addGlobal"); ?>">
                                        <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form id="ExportForm" action="<?php echo site_url('admin/user/attendance/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:block;">
                            <div class="row card-panel">
                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                <div class="row m-b-0">
                                    <div class="input-field col s12 m6">
                                        <input type="text" name="StartDate" id="StartDate" value="<?= date('01-m-Y') ?>" maxlength="20" class="form-control datepicker">
                                        <label name="StartDate" class=""><?php echo label('msg_lbl_startdate'); ?></label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input type="text" name="EndDate" id="EndDate" value="<?= date('d-m-Y') ?>" maxlength="20" class="form-control datepicker">
                                        <label name="EndDate" class=""><?php echo label('msg_lbl_enddate'); ?></label>
                                    </div>
                                </div>
                                <div class="row right">
                                    <a class="clear-all ClearAllFilter">Cancel</a>
                                    <button class="btn waves-effect waves-light SearchSubmit" type="button"><?php echo label('msg_lbl_submit'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="display">
                            <thead>
                                <tr>
                                    <th><?php echo label('msg_lbl_name'); ?></th>
                                    <th><?php echo label('msg_lbl_mobileno'); ?></th>
                                    <th><?php echo label('msg_lbl_startdate'); ?></th>
                                    <th><?php echo label('msg_lbl_enddate'); ?></th>
                                    <th><?php echo label('msg_lbl_presentcount'); ?></th>
                                    <th><?php echo label('msg_lbl_absentcount'); ?></th>
                                    <th><?php echo label('msg_lbl_halfleavecount'); ?></th>
                                    <th><?php echo label('msg_lbl_halfovertimecount'); ?></th>
                                    <th><?php echo label('msg_lbl_fullovertimecount'); ?></th>
                                    <th><?php echo label('msg_lbl_total'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="TableBody"></tbody>
                        </table>
                    </div>
                    <div class="PaginationDiv"></div>
                </div>
                <?php echo @$view_modal_popup; ?>
            </div>
        </div>
    </div>
</section>
<!-- END CONTENT-->