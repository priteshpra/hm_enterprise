<script type="text/javascript">
    $(document).ready(function() {
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
    });
    $(document).on('click', '.export-excel', function() {
        var div = $(this).attr('data-div');
        $("#" + div + " #ExportForm").submit();
    })
    window.PageSize = 10;
    window.CurrentPage = 1;
    window.div = '';
    window.VisitorID = '<?php echo $VisitorID; ?>';
    window.CustomerID = '<?php echo $CustomerID; ?>';
    window.SiteName = '';

    function ajax_sites(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/user/sites/ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                SiteName: SiteName,
                VisitorID: VisitorID,
                CustomerID: CustomerID
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#Sites .TableBody').html(obj.listing);
                $('#Sites .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_quotation(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/user/quotation/ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                Status: -1,
                VisitorID: VisitorID,
                CustomerID: CustomerID
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#Quotation .TableBody').html(obj.listing);
                $('#Quotation .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_reminder(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/user/visitorreminder/ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                VisitorID: VisitorID
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#reminder #TableBody').html(obj.listing);
                $('#reminder .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    //---------pagiing and search----------//     
    $(document).ready(function() {
        ajax_sites(PageSize, CurrentPage);
        ajax_quotation(PageSize, CurrentPage);
        ajax_reminder(PageSize, CurrentPage);
    });

    $("#reminder #TableBody").on('click', '.status_change', function() {
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
            url: base_url + "admin/user/visitorreminder/changeStatus",
            data: {
                Table: "VisitorReminder",
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
    })

    $("#reminder #TableBody").on('click', '.info', function() {
        $("#model_title").html("<?php echo label('msg_lbl_visitorreminder'); ?>");
        var mydiv = $(this).attr('data-div');
        if (typeof mydiv === "undefined") {
            mydiv = "";
        } else {
            mydiv += "#" + mydiv;
        }

        var ID = $(this).attr('data-id');
        var Table = "VisitorReminder";
        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitorreminder/getRecordInfo",
            data: {
                ID: ID,
                Table: Table
            },
            success: function(data) {
                $(mydiv + " #record_info").html(data);
                $(mydiv + ' #view-pop-up-modal').openModal();
            }
        })
    })

    $('.SearchSubmit').on('click', function() {
        div = $(this).attr('data-div');
        if (div == "Sites") {
            SiteName = $('#SiteName').val();
            ajax_sites(PageSize, 1);
        } else if (div == "Quotation") {
            ajax_quotation(PageSize, 1);
        } else if (div == "reminder") {
            ajax_reminder(PageSize, 1);
        }
    })

    $('.PageSize').on('change', function() {
        PageSize = $(this).val();
        div = $(this).attr('data-div');
        if (div == "Sites") {
            ajax_sites(PageSize, 1);
        } else if (div == "Quotation") {
            ajax_quotation(PageSize, 1);
        } else if (div == "reminder") {
            ajax_reminder(PageSize, 1);
        }
    })

    $('.PaginationDiv').on('click', '.pagination_buttons', function() {
        var page = $(this).attr('data-page-number');
        if (div == "Sites") {
            ajax_sites(PageSize, page);
        } else if (div == "Quotation") {
            ajax_quotation(PageSize, page);
        } else if (div == "reminder") {
            ajax_reminder(PageSize, page);
        }
    });
    $(document).on('click', ".tabclick", function() {

        div = $(this).attr('data-div');
        if (div == "Sites") {
            PageSize = $('#' + div + ' #PageSize').val();
            ajax_sites(PageSize, 1);
        } else if (div == "Quotation") {
            ajax_quotation(PageSize, 1);
        } else if (div == "reminder") {
            ajax_reminder(PageSize, 1);
        }

    });

    $("#Sites .TableBody").on('click', '.info', function() {
        $("#model_title").html("<?php echo label('msg_lbl_sites'); ?>");
        var mydiv = $(this).attr('data-div');
        if (typeof mydiv === "undefined") {
            mydiv = "";
        } else {
            mydiv += "#" + mydiv;
        }

        var ID = $(this).attr('data-id');
        var Table = "Sites";
        $.ajax({
            type: "post",
            url: base_url + "admin/user/sites/getRecordInfo",
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


    $("#Sites .TableBody").on('click', '.status_change', function() {
        var mydiv = $(this).attr('data-div');
        var ID = $(this).attr('data-id');
        var Status = $(this).attr('data-new-status');
        var current_status = $(this).attr('data-icon-type');
        $("#model_title").html("<?php echo label('msg_lbl_sites'); ?>");

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
            url: base_url + "admin/user/sites/changeStatus",
            data: {
                Table: "Sites",
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