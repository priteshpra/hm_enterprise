<label for="AdminID" class="active">Admin</label>

<select id="AdminID" name="AdminID" class="select_materialize" style="width:100%;display:none" >
    <?php
    if ($selected_admin_id === 0) {
        ?>
        <option value="" selected="selected">Select Admin</option>
        <?php
    }
     
    foreach ($admin as $key => $value) {

        if ($value->UserID === $selected_admin_id) {
            $selected = "selected=selected";
        } else {
            $selected = "";
        }
        ?>
        <option value='<?php echo $value->UserID; ?>' <?php echo $selected; ?> > <?php echo $value->FirstName ." " . $value->LastName ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>