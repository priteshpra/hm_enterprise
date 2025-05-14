<select name="UsertypeID[]" id="UsertypeID" class="select2_class <?php echo @$Selected; ?>usertype_select2 userTypeClass UsertypeID">
</select>
<script>
    $(document).ready(function () {
        $('.<?php echo @$Selected; ?>usertype_select2').select2({
            placeholder: 'Select Usertype',
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo site_url('admin/masters/usertype/combobox');?>',
                dataType: 'json',
                delay: 250,
                data : {
                    'IsMaterial': "0"
                },
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
            $(".<?php echo @$Selected; ?>usertype_select2").empty().append('<option value="<?php echo $Selected;?>" data-rate="<?=@$Rate?>" data-hsn="<?=@$HSNNo?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
            <?php
        }
        ?>
    });
</script>
