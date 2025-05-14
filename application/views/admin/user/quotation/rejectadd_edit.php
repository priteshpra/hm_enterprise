<?php //pr($dataq);
?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/user/visitor/details/' . $dataq->VisitorID . '#Quotation'); ?>"><strong><?php echo label('msg_lbl_qoutation_reject') ?></strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/user/quotation/reject/<?php echo $page_name . '/' . @$ID; ?>">
                    <input id="QuotationID" name="QuotationID" value="<?php echo @$ID; ?>" type="hidden" />
                    <input id="CustomerID" name="CustomerID" value="<?php echo @$dataq->CustomerID; ?>" type="hidden" />
                    <input id="SitesID" name="SitesID" value="<?php echo @$dataq->SitesID; ?>" type="hidden" />
                    <input id="VisitorID" name="VisitorID" value="<?php echo @$dataq->VisitorID; ?>" type="hidden" />
                    <div class="row">
                        <div>
                            <?php foreach ($reason_array as $data) { ?>
                                <input name="Reason" class="Reason" type="radio" id="<?php echo $data->ReasonID; ?>" value="<?php echo $data->ReasonID; ?>" checked="checked">
                                <label for="<?php echo $data->ReasonID; ?>" style="color:#000;"><?php echo $data->Reason; ?></label>
                                <br />
                            <?php } ?>
                        </div>
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