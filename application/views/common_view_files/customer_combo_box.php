<select id="CustomerID" name="CustomerID" class="select2_class customer_select2">
</select>
<script>
    $(document).ready(function () {
        $('.customer_select2').select2({
            placeholder: 'Select Customer',
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo site_url('admin/user/customer/combobox');?>',
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
            $(".customer_select2").empty().append('<option value="<?php echo $Selected;?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
        <?php
        }
        ?>
    });
</script>
