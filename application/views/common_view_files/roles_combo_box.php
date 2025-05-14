<select id="RoleID" name="RoleID" class="select2_class role_select2">
</select>
<script>
    $(document).ready(function () {
        $('.role_select2').select2({
            placeholder: 'Select a Role',
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo site_url('admin/role/combobox');?>',
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
            $(".role_select2").empty().append('<option value="<?php echo $Selected;?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
        <?php
        }
        ?>

    });
</script>
