<?php foreach ($pagemaster as $pagemaster) { ?>

    <tr id="row_<?php echo $pagemaster->PageID; ?>">   
        <td align="center"><?php echo $pagemaster->PageName; ?></td>
		 <?php
        if ($pagemaster->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        if(@$this->cur_module->is_status == 1){
            $status = CHANGE_STATUS;
        }
        ?>
        <td class="status action center status-box-th">
            <i title="Inactive" class="<?php echo INACTIVE_ICON_CLASS .' ' . @$status . ' ' . $inactive_icon_status; ?> btn-floating waves-effect waves-light red darken-4" data-icon-type="inactive" data-id="<?php echo $pagemaster->PageID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="<?php echo LOADING_ICON_CLASS . " " . @$status; ?> btn-floating waves-effect waves-light green hide" data-icon-type="loading" data-id="<?php echo $pagemaster->PageID; ?>"></i>
            <i title="Active" class="<?php echo ACTIVE_ICON_CLASS .' ' . @$status . ' ' . $active_icon_status; ?> btn-floating waves-effect waves-light green accent-4" data-icon-type="active" data-id="<?php echo $pagemaster->PageID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>    
        <td class="action center action-box-th">
        <?php if(@$this->cur_module->is_edit == 1){?>
            <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/pagemaster/edit/<?php echo $pagemaster->PageID; ?>" class="btn-floating waves-effect waves-light blue m-r-5"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" ></i>
            </a>
            &nbsp;&nbsp;
            <?php } ?>
            <a class="info bgglobal modal-trigger btn-floating waves-effect waves-light black" href="#modal1" data-id="<?php echo $pagemaster->PageID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>      
    </tr>
<?php }
?>




