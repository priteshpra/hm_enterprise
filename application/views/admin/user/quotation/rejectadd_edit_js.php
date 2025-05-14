<script>
    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        max: new Date(),
        onSet: function(arg) {
            if ('select' in arg) { //prevent closing on selecting month/year
                this.close();
            }
        }
    })
    $('.timep').clockpicker({
        placement: 'bottom',
        align: 'left',
        darktheme: false,
        autoclose: true,
        twelvehour: false
    });

    $(document).ready(function() {
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
    })


    window.submitflag = 1;
    $('#button_submit').on('click', function() {
        var error_combo = checkComboBox(['']);
        var error = checkValidations();
        if (error === 'yes' || error_combo === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            if (submitflag == 0) {
                return false;
            }
            var req = 0;


            submitflag == 0;
            $.ajax({
                success: function(data) {
                    $.ajax({
                        success: function(response) {
                            $('#button_submit').addClass('hide');
                            $('#button_submit_loading').removeClass('hide');
                            alertify.success("<?php echo label('please_wait'); ?>");
                            $('form').submit();
                        }
                    });
                },
                error: function(data) {
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
                }
            })
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