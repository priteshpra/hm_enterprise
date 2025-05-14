<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->SitesID; ?>">
        <td><?php echo $data->SiteName; ?></td>
        <td><?php echo $data->Name; ?></td>
        <td><?php echo $data->SiteType; ?></td>
        <td><?php echo $data->WorkingHours; ?></td>
        <td><?php echo $data->WorkingDays; ?></td>
        <td><?php echo $data->ProposedDate; ?></td>
        <td><?php echo $data->StartDate; ?></td>
        <td><?php echo $data->EndDate; ?></td>
        <td><?php echo $data->GSTNo; ?></td>
        <td><?php
            $Address = '';
            if ($data->Address != '') {
                $Address .= $data->Address;
            }
            if ($data->Address2 != '') {
                $Address .= ', ' . $data->Address2;
            }
            if ($data->CityName != '') {
                $Address .= ', ' . $data->CityName;
            }
            if ($data->StateName != '') {
                $Address .= ', ' . $data->StateName;
            }
            if ($data->PinCode != '') {
                $Address .= ' - ' . $data->PinCode;
            }
            echo $Address;
            ?></td>
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
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status . ' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->SitesID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS . ' ' . @$status; ?> hide" data-icon-type="loading" data-id="<?php echo $data->SitesID; ?>"></i>
            <i title="Active" class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status . ' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->SitesID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
        <td class="action center action-box-th">
            <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo site_url('admin/user/sites/edit/' . $data->SitesID); ?>">
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>">
                </i>
            </a>
            <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $data->SitesID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
            <a class="btn-floating waves-effect waves-light teal m-r-5" href="<?php echo site_url('admin/user/quotation/add/' . $data->SitesID); ?>">
                <i title="Add Quotation" class="mdi-av-my-library-add">
                </i>
            </a>
            <?php if(@$data->CustomerID != 0) { ?>
            <a class="btn-floating waves-effect waves-light deep-purple m-r-5" href="<?php echo site_url('admin/user/document/add/' . $data->SitesID); ?>">
                <i title="Add Document" class="mdi-content-content-copy">
                </i>
            </a>
            <?php } ?>
        </td>
    </tr>
<?php } ?>