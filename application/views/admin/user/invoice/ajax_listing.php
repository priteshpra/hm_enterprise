<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->InvoiceID; ?>">
        <td><?php echo $data->EstimateNo; ?></td>
        <td><?php echo $data->InvoiceNo; ?></td>
        <td><?php echo $data->SiteUserFrindlyName; ?></td>
        <td><?php echo $data->InvoiceDate; ?></td>
        <td><?php echo $data->TotalAmount; ?></td>
        <td><?php echo $data->SubTotal; ?></td>
        <td><?php echo $data->CGST; ?></td>
        <td><?php echo $data->SGST; ?></td>
        <td><?php echo $data->IGST; ?></td>
        <td><?php echo number_format($data->RemainingPayment, 2); ?></td>
        <td><?php echo number_format($data->RemainingGSTPayment, 2); ?></td>
        <td><?php echo $data->Notes; ?></td>
        <td><?php echo $data->Terms; ?></td>
        <td class="action center action-box-th">
            <?php if ($data->RemainingPayment != "0" && $data->RemainingGSTPayment != "0") { ?>
                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo base_url('admin/user/payment/add/' . $data->InvoiceID); ?>">
                    <i title="Add Payment" class="mdi-av-my-library-add">
                    </i>
                </a>
            <?php } ?>
            <a class="btn-floating waves-effect waves-light brown m-r-5" href="<?php echo base_url('assets/uploads/invoice/' . $data->Document); ?>" target="_blank">
                <i title="Download Invoice" class="mdi-file-file-download">
                </i>
            </a>
        </td>
    </tr>
<?php } ?>