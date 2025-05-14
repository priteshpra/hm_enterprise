<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo site_url('admin/user/visitor'); ?>"><?php echo label('msg_lbl_visitor'); ?></a></h5>
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
                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked">
                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter">
                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                </div>
                                <div class="col l3 m4 s12 list-page-right-top-icon center">
                                    <a class="btn-floating waves-effect waves-light grey">
                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                    </a>

                                    <a class="btn-floating  waves-effect waves-light export-excel" href="javascript:void(0);">
                                        <i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i>
                                    </a>
                                    <a class="btn-floating  waves-effect waves-light green accent-6" href="<?php echo site_url("admin/user/visitor/mobileadd"); ?>">
                                        <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form id="ExportForm" action="<?php echo site_url('admin/user/visitor/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                            <div class="row card-panel">
                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                <div class="row m-b-0">
                                    <div class="input-field col s12 m6">
                                        <input type="text" name="EmailID" id="EmailID" maxlength="250" class="form-control">
                                        <label name="EmailID" class=""><?php echo label('msg_lbl_emailormobileno'); ?></label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input type="text" name="Name" id="Name" maxlength="200" class="form-control">
                                        <label name="Name" class=""><?php echo label('msg_lbl_name'); ?></label>
                                    </div>
                                    <div class="input-field search_label_radio col s12 m6">
                                        <div name="status" class="form-control search_div m-t-10 left"><?php echo label('msg_lbl_status'); ?></div>
                                        <input name="Status" type="radio" id="AllStatus" value="-1" checked="checked">
                                        <label for="AllStatus"><?php echo label('msg_lbl_all'); ?></label>
                                        <input name="Status" type="radio" id="Active" value="1">
                                        <label for="Active"><?php echo label('msg_lbl_active'); ?></label>
                                        <input name="Status" type="radio" id="InActive" value="0">
                                        <label for="InActive"><?php echo label('msg_lbl_inactive'); ?></label>
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
                                    <th><?php echo label('msg_lbl_emailid'); ?></th>
                                    <th><?php echo label('msg_lbl_mobileno'); ?></th>
                                    <th><?php echo label('msg_lbl_pincode'); ?></th>
                                    <th><?php echo label('msg_lbl_leadtype'); ?></th>
                                    <th><?php echo label('msg_lbl_city'); ?></th>
                                    <th><?php echo label('msg_lbl_type'); ?></th>
                                    <th class="width_100 actions center"><?php echo label('msg_lbl_status'); ?></th>
                                    <th class="width_100 actions center"><?php echo label('msg_lbl_actions'); ?></th>
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