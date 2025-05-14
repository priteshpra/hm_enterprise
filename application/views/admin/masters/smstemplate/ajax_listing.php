<?php //pr($data_array); die(); ?>
<?php foreach ($data_array as $data) { ?>

    <tr id="row_<?php echo $data->SMSTemplateID; ?>">   
        <td align="center"><?php echo $data->SmsTemplateTitle; ?></td> 
		<td align="center"><?php echo $data->SmsMessage; ?></td>  		
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
        <td class="center action">

            <i class="<?php echo INACTIVE_ICON_CLASS . ' ' . @$status.' ' . $inactive_icon_status; ?> btn-floating waves-effect waves-light red darken-4" data-icon-type="inactive" data-id="<?php echo $data->SMSTemplateID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i class="btn-floating waves-effect green accent-4 fa fa-spinner fa-spin fa-fw margin-bottom<?php echo LOADING_ICON_CLASS. ' ' .@$status; ?> hide" data-icon-type="loading" data-id="<?php echo $data->SMSTemplateID; ?>"></i>

            <i class="<?php echo ACTIVE_ICON_CLASS .' ' . @$status .' ' . $active_icon_status; ?> btn-floating waves-effect waves-light green accent-4" data-icon-type="active" data-id="<?php echo $data->SMSTemplateID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
        <td class="action center">
             <?php if(@$this->cur_module->is_edit == 1){?>
			<a href="<?php echo site_url('admin/masters/smstemplate/edit/'.$data->SMSTemplateID); ?>" class="btn-floating waves-effect waves-light blue"><i class="<?php echo EDIT_ICON_CLASS; ?>"></i>
            </a>
            &nbsp;&nbsp;
			 <?php }?>
            <a class="info bgglobal modal-trigger black btn-floating waves-effect " href="#modal1" data-id="<?php echo $data->SMSTemplateID; ?>">
                <i class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>      
        </td>      
    </tr>
<?php }
?>




