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
    // This is for the active textbox
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

    window.submitflag = 1;
    $('#button_submit').on('click', function() {
        var error = checkValidations();
        if (error === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            if (($("#PaymentAmount").val() == "" || $("#PaymentAmount").val() == 0) && ($("#GSTAmount").val() == "" || $("#GSTAmount").val() == 0)) {
                alertify.error("Please Enter Amount");
                return false;
            }
            if (submitflag == 0) {
                return false;
            }
            submitflag == 0;
            $.ajax({
                success: function(data) {
                    submitflag = 1;
                    $('#button_submit').addClass('hide');
                    $('#button_submit_loading').removeClass('hide');
                    alertify.success("<?php echo label('please_wait'); ?>");
                    $('form').submit();
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


    $('input[name=PaymentMode]').on('change', function() {
        if ($(this).val() == 'Cheque') {
            $('#OnlineDiv').addClass('hide');
            $('#ChequeDiv').removeClass('hide');
            $('#ChequeNo').addClass('empty_validation_class');
            $('#ChequeNo').val('');
            $('#TypeBankName').removeClass('hide');
            $('#TypeBranchName').removeClass('hide');
            $('#TypeAccountNo').removeClass('hide');
        } else if ($(this).val() == 'Online') {
            $('#OnlineDiv').removeClass('hide');
            $('#ChequeDiv').addClass('hide');
            $('#ChequeNo').removeClass('empty_validation_class');
            $('#IFCCode').val('');
            $('#UTR').val('');
            $('#TypeBankName').removeClass('hide');
            $('#TypeBranchName').removeClass('hide');
            $('#TypeAccountNo').removeClass('hide');
        } else if ($(this).val() == 'Cash') {
            $('#OnlineDiv').addClass('hide');
            $('#ChequeDiv').addClass('hide');
            $('#TypeBankName').addClass('hide');
            $('#TypeBranchName').addClass('hide');
            $('#TypeAccountNo').addClass('hide');

            $('#ChequeNo').removeClass('empty_validation_class');
            $('#BankName').removeClass('empty_validation_class');
            $('#BranchName').removeClass('empty_validation_class');
        }
    });

    $(document).on("keyup", "#Percentage", function(event) {
        var per = $(this).val();
        var amount = $("#RemainingPayment").val();
        var paymam = Math.round((amount * per) / 100);
        $("#PaymentAmount").val(paymam);
        if (!$("#PaymentAmountlbl").hasClass("active")) {
            $("#PaymentAmountlbl").addClass("active")
        }
    });
    $(document).on("keyup", "#PaymentAmount", function(event) {
        var paymam = $(this).val();
        var amount = $("#RemainingPayment").val();
        var per = Math.round((paymam * 100) / amount);
        $("#Percentage").val(per);
        if (!$("#Percentagelbl").hasClass("active")) {
            $("#Percentagelbl").addClass("active")
        }
    });

    $(document).ready(function() {
        var Type = $('input[name=PaymentMode]:checked').val();
        if (Type == 'Cheque') {
            $('#OnlineDiv').addClass('hide');
            $('#ChequeDiv').removeClass('hide');
            $('#ChequeNo').addClass('empty_validation_class');
            $('#ChequeNo').val('');
            $('#TypeBankName').removeClass('hide');
            $('#TypeBranchName').removeClass('hide');
            $('#TypeAccountNo').removeClass('hide');
        } else if (Type == 'Online') {
            $('#OnlineDiv').removeClass('hide');
            $('#ChequeDiv').addClass('hide');
            $('#ChequeNo').removeClass('empty_validation_class');
            $('#IFCCode').val('');
            $('#UTR').val('');
            $('#TypeBankName').removeClass('hide');
            $('#TypeBranchName').removeClass('hide');
            $('#TypeAccountNo').removeClass('hide');
        } else if (Type == 'Cash') {
            $('#OnlineDiv').addClass('hide');
            $('#ChequeDiv').addClass('hide');
            $('#TypeBankName').addClass('hide');
            $('#TypeBranchName').addClass('hide');
            $('#TypeAccountNo').addClass('hide');

            $('#ChequeNo').removeClass('empty_validation_class');
            $('#BankName').removeClass('empty_validation_class');
            $('#BranchName').removeClass('empty_validation_class');
        }
    });
</script>