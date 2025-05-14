<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->TicketID; ?>">

        <td align="center"><?php echo $data->Title; ?></td>
        <td align="center"><?php echo $data->Description; ?></td>
        <td align="center"><?php echo $data->Priority; ?></td>
        <td align="center"><img class="txt-underline bold" src="<?php echo site_url('assets/uploads/ticket/') . $data->Image; ?>" width="120"></td>
        <td align="center"><?php echo $data->FirstName . ' ' . $data->LastName; ?></td>

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
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status . ' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->TicketID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS . ' ' . @$status; ?> hide" data-icon-type="loading" data-id="<?php echo $data->TicketID; ?>"></i>
            <i title="Active" class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status . ' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->TicketID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
        <td class="center action">
            <a class="btn-floating waves-effect waves-light blue" href="<?php echo site_url('admin/user/tickets/edit/' . $data->TicketID); ?>">
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>">
                </i>
            </a>
            &nbsp;&nbsp;
            <a class="info bgglobal modal-trigger btn-floating waves-effect black" href="#modal1" data-id="<?php echo $data->TicketID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>
    </tr>
<?php } ?>