<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/usertype') ?>"><strong><?php echo label('msg_lbl_usertype')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/usertype/'.$page_name) ?>">
            <input id="UsertypeID" name="UsertypeID" value="<?php echo isset($data->UsertypeID)?$data->UsertypeID:0; ?>" type="hidden"  />
            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="text" name="UsertypeData" id="UsertypeData" maxlength="50" class="form-control empty_validation_class" value="<?php echo @$data->Usertype; ?>">
                    <label name="UsertypeData" class=""><?php echo label('msg_lbl_usertype');?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="HSNNo" id="HSNNo" maxlength="50" class="form-control empty_validation_class" value="<?php echo @$data->HSNNo; ?>">
                    <label name="HSNNo" class=""><?php echo label('msg_lbl_hsnno');?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="Rate" id="Rate" maxlength="50" class="form-control NumberOnly empty_validation_class" value="<?php echo @$data->Rate; ?>">
                    <label name="Rate" class=""><?php echo label('msg_lbl_rate');?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class=""  name="IsMaterial" id="IsMaterial" <?= (@$data->IsMaterial == ACTIVE) ? "checked='checked'" : "" ?>>
                    <label for="IsMaterial"><?php echo label('msg_lbl_ismaterial');?></label>     
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
                    <a href="<?php echo site_url('admin/masters/usertype') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
