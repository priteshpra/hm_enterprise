<script>
    window.submitflag = 0;
    $(document).ready(function () {
        setTimeout(function(){ $('#Question').focus(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
        ?>     
        <?php if (isset($this->session->userdata['postsuccess'])) {
         echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
        ?>
        
        window.html = $('.option_one').html();
        $('.more_options').find('.add_question').remove()
        if($('#QuestionID').val() == "0") {
            $('.option_one').find('.remove_question').remove()
        }
    })
    
    $('body').on('click', '.add_question', function(){
        $('.more_options').append(window.html);
        $('.more_options').find('.add_question').remove()

        $('.more_options input').last().val('')
    })
    $('body').on('click', '.remove_question', function(){
        $(this).closest('.row').remove();
    })
    
    $('#button_submit').on('click', function (){
        var error = checkValidations();
        
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            if(submitflag == 1){
                return false;
            }
            submitflag = 1;
            var ID = $('#QuestionID').val();
            var Question = $('#Question').val();
            
            submitflag = 0;
            $('#button_submit').addClass('hide');
            $('#button_submit_loading').removeClass('hide');
            alertify.success("<?php echo label('please_wait');?>");
            $('#AddForm').submit();
                    
                
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