<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->TeamdefinationID; ?>">
        <td><?php echo $data->EstimateNo; ?></td>
        <td><?php echo $data->EmployeeName; ?></td>
        <td><?php echo $data->StartDate . ' ' . $data->StartTime; ?></td>
        <td><?php echo $data->EndDate . ' ' . $data->EndTime; ?></td>
        <td><?php echo $data->SiteUserFrindlyName; ?></td>
        <td><?php echo $data->Type; ?></td>
        <td><?php echo $data->AvialbleStatus; ?></td>
    </tr>
<?php } ?>