<script>
    window.submitflag = 0;

    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        max: new Date(),
        onSet: function(arg) {
            if ('select' in arg) { //prevent closing on selecting month/year
                this.close();
            }
        }
    })

    $(document).ready(function() {
        setTimeout(function() {
            $('#SiteName').focus();
        }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
    })

    $('.button_submit').on('click', function() {
        var error = checkValidations();
        var combo_box_error = checkComboBox([]);
        var Type = $(this).attr('data-val');
        $('#SubmitType').val(Type);

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
                type: "post",
                url: base_url + "admin/user/visitor/checkDuplicate",
                data: {
                    Table: "Visitor",
                    DataValue: MobileNo,
                    ID: ID,
                },
                success: function(data) {
                    submitflag = 0;
                    var obj = JSON.parse(data);
                    if (obj.result == 'Success') {
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait'); ?>");
                        $('#AddForm').submit();
                    } else {
                        alertify.error("<?php echo label('msg_lbl_mobileno_already_exists'); ?>");
                        return false;
                    }
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