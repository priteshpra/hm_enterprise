<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->UserID; ?>">
        <td><?php echo $data->EmployeeName; ?></td>
        <td><?php echo $data->MobileNo; ?></td>
        <td><?php echo $data->StartDate; ?></td>
        <td><?php echo $data->EndDate; ?></td>
        <td><?php echo $data->PresentCount; ?></td>
        <td><?php echo $data->AbsentCount; ?></td>
        <td><?php echo $data->HalfDayCount*2; ?></td>
        <td><?php echo $data->HalfOverTime*2; ?></td>
        <td><?php echo $data->FullOverTime; ?></td>
        <td>
            <?php 
            echo 
                $data->PresentCount+$data->AbsentCount+$data->FullOverTime+$data->HalfDayCount+$data->HalfOverTime
            ; ?>
        </td>
    </tr>
<?php } ?>