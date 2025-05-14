<?php //pr($user);
?>

<style>
    .selected.na {
        background-color: #6b6b6b;
    }

    .selected.present {
        background-color: #33691e;
    }

    .selected.absent {
        background-color: #B71C1C;
    }

    .selected.halfday {
        background-color: #f57f17;
    }

    .selected.halfday-overtime {
        background-color: #01579B;
    }

    .selected.fullday-overtime {
        background-color: #4a148c;
    }

    .selected.none {
        background-color: white;
    }

    .radio_parent {
        padding: 10px 0;
    }

    .radio_parent.selected label {
        color: white;
    }

    .radio_parent.none.selected label {
        color: black;
    }

    .radio_parent label {
        color: black;
        margin: 0;
    }

    input[type="radio"] {
        display: none !important;
    }

    .user_attandance button {
        border: 1px solid #a7a7a7;
        padding: 10px 5px;
        color: black
    }
</style>
<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/user/attendance/list') ?>"><strong><?php echo label('msg_lbl_attendance'); ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/user/attendance/' . $page_name) ?>">

            <input id="QuotationID" name="QuotationID" value="<?php echo @$data->QuotationID; ?>" type="hidden" />
            <input id="SitesID" name="SitesID" value="<?php echo @$data->SitesID; ?>" type="hidden" />
            <input id="CustomerID" name="CustomerID" value="<?php echo @$data->CustomerID; ?>" type="hidden" />

            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="text" name="AttendanceDate" id="AttendanceDate" value="<?php echo date("d-m-Y"); ?>" class="empty_validation_class" readonly>
                    <label name="AttendanceDate" class=""><?php echo label('msg_lbl_attendance') ?></label>
                </div>
            </div>
            <div class="row ">
                <?php
                if (!isset($user['0']->Message)) {
                    foreach ($user as $key => $value) { ?>
                        <div class="row user_attandance">
                            <div class="col s6 m2">
                                <span><?php echo $value->FirstName . ' ' . $value->LastName . ' (' . $value->MobileNo . ')'; ?></span>
                            </div>
                            <div class="col ">
                                <div class="radio_parent na <?php echo ((@$value->AttendanceID == '0')) ? 'selected' : ''; ?> <?php echo ((@$value->Attendance == '-1')) ? 'selected' : ''; ?>">
                                    <input type="radio" class="att_na" id="N_<?php echo $value->UserID; ?>" name="<?php echo $value->UserID; ?>" value="-1" checked <?php echo ((@$value->Attendance == '1')) ? 'checked="checked"' : ''; ?>>
                                    <label for="N_<?php echo $value->UserID; ?>">NA</label>
                                </div>
                            </div>
                            <div class="col ">
                                <div class="radio_parent present <?php echo ((@$value->Attendance == '1')) ? 'selected' : ''; ?>">
                                    <input type="radio" class="att_present" id="P_<?php echo $value->UserID; ?>" name="<?php echo $value->UserID; ?>" value="1" <?php echo ((@$value->Attendance == '1')) ? 'checked="checked"' : ''; ?>>
                                    <label for="P_<?php echo $value->UserID; ?>">Present</label>
                                </div>
                            </div>
                            <div class="col ">
                                <div class="radio_parent absent <?php echo ((@$value->Attendance == '0')) ? 'selected' : ''; ?>">
                                    <input type="radio" class="att_absent" id="A_<?php echo $value->UserID; ?>" name="<?php echo $value->UserID; ?>" value="0" <?php echo ((@$value->Attendance == '0')) ? 'checked="checked"' : ''; ?>>
                                    <label for="A_<?php echo $value->UserID; ?>">Absent</label>
                                </div>
                            </div>
                            <div class="col ">
                                <div class="radio_parent halfday <?php echo ((@$value->Attendance == '0.5')) ? 'selected' : ''; ?>">
                                    <input type="radio" class="att_halfday" id="H_<?php echo $value->UserID; ?>" name="<?php echo $value->UserID; ?>" value="0.5" <?php echo ((@$value->Attendance == '0.5')) ? 'checked="checked"' : ''; ?>>
                                    <label for="H_<?php echo $value->UserID; ?>">Half Day</label>
                                </div>
                            </div>
                            <div class="col ">
                                <div class="radio_parent halfday-overtime <?php echo ((@$value->Overtime == '0.5')) ? 'selected' : ''; ?>">
                                    <input type="radio" class="att_helper" id="HalfDayOVerTime_<?php echo $value->UserID; ?>" name="OverTime_<?php echo $value->UserID; ?>" value="0.5" <?php echo ((@$value->Overtime == '0.5')) ? 'checked="checked"' : ''; ?> <?php echo ((@$value->Attendance != '1' && @$value->AttendanceID != '0')) ? 'disabled="disabled"' : ''; ?>>
                                    <label for="HalfDayOVerTime_<?php echo $value->UserID; ?>">Half Day Over Time</label>
                                </div>
                            </div>
                            <div class="col ">
                                <div class="radio_parent fullday-overtime <?php echo ((@$value->Overtime == '1')) ? 'selected' : ''; ?>">
                                    <input type="radio" class="att_helper" id="FullDayOVerTime_<?php echo $value->UserID; ?>" name="OverTime_<?php echo $value->UserID; ?>" value="1" <?php echo ((@$value->Overtime == '1')) ? 'checked="checked"' : ''; ?> <?php echo ((@$value->Attendance != '1' && @$value->AttendanceID != '0')) ? 'disabled="disabled"' : ''; ?>>
                                    <label for="FullDayOVerTime_<?php echo $value->UserID; ?>">Full Day Over Time</label>
                                </div>
                            </div>
                            <div class="col ">
                                <div class="radio_parent none <?php echo ((@$value->Overtime == '0')) ? 'selected' : ''; ?>">
                                    <input type="radio" class="att_helper" id="None_<?php echo $value->UserID; ?>" name="OverTime_<?php echo $value->UserID; ?>" value="0" <?php echo ((@$value->Overtime == '0')) ? 'checked="checked"' : ''; ?> <?php echo ((@$value->Attendance != '1' && @$value->AttendanceID != '0')) ? 'disabled="disabled"' : ''; ?>>
                                    <label for="None_<?php echo $value->UserID; ?>">None</label>
                                </div>
                            </div>
                        </div>
                <?php  }
                } ?>
            </div>

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
                    <?php
                    if (!isset($user['0']->Message)) { ?>
                        <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php  } ?>
                    <?php echo $loading_button; ?>

                    <a href="<?php echo site_url('admin/user/attendance/list') ?>" class="clear-all right">Cancel</a>

                </div>
            </div>
        </form>
    </div>
</div>