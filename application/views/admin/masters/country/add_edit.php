<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/country') ?>"><strong><?php echo label('msg_lbl_title_country')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/country/'.$page_name) ?>">
            <input id="CountryID" name="CountryID" value="<?php echo @$data->CountryID; ?>" type="hidden"  />
            <div class="row">
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_country_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="CountryName" name="CountryName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->CountryName; ?>"  maxlength="100" />
                    <label for="CountryName"><?php echo label('msg_lbl_country')?></label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_sort_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="SortName" name="SortName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->SortName; ?>"  maxlength="3" />
                    <label for="SortName"><?php echo label('msg_lbl_sortname')?></label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_mobilecode');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="MobileCode" name="MobileCode" type="text" class="empty_validation_class" value="<?php echo @$data->MobileCode; ?>"  maxlength="4" />
                    <label for="MobileCode"><?php echo label('msg_lbl_mobilecode')?></label>
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
                    <a href="<?php echo site_url('admin/masters/country') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
