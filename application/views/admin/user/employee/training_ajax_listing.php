<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->UserID; ?>">
        <td><?php echo $data->Training; ?></td>
		<td><?php echo $data->TrainingDate.' '.$data->TrainingTime; ?></td>

<!-- 		<td class="action center action-box-th"> 
            <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php //echo site_url('admin/user/employee/edit/'.$data->UserID); ?>">
                <i title="Edit" class="<?php //echo EDIT_ICON_CLASS; ?>">
                </i>
            </a>
        </td>    -->                                                                                                                                                                         
    </tr>
<?php } ?>   