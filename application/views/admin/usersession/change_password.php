<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('change-password') ?>"><strong><?php echo label('msg_lbl_change_password')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('change-password') ?>">
            <input id="PageID" name="PageID" value="<?php echo isset($data->PageID)?$data->PageID:0; ?>" type="hidden"  />
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="mdi-action-lock-outline prefix"></i>
                    <input id="current_password" class="empty_validation_class" name="current_password" type="password" maxlength = "32">
                    <label for="current_password"><?php echo label('msg_lbl_current_password');?></label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="mdi-action-lock-outline prefix"></i>
                    <input id="new_password" class="empty_validation_class" name="new_password"  type="password" maxlength = "32">
                    <label for="new_password"><?php echo label('msg_lbl_new_password');?></label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="mdi-action-lock-outline prefix"></i>
                    <input id="confirm_password" class="empty_validation_class" name="confirm_password"  type="password" maxlength = "32">
                    <label for="confirm_password"><?php echo label('msg_lbl_confirm_password');?></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6 right">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit');?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin-dashboard') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
