<script>
    window.submitflag = 0;

    $('input[type=radio]').change(function(){
        name = $(this).prop('name')
        classname = $(this).attr('class');
        if(classname == "att_present") {
            $('input[name="OverTime_'+name+'"]').prop('disabled', false);
        } else {
            $('input[name="OverTime_'+name+'"]').closest('.radio_parent').removeClass('selected')
            $('input[name="OverTime_'+name+'"]').prop('disabled', true);
            $('#None_'+name).prop('checked', true);
        }
        $('input[name='+name+']').closest('.radio_parent').removeClass('selected')
        $(this).closest('.radio_parent').addClass('selected')
    })
    
    window.dt = new Date();
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
        var combo_box_error = checkComboBox([]);

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

    $('input[name=useratt]').change(function() {
        $('.radio_parent').find('label.btn').removeClass('checked')
        $(this).closest('.radio_parent').find('label.btn').addClass('checked')
    })
</script>