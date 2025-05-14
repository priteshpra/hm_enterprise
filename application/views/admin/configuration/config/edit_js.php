<script type="text/javascript">
   $(document).ready(function () {
    setTimeout(function(){ $('#Title').focus(); 
	}, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
});
    $("#button_submit_config").on('click', function (){
	var error = checkValidations();
        
        if(error == 'yes'){ 
            alertify.error("<?php echo label('required_field');?>");
            return false;
        }else{
            if($("#IsTaxApplicable").is(":checked")){
                var tax = parseInt($("#Tax").val());
                if(tax > 99){
                    alertify.error("<?php echo label('Enter_valid_tax');?>");
                    return false;
                }
            }
            $('#button_submit_config').addClass('hide');
            $('#button_submit_loading').removeClass('hide');
            $('form').submit();
        } 


    });
$(document).on('change',"#IsTaxApplicable",function(){
    if($(this).is(":checked")){
        $(".taxinput").show();
        $("#Tax").addClass("empty_validation_class");
    }else{
        $(".taxinput").hide();
        $("#Tax").removeClass("empty_validation_class");
    }
});
$(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit_config").click();
            return false;
        }
    });
</script>