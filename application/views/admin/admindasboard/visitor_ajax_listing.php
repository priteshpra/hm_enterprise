<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->VisitorID; ?>">
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('admin/user/visitor/details/' . $data->VisitorID); ?>">
                <?php echo $data->Name; ?>
            </a>
        </td>
        <td><?php echo $data->EmailID; ?></td>
        <td><?php echo $data->MobileNo; ?></td>
        <td><?php echo $data->PinCode; ?></td>
        <td><?php echo $data->LeadType; ?></td>
        <td><?php echo $data->CityName; ?></td>
        <td>
            <?php
            if ($data->CustomerID > 0) {
                echo "Customer";
            } else {
                echo "Pending";
            }

            ?>
        </td>
    </tr>
<?php } ?>