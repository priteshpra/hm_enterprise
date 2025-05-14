<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->InspectionAnswerID; ?>">
        <td><?php echo $data->Question; ?></td>
        <td><?php echo $data->Answer; ?></td>
    </tr>
<?php } ?>