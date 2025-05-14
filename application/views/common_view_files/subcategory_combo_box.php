<select id="SubCategoryID" name="SubCategoryID" class="select2_class category_select2">
</select>
<script>
    $(document).ready(function () {
        $('.category_select2').select2({
            placeholder: 'Select SubCategory',
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo site_url('admin/masters/subcategory/combobox');?>',
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
            $(".category_select2").empty().append('<option value="<?php echo $Selected;?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
        <?php
        }
        ?>
    });
</script>
