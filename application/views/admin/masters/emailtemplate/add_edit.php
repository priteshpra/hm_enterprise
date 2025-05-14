<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/masters/emailtemplate') ?>"><strong><?php echo label('msg_lbl_title_emailtemplate')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo site_url('admin/masters/emailtemplate/'.$page_name); ?>">
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_emailtemplatetitle');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="EmailTemplateTitle" name="EmailTemplateTitle" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->EmailTemplateTitle; ?>"  maxlength="100" />
                            <label for="EmailTemplateTitle"><?php echo label('msg_lbl_emailtemplatetitle')?></label>
                        </div>
                         <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_emailsubject');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="EmailSubject" name="EmailSubject" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->EmailSubject; ?>"  maxlength="200" />
                            <label for="EmailSubject"><?php echo label('msg_lbl_emailsubject')?></label>
                        </div>
                    </div> 
					<div class="row">
						<a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_content');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <label for="Content"><?php echo label('msg_lbl_content')?></label>
						<textarea name="Content" id="Content" class="materialize-textarea"><?php echo @$data->Content; ?></textarea>
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
                            <a href="<?php echo site_url('admin/masters/emailtemplate') ?>" class="clear-all right">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>