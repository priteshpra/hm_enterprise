<div id="" class="">
    <?php //pr($item); ?>
    <?php if(!isset($item['0']->Message)) { ?>
        <?php foreach ($item as $key => $value) { ?>
            <div class="diagnosis_medication_panel_box medicationAddList">
                <div class=" col s12 m5">
                    <?php echo getUsertypeComboBox($value->UsertypeID); ?>
                </div>
                <div class=" col s12 m7">
                    <div class="row">
                        <div class="input-field col s12 m3">
                            <input name="HSN_SAC[]" type="text" value="<?php echo $value->HSNNo; ?>" class="empty_validation_class HSN_SAC" maxlength="100" />
                            <label for="HSN_SAC" class="LHSN_SAC active">HSN/SAC</label>
                        </div>
                        <div class="input-field col s12 m2">
                            <input name="Qty[]" type="text" value="<?php echo $value->Qty; ?>" class="empty_validation_class Qty" maxlength="100" />
                            <label for="Qty" class="active">Qty</label>
                        </div>
                        <div class="input-field col s12 m3">
                            <input name="Rate[]" type="text" value="<?php echo $value->Rate; ?>" class="empty_validation_class Rate NumberOnly" maxlength="100" />
                            <label for="Rate" class="LRate active">Rate</label>
                        </div>
                        <div class="input-field col s12 m3 total">
                            <input type="text" value="<?php echo number_format($value->Qty * $value->Rate, 2); ?>" class="empty_validation_class ItemTotal" maxlength="100" readonly />
                            <label class="active">Item Total</label>
                        </div>
                        <div class="input-field col s12 m1">
                            <a class="btn-floating waves-effect waves-light red remove_medication"><i class="mdi-content-remove"></i></a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        <?php } ?>
    <?php } ?>
</div>