<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->CustomerPaymentID; ?>">
        <td><?php echo $data->SitesName; ?></td>
        <td><?php echo $data->CompanyName; ?></td>
        <td><?php echo $data->PaymentDate; ?></td>
        <td><?php echo $data->PaymentAmount; ?></td>
        <td><?php echo $data->GSTAmount; ?></td>
    <?php } ?>