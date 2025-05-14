<?php //pr($data_array);exit;
foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->BannerID; ?>">
        <?php 
            if(@$data->Image != null && (file_exists(BASEPATH.'../'.BANNER_UPLOAD_PATH.@$data->Image))){
                $path1 = site_url(BANNER_UPLOAD_PATH.$data->Image);
            }else{
                $path1 = $path = site_url(DEFAULT_IMAGE);
            }
        ?>
        <td>
            <a class="image-popup-vertical-fit" href="<?php echo $path1;?>" >
                <img src="<?php echo $path1;?>" width="100" height="75">
            </a>
        </td>
        <td><?php echo $data->Title; ?></td>
        <td><?php echo $data->SequenceNo; ?></td>
		<?php
        if ($data->Status == ACTIVE) {
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
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->BannerID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS . ' ' .@$status; ?> hide" data-icon-type="loading" data-id="<?php echo $data->BannerID; ?>"></i>
			<i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->BannerID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
		<td class="action center action-box-th">         
            <?php if(@$this->cur_module->is_edit == 1){?>
                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo site_url('admin/masters/banner/edit/'.$data->BannerID); ?>">
                    <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>">
                    </i>
                </a>
                &nbsp;&nbsp;
            <?php } ?>
			<a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $data->BannerID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>                                                                                                                                                                            
    </tr>
<?php } ?>   