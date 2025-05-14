<select id="CityID" name="CityID" class="select2_class city_select2">
</select>
<script>
    $(document).ready(function () {
        $('.city_select2').select2({
            placeholder: 'Select a City',
            ajax: {
                data: function (params) {
                  var query = {
                        q: params.term,
                        StateID:($("#StateID").val() == "" || $("#StateID").val() == null)?<?php echo ($OnlyCombo==1)?-1:-1;?>:$("#StateID").val(),
                  }
                  return query;
                },
                url: '<?php echo site_url('common/GetCity');?>',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true,
                error:function(data){
                    console.log(data);
                }
            }

      });
        <?php 
        if($Selected != 0){
            ?>
            $(".city_select2").empty().append('<option value="<?php echo $Selected;?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
        <?php
        }
        ?>

    });
</script>
