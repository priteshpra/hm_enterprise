<?php 
foreach ($data_array as $data) { ?>

    <tr id="row_<?php echo $data->MessageID; ?>">
        <td align="center"><?php echo ucfirst($data->MessageLanguage); ?></td>    
        <td align="center"><?php echo $data->MessageKey; ?></td>
        <td align="center"><?php echo $data->Message; ?></td> 

        <td class="action center">
            <a href="<?php echo site_url('admin/masters/message/edit/'.$data->MessageID); ?>" class="btn-floating waves-effect waves-light blue"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0"></i>
            </a>
        
        </td>      
    </tr>
<?php }
?>




