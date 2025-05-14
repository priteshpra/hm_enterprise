<select id="SitesID" name="SitesID" class="select2_class sites_select2">
</select>
<script>
    $(document).ready(function () {
        $('.sites_select2').select2({
            placeholder: 'Select a Sites',
            ajax: {
                data: function (params) {
                  var query = {
                        q: params.term,
                        CustomerID:-1,
                  }
                  return query;
                },
                url: '<?php echo site_url('admin/user/customer/sitecombobox');?>',
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
            $(".sites_select2").empty().append('<option value="<?php echo $Selected;?>"><?php echo $SelectedName;?></option>').val('<?php echo $Selected;?>').trigger('change');
        <?php
        }
        ?>

    });
</script>
