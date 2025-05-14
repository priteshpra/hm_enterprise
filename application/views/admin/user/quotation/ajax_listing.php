<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->QuotationID; ?>">
        <td><?php echo $data->EstimateNo; ?></td>
        <td><?php echo $data->Name; ?></td>
        <td><?php
            $Address = '';
            if ($data->Address != '') {
                $Address .= $data->Address;
            }
            if ($data->Address2 != '') {
                $Address .= ', ' . $data->Address2;
            }
            if ($data->CityName != '') {
                $Address .= ', ' . $data->CityName;
            }
            if ($data->StateName != '') {
                $Address .= ', ' . $data->StateName;
            }
            if ($data->PinCode != '') {
                $Address .= ' - ' . $data->PinCode;
            }
            echo $Address;
            ?>
        </td>
        <td><?php echo $data->Service; ?></td>
        <td><?php echo $data->CompanyName; ?></td>
        <td><?php echo $data->SiteName; ?></td>
        <td><?php echo $data->SubTotal; ?></td>
        <td><?php echo $data->CGST; ?></td>
        <td><?php echo $data->SGST; ?></td>
        <td><?php echo $data->IGST; ?></td>
        <td><?php echo $data->Total; ?></td>
        <td><?php echo $data->QuotationStatus; ?></td>
        <td class="action center action-box-th">
            <?php if ($data->QuotationStatus == 'Pending') { ?>
                <a href="<?php echo $this->config->item('base_url'); ?>admin/user/quotation/accept/<?php echo $data->QuotationID; ?>" class="btn-floating waves-effect blue lighten-1">
                    <i title="Accept Quotation" class="mdi-action-autorenew"></i>
                </a>
                <a href="<?php echo $this->config->item('base_url'); ?>admin/user/quotation/reject/<?php echo $data->QuotationID; ?>" class="btn-floating waves-effect red lighten-2">
                    <i title="Reject Quotation" class="mdi-av-shuffle"></i>
                </a>
            <?php } ?>
            <?php if ($data->QuotationStatus == 'Accept' && $data->IsFixCost == 'No') { ?>
                <a href="<?php echo $this->config->item('base_url'); ?>admin/user/teamdefination/add/<?php echo $data->QuotationID; ?>" class="btn-floating waves-effect blue">
                    <i title="Add Team Defination" class="mdi-action-launch"></i>
                </a>
                <a href="<?php echo $this->config->item('base_url'); ?>admin/user/invoice/addwithoutfixcost/<?php echo $data->QuotationID; ?>" class="btn-floating waves-effect teal">
                    <i title="Add Invoice" class="mdi-action-note-add"></i>
                </a>
                <a href="<?php echo $this->config->item('base_url'); ?>admin/user/attendance/add/<?php echo $data->QuotationID; ?>" class="btn-floating waves-effect deep-purple">
                    <i title="Add Attendance" class="mdi-av-playlist-add"></i>
                </a>
            <?php } else if ($data->QuotationStatus == 'Accept' && $data->IsFixCost == 'Yes') { ?>
                <a href="<?php echo $this->config->item('base_url'); ?>admin/user/invoice/add/<?php echo $data->QuotationID; ?>" class="btn-floating waves-effect teal">
                    <i title="Add Invoice" class="mdi-action-note-add"></i>
                </a>
            <?php } ?>
            <a class="btn-floating waves-effect waves-light brown m-r-5" href="<?php echo base_url('assets/uploads/estimation/' . $data->Document); ?>" target="_blank">
                <i title="Download Quotation" class="mdi-file-file-download">
                </i>
            </a>
        </td>
    </tr>
<?php } ?>