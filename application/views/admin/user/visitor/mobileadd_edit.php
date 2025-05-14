<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/user/visitor') ?>"><strong><?php echo label('msg_lbl_visitor') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/user/visitor/' . $page_name) ?>" >
            <input type="password" class="hide">
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="MobileNo" name="MobileNo" type="text" class="empty_validation_class MobileNo" value="<?php echo @$data->MobileNo; ?>" maxlength="10" />
                    <label for="MobileNo"><?php echo label('msg_lbl_mobileno') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo getServiceComboBox(); ?>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m6 right">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/user/visitor') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>