<script>
    
    window.submitflag = 0;
    
    $(document).ready(function () {
        setTimeout(function(){ $('#RoomNo').focus(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
        ?>     
        <?php if (isset($this->session->userdata['postsuccess'])) {
         echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
        ?>     
    })
    
   /* $('#button_submit').on('click', function (){
        if ($('#TrainingDateTimeID').val() === ''){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            $('#AddForm').submit();
        }
        return false;
    });*/

    /* $('#button_submit').on('click', function (){
        var error = checkValidations();
        if (error === 'yes'){
            alertify.error("<?php //echo label('required_field'); ?>");
            return false;
        }else{
            $('#AddForm').submit();
        }
        return false;
    }); */

    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
    
</script>


<script>

        window.dt = new Date();
        $('.datepickerval').pickadate({
            format: 'dd-mm-yyyy',
            min: new Date(),
            onSet: function( arg ){
                if ( 'select' in arg ){ //prevent closing on selecting month/year
                    this.close();
                }
            }
        });
        $('.timeppast').clockpicker({
            placement: 'bottom',
            align: 'left',
            darktheme: false,
            twelvehour: false,
            'default': 'now'
        });
        $('.timep').clockpicker({
            placement: 'bottom',
            align: 'left',
            darktheme: false,
            twelvehour: false,
            'default': 'now',
            min:dt.getTime()
                            
        });

        $('.datepickervalall').pickadate({
            format: 'dd-mm-yyyy',
            max: new Date(),
            onSet: function( arg ){
                if ( 'select' in arg ){ //prevent closing on selecting month/year
                    this.close();
                }
            }
        });
    $(document).ready(function () {

        setTimeout(function(){ $('#Message').focus(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
        ?>     
        <?php if (isset($this->session->userdata['postsuccess'])) {
         echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
        ?>
            
    })
    $('#ReminderDate').change(function(){
        $('#ReminderTime').val('');
    });
    $('#ReminderTime').change(function(){
            var dt = new Date();
            var ct = dt.getDate() + "-" + (dt.getMonth()+1) + "-" + (dt.getFullYear());
            dtm = dt.getHours()+':'+dt.getMinutes();
            rtime = $('#ReminderTime').val();
            rdate = $('#ReminderDate').val();
            if(rdate == ct){
                if(rtime < dtm){
                    alertify.error("<?php echo label('future_time'); ?>");
                    $('#ReminderTime').val('');
                    return false;
                }
            }
    });
    window.submitflag = 1;
    $('#button_submit').on('click', function ()
    {
        var error = checkValidations();
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            if(submitflag == 0){
                  return false;
            }
            submitflag == 0;
            $.ajax({
                success:function(data)
                {
                    $('#button_submit').addClass('hide');
                    $('#button_submit_loading').removeClass('hide');
                    alertify.success("<?php echo label('please_wait');?>");
                    $('form').submit();
                },
                error:function(data)
                {
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                }
            })
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