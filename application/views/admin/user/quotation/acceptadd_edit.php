<?php //pr($dataq);
?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/user/visitor/details/' . $dataq->VisitorID . '#Quotation'); ?>"><strong><?php echo label('msg_lbl_qoutation_accept') ?></strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/user/quotation/accept/<?php echo $page_name . '/' . @$ID; ?>">
                    <input id="QuotationID" name="QuotationID" value="<?php echo @$ID; ?>" type="hidden" />
                    <input id="CustomerID" name="CustomerID" value="<?php echo @$dataq->CustomerID; ?>" type="hidden" />
                    <input id="VisitorID" name="VisitorID" value="<?php echo @$dataq->VisitorID; ?>" type="hidden" />
                    <input id="SitesID" name="SitesID" value="<?php echo @$dataq->SitesID; ?>" type="hidden" />
                    <div class="input-field col s12 m6">
                        <input type="text" name="StartDate" id="StartDate" value="<?php
                                                                                    if (isset($data->QuotationID)) {
                                                                                        echo ($data->StartDate);
                                                                                    } else
                                                                                        echo date("d-m-Y"); ?>" class="datepickerval empty_validation_class ">
                        <label for="StartDate"><?php echo label('msg_lbl_startdate') ?></label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="EndDate" id="EndDate" value="<?php
                                                                                if (isset($data->QuotationID)) {
                                                                                    echo ($data->EndDate);
                                                                                } else
                                                                                    echo date("d-m-Y"); ?>" class="datepickerval empty_validation_class ">
                        <label for="EndDate"><?php echo label('msg_lbl_enddate') ?></label>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($visitor->Status) && @$visitor->Status == INACTIVE) {
                                                                                            echo "";
                                                                                        } else {
                                                                                            echo "checked='checked'";
                                                                                        }
                                                                                        ?>>
                            <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit"><?php echo label('msg_lbl_submit'); ?>
                            </button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo site_url('admin/user/visitor/details/' . $dataq->VisitorID . '#Quotation'); ?>" class="clear-all right">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>