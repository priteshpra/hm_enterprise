<select id="UserID" name="UserID[]" class="select2_class user_select2">
</select>
<script>
    $(document).ready(function () {
        $('.user_select2').select2({
            placeholder: 'Select a User',
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo site_url('admin/user/employee/combobox');?>',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };

                },
                cache: true
            }

      });
        <?php
        
        if($Selected != 0){
            ?>
            $(".user_select2").empty().append('<option value="<?php echo $Selected;?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
        <?php
        }
        ?>

    });
</script>
