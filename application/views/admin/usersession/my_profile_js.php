<script>
    $(document).ready(function () {
       setTimeout(function(){ $('#FirstName').focus(); }, 1100);
    <?php
    if (isset($this->session->userdata['posterror'])) {
        echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
    }?>
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>
});
    $("#button_submit").click(function (){
        var error = checkValidations();
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            $.ajax({
                type:"post",
                url: "<?php echo base_url('common/CheckEmailMobExist');?>",
                data:{ EmailID:'',MobileNo:$("#MobileNo").val(),ID:'<?php echo $data->UserID;?>'},
                success:function(data)
                {
                    if(data == 1){  
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait');?>");
                        $('#AddForm').submit();
                    }else {
                        alertify.error(data);
                        return false;
                    }  
                }
            });
                
        }
        return false;
    });
 $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#submit_button").click();
            return false;
        }
    });
</script>