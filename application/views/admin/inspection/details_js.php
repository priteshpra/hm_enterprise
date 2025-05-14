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
    window.InspectionID = '<?php echo (@$InspectionID); ?>';


    function common_ajax(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/inspection/item_ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                InspectionID: InspectionID
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#inspection #TableBody').html(obj.listing);
                $('#inspection .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    //---------pagiing and search----------//     
    $(document).ready(function() {
        $("#model_title").html("<?php echo label('msg_lbl_inspection'); ?>");
        common_ajax(PageSize, CurrentPage);
        sites_ajax(PageSize, CurrentPage);
    })

    $(document).on('click', ".tabclick", function() {
        div = $(this).attr('data-div');
        if (div == "inspection") {
            common_ajax(PageSize, 1);
        }
    });

    $('.SearchSubmit').on('click', function() {
        div = $(this).attr('data-div');
        if (div == "inspection") {
            common_ajax(PageSize, 1);
        }
    })

    $('.PageSize').on('change', function() {
        PageSize = $(this).val();
        div = $(this).attr('data-div');
        if (div == "inspection") {
            common_ajax(PageSize, 1);
        }
    })

    $('.PaginationDiv').on('click', '.pagination_buttons', function() {
        var page = $(this).attr('data-page-number');
        if (div == "inspection") {
            common_ajax(PageSize, page);
        }
    })
</script>