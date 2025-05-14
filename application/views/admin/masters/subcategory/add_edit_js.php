<script>
    window.submitflag = 0;
    $(document).ready(function () {
        setTimeout(function(){ $('#SubCategoryName').focus(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
        ?>     
    })
    
    $('#button_submit').on('click', function (){
        var error = checkValidations();
        var combo_box_error = checkComboBox([]);
        if (error === 'yes' || combo_box_error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            if(submitflag == 1){
                return false;
            }
            submitflag = 1;
            var ID = $('#SubCategoryID').val();
            var SubCategoryName = $('#SubCategoryName').val();
            
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/subcategory/checkDuplicate",
                data:{
                    Table:"SubCategory",
                    DataValue:SubCategoryName,
                    ID:ID,
                },success:function(data){
                    submitflag = 0;
                    var obj = JSON.parse(data);
                    if(obj.result == 'Success'){
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait');?>");
                        $('#AddForm').submit();
                    }else{
                        alertify.error("<?php echo label('msg_lbl_subcategory_already_exists');?>");
                        return false;
                    }           
                },error:function($data){
                    submitflag = 0;
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                },
            });
        }
    });
    
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>