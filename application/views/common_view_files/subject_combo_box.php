<select name="SubjectID" id="SubjectID" class="select2_class subject_select2 subject">
</select>
<script>
    $(document).ready(function () {
        $('.subject_select2').select2({
            placeholder: 'Select Subject',
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo site_url('admin/masters/subject/combobox');?>',
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
            $(".subject_select2").empty().append('<option value="<?php echo $Selected;?>" data-rate="<?=@$Rate?>" data-hsn="<?=@$HSNNo?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
            <?php
        }
        ?>
    });
</script>
