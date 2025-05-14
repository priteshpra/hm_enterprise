<script>
    window.submitflag = 0;

    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        onSet: function(arg) {
            if ('select' in arg) { //prevent closing on selecting month/year
                this.close();
            }
        }
    });

    $(document).ready(function() {
        setTimeout(function() {
            $('#FirstName').focus();
        }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
    })

    $('#button_submit').on('click', function() {
        var error = checkValidations();
        var combo_box_error = checkComboBox(['CityID','UsertypeID']);
        if (error === 'yes' || combo_box_error === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            var ID = $('#UserID').val();
            if (ID == 0) {
                if (isPassword($("#Password").val())) {
                    alertify.error('<?php echo label('password_8_32_long_min_1_char_spc_digit'); ?>');
                    return false;
                }
                if ($("#Password").val() != $("#ConfirmPassword").val()) {
                    alertify.error("<?php echo label('password_conf_not_macth'); ?>");
                    return false;
                }
            }
            if (submitflag == 1) {
                return false;
            }
            submitflag = 1;

            var EmailID = $('#EmailID').val();
            var MobileNo = $('#MobileNo').val();
            $.ajax({
                success: function(data) {
                    $('#button_submit').addClass('hide');
                    $('#button_submit_loading').removeClass('hide');
                    alertify.success("<?php echo label('please_wait'); ?>");
                    $('#AddForm').submit();
                },
                error: function($data) {
                    submitflag = 0;
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
                },
            });
        }
        return false;
    });

    $(document).keypress(function(e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>