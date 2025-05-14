<select id="UserID" name="UserID[]" class="select2_class user_select2" multiple>
</select>
<script>
    $(document).ready(function() {
        $('.user_select2').select2({
            placeholder: 'Select a User',
            allowClear: true,
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo site_url('admin/user/employee/comboboxbydate'); ?>',
                dataType: 'json',
                method: 'POST',
                data: function(params) {
                    var query = {
                        q: params.term,
                        StartDate: $('#StartDate').val(),
                        EndDate: $('#EndDate').val(),
                        Type: $('input[name="Type"]:checked').val()
                    }
                    return query;
                },
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
            $(".user_select2").empty().append('<option value="<?php echo $Selected; ?>"><?php echo $SelectedName; ?></option>').val('<?php echo $Selected; ?>').trigger('change');
        <?php
        }
        ?>

    });
</script>