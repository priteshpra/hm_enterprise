<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/user/visitor') ?>"><strong><?php echo label('msg_lbl_visitor') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/user/visitor/' . $page_name) ?>" enctype="multipart/form-data">
            <input type="password" class="hide">
            <input id="VisitorID" name="VisitorID" value="<?php echo isset($data->VisitorID) ? $data->VisitorID : 0; ?>" type="hidden" />
            <input type="hidden" name="SubmitType" class="SubmitType" id="SubmitType" value="Submit">
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="Name" name="Name" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->Name; ?>" maxlength="100" />
                    <label for="Name"><?php echo label('msg_lbl_name') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="EmailID" name="EmailID" type="email" class="" value="<?php echo @$data->EmailID; ?>" maxlength="250" <?php echo isset($data->UserID) ? 'readonly' : ''; ?> />
                    <label for="EmailID"><?php echo label('msg_lbl_emailid') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="MobileNo" name="MobileNo" type="text" class="empty_validation_class MobileNo" value="<?php echo isset($data->VisitorID) ? $data->MobileNo : $this->session->userdata('MobileNo'); ?>" maxlength="10" readonly />
                    <label for="MobileNo"><?php echo label('msg_lbl_mobileno') ?></label>
                </div>

                <div class="input-field col s12 m6">
                    <label name="LeadType"><?php echo label('msg_lbl_leadtype') ?></label><br>
                    <?php
                    $leadtype = $this->configdata->LeadType;
                    $leadtype_array = explode(',', $leadtype);
                    foreach ($leadtype_array as $value) {
                    ?>
                        <input name="LeadType" type="radio" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo ((isset($data->LeadType) && @$data->LeadType == $value)) ? 'checked="checked"' : ''; ?> <?php if (!isset($data->LeadType) && $value == 'Cold') {
                                                                                                                                                                                                                                echo 'checked="checked"';
                                                                                                                                                                                                                            } ?> class="leadtype">
                        <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                    <?php
                    }
                    ?>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m4 hide">
                    <?php echo @$Country; ?>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$State; ?>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$City; ?>
                </div>
                <div class="input-field col s12 m6">
                    <input id="PinCode" name="PinCode" type="text" class="NumberOnly" value="<?php echo @$data->PinCode; ?>" maxlength="6" />
                    <label for="PinCode"><?php echo label('msg_lbl_pincode') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_address'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="Address" name="Address" type="text" class="empty_validation_class" value="<?php echo @$data->Address; ?>" maxlength="200" />
                    <label for="Address"><?php echo label('msg_lbl_address') ?></label>
                </div>
                <div class="clearfix"></div>
            </div>

            <?php if(!isset($data->VisitorID)) { ?>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="SiteName" name="SiteName" type="text" class="empty_validation_class" value="<?php echo @$data->SiteName; ?>" maxlength="100" />
                    <label for="SiteName"><?php echo label('msg_lbl_sitename') ?></label>
                </div>
                <!-- <div class="input-field col s6">
                    <input id="Name" name="Name" type="text" class="empty_validation_class" value="<?php echo @$data->Name; ?>" maxlength="100" />
                    <label for="Name">Company Name/Individual Name</label>
                </div> -->
                <div class="input-field col s12 m6 hide">
                    <input id="WorkingDays" name="WorkingDays" type="text" class="empty_validation_class AmountOnly" value="1<?php //echo @$data->WorkingDays; ?>" maxlength="100" />
                    <label for="WorkingDays"><?php echo label('msg_lbl_workingdays') ?></label>
                </div>
                <div class="input-field col s12 m6 hide">
                    <input id="WorkingHours" name="WorkingHours" type="text" class="empty_validation_class AmountOnly" value="1<?php //echo @$data->WorkingHours; ?>" maxlength="100" />
                    <label for="WorkingHours"><?php echo label('msg_lbl_workinghours') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="ProposedDate" id="ProposedDate" value="<?php
                                                                                    if (isset($data->VisitorID)) {
                                                                                        echo @$data->ProposedDate;
                                                                                    } else
                                                                                        echo date("d-m-Y"); ?>" class="datepicker empty_validation_class">
                    <label name="ProposedDate" class=""><?php echo label('msg_lbl_proposeddate') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="StartDate" id="StartDate" value="<?php
                                                                                if (isset($data->QuotationID)) {
                                                                                    echo ($data->StartDate);
                                                                                } else
                                                                                    echo date("d-m-Y"); ?>" class="datepicker empty_validation_class ">
                    <label for="StartDate"><?php echo label('msg_lbl_expectedstartdate') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="EndDate" id="EndDate" value="<?php
                                                                            if (isset($data->QuotationID)) {
                                                                                echo ($data->EndDate);
                                                                            } else
                                                                                echo date("d-m-Y"); ?>" class="datepicker empty_validation_class">
                    <label for="EndDate"><?php echo label('msg_lbl_expectedenddate') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="GSTNo" name="GSTNo" type="text" class="" value="<?php echo @$data->GSTNo; ?>" maxlength="15" />
                    <label for="GSTNo"><?php echo label('msg_lbl_gstno') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <div><span data-localize="exhibition-furthertext">Sites Type</span></div>
                    <input name="SiteType" class="SiteType" type="radio" id="Residential" value="Residential" <?php echo ((isset($data->SiteType) && @$data->SiteType == 'Residential')) ? 'checked="checked"' : ''; ?> <?php echo ((!isset($data->QuestionID))) ? 'checked="checked"' : ''; ?>>
                    <label for="Residential">Residential</label>
                    <input name="SiteType" class="SiteType" type="radio" id="Commercial" value="Commercial" <?php echo ((isset($data->SiteType) && @$data->SiteType == 'Commercial')) ? 'checked="checked"' : ''; ?>>
                    <label for="Commercial">Commercial</label>
                    <input name="SiteType" class="SiteType" type="radio" id="Industrial" value="Industrial" <?php echo ((isset($data->SiteType) && @$data->SiteType == 'Industrial')) ? 'checked="checked"' : ''; ?>>
                    <label for="Industrial">Industrial</label>
                </div>
            </div>
            <?php } else {?>
                <div class="row">
                    <?php if(isset($Sites[0]->SitesID)) { ?>
                        <?php foreach($Sites as $item) { ?>
                            <div class="input-field col s12 m3">
                                <input class="with-gap" name="SiteID" type="radio" id="Site<?=$item->SitesID?>">
                                <label for="Site<?=$item->SitesID?>">
                                    <b><?=$item->SiteName ?></b><br/>
                                    <?=$item->Address ?><?=$item->Address2!=""?", ".$item->Address2:"" ?><?=$item->CityName!=""?", ".$item->CityName:"" ?><?=$item->StateName!=""?", ".$item->StateName:"" ?>
                                </label>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class="" name="Status" id="Status" <?php
                        if (isset($data->Status) && @$data->Status == INACTIVE) {
                            echo "";
                        } else {
                            echo "checked='checked'";
                        }
                        ?>>
                    <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                </div>
                <div class="input-field col s12 m6 right">
                    <button class="btn waves-effect waves-light right button_submit" id="button_submit" name="button_submit" type="button" style="margin-left: 35px;" data-val="Add">Submit & add sites</button>
                    <button class="btn waves-effect waves-light right button_submit" id="button_submit" name="button_submit" type="button" data-val="Submit"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/user/visitor') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>