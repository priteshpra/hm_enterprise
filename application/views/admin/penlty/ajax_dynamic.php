<div class="user_row">
    <div class="row">
        <div class="col m11 s11">
            <div class="col m6 s12">
                <label>Name</label><br />
                <input type="text" value="<?=$user_name?>" name="user" readOnly />
                <input type="hidden" name="Users[]" value="<?=$user_id?>" />
            </div>
            <div class="col m6 s12">
                <label>Amount</label><br /><input type="text" value="<?='Rs.'.$amount?>" name="amount" readOnly />
                <input type="hidden" name="Amounts[]" value="<?=$amount?>" />
            </div>
        </div>
        <div class="col m1 s1 right-align">
            <a class="btn-floating waves-effect waves-light red accent-6 remove_user">
                <i class="mdi-content-remove tooltipped" data-position="top" data-delay="50" data-tooltip="Remove"></i>
            </a>
        </div>
    </div>
</div>