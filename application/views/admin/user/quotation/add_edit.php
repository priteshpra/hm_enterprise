<?php
//pr($Visitor);
//pr($Sites);
?>
<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/user/visitor/details/' . $VisitorID . '#Quotation') ?>"><strong><?php echo label('msg_lbl_quotations') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <div class="row">
            <div class="input-field col s2">
                <b>Name :</b> <?php echo @$Visitor->Name; ?>
            </div>
            <div class="input-field col s3">
                <b>Mobile No :</b> <?php echo @$Visitor->MobileNo; ?>
            </div>
            <div class="clearfix"></div>
            <div class="input-field col s3">
                <b>Site Name :</b> <?php echo @$Sites->SiteName; ?>
            </div>
            <div class="clearfix"></div>
            <div class="input-field col s3">
                <b><?php echo label('msg_lbl_namecompanyname'); ?> : </b><?php echo @$Sites->Name; ?>
            </div>
            <div class="clearfix"></div>
            <div class="input-field col s12">
                <b>Bill To :</b>
                <?php
                $Address = '';
                if ($Sites->Address != '') {
                    $Address .= $Sites->Address;
                }
                if ($Sites->Address2 != '') {
                    $Address .= ', ' . $Sites->Address2;
                }
                if ($Sites->CityName != '') {
                    $Address .= ', ' . $Sites->CityName;
                }
                if ($Sites->StateName != '') {
                    $Address .= ', ' . $Sites->StateName;
                }
                if ($Sites->PinCode != '') {
                    $Address .= ' - ' . $Sites->PinCode;
                }
                echo $Address;
                ?>
            </div>
        </div>
    </div>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/user/quotation/' . $page_name) ?>">
            <input type="password" class="hide">
            <input id="VisitorID" name="VisitorID" value="<?php echo $VisitorID; ?>" type="hidden" />
            <input id="SitesID" name="SitesID" value="<?php echo $SitesID; ?>" type="hidden" />
            <input id="CustomerID" name="CustomerID" value="<?php echo $CustomerID; ?>" type="hidden" />

            <div class="row">
                <div class="input-field col s12 m4">
                    <input type="text" name="EstimateDate" id="EstimateDate" value="<?php
                                                                                    if (isset($data->QuotationID)) {
                                                                                        echo @$data->EstimateDate;
                                                                                    } else
                                                                                        echo date("d-m-Y"); ?>" class="datepicker empty_validation_class">
                    <label name="EstimateDate" class=""><?php echo label('msg_lbl_estimationdate') ?></label>
                </div>
                <div class="input-field col s12 m4">
                    <?php echo @$Company; ?>
                </div>
                <div class="input-field col s12 m4">
                    <?php echo @$Service; ?>
                </div>
            </div>
            <div class="row" style="border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 5px 5px #eee;">
                <div class="input-field col s12 m12">
                    <h4 class="header m-t-0">
                        <strong>SHIP TO</strong>
                    </h4>
                </div>
                <div class="input-field col s12 m6">
                    <input id="Address" name="Address" type="text" class="empty_validation_class" value="<?php echo @$data->Address; ?>" maxlength="200" />
                    <label for="Address"><?php echo label('msg_lbl_address1') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="Address2" name="Address2" type="text" class="" value="<?php echo @$data->Address2; ?>" maxlength="200" />
                    <label for="Address2"><?php echo label('msg_lbl_address2') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$City; ?>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$State; ?>
                </div>
                <div class="input-field col s12 m6">
                    <input id="PinCode" name="PinCode" type="text" class="empty_validation_class NumberOnly" value="<?php echo @$data->PinCode; ?>" maxlength="6" />
                    <label for="PinCode"><?php echo label('msg_lbl_pincode') ?></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m12 small-input">
                    <div id="quotation_main" class="row  saggi-card">
                        <div class="input-field col s12 m12">
                            <h4 class="header2 m-0">
                                <strong>Users</strong>
                            </h4>
                        </div>
                        <div class="diagnosis_medication_panel_box medicationAddList">
                            <div class="col s12 m5">
                                <?php echo @$Usertype; ?>
                            </div>
                            <div class="col s12 m7">
                                <div class="row">
                                    <div class="input-field col s12 m3">
                                        <input name="HSN_SAC[]" type="text" class="empty_validation_class HSN_SAC" maxlength="100" />
                                        <label for="HSN_SAC" class="LHSN_SAC">HSN/SAC</label>
                                    </div>
                                    <div class="input-field col s12 m1">
                                        <input name="Qty[]" type="text" class="empty_validation_class Qty" maxlength="100" />
                                        <label for="Qty" class="active">Qty</label>
                                    </div>
                                    <div class="input-field col s12 m1">
                                        <input name="Days[]" type="text" class="empty_validation_class Days" maxlength="100" />
                                        <label for="Days" class="active">Days</label>
                                    </div>
                                    <div class="input-field col s12 m3">
                                        <input name="Rate[]" type="text" class="empty_validation_class Rate" maxlength="100" />
                                        <label for="Rate" class="LRate">Rate</label>
                                    </div>
                                    <div class="input-field col s12 m3 total">
                                        <input type="text" class="empty_validation_class ItemTotal" maxlength="100" readOnly />
                                        <label class="LRate">Item Total</label>
                                    </div>
                                    <div class="input-field col s12 m1 right-align">
                                        <a id="add_user" class="btn-floating waves-effect waves-light green"><i class="mdi-content-add"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div id="quotation_material" class="row  saggi-card">
                        <div class="input-field col s12 m12">
                            <h4 class="header2 m-0">
                                <strong>Materials</strong>
                            </h4>
                        </div>
                        <div class="diagnosis_medication_panel_box medicationAddList">
                            <div class="col s12 m5">
                                <?php echo @$UsertypeMaterial; ?>
                            </div>
                            <div class="col s12 m7">
                                <div class="row">
                                    <div class="input-field col s12 m3">
                                        <input name="HSN_SAC[]" type="text" class=" HSN_SAC" maxlength="100" />
                                        <label for="HSN_SAC" class="LHSN_SAC">HSN/SAC</label>
                                    </div>
                                    <div class="input-field col s12 m1">
                                        <input name="Qty[]" type="text" class=" Qty" maxlength="100" />
                                        <label for="Qty" class="active">Qty</label>
                                    </div>
                                    <div class="input-field col s12 m1">
                                        <input name="Days[]" type="text" class=" Days" maxlength="100" />
                                        <label for="Days" class="active">Days</label>
                                    </div>
                                    <div class="input-field col s12 m3">
                                        <input name="Rate[]" type="text" class=" Rate" maxlength="100" />
                                        <label for="Rate" class="LRate">Rate</label>
                                    </div>
                                    <div class="input-field col s12 m3 total">
                                        <input type="text" class=" ItemTotal" maxlength="100" readOnly />
                                        <label class="LRate">Item Total</label>
                                    </div>
                                    <div class="input-field col s12 m1 right-align">
                                        <a id="add_material" class="btn-floating waves-effect waves-light green"><i class="mdi-content-add"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row saggi-card" style="padding-bottom: 15px;">
                        <div class="input-field col s12 m5">
                        </div>
                        <div class="input-field col s12 m7 total">
                            <div class="input-field col s12 m3 offset-m8">
                                <input id="SubTotal" name="SubTotal" type="text" class="AmountOnly SubTotal" value="<?php echo @$data->TotalAmount; ?>" maxlength="20" readOnly />
                                <label for="SubTotal" class="active LSubTotal"><?php echo label('msg_lbl_subtotal') ?></label>
                            </div>
                            <div class="input-field col s12 m3 offset-m8">
                                <input id="CGST" name="CGST" type="text" class="AmountOnly CGST" value="<?php echo @$data->CGST; ?>" maxlength="20" readOnly />
                                <label for="CGST" class="active LCGST"><?php echo label('msg_lbl_cgst') ?></label>
                            </div>
                            <div class="input-field col s12 m3 offset-m8">
                                <input id="SGST" name="SGST" type="text" class="AmountOnly SGST" value="<?php echo @$data->SGST; ?>" maxlength="20" readOnly />
                                <label for="SGST" class="active LSGST"><?php echo label('msg_lbl_sgst') ?></label>
                            </div>
                            <div class="input-field col s12 m3 offset-m8">
                                <input id="IGST" name="IGST" type="text" class="AmountOnly IGST" value="<?php echo @$data->IGST; ?>" maxlength="20" readOnly />
                                <label for="IGST" class="active LIGST"><?php echo label('msg_lbl_igst') ?></label>
                            </div>
                            <div class="input-field col s12 m3 offset-m8">
                                <input id="Total" name="TotalAmount" type="text" class="AmountOnly TotalAmount" value="<?php echo @$data->TotalAmount; ?>" maxlength="20" readOnly />
                                <label for="TotalAmount" class="active LTotalAmount"><?php echo label('msg_lbl_totalamount') ?></label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <textarea id="Notes" name="Notes" type="text" class="materialize-textarea empty_validation_class"><?php echo @$Notes->Note; ?></textarea>
                    <label for="Notes"><?php echo label('msg_lbl_notes') ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <textarea id="Terms" name="Terms" type="text" class="materialize-textarea empty_validation_class"><?php echo @$Notes->Term; ?></textarea>
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
                    <a href="<?php echo site_url('admin/user/visitor/details/' . $VisitorID . '#Quotation') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>