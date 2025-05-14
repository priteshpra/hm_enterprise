<script>
$(document).ready(function () {
       setTimeout(function(){ $('#current_password').focus(); }, 1100);
    <?php
    if (isset($this->session->userdata['posterror'])) {
        echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
    }?>
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>
});

    $('#button_submit').click(function (){
        var error = checkValidations();
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
        $.ajax({
            method: "POST",
            url: base_url + "admin/usersession/checkIfCurrentPasswordMatches",
            data: {current_password: $.trim($('#current_password').val())},
            success: function (data)
            {
                if(data == 1){
                var newp = $('#new_password').val();
                var confirm = $("#confirm_password").val();
                    if(newp != confirm){
                        alertify.error("<?php echo label('new_password_conf_not_macth');?>");    
                        return false;
                    }
                    var flag = isPassword($('#new_password').val());
                    if(flag == 1){
                            alertify.error("<?php echo label('password_8_32_long_min_1_char_spc_digit');?>");
                    }else{
                        $('#submit_button').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait');?>");
                        $('#AddForm').submit();
                    }
                }else{
                    alertify.error("<?php echo label('old_password_does_not_match');?>");
                }
            }
        });
    return false;
    });
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#submit_button").click();
            return false;
        }
    });
</script>