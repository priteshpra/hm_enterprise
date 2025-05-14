<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo site_url('admin/configuration/activitylog'); ?>"><?php echo label('msg_lbl_title_adminactivitylog');?></a></h5>
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
                                        <option value="10"  selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col l7 m6 s12 center">
                                    <span><label><?php echo label('msg_lbl_data_display');?> :</label></span> &nbsp;&nbsp;
                                    <input name="data_display" type="radio" id="All" value="All" class="ChangeFilter" checked="checked">
                                    <label for="All"><?php echo label('msg_lbl_all');?></label>
                                    <input name="data_display" type="radio" id="Filter" value="Filter" class="ChangeFilter">
                                    <label for="Filter"><?php echo label('msg_lbl_filter');?></label>  &nbsp;&nbsp;
                                </div>  
                                <div class="col l3 m4 s12 list-page-right-top-icon center">
                                    <a class="btn-floating waves-effect waves-light grey">
                                        <i class="FieldDisplay mdi-hardware-keyboard-arrow-down tooltipped" data-position="top" data-delay="50" data-tooltip="Search Filter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form class="col s12 SearchAction p-b-20" style="display:none;">
                            <div class="row card-panel">                                
                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value');?> </strong></h4>
                                <div class="row m-b-0">
                                    <div class="input-field col s12 m6">
                                        <input type="text" name="ActivitylogName" id="ActivitylogName" value="" class="form-control LetterOnly" maxlength="250">
                                        <label name="ActivitylogName" class=""><?php echo label('msg_lbl_activitylog');?></label>
                                    </div>   
                                    <div class="input-field col s12 m6">
                                        <input type="text" name="ActivityDate" id="ActivityDate" class="datepicker">
                                        <label name="ActivityDate"><?php echo label('msg_lbl_activitydate');?></label>
                                    </div>
                                </div>
                                <div class="row right">
                                    <a class="clear-all ClearAllFilter">Cancel</a>
                                    <button class="btn waves-effect waves-light SearchSubmit" type="button"><?php echo label('msg_lbl_submit');?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="display">
                            <thead>
                                <tr>
                                    <th class="width_200"><?php echo label('msg_lbl_activitylogname');?></th>
                                    <th class="width_500"><?php echo label('msg_lbl_description');?></th>
                                    <th class="width_200"><?php echo label('msg_lbl_date_time');?></th>
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