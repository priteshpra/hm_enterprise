<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo site_url('admin/role'); ?>"><?php echo label('msg_lbl_title_roles');?></a></h5>
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
                        <div class="col s12 m12 l12">
                          <input type="hidden" value="<?php echo @$role_data->RoleID?>" id="RoleMpID"/>
                          <h5 class="breadcrumbs-title text-uppercase"><a class="txt-underline" href="<?php echo site_url('admin/rolemapping/index/'.@$role_data->RoleID);?>"> <?= (@$role_data->RoleName)?$role_data->RoleName:"Role Mapping";?></a></h5>
                        </div>
                        <div class="col s12">
                            <div class="row m-b-0">
                                <div class="input-field col l2 m2 s12">
                                    <select id="PageSize" class="PageSize select_materialize">
                                        <option value="10"  selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col l3 m4 s12 list-page-right-top-icon center right">
                                    <a class="btn-floating  waves-effect waves-light export-excel" href="<?php echo site_url('admin/rolemapping/export_to_excel');?>">
                                        <i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i>
                                    </a>
                                    <a class="btn-floating  waves-effect waves-light green accent-6" href="<?php echo site_url("admin/rolemapping/add/".@$role_data->RoleID);?>">
                                        <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="display">
                            <thead>
                                <tr>
                                    <th ><?php echo label('msg_lbl_roles');?></th>
                                    <th ><?php echo label('msg_lbl_name');?></th>
                                    <th class="width_100 actions center"><?php echo label('msg_lbl_actions');?></th>
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
</section>
<!-- END CONTENT-->