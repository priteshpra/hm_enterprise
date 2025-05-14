<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('my-profile') ?>"><strong><?php echo label('msg_lbl_my_profile')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('my-profile') ?>">
            <input id="PageID" name="PageID" value="<?php echo isset($data->PageID)?$data->PageID:0; ?>" type="hidden"  />
            <div class="row">
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_firstname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="FirstName" name="FirstName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->FirstName; ?>"  maxlength="100" />
                    <label for="FirstName"><?php echo label('msg_lbl_firstname')?></label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_lastname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="LastName" name="LastName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->LastName; ?>"  maxlength="100" />
                    <label for="LastName"><?php echo label('msg_lbl_firstname')?></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                  <input id="EmailID" type="email"  maxlength="100"  name="EmailID" value="<?php echo @$data->EmailID;?>" readonly>
                  <label for="EmailID" class=""><?php echo label('msg_lbl_email');?></label>
                </div>
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_mobileno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                  <input id="MobileNo" type="text"  class="empty_validation_class MobileNo"  name="MobileNo" value="<?php echo @$data->MobileNo;?>" maxlength="15">
                  <label for="MobileNo" class=""><?php echo label('msg_lbl_mobileno');?></label>
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
