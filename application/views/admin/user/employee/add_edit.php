<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/user/employee') ?>"><strong><?php echo label('msg_lbl_title_employee') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/user/employee/' . $page_name) ?>" enctype="multipart/form-data">
            <input type="password" class="hide">
            <input id="UserID" name="UserID" value="<?php echo isset($data->UserID) ? $data->UserID : 0; ?>" type="hidden" />
            <div class="row">
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_firstname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="FirstName" name="FirstName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->FirstName; ?>" maxlength="100" />
                    <label for="FirstName"><?php echo label('msg_lbl_firstname') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_lastname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="LastName" name="LastName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->LastName; ?>" maxlength="100" />
                    <label for="LastName"><?php echo label('msg_lbl_lastname') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_emailid'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="EmailID" name="EmailID" type="email" class="" value="<?php echo @$data->EmailID; ?>" maxlength="250" <?php echo isset($data->UserID) ? 'readonly' : ''; ?> />
                    <label for="EmailID"><?php echo label('msg_lbl_emailid') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_mobileno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="MobileNo" name="MobileNo" type="text" class="empty_validation_class MobileNo" value="<?php echo @$data->MobileNo; ?>" maxlength="10" />
                    <label for="MobileNo"><?php echo label('msg_lbl_mobileno') ?></label>
                </div>
                <?php if (!isset($data->UserID)) { ?>
                    <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_password'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="Password" name="Password" type="password" class="empty_validation_class" value="" maxlength="32" />
                        <label for="Password"><?php echo label('msg_lbl_password') ?></label>
                    </div>
                    <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_confirm_password'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="ConfirmPassword" name="ConfirmPassword" type="password" class="empty_validation_class" value="" maxlength="32" />
                        <label for="ConfirmPassword"><?php echo label('msg_lbl_confirm_password') ?></label>
                    </div>
                <?php } ?>
                <div class="input-field col s12 m4 hide">
                    <?php echo @$Country; ?>
                </div>
                <div class="input-field col s12 m4 hide">
                    <?php echo @$State; ?>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$City; ?>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_address'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="Address" name="Address" type="text" class="empty_validation_class" value="<?php echo @$data->Address; ?>" maxlength="200" />
                    <label for="Address"><?php echo label('msg_lbl_address') ?></label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="JoiningDate" id="JoiningDate" value="<?php echo isset($data->JoiningDate) ? @$data->JoiningDate : date('d-m-Y'); ?>" class="datepickerval empty_validation_class">
                    <label name="JoiningDate" class=""><?php echo label('msg_lbl_joiningdate') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="Salary" name="Salary" type="text" class="AmountOnly" value="<?php echo @$data->Salary; ?>" maxlength="20" />
                    <label for="Salary"><?php echo label('msg_lbl_salary') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="WorkingHours" name="WorkingHours" type="text" class="" value="<?php echo @$data->WorkingHours; ?>" maxlength="20" />
                    <label for="WorkingHours"><?php echo label('msg_lbl_workinghours') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="BankName" name="BankName" type="text" class="LetterOnly" value="<?php echo @$data->BankName; ?>" maxlength="50" />
                    <label for="BankName"><?php echo label('msg_lbl_bankname') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="BranchName" name="BranchName" type="text" class="" value="<?php echo @$data->BranchName; ?>" maxlength="50" />
                    <label for="BranchName"><?php echo label('msg_lbl_branchname') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="AccountNo" name="AccountNo" type="text" class="NumberOnly" value="<?php echo @$data->AccountNo; ?>" maxlength="16" />
                    <label for="AccountNo"><?php echo label('msg_lbl_accountno') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="IFSCCode" name="IFSCCode" type="text" class="NumberLetter" value="<?php echo @$data->IFSCCode; ?>" maxlength="11" />
                    <label for="IFSCCode"><?php echo label('msg_lbl_ifsccode') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="GSTNo" name="GSTNo" type="text" class="NumberOnly empty_validation_class" value="<?php echo @$data->GSTNo; ?>" maxlength="12" />
                    <label for="GSTNo"><?php echo label('msg_lbl_gstno') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$UserType; ?>
                </div>
                <div class="row">
                    <?php
                    if (@$data->Documents != null && (file_exists(BASEPATH . '../' . USERDOCUMENT_UPLOAD_PATH . @$data->Documents))) {
                        $path1 = site_url(USERDOCUMENT_UPLOAD_PATH . $data->Documents);
                    } else {
                        $path1 = $path = site_url(DEFAULT_IMAGE);
                    }
                    ?>
                    <div class="m-t-20 col s12 m12">
                        <label class="imageview-label"><?php echo label('msg_lbl_aadharcard'); ?></label>
                        <div class="row">
                            <div class="input-field m-t-0 col s12 m2 imageview1">
                                <img width="150" id="PhotoURLPreview" src='<?php echo $path1; ?>'>
                                <a id="PhotoURLCross" class="cross1 hide" data-img="PhotoURLPreview" data-file="userfile" data-edit="editProfilePicture"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                            </div>
                            <div class="file-field input-fieldcol col s12 m10 m-t-10">
                                <input tabindex="999" class="file-path empty_validation_class" type="text" id="editProfilePicture" name="editProfilePicture" value='<?php echo @$data->Documents; ?>' readonly />
                                <div class="btn">
                                    <span>File</span>
                                    <input accept="image/*" type="file" name="userfile" id="userfile" class="images" data-cross="PhotoURLCross" data-img="PhotoURLPreview" data-edit="editProfilePicture" data-type="image" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (@$data->OfferLetter != null && (file_exists(BASEPATH . '../' . USEROFEERLETTER_UPLOAD_PATH . @$data->OfferLetter))) {
                        $path1 = site_url(USEROFEERLETTER_UPLOAD_PATH . $data->OfferLetter);
                    } else {
                        $path1 = $path = site_url(DEFAULT_IMAGE);
                    }
                    ?>
                    <div class="m-t-20 col s12 m12">
                        <label class="imageview-label"><?php echo label('msg_lbl_offerletter'); ?></label>
                        <div class="row">
                            <div class="input-field m-t-0 col s12 m2 imageview1">
                                <img width="150" id="PhotoURLPreview1" src='<?php echo $path1; ?>'>
                                <a id="PhotoURLCross1" class="cross1 hide" data-img="PhotoURLPreview1" data-file="userfile1" data-edit="editProfilePicture1"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                            </div>
                            <div class="file-field input-fieldcol col s12 m10 m-t-10">
                                <input tabindex="999" class="file-path empty_validation_class" type="text" id="editProfilePicture1" name="editProfilePicture1" value='<?php echo @$data->OfferLetter; ?>' readonly />
                                <div class="btn">
                                    <span>File</span>
                                    <input accept="image/*" type="file" name="userfile1" id="userfile1" class="images" data-cross="PhotoURLCross1" data-img="PhotoURLPreview1" data-edit="editProfilePicture1" data-type="image" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (@$data->ProfilePic != null && (file_exists(BASEPATH . '../' . USER_UPLOAD_PATH . @$data->ProfilePic))) {
                        $path1 = site_url(USER_UPLOAD_PATH . $data->ProfilePic);
                    } else {
                        $path1 = $path = site_url(DEFAULT_IMAGE);
                    }
                    ?>
                    <div class="m-t-20 col s12 m12">
                        <label class="imageview-label"><?php echo label('msg_lbl_profilepic'); ?></label>
                        <div class="row">
                            <div class="input-field m-t-0 col s12 m2 imageview1">
                                <img width="150" id="PhotoURLPreview2" src='<?php echo $path1; ?>'>
                                <a id="PhotoURLCross2" class="cross1 hide" data-img="PhotoURLPreview2" data-file="userfile2" data-edit="editProfilePicture2"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                            </div>
                            <div class="file-field input-fieldcol col s12 m10 m-t-10">
                                <input tabindex="999" class="file-path empty_validation_class" type="text" id="editProfilePicture2" name="editProfilePicture2" value='<?php echo @$data->ProfilePic; ?>' readonly />
                                <div class="btn">
                                    <span>File</span>
                                    <input accept="image/*" type="file" name="userfile2" id="userfile2" class="images" data-cross="PhotoURLCross2" data-img="PhotoURLPreview2" data-edit="editProfilePicture2" data-type="image" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m6 right">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/user/employee') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>