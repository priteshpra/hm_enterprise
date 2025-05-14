<select id="ServiceID" name="ServiceID" class="select2_class service_select2">
</select>
<script>
    $(document).ready(function () {
        $('.service_select2').select2({
            placeholder: 'Select Service',
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo site_url('admin/masters/service/combobox');?>',
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
            $(".service_select2").empty().append('<option value="<?php echo $Selected;?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
        <?php
        }
        ?>
    });
</script>
