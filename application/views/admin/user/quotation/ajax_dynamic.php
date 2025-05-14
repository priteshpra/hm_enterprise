<div id="medication_clone_<?php echo $ID; ?>" class="diagnosis_medication_panel_box medicationAddList" >
    
    <div class="diagnosis_medication_left_panel">
        <div class=" col s12 m5">
            <?=@$Usertype?>
        </div>
        <div class=" col s12 m7">
            <div class="row">
                <div class="input-field col s12 m3">
                    <input name="HSN_SAC[]" type="text" class="empty_validation_class HSN_SAC active" maxlength="100" value="<?= @$visitor->HSN_SAC ?>" />
                    <label for="HSN_SAC" class="LHSN_SAC">HSN/SAC</label>
                </div>
                <div class="input-field col s12 m1">
                    <input name="Qty[]" type="text" class="empty_validation_class Qty active" maxlength="100" value="<?= @$visitor->Qty ?>" />
                    <label for="Qty" class="active">Qty</label>
                </div>
                <div class="input-field col s12 m1">
                    <input name="Days[]" type="text" class="empty_validation_class Days active" maxlength="100" value="<?= @$visitor->Days ?>" />
                    <label for="Days" class="active">Days</label>
                </div>
                <div class="input-field col s12 m3">
                    <input name="Rate[]" type="text" class="empty_validation_class Rate active" maxlength="100" value="<?= @$visitor->Rate ?>" />
                    <label for="Rate" class="active LRate">Rate</label>
                </div>
                <div class="input-field col s12 m3 total">
                    <input type="text" class="empty_validation_class ItemTotal active" maxlength="100" value="<?= @$visitor->Qty*@$visitor->Qty ?>" readonly/>
                    <label>Item Total</label>
                </div>
                <div class="input-field col s12 m1 right-align">
                    <a class="remove_medication btn-floating waves-effect waves-light red"><i class="mdi-content-remove "></i></a>
                </div>
            </div>
        </div>
    </div>
</div>