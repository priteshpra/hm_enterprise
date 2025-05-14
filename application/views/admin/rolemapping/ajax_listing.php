<?php 
foreach ($data_array as $data) {  ?>
    <tr id="row_<?php echo $data->UserID; ?>">
        <td><?=$data->RoleName; ?></td>
        <td><?=$data->FirstName ." " .$data->LastName; ?></td>
        <td class="center action">
            <a class="btn-floating waves-effect waves-light blue" href="<?php echo site_url('admin/rolemapping/add/'.$data->RoleID . "/".$data->UserID); ?>">
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"></i>
            </a>
        </td> 
    </tr>
<?php 
}
?>