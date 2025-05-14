<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/city') ?>"><strong><?php echo label('msg_lbl_title_city') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/city/' . $page_name) ?>">
            <input id="CityID" name="CityID" value="<?php echo isset($data->CityID) ? $data->CityID : 0; ?>" type="hidden" />
            <div class="row">
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_city'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="CityName" name="CityName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->CityName; ?>" maxlength="100" />
                    <label for="CityName"><?php echo label('msg_lbl_city') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$Country; ?>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <?php echo @$State; ?>
                </div>
                <div class="input-field radio_input_field_add_edit col s12 m6">
                    <label><?php echo label('msg_lbl_isopen'); ?></label><br />
                    <input name="IsOpen" type="radio" id="Yes" value="Yes" checked="checked" <?php echo ((isset($data->IsOpen) && @$data->IsOpen == 'Yes')) ? 'checked="checked"' : ''; ?>>
                    <label for="Yes"><?php echo label('msg_lbl_yes') ?></label>
                    <input name="IsOpen" type="radio" id="No" value="No" <?php echo ((isset($data->IsOpen) && @$data->IsOpen == 'No')) ? 'checked="checked"' : ''; ?>>
                    <label for="No"><?php echo label('msg_lbl_no'); ?></label>
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
                    <a href="<?php echo site_url('admin/masters/city') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>