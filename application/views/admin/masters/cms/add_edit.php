<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/masters/cms') ?>"><strong><?php echo label('msg_lbl_title_cms')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo site_url('admin/masters/cms/'.$page_name); ?>">
                    <div class="row">
                        <div class="input-field col s6">
                            <?php echo $Page;?>
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
                            <a href="<?php echo site_url('admin/masters/cms') ?>" class="clear-all right">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>