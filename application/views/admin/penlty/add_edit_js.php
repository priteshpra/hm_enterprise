<script>
    window.submitflag = 0;
    $(document).ready(function () {
        setTimeout(function(){ $('#Reason').focus(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
        ?>     
        <?php if (isset($this->session->userdata['postsuccess'])) {
         echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
        ?>


    $('body').on('click', '#AddRow', function() {
        /* reasons = '';
        $("input[name=AddReasons]:checked").each(function(){
            //alert($(this).val())
            reasons += $(this).val()+", ";
        });
        if(reasons != "") {
            reasons = reasons.substring(0, reasons.length-2)
        } */

        user_id = $("#AddUser :selected").val()
        user_name = $("#AddUser :selected").text()
        amount = $('#AddAmount').val()

        $.ajax({
                type:"post",
                url: base_url + "admin/Penlty/addUserView",
                data:{
                    user_id: user_id,
                    user_name: user_name,
                    amount: amount
                },success:function(data){
                    html = data;
                    $('#more_fields').append(html)
                },error:function($data){
                    submitflag = 0;
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                },
            });
        //html = '<div class="row"><div class="col m11 s11"><div class="col m6 s12"><label>Name</label><br /><input type="text" value="'+user_name+'" name="user" readOnly /><input type="hidden" name="Users[]" value="'+user_id+'" /></div><div class="col m6 s12"><label>Amount</label><br /><input type="text" value="Rs.'+amount+'" name="amount" readOnly /><input type="hidden" name="Amounts[]" value="'+amount+'" /></div></div><div class="col m1 s1 right-align"><a class="btn-floating waves-effect waves-light red accent-6"><i class="mdi-content-remove tooltipped" data-position="top" data-delay="50" data-tooltip="Remove"></i></a></div></div>';
    })
    $('body').on('click', '.remove_user', function(){
        $(this).closest('.user_row').remove();
    })
    $('#penalty_main').find('#remove_parent').hide();
    $('.user_combobox').html($('#hello').html());
    $('#add_more').on('click', function (){
        copy_data = $('#penalty_main').html()
        $('#more_fields').append(copy_data);
        $('#more_fields').find('#remove_parent').show();
    })
    
    $('body').on('click', '#remove_parent', function() {
        $(this).closest('.user_row').remove();
    });
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
            var ID = $('#ReasonID').val();
            var Reason = $('#Reason').val();
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/reason/checkDuplicate",
                data:{
                    Table:"Reason",
                    DataValue:Reason,
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
                        alertify.error("<?php echo label('reason_already_exists');?>");
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