<div id="card-stats" class="container">
    <div class="row">
        <!--card stats start-->

        <div id="card-stats">
            <div class="row">
                <div class="col m12 s12 center m-t-20">
                    <input type="radio" name="FilterType" id="Daily" value="Daily" checked="checked">
                    <label for="Daily">Daily</label>
                    <input type="radio" name="FilterType" id="Weekly" value="Weekly">
                    <label for="Weekly">Weekly</label>
                    <input type="radio" name="FilterType" id="Monthly" value="Monthly">
                    <label for="Monthly">Monthly</label>
                    <input type="radio" name="FilterType" id="Yearly" value="Yearly">
                    <label for="Yearly">Yearly</label>
                    <input type="radio" name="FilterType" id="Total" value="Total">
                    <label for="Total">Total</label>
                </div>
                <div id="dashboard_listing">
                </div>
            </div>
        </div>

        <!--card stats end-->
    </div>
</div>
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/report/FollowUpReport">Followup</a></h5>
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
                                <div class="input-field col m2 s12">
                                    <select class="select-dropdown">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="width_130"><?php echo label('msg_lbl_employeename') ?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_name') ?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_mobileno') ?></th>
                                    <th class="width_300"><?php echo label('msg_lbl_message') ?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_reminderdatetime') ?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_pastdatetime') ?></th>
                                </tr>
                            </thead>
                            <tbody id="table_body" class="table_body">
                            </tbody>
                        </table>
                    </div>
                    <div id="table_paging_div"></div>
                </div>
            </div>
        </div>
    </div>
    <!--end container-->

</section>

<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="javascript:void(0);">Lead</a></h5>
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
                                <div class="input-field col m2 s12">
                                    <select class="select-dropdown">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo label('msg_lbl_name'); ?></th>
                                    <th><?php echo label('msg_lbl_emailid'); ?></th>
                                    <th><?php echo label('msg_lbl_mobileno'); ?></th>
                                    <th><?php echo label('msg_lbl_pincode'); ?></th>
                                    <th><?php echo label('msg_lbl_leadtype'); ?></th>
                                    <th><?php echo label('msg_lbl_city'); ?></th>
                                    <th><?php echo label('msg_lbl_type'); ?></th>
                                </tr>
                            </thead>
                            <tbody id="leadtable_body" class="table_body">
                            </tbody>
                        </table>
                    </div>
                    <div id="leadtable_paging_div"></div>
                </div>
            </div>
        </div>
    </div>
    <!--end container-->
</section>

<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/sparkline/sparkline-script.js"></script>
<form id="dashboardfrm" action="<?php echo site_url('admin/report/report'); ?>" method="post">
    <input type="hidden" name="FilterType" id="FilterType" value="">
    <input type="hidden" name="FilterDiv" id="FilterDiv" value="">
</form>