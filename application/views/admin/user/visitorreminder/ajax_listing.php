<?php
foreach ($data_array as $data) { ?>

    <tr id="row_<?php echo $data->VisitorReminderID; ?>">
        <td>
            <?php
            if (@$this->reminder_module->is_response == 1) {
            ?>
                <a class="txt-underline bold" href="<?php echo site_url("admin/user/response/visitor/" . $data->VisitorID . "/" . $data->VisitorReminderID); ?>">
                <?php } ?>
                <?= $data->Message; ?>
                <?php
                if (@$this->reminder_module->is_response == 1) {
                ?>
                </a>
            <?php } ?>
        </td>
        <td><?= $data->ReminderDate; ?></td>
        <td><?= $data->PastDate; ?></td>
        <?php
        if ($data->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        if (@$this->cur_module->is_status == 1) {
            $status = CHANGE_STATUS;
        }
        ?>
        <td class="status action center status-box-th">
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status . ' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->VisitorID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS . ' ' . @$status; ?> hide" data-icon-type="loading" data-id="<?php echo $data->VisitorID; ?>"></i>
            <i title="Active" class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status . ' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->VisitorID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
        <td class="action center">

            <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo site_url('admin/user/visitorreminder/edit/' . $data->VisitorReminderID); ?>">
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>">
                </i>
            </a>

            <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $data->VisitorReminderID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>

            <!-- <a href="javascript:void(0)" data-id="<?php echo $data->VisitorReminderID; ?>" data-type="Mail" data-user="VisitorReminder" class="reminderbtn btn-floating waves-effect waves-light orange accent-4">
                  <i class="mdi-communication-email tooltipped" title="Send Mail"></i>
                </a>
                
                <a href="javascript:void(0)" data-id="<?php echo $data->VisitorReminderID; ?>" data-type="SMS" data-user="VisitorReminder" class="reminderbtn btn-floating waves-effect waves-light indigo accent-6">
                  <i class="mdi-communication-textsms tooltipped" title="Send SMS"></i>
                </a>
                
                <a href="javascript:void(0)" data-id="<?php echo $data->VisitorReminderID; ?>" class="addresponse btn-floating waves-effect waves-light teal darken-2">
                  <i class="mdi-content-reply tooltipped" title="Add Response"></i>
                </a> -->

        </td>

    </tr>
<?php }
?>