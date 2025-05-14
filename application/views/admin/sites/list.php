<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title">
                        <a href="<?php echo site_url('admin/sites'); ?>"><?= label('msg_lbl_sites') ?></a>
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->
    <!--start container-->
    <div class="container">
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
                                    <div class="col l7 m6 s12 center">
                                        <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                        <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked">
                                        <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                        <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter">
                                        <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;
                                    </div>
                                    <div class="col l10 m10 s12 list-page-right-top-icon center">
                                        <a class="btn-floating waves-effect waves-light grey hide">
                                            <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-div="Sites" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <form id="ExportForm" action="<?php echo site_url('admin/user/sites/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20" style="display:none;">
                                <div class="row card-panel">
                                    <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?></strong></h4>
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
                                        <th class="width_100 actions center">
                                            <?php echo label('msg_lbl_status'); ?></th>
                                        <th class="width_200 center"><?php echo label('msg_lbl_actions'); ?>
                                        </th>
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
    </div>
</section>
<?php echo @$view_modal_popup; ?>
<!-- END CONTENT-->