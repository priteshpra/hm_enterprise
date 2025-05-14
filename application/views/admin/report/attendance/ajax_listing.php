<thead>
    <tr>
        <th><?php echo label('msg_lbl_title_employee'); ?></th>
        <th><?php echo label('msg_lbl_companyname'); ?></th>
        <?php
        $date = $this->StartDate;
        $end_date = $this->EndDate;

        while (strtotime($date) < strtotime($end_date)) {
            $date = date("d-m-Y", strtotime("+1 day", strtotime($date)));
            echo '<th>' . $date . '</th>';
        }
        ?>
    </tr>
</thead>
<tbody>
    <?php
    foreach ($data_array as $data) {
    ?>
        <tr class="gradeX" id="row_<?php echo $data['AttendanceID']; ?>">
            <td><?php echo $data['Name']; ?></td>
            <td><?php echo $data['CompanyName']; ?></td>
            <?php
            $date = $StartDate;
            $end_date = $EndDate;
            while (strtotime($date) < strtotime($end_date)) {
                $date = date("d-m-Y", strtotime("+1 day", strtotime($date)));
                if (array_key_exists($date, $data['date'])) {
                    echo '<td>' . $data['date'][$date] . '</td>';
                } else {
                    echo '<td>-</td>';
                }
            }
            //echo $value['attendance'] . $value['date'];
            ?> <?php } ?>
</tbody>