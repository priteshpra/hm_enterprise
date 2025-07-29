<?php //pr($item);
?>
<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/user/customer/details/' . $data->CustomerID . '#Invoice') ?>"><strong><?php echo label('msg_lbl_title_invoice') . ' - ' . $data->EstimateNo . ' - ' . $data->Service ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/user/invoice/' . $page_name) ?>">

            <input id="QuotationID" name="QuotationID" value="<?php echo $data->QuotationID; ?>" type="hidden" />
            <input id="SitesID" name="SitesID" value="<?php echo $data->SitesID; ?>" type="hidden" />
            <input id="CustomerID" name="CustomerID" value="<?php echo $data->CustomerID; ?>" type="hidden" />
            <input id="UsertypeID" name="UsertypeID" value="<?php echo isset($data->UsertypeID) ? $data->UsertypeID : 0; ?>" type="hidden" />

            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="text" name="InvoiceDate" id="InvoiceDate" value="<?php echo date("d-m-Y"); ?>" class="datepicker empty_validation_class">
                    <label name="InvoiceDate" class=""><?php echo label('msg_lbl_invoicedate') ?></label>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <input type="text" name="StartDate" id="StartDate" value="<?php echo @$data->StartDate; ?>" class="datepicker empty_validation_class">
                    <label name="StartDate" class=""><?php echo label('msg_lbl_startdate') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="EndDate" id="EndDate" value="<?php echo @$data->EndDate; ?>" class="datepicker empty_validation_class">
                    <label name="EndDate" class=""><?php echo label('msg_lbl_enddate') ?></label>
                </div>
            </div>
            <div class="row saggi-card">
                <div class="input-field col s12 m5">
                    <h4 class="header2 m-0">
                        <strong>User</strong>
                    </h4>
                </div>
                <div class="input-field col s12 m7">
                    <div class="input-field col s1 m1 offset-m11 center-align">
                        <a id="medicationcloneclick" class="btn-floating waves-effect waves-light green"><i class="mdi-content-add"></i></a>
                    </div>
                </div>
                <div class="input-field col s12 m12 small-input">
                    <div id="medication_main" class="row" style="margin-bottom:0">
                        <?php //print_r($item); 
                        ?>
                        <?php foreach ($item as $key => $value) { ?>
                            <div class="diagnosis_medication_panel_box medicationAddList">
                                <div class="col s12 m5">
                                    <?php echo isset($value->UsertypeID) ? getUsertypeComboBox($value->UsertypeID) : ''; ?>
                                </div>
                                <div class="col s12 m7">
                                    <div class="row">
                                        <div class="input-field col s12 m3">
                                            <input name="HSN_SAC[]" type="text" value="<?php echo $value->HSNNo; ?>" class="empty_validation_class HSN_SAC" maxlength="100" />
                                            <label for="HSN_SAC" class="LHSN_SAC">HSN/SAC</label>
                                        </div>
                                        <div class="input-field col s12 m2">
                                            <input name="Qty[]" type="text" value="<?php echo $value->Qty * $value->Days; ?>" class="empty_validation_class Qty" maxlength="100" />
                                            <label for="Qty" class="active">Qty</label>
                                        </div>
                                        <div class="input-field col s12 m3">
                                            <input name="Rate[]" type="text" value="<?php echo $value->Rate; ?>" class="empty_validation_class Rate" maxlength="100" />
                                            <label for="Rate" class="LRate">Rate</label>
                                        </div>
                                        <div class="input-field col s12 m3 total">
                                            <input id="ItemTotal" type="text" value="<?php echo number_format($value->Qty * $value->Rate, 2); ?>" class="empty_validation_class ItemTotal" maxlength="100" readOnly />
                                            <label for="ItemTotal">Item Total</label>
                                        </div>
                                        <div class="input-field col s1 m1">
                                            <a class="btn-floating waves-effect waves-light remove_medication red"><i class="mdi-content-remove"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="row total">
                        <div class="input-field col s12 m5">
                        </div>
                        <div class="input-field col s12 m7">
                            <div class="input-field col s12 m3 offset-m8">
                                <input id="SubTotal" name="SubTotal" type="text" class="AmountOnly SubTotal" value="<?php echo @$data->TotalAmount; ?>" maxlength="20" readonly />
                                <label for="SubTotal" class="active LSubTotal"><?php echo label('msg_lbl_subtotal') ?></label>
                            </div>
                            <div class="input-field col s12 m3 offset-m8">
                                <input id="CGST" name="CGST" type="text" class="AmountOnly CGST" value="<?php echo @$data->CGST; ?>" maxlength="20" readonly />
                                <label for="CGST" class="active LCGST"><?php echo label('msg_lbl_cgst') ?></label>
                            </div>
                            <div class="input-field col s12 m3 offset-m8">
                                <input id="SGST" name="SGST" type="text" class="AmountOnly SGST" value="<?php echo @$data->SGST; ?>" maxlength="20" readonly />
                                <label for="SGST" class="active LSGST"><?php echo label('msg_lbl_sgst') ?></label>
                            </div>
                            <div class="input-field col s12 m3 offset-m8">
                                <input id="IGST" name="IGST" type="text" class="AmountOnly IGST" value="<?php echo @$data->IGST; ?>" maxlength="20" readonly />
                                <label for="IGST" class="active LIGST"><?php echo label('msg_lbl_igst') ?></label>
                            </div>
                            <div class="input-field col s12 m3 offset-m8">
                                <input id="Total" name="TotalAmount" type="text" class="AmountOnly TotalAmount" value="<?php echo @$data->TotalAmount; ?>" maxlength="20" readonly />
                                <label for="TotalAmount" class="active LTotalAmount"><?php echo label('msg_lbl_totalamount') ?></label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <textarea id="Notes" name="Notes" type="text" class="materialize-textarea empty_validation_class"><?php echo @$data->Notes; ?></textarea>
                    <label for="Notes"><?php echo label('msg_lbl_notes') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <textarea id="Terms" name="Terms" type="text" class="materialize-textarea empty_validation_class"><?php echo @$data->Terms; ?></textarea>
                    <label for="Terms"><?php echo label('msg_lbl_terms') ?></label>
                </div>
            </div>
            <div class="row">
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                if (isset($data->Status) && @$data->Status == INACTIVE) {
                                                                                    echo "";
                                                                                } else {
                                                                                    echo "checked='checked'";
                                                                                }
                                                                                ?>>
                    <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                </div>
                <div class="input-field col s12 m6 right">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/user/customer/details/' . $data->CustomerID . '#Invoice') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>