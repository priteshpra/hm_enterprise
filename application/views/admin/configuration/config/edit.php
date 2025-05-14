<div class="section">
<div class="container">
    <div class="card-panel card-panel-box">
        <h4 class="header"><a href="<?php echo site_url('admin/configuration/config'); ?>"><strong> Config </strong></a></h4>
        <div class="row">
                <form class="col s12" name="edit_config_form" id="edit_config_form" method="post" type="submit" action="<?php echo site_url('admin/configuration/config/'.$page); ?>" >
                    
                    <div class="row">
                        <div class="input-field col s12 m6">
                             <i class="<?php echo INFO_ICON_CLASS; ?> masterTooltip" title="Enter Crash Email, Crash Email Address must be in the proper format like : admin@gmail.com, Maximum length is 50"   ></i>
                            <input class="empty_validation_class email_validation_class" id="CrashEmail" name="CrashEmail" type="email" value="<?php echo @$config->CrashEmail; ?>" maxlength="50"  />
                            <label for="CrashEmail" class="active">Crash Email</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="<?php echo INFO_ICON_CLASS; ?> masterTooltip" title="Enter Support Email, Support Email Address must be in the proper format like : admin@gmail.com, Maximum length is 50"   ></i>
                            <input class="empty_validation_class email_validation_class" id="SupportEmail" name="SupportEmail" type="email"  value="<?php echo @$config->SupportEmail; ?>" maxlength="50" />
                            <label for="SupportEmail" class="active">Support Email</label>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="input-field col s12 m6">
                            <i class="<?php echo INFO_ICON_CLASS; ?> masterTooltip" title="Enter user Point Limit, Enter only Numeric values, Maximum Length is 4"></i>
                            <input id="UserPoint" name="UserPoint" type="text" value="<?php echo @$config->UserPoint; ?>" class="empty_validation_class NumberOnly" onkeypress="return isNumberKey(event);" maxlength="4" />
                            <label for="UserPoint" class="active">User Point Limit</label>
                        </div>
                        <div class="input-field col s12 m6">
                                <i class="<?php echo INFO_ICON_CLASS; ?> masterTooltip" title="Enter Refer Point, Enter only Numeric values, Maximum Length is 4"></i>
                                <input name="referpoint" id="referpoint" type="text" class="empty_validation_class NumberOnly" value="<?php echo @$config->ReferPoint; ?>" maxlength="4" />
                                <label for="referpoint" class="active">Refer Point</label>
                            </div>
                        <div class="input-field col s12 m6">
                                <i class="<?php echo INFO_ICON_CLASS; ?> masterTooltip" title="Enter Friend Refer Point, Enter only Numeric values, Maximum length is 4"></i>
                                <input name="friendreferpoint" id="friendreferpoint" type="text" class="empty_validation_class NumberOnly" value="<?php echo @$config->FriendReferPoint; ?>" maxlength="6" />
                                <label for="friendreferpoint" class="active">Friend Refer Point</label>
                        </div>
                        <div class="input-field col s12 m6 taxinput" <?php if (isset($config->IsTaxApplicable) && $config->IsTaxApplicable == INACTIVE) echo " style='display:none' ";?>>
                            <i class="<?php echo INFO_ICON_CLASS; ?> masterTooltip" title="Enter Tax, Enter only Numeric values, Maximum Length is 5"   ></i>
                            <input name="Tax" id="Tax" type="text" class="empty_validation_class AmountOnly" value="<?php if(@$config->Tax != 0) echo @$config->Tax; ?>" maxlength="5" />
                            <label for="Tax" class="active">Tax</label>
                        </div>
                    </div> 
					<div class="row">
                    <div class="input-field col s12 m6">
                          <input type="checkbox" class="filled-in" name="IsTaxApplicable" id="IsTaxApplicable"   
                          <?php
                                if (isset($config->IsTaxApplicable) && $config->IsTaxApplicable == INACTIVE) {
                                    echo "";
                                } else {
                                    echo "checked='checked'";
                                }
                                                     
                            ?>>
                            <label for="IsTaxApplicable">Is Tax Applicable?</label>     
                        </div>
                        
                    </div>
                <div class="row">
					<div class="">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right" name="button_submit_config" id="button_submit_config" type="button" ><!--indigo-->Submit
                                <i class="mdi-content-send right"></i>
                            </button>
                            <?php echo $loading_button; ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>  
	</div>
    </div>
</div>