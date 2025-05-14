<?php foreach ($data_array as $data) { ?>
    <tr>
        <td><?php echo $data->SalaryDate; ?></td>
        <td><?php echo $data->StartDate; ?></td>
        <td><?php echo $data->EndDate; ?></td>
        <td><?php echo $data->Present * $data->Rate . ' (' . $data->Present . ')'; ?></td>
        <td><?php echo $data->Absent * $data->Rate . ' (' . $data->Absent . ')'; ?></td>
        <td><?php echo $data->HalfDay * $data->Rate . ' (' . ($data->HalfDay * 2) . ')'; ?></td>
        <td><?php echo $data->HalfOverTime * $data->Rate . ' (' . ($data->HalfOverTime * 2) . ')'; ?></td>
        <td><?php echo $data->FullOverTime * $data->Rate . ' (' . $data->FullOverTime . ')'; ?></td>
        <td><?php echo $data->Penalty; ?></td>
        <td><?php echo $data->PayAmount; ?></td>
    </tr>
<?php } ?>