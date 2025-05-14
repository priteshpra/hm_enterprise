<?php //pr($data); 
?>
<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/user/customer/details/' . $data->CustomerID . '#Teamdefination') ?>"><strong><?php echo label('msg_lbl_teamdefination') . ' - ' . $data->EstimateNo . ' - ' . $data->Service ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/user/teamdefination/' . $page_name) ?>">

            <input id="QuotationID" name="QuotationID" value="<?php echo $data->QuotationID; ?>" type="hidden" />
            <input id="SitesID" name="SitesID" value="<?php echo $data->SitesID; ?>" type="hidden" />
            <input id="CustomerID" name="CustomerID" value="<?php echo $data->CustomerID; ?>" type="hidden" />

            <div class="row">

                <div class="input-field col s12 m6">
                    <input type="text" name="StartDate" id="StartDate" value="<?php echo @$data->StartDate; ?>" class="datepicker empty_validation_class">
                    <label name="StartDate" class=""><?php echo label('msg_lbl_startdate') ?></label>
                </div>
                <div class="input-field col s6">
                    <label class="timeplabel" for="StartTime"><?php echo label('msg_lbl_starttime'); ?></label>
                    <input id="StartTime" name="StartTime" class="timep " value="" type="text">
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="EndDate" id="EndDate" value="<?php echo @$data->EndDate; ?>" class="datepicker empty_validation_class">
                    <label name="EndDate" class=""><?php echo label('msg_lbl_enddate') ?></label>
                </div>
                <div class="input-field col s6">
                    <label class="timeplabel" for="EndTime"><?php echo label('msg_lbl_endtime'); ?></label>
                    <input id="EndTime" name="EndTime" class="timep " value="" type="text">
                </div>
                <div class="input-field col s12 m6">
                    <input type="radio" name="Type" id="ETNew" value="New" checked />
                    <label for="ETNew">New</label>
                    <input type="radio" name="Type" id="ETRokadi" value="Rokadi" />
                    <label for="ETRokadi">Rokadi</label>
                    <input type="radio" name="Type" id="ETShuffle" value="Shuffle" />
                    <label for="ETShuffle">Shuffle</label>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m12">
                    <?php echo @$User; ?>
                </div>
            </div>
            <div class="row">
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                if (isset($data->Status) && @$data->Status == INACTIVE) {
                                                                                    echo "";
                                                                                } else {
                                                                                    echo "checked='checked'";
                                                                                }
                                                                                ?>>
                    <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                </div>
                <div class="input-field col s12 m6 right">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/user/customer/details/' . $data->CustomerID . '#Teamdefination') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>