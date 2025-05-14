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
    window.PenaltyID = '<?php echo (@$PenaltyID); ?>';


    function common_ajax(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/penlty/item_ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                PenaltyID: PenaltyID
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#penlty #TableBody').html(obj.listing);
                $('#penlty .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    //---------pagiing and search----------//     
    $(document).ready(function() {
        $("#model_title").html("<?php echo label('msg_lbl_penlty'); ?>");
        common_ajax(PageSize, CurrentPage);
        sites_ajax(PageSize, CurrentPage);
    })

    $(document).on('click', ".tabclick", function() {
        div = $(this).attr('data-div');
        if (div == "penlty") {
            common_ajax(PageSize, 1);
        }
    });

    $('.SearchSubmit').on('click', function() {
        div = $(this).attr('data-div');
        if (div == "penlty") {
            common_ajax(PageSize, 1);
        }
    })

    $('.PageSize').on('change', function() {
        PageSize = $(this).val();
        div = $(this).attr('data-div');
        if (div == "penlty") {
            common_ajax(PageSize, 1);
        }
    })

    $('.PaginationDiv').on('click', '.pagination_buttons', function() {
        var page = $(this).attr('data-page-number');
        if (div == "penlty") {
            common_ajax(PageSize, page);
        }
    })

    $("#penlty #TableBody").on('click', '.status_change', function() {
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
            url: base_url + "admin/penlty/changeStatus",
            data: {
                Table: "PenltyEmployee",
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

    $("#TableBody").on('click', '.info', function() {
        var mydiv = $(this).attr('data-div');
        if (typeof mydiv === "undefined") {
            mydiv = "";
        } else {
            mydiv += "#" + mydiv;
        }

        var ID = $(this).attr('data-id');
        var Table = "PenltyEmployee";
        $.ajax({
            type: "post",
            url: base_url + "admin/penlty/getRecordInfo",
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
</script>