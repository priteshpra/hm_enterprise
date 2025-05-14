<select id="StateID" name="StateID" class="select2_class state_select2">
</select>
<script>
    $(document).ready(function () {
        $('.state_select2').select2({
            placeholder: 'Select a State',
            minimumInputLength: 1,
            ajax: {
                data: function (params) {
                  var query = {
                        q: params.term,
                        CountryID:($("#CountryID").val() == "" || $("#CountryID").val() == null)?<?php echo ($OnlyCombo==1)?-1:0;?>:$("#CountryID").val(),
                  }
                  return query;
                },
                url: '<?php echo site_url('common/GetState');?>',
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
            $(".state_select2").empty().append('<option value="<?php echo $Selected;?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
        <?php
        }
        ?>

    });
</script>
