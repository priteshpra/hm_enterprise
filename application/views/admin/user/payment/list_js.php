<script type="text/javascript">
    $(document).ready(function() {
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
    });

    $(document).on('click', '.export-excel', function() {
        $("#ExportForm").submit();
    })

    window.PageSize = 10;
    window.CurrentPage = 1;
    window.SitesID = '-1';
    window.VisitorID = '-1';
    window.CustomerID = '-1';
    window.QoutationStatus = '';

    function common_ajax(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/user/payment/ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                SitesID: SitesID,
                VisitorID: VisitorID,
                CustomerID: CustomerID,
                QoutationStatus: QoutationStatus
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('.TableBody').html(obj.listing);
                $('.PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    //---------pagiing and search----------//     
    $(document).ready(function() {
        $("#model_title").html("<?php echo label('msg_lbl_payment'); ?>");
        common_ajax(PageSize, CurrentPage);
    })

    $('.SearchSubmit').on('click', function() {
        SitesID = $('#SitesID').val();
        VisitorID = $('#VisitorID').val();
        CustomerID = $('#CustomerID').val();
        QoutationStatus = $('input[name="QoutationStatus"]:checked').val();
        Status = $('input[name="Status"]:checked').val();
        common_ajax(PageSize, 1);
    })

    $('.PageSize').on('change', function() {
        PageSize = $(this).val();
        common_ajax(PageSize, 1);
    })

    $('.PaginationDiv').on('click', '.pagination_buttons', function() {
        PageSize = $('#PageSize').val();
        var page = $(this).attr('data-page-number');
        common_ajax(PageSize, page);
    })

    $(".TableBody").on('click', '.info', function() {
        var mydiv = $(this).attr('data-div');
        if (typeof mydiv === "undefined") {
            mydiv = "";
        } else {
            mydiv += "#" + mydiv;
        }

        var ID = $(this).attr('data-id');
        var Table = "Quotation";
        $.ajax({
            type: "post",
            url: base_url + "admin/user/quotation/getRecordInfo",
            data: {
                ID: ID,
                Table: Table
            },
            success: function(data) {
                $(mydiv + " #record_info").html(data);
                $(mydiv + ' #view-pop-up-modal').openModal();
            }
        })
    });


    $(".TableBody").on('click', '.status_change', function() {
        var mydiv = $(this).attr('data-div');
        var ID = $(this).attr('data-id');
        var Status = $(this).attr('data-new-status');
        var current_status = $(this).attr('data-icon-type');

        if (typeof mydiv === "undefined") {
            mydiv = "";
        } else {
            mydiv += "#" + mydiv;
        }

        $(mydiv + ' #row_' + ID).find('.status_change.' + active_status_icon_class).addClass('hide');
        $(mydiv + ' #row_' + ID).find('.status_change.' + inactive_status_icon_class).addClass('hide');
        $(mydiv + ' #row_' + ID).find('.status_change.' + loading_status_icon_class).removeClass('hide');
        $.ajax({
            type: "post",
            url: base_url + "admin/user/quotation/changeStatus",
            data: {
                Table: "Quotation",
                ID: ID,
                Status: Status,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.result == "Error") {
                    if (current_status == "inactive") {
                        current_status = "active";
                    } else {
                        current_status = "inactive";
                    }
                }
                if (current_status === 'inactive') {
                    $(mydiv + ' #row_' + ID).find('.status_change.' + active_status_icon_class).removeClass('hide');
                    $(mydiv + ' #row_' + ID).find('.status_change.' + inactive_status_icon_class).addClass('hide');
                    $(mydiv + ' #row_' + ID).find('.status_change.' + loading_status_icon_class).addClass('hide');
                } else {
                    $(mydiv + ' #row_' + ID).find('.status_change.' + active_status_icon_class).addClass('hide');
                    $(mydiv + ' #row_' + ID).find('.status_change.' + inactive_status_icon_class).removeClass('hide');
                    $(mydiv + ' #row_' + ID).find('.status_change.' + loading_status_icon_class).addClass('hide');
                }
                alertify.success(obj.message);
            }
        })
    });
</script>