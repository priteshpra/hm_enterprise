<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->TrainingEmployeeID; ?>">
        <td><?php echo $data->EmployeeName; ?></td>
        <td><?php echo $data->Training; ?></td>
        <td><?php echo $data->TrainingDate; ?></td>
        <td><?php echo $data->TrainingTime; ?></td>
<?php } ?>   