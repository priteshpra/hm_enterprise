<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->EmployeeUniformID; ?>">
        <td><?php echo $data->EmployeeName; ?></td>
        <td><?php echo $data->Uniformtype; ?></td>
        <td><?php echo $data->UniformDate; ?></td>
    <?php } ?>