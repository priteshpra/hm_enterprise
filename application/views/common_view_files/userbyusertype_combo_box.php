<select id="<?= $ID ?>" name="<?= $ID ?>" class="select2_class <?= $ID ?>user_select2">
</select>
<script>
    $(document).ready(function() {
        $('.<?= $ID ?>user_select2').select2({
            placeholder: 'Select <?= $Type ?>',
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo site_url('admin/user/employee/usercombobox/' . $Type); ?>',
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
            $(".<?= $ID ?>user_select2").empty().append('<option value="<?php echo $Selected; ?>"><?php echo $SelectedName; ?></option>').val('<?php echo $Selected; ?>').trigger('change');
        <?php
        }
        ?>

    });
</script>