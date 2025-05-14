<select id="CompanyID" name="CompanyID" class="select2_class company_select2">
</select>
<script>
    $(document).ready(function() {
        $('.company_select2').select2({
            placeholder: 'Select Company',
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo site_url('admin/masters/company/combobox'); ?>',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };

                },
                cache: true
            }

        });
        <?php
        if ($Selected != 0) {
        ?>
            $(".company_select2").empty().append('<option value="<?php echo $Selected; ?>"><?php echo $SelectedName; ?></option>').val('<?php echo $Selected; ?>').trigger('change');
        <?php
        }
        ?>
    });
</script>