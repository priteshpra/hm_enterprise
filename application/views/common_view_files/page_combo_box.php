<select id="PageID" name="PageID" class="select2_class page_select2">
</select>
<script>
    $(document).ready(function () {
        $('.page_select2').select2({
            placeholder: 'Select a Page',
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo site_url('admin/masters/page/combobox');?>',
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
            $(".page_select2").empty().append('<option value="<?php echo $Selected;?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
        <?php
        }
        ?>

    });
</script>
