<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/configuration/config') ?>"><strong><?php echo label('msg_lbl_title_config') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/configuration/config/' . $page_name) ?>">
            <div class="row">
                <div class="row">
                    <div class="input-field col s6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_mailsentfrom'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input class="empty_validation_class" id="MailFromName" name="MailFromName" type="text" value="<?php echo @$data->MailFromName; ?>" maxlength="50" />
                        <label for="MailFromName" class="active"><?php echo label('msg_lbl_mailsentfrom') ?></label>
                    </div>
                    <div class="input-field col s6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_supportemail'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input class="empty_validation_class" id="SupportEmail" name="SupportEmail" type="email" value="<?php echo @$data->SupportEmail; ?>" maxlength="50" />
                        <label for="SupportEmail" class="active"><?php echo label('msg_lbl_supportemail') ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_mailpassword'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input class="empty_validation_class" id="EmailPassword" name="EmailPassword" type="text" value="<?php echo @$data->EmailPassword; ?>" maxlength="50" />
                        <label for="EmailPassword" class="active"><?php echo label('msg_lbl_mailpassword') ?></label>
                    </div>
                    <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_appversionandroid'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input class="empty_validation_class AmountOnly" id="AppVersionAndroid" name="AppVersionAndroid" type="text" value="<?php echo @$data->AppVersionAndroid; ?>" maxlength="4" />
                        <label for="AppVersionAndroid" class="active"><?php echo label('msg_lbl_appversionandroid') ?></label>
                    </div>

                </div>
                <div class="row hide">
                    <div class="input-field col s12 m6 ">
                        <label class="active">Select TimeZone</label>
                        <select id="TimeZone" name="TimeZone" class="select2_class">
                            <option value="" selected="">Select TimeZone</option>
                            <option value='00:00' <?php if (@$data->TimeZone == '+00:00') {
                                                        echo 'selected';
                                                    } ?>> +00:00 </option>
                            <option value='05:30' <?php if (@$data->TimeZone == '+05:30') {
                                                        echo 'selected';
                                                    } ?>> +05:30 </option>
                        </select>
                    </div>
                    <div class="input-field col s12 m6 >
                         <a class=" tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_appversionios'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input class="empty_validation_class AmountOnly" id="AppVersionIOS" name="AppVersionIOS" type="text" value="<?php echo @$data->AppVersionIOS; ?>" maxlength="4" />
                        <label for="AppVersionIOS" class="active"><?php echo label('msg_lbl_appversionios') ?></label>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m6 right">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                </div>
            </div>
        </form>
    </div>
</div>