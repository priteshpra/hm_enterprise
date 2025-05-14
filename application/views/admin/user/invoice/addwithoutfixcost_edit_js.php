<script>
    window.submitflag = 0;
    window.medicationclone = 0;
    window.SGST = <?php echo $SGST; ?>;
    window.CGST = <?php echo $CGST; ?>;
    window.IGST = <?php echo $IGST; ?>;

    window.subtotal = 0;
    window.total = 0;
    window.cgst = 0;
    window.sgst = 0;
    window.igst = 0;
    window.isigst = '<?php echo $ISIGST; ?>';

    dropdown_enabled = false;
    $(window).load(function() {
        dropdown_enabled = true;
    })

    function getUserDataByDate(startdate, enddate) {
        dropdown_enabled = false;
        $.ajax({
            type: "post",
            datatype: "html",
            url: base_url + "admin/user/invoice/getUserDataByDate",
            data: {
                id: "<?php echo $ID; ?>",
                startdate: startdate,
                enddate: enddate
            },
            success: function(data) {
                $("#medication_main").html(data);
                calculateTotal()
            },
            error: function(data) {
                calculateTotal()
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
        
        $.ajax({
            type: "post",
            datatype: "html",
            url: base_url + "admin/user/invoice/getMaterialDataByDate",
            data: {
                id: "<?php echo $ID; ?>",
                startdate: startdate,
                enddate: enddate
            },
            success: function(data) {
                setTimeout(function() {
                    dropdown_enabled = true;
                }, 500);
                $("#material_main").html(data);
                calculateTotal()
            },
            error: function(data) {
                calculateTotal()
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }


    $('body').on('change', '#StartDate', function() {
        getUserDataByDate($('#StartDate').val(), $('#EndDate').val())
    })
    $('body').on('change', '#EndDate', function() {
        getUserDataByDate($('#StartDate').val(), $('#EndDate').val())
    })
    getUserDataByDate($('#StartDate').val(), $('#EndDate').val())


    $('body').on('change', '.UsertypeID', function() {
        if (dropdown_enabled) {
            rate = $(this).closest('.medicationAddList').find('#UsertypeID option:selected').attr('data-rate');
            if (rate == undefined) {
                window.Rate = parseFloat($(this).closest('.medicationAddList').find('#UsertypeID').select2('data')['0'].Rate);
                window.HSNNo = ($(this).closest('.medicationAddList').find('#UsertypeID').select2('data')['0'].HSNNo);
            } else {
                window.Rate = parseFloat($(this).closest('.medicationAddList').find('#UsertypeID option:selected').attr('data-rate'));
                window.HSNNo = $(this).closest('.medicationAddList').find('#UsertypeID option:selected').attr('data-hsn');
            }
            //console.log(window.Rate);
            $(this).closest('.medicationAddList').find(".HSN_SAC").val(HSNNo);
            $(this).closest('.medicationAddList').find(".Rate").val(Rate);
            $(this).closest('.medicationAddList').find(".ItemTotal").val(Rate);
            $(this).closest('.medicationAddList').find('.HSN_SAC').addClass('active');
            $(this).closest('.medicationAddList').find('.LHSN_SAC').addClass('active');
            $(this).closest('.medicationAddList').find('.LRate').addClass('active');

            obj = $(this).closest('.medicationAddList').find('.Qty')
            if (obj.val() == "") {
                obj.val('1')
            }
            obj.addClass('active');
            obj.focus();

            $(this).closest('.medicationAddList').find(".ItemTotal").val(Rate);
            obj = $(this).closest('.medicationAddList').find('.ItemTotal')
            obj.addClass('active');
            obj.focus();
        }
    })

    
    $('body').on('change', '.UsertypeIDMaterial', function() {
        if (dropdown_enabled) {
            rate = $(this).closest('.medicationAddList').find('#UsertypeIDMaterial option:selected').attr('data-rate');
            if (rate == undefined) {
                window.Rate = parseFloat($(this).closest('.medicationAddList').find('#UsertypeIDMaterial').select2('data')['0'].Rate);
                window.HSNNo = ($(this).closest('.medicationAddList').find('#UsertypeIDMaterial').select2('data')['0'].HSNNo);
            } else {
                window.Rate = parseFloat($(this).closest('.medicationAddList').find('#UsertypeIDMaterial option:selected').attr('data-rate'));
                window.HSNNo = $(this).closest('.medicationAddList').find('#UsertypeIDMaterial option:selected').attr('data-hsn');
            }
            //console.log(window.Rate);
            $(this).closest('.medicationAddList').find(".HSN_SAC").val(HSNNo);
            $(this).closest('.medicationAddList').find(".Rate").val(Rate);
            $(this).closest('.medicationAddList').find(".ItemTotal").val(Rate);
            $(this).closest('.medicationAddList').find('.HSN_SAC').addClass('active');
            $(this).closest('.medicationAddList').find('.LHSN_SAC').addClass('active');
            $(this).closest('.medicationAddList').find('.LRate').addClass('active');

            obj = $(this).closest('.medicationAddList').find('.Qty')
            if (obj.val() == "") {
                obj.val('1')
            }
            obj.addClass('active');
            obj.focus();

            $(this).closest('.medicationAddList').find(".ItemTotal").val(Rate);
            obj = $(this).closest('.medicationAddList').find('.ItemTotal')
            obj.addClass('active');
            obj.focus();
        }
    })

    function calculateTotal() {
        window.subtotal = 0;
        $('input[name^="Qty"]').each(function() {
            qty_str = $(this).val();
            rate_str = $(this).closest('.medicationAddList').find('.Rate').val()
            if (rate_str != "" && qty_str != "") {
                rate = parseFloat(rate_str);
                qty = parseFloat(qty_str);

                $(this).closest('.medicationAddList').find('.ItemTotal').val(addCommas(rate * qty))
                window.subtotal = subtotal + rate * qty;
            }
        });
        $('#SubTotal').val(window.subtotal)
        igst = (window.subtotal * window.IGST / 100).toFixed(2);
        cgst = (window.subtotal * window.CGST / 100).toFixed(2);
        sgst = (window.subtotal * window.SGST / 100).toFixed(2);


        if (isigst == 'Yes') {
            $('#IGST').val(igst);
            $('#CGST').val(0);
            $('#SGST').val(0);
        } else {
            $('#CGST').val(cgst);
            $('#SGST').val(sgst);
            $('#IGST').val(0);
        }

        total = parseFloat(window.subtotal) + parseFloat(igst);
        $('#Total').val(total.toFixed(2));

        obj = $('#SubTotal')
        obj.addClass('active');
        obj.focus();

        obj = $('#Total')
        obj.addClass('active');
        obj.focus();

        /* 
        $('.Total').val(total);
        $('.LTotal').addClass('active');

        if (isigst == 'Yes') {
            $('.IGST').val(igst);
            $('.LIGST').addClass('active');
        } else {
            $('.CGST').val(cgst);
            $('.LCGST').addClass('active');

            $('.SGST').val(sgst);
            $('.LSGST').addClass('active');
        } */
    }


    $('body').on('blur', '.Qty', function() {
        calculateTotal()
    })

    $('body').on('blur', '.Rate', function() {
        calculateTotal()
    })

    $(document).on("click", ".remove_diagnosis,.remove_medication,.remove_report", function() {
        $(this).closest(".medicationAddList").remove();
        calculateTotal()
    });


    $(document).on("click", "#add_user", function() {
        medicationclone++
        $.ajax({
            type: "post",
            datatype: "html",
            url: base_url + "admin/user/invoice/ajax_userclone/" + medicationclone,
            data: {},
            success: function(data) {
                $("#medication_main").append(data);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    });

    $(document).on("click", "#add_material", function() {
        medicationclone++
        $.ajax({
            type: "post",
            datatype: "html",
            url: base_url + "admin/user/invoice/ajax_materialclone/" + medicationclone,
            data: {},
            success: function(data) {
                $("#material_main").append(data);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    });



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
</script>