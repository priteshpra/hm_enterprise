<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->AttendanceDate; ?>">
        <td><?php echo $data->EstimateNo; ?></td>
        <td><?php echo $data->SiteUserFrindlyName; ?></td>
        <td><?php echo $data->AttendanceDate; ?></td>
        <td><?php echo $data->PresentCount; ?></td>
        <td><?php echo $data->HalfDayount; ?></td>
        <td><?php echo $data->Absentount; ?></td>
        <td><?php echo $data->OverTime; ?></td>
    </tr>
<?php } ?>