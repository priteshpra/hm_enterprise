<script>
    window.submitflag = 0;
    window.medicationclone = 0;
    window.SGST = <?php echo $SGST; ?>;
    window.CGST = <?php echo $CGST; ?>;
    window.IGST = <?php echo $IGST; ?>;
    
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
    });

    window.Total = 0;
    window.cgst = 0;
    window.sgst = 0;
    window.igst = 0;
    window.isigst = '<?php echo $ISIGST; ?>';
    
    function calculateTotal() {
        window.subtotal = 0;
        $('input[name^="Qty"]').each(function() {
            qty_str = $(this).val();
            rate_str = $(this).closest('.medicationAddList').find('.Rate').val()
            days_str = $(this).closest('.medicationAddList').find('.Days').val()
            if (rate_str != "" && qty_str != "" && days_str != "") {
                rate = parseFloat(rate_str);
                qty = parseFloat(qty_str);
                days = parseFloat(days_str);
                
                $(this).closest('.medicationAddList').find('.ItemTotal').val(addCommas(rate*qty*days))
                window.subtotal = subtotal + rate * qty * days;
            }
        });
        $('#SubTotal').val(window.subtotal)
        igst = (window.subtotal * window.IGST / 100).toFixed(2);
        cgst = (window.subtotal * window.CGST / 100).toFixed(2);
        sgst = (window.subtotal * window.SGST / 100).toFixed(2);

        if (isigst == 'Yes') {
            $('#IGST').val(igst)
            $('#CGST').val(0)
            $('#SGST').val(0)
        } else {
            $('#CGST').val(cgst)
            $('#SGST').val(sgst)
            $('#IGST').val(0)
        }
        
        total = parseFloat(window.subtotal) + parseFloat(igst);
        $('#Total').val(total.toFixed(2));
        $('.LSubTotal').addClass('active');
        $('.LIGST').addClass('active');
        $('.LCGST').addClass('active');
        $('.LSGST').addClass('active');
        $('.LTotalAmount').addClass('active');
        
        $('.ItemTotal').addClass('active');
    }
   
    $('body').on('change', '.UsertypeID', function() {
        window.Rate = parseFloat($(this).closest('.medicationAddList').find('#UsertypeID').select2('data')['0'].Rate);
        window.HSNNo = ($(this).closest('.medicationAddList').find('#UsertypeID').select2('data')['0'].HSNNo);
        $(this).closest('.medicationAddList').find(".HSN_SAC").val(HSNNo);
        $(this).closest('.medicationAddList').find(".Rate").val(Rate);
        $(this).closest('.medicationAddList').find('.LHSN_SAC').addClass('active');
        $(this).closest('.medicationAddList').find('.LRate').addClass('active');

        obj = $(this).closest('.medicationAddList').find('.Qty')
        obj.val('1')
        obj.addClass('active');
        obj.focus();
        
        obj = $(this).closest('.medicationAddList').find('.Days')
        obj.val('1')
        obj.addClass('active');
        obj.focus();
        
        obj = $(this).closest('.medicationAddList').find('.ItemTotal')
        obj.addClass('active');
        obj.focus();
    })
    
    $('body').on('change', '.UsertypeIDMaterial', function() {
        window.Rate = parseFloat($(this).closest('.medicationAddList').find('#UsertypeIDMaterial').select2('data')['0'].Rate);
        window.HSNNo = ($(this).closest('.medicationAddList').find('#UsertypeIDMaterial').select2('data')['0'].HSNNo);
        $(this).closest('.medicationAddList').find(".HSN_SAC").val(HSNNo);
        $(this).closest('.medicationAddList').find(".Rate").val(Rate);
        $(this).closest('.medicationAddList').find('.LHSN_SAC').addClass('active');
        $(this).closest('.medicationAddList').find('.LRate').addClass('active');

        obj = $(this).closest('.medicationAddList').find('.Qty')
        obj.val('1')
        obj.addClass('active');
        obj.focus();
        
        obj = $(this).closest('.medicationAddList').find('.Days')
        obj.val('1')
        obj.addClass('active');
        obj.focus();
        
        obj = $(this).closest('.medicationAddList').find('.ItemTotal')
        obj.addClass('active');
        obj.focus();
    })

    $('body').on('blur', '.Qty', function() {
        calculateTotal()
    })

    $('body').on('blur', '.Rate', function() {
        calculateTotal()
    })

    $('body').on('blur', '.Days', function() {
        calculateTotal()
    })

    $(document).on("click", "#add_user", function() {
        medicationclone++
        $.ajax({
            type: "post",
            datatype: "html",
            url: base_url + "admin/user/quotation/ajax_userclone/" + medicationclone,
            data: {},
            success: function(data) {
                $("#quotation_main").append(data);
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
            url: base_url + "admin/user/quotation/ajax_userclone/" + medicationclone,
            data: {},
            success: function(data) {
                $("#quotation_material").append(data);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    });

    $(document).on("click", ".remove_diagnosis,.remove_medication,.remove_report", function() {
        $(this).closest(".medicationAddList").remove();
        calculateTotal()
    });

    $('#button_submit').on('click', function() {
        var error = checkValidations();
        var combo_box_error = checkComboBox(['CompanyID','ServiceID','UsertypeID']);

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