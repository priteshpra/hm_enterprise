<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/masters/smstemplate') ?>"><strong><?php echo label('msg_lbl_title_smstemplate')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/smstemplate/'.$page_name); ?>">
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_smstemplatetitle');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="SmsTemplateTitle" name="SmsTemplateTitle" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->SmsTemplateTitle; ?>"  maxlength="100" />
                            <label for="SmsTemplateTitle"><?php echo label('msg_lbl_smstemplatetitle')?></label>
                        </div>
                    </div> 
					<div class="row">
						<a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_smsmessage');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <label for="SmsMessage"><?php echo label('msg_lbl_smsmessage')?></label>
						<textarea name="SmsMessage" id="SmsMessage" class="materialize-textarea empty_validation_class" maxlength="140"><?php echo @$data->SmsMessage; ?></textarea>
					</div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($data->Status) && @$data->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status">Status</label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit');?></button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo site_url('admin/masters/smstemplate') ?>" class="clear-all right">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>