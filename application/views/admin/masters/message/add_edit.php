<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/message') ?>"><strong><?php echo label('msg_lbl_message')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/message/'.$page_name) ?>">
            <input id="MessageID" name="MessageID" value="<?php echo isset($data->MessageID)?$data->MessageID:0; ?>" type="hidden"  />
            <div class="row">
                <div class="input-field col s6">
                    <input id="Language" name="Language" value="<?php echo @$data->MessageLanguage; ?>" type="text"  maxlength="50" class="empty_validation_class" Readonly />
                    <label for="Language"><?php echo label('msg_lbl_language')?></label>  
                </div>
                <div class="input-field col s6">
                    <input id="MessageKey" name="MessageKey" value="<?php echo @$data->MessageKey; ?>" type="text"  maxlength="250" class="empty_validation_class" Readonly />
                    <label for="MessageKey"><?php echo label('msg_lbl_messagekey')?></label>
                </div>
                <div class="input-field col s6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_Select_message');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="Message" name="Message" value="<?php echo @$data->Message; ?>" type="text"  maxlength="250" class="empty_validation_class"  />
                    <label for="Message"><?php echo label('msg_lbl_message')?></label>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class=""  name="Status" id="Status"   
                    <?php
                    if (isset($data->Status) && @$data->Status == INACTIVE) {
                        echo "";
                    } else {
                        echo "checked='checked'";
                    }
                    ?>>
                    <label for="Status"><?php echo label('msg_lbl_status');?></label>     
                </div>
                <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit');?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/masters/message') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
