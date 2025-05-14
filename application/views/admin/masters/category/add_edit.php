<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/category') ?>"><strong><?php echo label('msg_lbl_category')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/category/'.$page_name) ?>">
            <input id="CategoryID" name="CategoryID" value="<?php echo isset($data->CategoryID)?$data->CategoryID:0; ?>" type="hidden"  />
            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="text" name="Category" id="Category" maxlength="50" class="form-control LetterOnly empty_validation_class" value="<?php echo @$data->Category; ?>">
                    <label name="Category" class=""><?php echo label('msg_lbl_category');?></label>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$Category; ?>
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
                    <a href="<?php echo site_url('admin/masters/category') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
