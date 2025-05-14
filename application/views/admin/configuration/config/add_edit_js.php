<script type="text/javascript">
$(document).ready(function () {
    setTimeout(function(){ $('#CrashEmail').focus(); 
	}, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
});
$("#button_submit").on('click', function (){
	var error = checkValidations();
	var field_ids = ['TimeZone'];
	var semail = $('#SupportEmail').val();
    var gst = $('#GSTAmount').val();
    var cst = $('#CSTAmount').val();
    var combo_box_error = checkComboBox(field_ids);
        
        if(error == 'yes' || combo_box_error =='yes'){ 
            alertify.error("<?php echo label('required_field');?>");
            return false;
        }else{
            
			if(!isEmail(semail)){
				$('#SupportEmail').addClass('invalid');
				alertify.error("<?php echo label('valid_email');?>");
				return false;
			}
            else{
				$('#button_submit').addClass('hide');
				$('#button_submit_loading').removeClass('hide');
				$('form').submit();
			}
        } 


    });
	$(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>