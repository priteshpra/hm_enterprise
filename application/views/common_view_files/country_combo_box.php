<select id="CountryID" name="CountryID" class="select2_class country_select2">
</select>
<script>
    $(document).ready(function () {
        $('.country_select2').select2({
            placeholder: 'Select a Country',
            minimumInputLength: 1,
            ajax: {
                url: '<?php echo site_url('common/GetCountry');?>',
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
            $(".country_select2").empty().append('<option value="<?php echo $Selected;?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
        <?php
        }
        ?>

    });
</script>
