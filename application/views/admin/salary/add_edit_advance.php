<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/salary') ?>"><strong><?php echo label('msg_lbl_advance_title') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/salary/' . $page_name) ?>">
            <div class="row">
                <div class="input-field col s12 m12">
                    <b>Advance</b>
                    <div class="row">
                        <div class="input-field col s12 m2">
                            <input type="text" name="Date" id="Date" value="<?= date('d-m-Y') ?>" maxlength="20" class="form-control datepicker empty_validation_class">
                            <label name="Date" class=""><?php echo label('msg_lbl_date'); ?></label>
                        </div>
                        <div class="input-field col s12 m1 ">
                            <input type="radio" name="Advance" id="Advance_Receive" class="empty_validation_class" value="Received" checked>
                            <label for="Advance_Receive" required><?php echo label('msg_lbl_received'); ?></label>
                        </div>
                        <div class="input-field col s12 m1 ">
                            <input type="radio" name="Advance" id="Advance_Paid" class="empty_validation_class" value="Paid">
                            <label for="Advance_Paid" required><?php echo label('msg_lbl_paid'); ?></label>
                        </div>
                        <div class="input-field col s12 m2 ">
                            <input type="text" name="AdvanceAmount" id="AdvanceAmount" class="NumberOnly empty_validation_class" value="" maxlength="20">
                            <label for="AdvanceAmount" class="" required><?php echo label('msg_lbl_advance'); ?></label>
                        </div>
                    </div>
                </div>
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
                <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/user/employee/details/'.$ID.'#Advance') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>