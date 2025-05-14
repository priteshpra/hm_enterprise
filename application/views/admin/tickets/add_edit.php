<?php //pr($ticket); die;?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header"><a href="<?php echo site_url('admin/role'); ?>"><strong>Tickets</strong></a></h4>
            <form id="edit_rolemapping_form" method="post" action="<?php echo site_url('admin/user/tickets/' . $page_name); ?>" enctype="multipart/form-data">
                <div class="row">
                    <input type="hidden" name="TicketID" id="TicketID" value="<?php echo @$TicketID; ?>" />
                    <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_rolename'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="Name" name="Name" type="text" maxlength="50" class="empty_validation_class LetterOnly" value="<?php echo @$ticket->Title; ?>" />
                        <label for="Name"><?php echo 'Title'; ?></label>
                    </div>
                    <div class="input-field col s12 m6">
                        <?php
                        $High = '';
                        $Medium = '';
                        $Low = '';
                        if (@$ticket->Priority == 'Low') {
                            $Low = 'selected';
                        } else if (@$ticket->Priority == 'High') {
                            $High = 'selected';
                        } else {
                            $Medium = 'selected';
                        }

                        ?>
                        <select id="PriorityID" name="PriorityID" class="select2_class">
                            <option value="">---Select Priority---</option>
                            <option value="1" <?php echo $High; ?>>High</option>
                            <option value="2" <?php echo $Medium; ?>>Medium</option>
                            <option value="3" <?php echo $Low; ?>>Low</option>
                        </select>
                    </div>
                    <div class="input-field col s12 m6">
                        <?php echo @$Subject ?>
                    </div>
                    <div class="input-field col s12 m6" style="display: none;">
                        <?php echo @$Country; ?>
                    </div>
                    <div class="input-field col s12 m6">
                        <?php echo @$State; ?>
                    </div>
                    <div class="input-field col s12 m6">
                        <?php echo @$City; ?>
                    </div>
                    <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_roledescription'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="Description" name="Description" type="text" maxlength="200" class="empty_validation_class LetterOnly" value="<?php echo @$ticket->Description ?>" />
                        <label for="Description"><?php echo label('msg_lbl_roledescription'); ?></label>
                    </div>
                    <div class="row pl-15">
                        <?php
                        if (@$ticket->Image != null && (file_exists(BASEPATH . '../' . TICKET_UPLOAD_PATH . @$ticket->Image))) {
                            $path1 = site_url(TICKET_UPLOAD_PATH . $ticket->Image);
                        } else {
                            $path1 = $path = site_url(DEFAULT_IMAGE);
                        }
                        ?>
                        <div class="m-t-20 col s12 m12">
                            <label class="imageview-label"><?php echo label('msg_lbl_image'); ?></label>
                            <div class="row">
                                <div class="input-field m-t-0 col s12 m2 imageview1">
                                    <img width="150" id="PhotoURLPreview" src='<?php echo $path1; ?>'>
                                    <a id="PhotoURLCross" class="cross1 hide" data-img="PhotoURLPreview" data-file="userfile" data-edit="editProfilePicture"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                                </div>
                                <div class="file-field input-fieldcol col s12 m10 m-t-10">
                                    <input tabindex="999" class="file-path empty_validation_class" type="text" id="editProfilePicture" name="editProfilePicture" value='<?php echo @$ticket->Image; ?>' readonly />
                                    <div class="btn">
                                        <span>File</span>
                                        <input accept="image/*" type="file" name="Image" id="Image" class="images" data-cross="PhotoURLCross" data-img="PhotoURLPreview" data-edit="editProfilePicture" data-type="image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
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
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light right" name="button_submit" id="button_submit" type="submit">Submit

                        </button>
                        <?php echo $loading_button; ?>
                        <a href="<?php echo site_url('admin/user/tickets'); ?>" class="right close-button">Cancel</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>