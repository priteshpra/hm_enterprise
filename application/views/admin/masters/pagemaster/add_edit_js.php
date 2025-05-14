<script>
    
     $(document).ready(function () {
       setTimeout(function(){ $('#PageName').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>   

            });
/*Function For Buutoon click event */

    $('#button_submit').on('click', function ()
    {
        var error = checkValidations();
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            var id = $('#PageID').val();
            var PageName = $('#PageName').val();
             
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/page/checkDuplicate",
                data:{ID:id,PageName:PageName},
                success:function(data)
                {
                    if(data == 0){
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait');?>");
                        $('form').submit();    
                    }else{
                        alertify.error('Page Name already exists.');
                        return false;
                    }           
                }
            });
            
        }
    });
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
    //End
</script>