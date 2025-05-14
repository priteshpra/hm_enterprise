<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->CheckincheckoutID; ?>">
        <td><?php echo $data->Checkintime; ?></td>
        <td><?php echo $data->Checkouttime; ?></td>
        <td><?php echo $data->InAddress; ?></td>
        <td><?php echo $data->OutAddress; ?></td>
    </tr>
<?php } ?>