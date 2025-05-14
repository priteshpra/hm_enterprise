<select id="QuotationID" name="QuotationID" class="select2_class quotation_select2">
</select>
<script>
    $(document).ready(function() {
        $('.quotation_select2').select2({
            placeholder: 'Select a Quotation',
            ajax: {
                data: function(params) {
                    var query = {
                        q: params.term,
                        SitesID: ($("#SitesID").val() == "" || $("#SitesID").val() == null) ? <?php echo ($OnlyCombo == 1) ? -1 : 0; ?> : $("#SitesID").val(),
                    }
                    return query;
                },
                url: '<?php echo site_url('admin/user/sites/quotationcombobox'); ?>',
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
            $(".quotation_select2").empty().append('<option value="<?php echo $Selected; ?>"><?php echo $SelectedName; ?></option>').val('<?php echo $Selected; ?>').trigger('change');
        <?php
        }
        ?>

    });
</script>