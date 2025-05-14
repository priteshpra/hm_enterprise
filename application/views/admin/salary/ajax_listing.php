<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->SalaryID; ?>">
        <td><?php echo $data->FirstName . ' ' . $data->LastName; ?></td>
        <td><?php echo $data->MobileNo; ?></td>
        <td><?php echo $data->SalaryDate; ?></td>
        <td><?php echo $data->StartDate; ?></td>
        <td><?php echo $data->EndDate; ?></td>
        <td><?php echo $data->Present * $data->Rate . ' ('.$data->Present.')'; ?></td>
        <td><?php echo $data->Absent * $data->Rate. ' ('.$data->Absent.')'; ?></td>
        <td><?php echo $data->HalfDay * $data->Rate . ' ('.($data->HalfDay*2).')'; ?></td>
        <td><?php echo $data->HalfOverTime * $data->Rate . ' ('.($data->HalfOverTime*2).')'; ?></td>
        <td><?php echo $data->FullOverTime * $data->Rate . ' ('.$data->FullOverTime.')'; ?></td>
        <td><?php echo $data->Penalty; ?></td>
        <td><?php echo $data->PayAmount; ?></td>
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
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status . ' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->SalaryID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS . ' ' . @$status; ?> hide" data-icon-type="loading" data-id="<?php echo $data->SalaryID; ?>"></i>
            <i title="Active" class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status . ' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->SalaryID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
        <td class="action center action-box-th">
            <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $data->SalaryID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>
    </tr>
<?php } ?>