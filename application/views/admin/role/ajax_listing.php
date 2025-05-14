<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->RoleID; ?>">

        <td align="center"><a class="txt-underline bold" href="<?php echo site_url('admin/rolemapping/index/'.$data->RoleID);?>"><?php echo $data->RoleName; ?></a></td>
        <?php
        if ($data->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        ?>
        <td class="center action">
            <a class="btn-floating waves-effect waves-light blue" href="<?php echo site_url('admin/role/edit/'.$data->RoleID); ?>" >
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>">
                </i>
            </a>
            &nbsp;&nbsp;
            <a class="info bgglobal modal-trigger btn-floating waves-effect black" href="#modal1" data-id="<?php echo $data->RoleID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>                                                                    
    </tr>
<?php } ?>   