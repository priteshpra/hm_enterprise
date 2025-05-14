<script>
    
    window.submitflag = 0;
    
    $(document).ready(function () {
        $('#StartDate_allocation').pickadate({ 
            format: 'yyyy-mm-dd',
            max: new Date(),
            onSet: function( arg ){
                if ( 'select' in arg ){ //prevent closing on selecting month/year
                    this.close();
                }
            }
        });
        $('#EndDate_allocation').pickadate({
            format: 'yyyy-mm-dd',
            max: new Date(),
            onSet: function( arg ){
                if ( 'select' in arg ){ //prevent closing on selecting month/year
                    this.close();
                }
            }
        });   


        setTimeout(function(){ $('#RoomNo').focus(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
        ?>     
        <?php if (isset($this->session->userdata['postsuccess'])) {
         echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
        ?>     
    })
    
    $('#button_submit').on('click', function (){
        var error = checkValidations();
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
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