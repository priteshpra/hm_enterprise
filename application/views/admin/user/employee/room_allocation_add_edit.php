<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/user/employee') ?>"><strong><?php echo label('msg_lbl_title_employee_room') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/user/employee/' . $page_name) ?>">
            <input id="UserID" name="UserID" value="<?php echo isset($UserID) ? $UserID : 0; ?>" type="hidden" />
            <div class="row">
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_roomno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="RoomNo" name="RoomNo" type="text" class="empty_validation_class NumberOnly" value="<?php echo @$data->RoomNo; ?>" />
                    <label for="RoomNo"><?php echo label('msg_lbl_roomno') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_room_address'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="RoomAddress" name="RoomAddress" type="text" class="empty_validation_class" value="<?php echo @$data->RoomAddress; ?>" maxlength="100" />
                    <label for="RoomAddress"><?php echo label('msg_lbl_room_address') ?></label>
                </div>

                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_startdate'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input type="text" name="StartDate" id="StartDate_allocation" value="<?php
                                                                                            echo date("d-m-Y"); ?>" class="datepicker empty_validation_class">
                    <label name="StartDate_allocation" class=""><?php echo label('StartDate') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enddate'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input type="text" name="EndDate" id="EndDate_allocation" value="<?php
                                                                                        echo date("d-m-Y"); ?>" class="datepicker empty_validation_class">
                    <label name="EndDate_allocation" class=""><?php echo label('EndDate') ?></label>
                </div>

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
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/user/employee') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>