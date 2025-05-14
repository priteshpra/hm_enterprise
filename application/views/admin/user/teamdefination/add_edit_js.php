<script>
    window.submitflag = 0;

    window.dt = new Date();


    $('.datepickerval').on('mousedown', function(event) {
        event.preventDefault();
    })
    $('.datepickervalall').on('mousedown', function(event) {
        event.preventDefault();
    })
    $('.timeppast').on('mousedown', function(event) {
        event.preventDefault();
    })
    $('.timep').on('mousedown', function(event) {
        event.preventDefault();
    })

    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        min: new Date(),
        onSet: function(arg) {
            if ('select' in arg) { //prevent closing on selecting month/year
                this.close();
            }
        }
    });
    $('.timeppast').clockpicker({
        placement: 'bottom',
        align: 'left',
        darktheme: false,
        twelvehour: false,
        'default': 'now'
    });
    $('.timep').clockpicker({
        placement: 'bottom',
        align: 'left',
        darktheme: false,
        twelvehour: false,
        'default': 'now',
        min: dt.getTime()

    });

    $('.datepickervalall').pickadate({
        format: 'dd-mm-yyyy',
        max: new Date(),
        onSet: function(arg) {
            if ('select' in arg) { //prevent closing on selecting month/year
                this.close();
            }
        }
    });

    $(document).ready(function() {
        $('input[name="StartDate"]').on('change', function() {
            $('#UserID').html('')
        })
        $('input[name="EndDate"]').on('change', function() {
            $('#UserID').html('')
        })
    })


    $(document).ready(function() {
        setTimeout(function() {
            $('#SiteName').focus();
        }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
    });

    $('#button_submit').on('click', function() {
        var error = checkValidations();
        var combo_box_error = checkComboBox(['UserID']);

        if (error === 'yes' || combo_box_error === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            if (submitflag == 1) {
                return false;
            }
            submitflag = 1;
            var ID = $('#VisitorID').val();
            var MobileNo = $('#MobileNo').val();
            $.ajax({
                success: function(data) {
                    submitflag = 0;
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