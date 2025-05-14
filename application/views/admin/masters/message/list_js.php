<script type="text/javascript">
$(document).ready(function () {
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>   
});
$(document).on('click','.export-excel',function(){
    $("#ExportForm").submit();
})
    window.PageSize = 10;
    window.CurrentPage = 1;
    window.Message = '';
    window.Status = '-1';
    function common_ajax(PageSize,CurrentPage){
        $.ajax({
            type: "post",
            datatype:"JSON",
            url: base_url + "admin/masters/message/ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                Message: Message,
                Status: Status
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
        $("#model_title").html("<?php echo label('msg_lbl_title_message');?>");
        common_ajax(PageSize,CurrentPage);
    })

    $('.SearchSubmit').on('click', function () {
        Message =  $('#Message').val(); 
        Status = $('input[name="Status"]:checked').val();
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