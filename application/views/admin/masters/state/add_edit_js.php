<script>
    window.submitflag = 0;
    $(document).ready(function () {
        setTimeout(function(){ $('#StateName').focus(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
        ?>     
        <?php if (isset($this->session->userdata['postsuccess'])) {
         echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
        ?>     
})
    
    $('#button_submit').on('click', function (){
        var error = checkValidations();
        var combo_box_error = checkComboBox(['CountryID']);    
        if (error === 'yes' || combo_box_error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            if(submitflag == 1){
                return false;
            }
            submitflag = 1;
            var ID = $('#StateID').val();
            var CountryID = $('#CountryID').val();
            var StateName = $('#StateName').val();
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/state/CheckDuplicateDouble",
                data:{
                    Table:"State",
                    DataValue:StateName,
                    SecondDataValue:CountryID,
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
                        alertify.error("<?php echo label('state_already_exists');?>");
                        return false;
                    }           
                },error:function($data){
                    submitflag = 0;
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                },
            });
        }
        return false;
    });
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>