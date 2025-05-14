<?php foreach ($data_array as $data) { ?>
    <tr>
        <td><?= $data->Name ?></td>
        <td><?= $data->AttendanceDate ?></td>
        <td>
            <?php
            if ($data->Attendance == '1') {
                echo 'Present';
            } else if ($data->Attendance == '0') {
                echo 'Absent';
            }else if ($data->Attendance == '0.5') {
                echo 'Half Day';
            }
            ?>
        </td>
        <td>
            <?php
            if ($data->OverTime == '1') {
                echo 'Full Over Time';
            } else if ($data->OverTime == '0.5') {
                echo 'Half Over Time';
            }
            ?>
        </td>
    </tr>
<?php } ?>