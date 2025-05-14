<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/page') ?>"><strong><?php echo label('msg_lbl_title_page')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/page/'.$page_name) ?>">
            <input id="PageID" name="PageID" value="<?php echo isset($data->PageID)?$data->PageID:0; ?>" type="hidden"  />
            <div class="row">
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_pagename');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="PageName" name="PageName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->PageName; ?>"  maxlength="100" />
                    <label for="PageName"><?php echo label('msg_lbl_pagename')?></label>
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
                    <a href="<?php echo site_url('admin/masters/page') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
