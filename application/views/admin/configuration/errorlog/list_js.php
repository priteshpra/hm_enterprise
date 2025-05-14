<script type="text/javascript">
$(document).ready(function () {
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>   
});

    window.PageSize = 10;
    window.CurrentPage = 1;
    window.MethodName = '';
    window.ActivityDate = '';
    function common_ajax(PageSize,CurrentPage){
        $.ajax({
            type: "post",
            datatype:"JSON",
            url: base_url + "admin/configuration/errorlog/ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                MethodName: MethodName,
                ActivityDate: ActivityDate
            },success: function (data){
                var obj = JSON.parse(data);
                $('.TableBody').html(obj.listing);
                $('.PaginationDiv').html(obj.pagination);
            },error: function (data){
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
    //---------pagiing and search----------//     
    $(document).ready(function () {
        common_ajax(PageSize,CurrentPage);
    })

    $('.SearchSubmit').on('click', function () {
        MethodName =  $('#MethodName').val(); 
        ActivityDate =  $('#ActivityDate').val(); 
        common_ajax(PageSize,1);
    })

    $('.PageSize').on('change', function () {
        PageSize = $(this).val();
        common_ajax(PageSize,1);
    })

    $('.PaginationDiv').on('click', '.pagination_buttons', function () {
        PageSize = $('#PageSize').val();
        var page = $(this).attr('data-page-number');
        common_ajax(PageSize,page);
    })
</script>