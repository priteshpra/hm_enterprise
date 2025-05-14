<script>
    window.PageSize = 10;
    window.CurrentPage = 1;
    window.ReportType = 'Followup';
    window.CustomStartDate = '';
    window.CustomEndDate = '';

    $(document).ready(function() {
        <?php
        if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        } ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
        ajax_dashboard($("input[name='FilterType']:checked").val());
        ajax_listing(PageSize, CurrentPage);
        visitorajax_listing(PageSize, CurrentPage);
    });

    $(document).on("change", "input[type='radio']", function() {
        ajax_dashboard($(this).val());
        ajax_listing(PageSize, CurrentPage);
        visitorajax_listing(PageSize, CurrentPage);
    });

    function ajax_dashboard(_FilterType) {
        $.ajax({
            type: "post",
            url: base_url + "admin/admindashboard/ajax_dashboard",
            data: {
                FilterType: _FilterType,
            },
            success: function(data) {
                $('#dashboard_listing').html(data);
            },
            error: function(data) {
                console.log(data);
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_listing(PageSize, CurrentPage) {

        var tmp = "( " + ReportType + " - " + FilterType + " )";
        if (ReportType == "Followup") {
            tmp = "( Lead Follow up - " + FilterType + " )";
        }
        $("#reportlabel").html(tmp);
        $.ajax({
            type: "post",
            url: base_url + "admin/admindashboard/followup_ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                FilterType: ($("input[name='FilterType']:checked").val()),
                ReportType: ReportType
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#table_body').html(obj.a);
                $('#table_paging_div').html(obj.b);
            },
            error: function(data) {
                console.log(data);
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function visitorajax_listing(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            url: base_url + "admin/admindashboard/visitor_ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                FilterType: ($("input[name='FilterType']:checked").val())
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#leadtable_body').html(obj.a);
                $('#leadtable_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }


    $('#table_paging_div').on('click', '.pagination_buttons', function() {
        var page = $(this).attr('data-page-number');
        ajax_listing(PageSize, page);
    })

    $('.select-dropdown').on('change', function() {
        PageSize = $(this).val();
        ajax_listing(PageSize, CurrentPage);
        leadajax_listing(PageSize, CurrentPage);
    })

    $('#table_paging_div').on('click', '.pagination_buttons', function() {
        var page = $(this).attr('data-page-number');
        ajax_listing(PageSize, page);
    })

    $('#leadtable_paging_div').on('click', '.pagination_buttons', function() {
        var page = $(this).attr('data-page-number');
        visitorajax_listing(PageSize, page);
    })
</script>