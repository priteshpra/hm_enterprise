<?php
foreach ($data_araay as $data) {  ?>
    <tr id="row_<?php echo $data->VisitorReminderID; ?>">
        <td><?= $data->EmployeeFirstName . ' ' . $data->EmployeeLastName; ?></td>
        <td><?= $data->Name; ?></td>
        <td><?= $data->MobileNo; ?></td>
        <td><?= $data->Message; ?></td>
        <td><?= $data->ReminderDate; ?></td>
        <td><?= $data->PastDate; ?></td>
    </tr>
<?php }
?>