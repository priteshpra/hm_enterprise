<script>
window.submitflag = 0;
 $(document).ready(function () {
    setTimeout(function(){ $('#Name').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
});
    $('#button_submit').on('click', function (){
        var error = checkValidations();
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field');?>");
            return false;
        }else{
            var cnt = $(".main_div input:checkbox:checked").length;
            if(cnt == 0){
                alertify.error("<?php echo label('required_minimum_one_role');?>");
                return false;
            }
            if(submitflag == 1){
                return false;
            }
            submitflag = 1;
            $.ajax({
                type:"post",
                url: base_url + "admin/role/CheckDuplicate",
                data:{
                    Table:"Role",
                    DataValue:$('#Name').val(),
                    ID:$("#RoleID").val(),
                },success:function(data){   
                    submitflag = 0;
                    var obj = JSON.parse(data);
                    if(obj.result == 'Success'){
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait');?>");
                        $('form').submit();
                    }else{
                        alertify.error("<?php echo label('role_already_exists');?>");
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
    $(".masters").on("click", function () {
        var div = $(this).val();
        if($(this).is(":checked")){
            $("#"+div + " .submodule").prop('checked',true);
            $("#"+div + " .insert_actions").prop('checked',true);
            $("#"+div + " .module_actions").prop('disabled',false);
            $("#"+div + " .check_sub_action").prop('disabled',false);
        }else{
            $("#"+div + " input:checkbox").prop('checked',false);
            $("#"+div + " .module_actions").prop('disabled',true);
            $("#"+div + " .check_sub_action").prop('disabled',true);
        }
        checkchange();
    });
    $(".check_all_action").on("click",function(){
        var div = $(this).val();
        var master = $(this).attr('data-master');
        if($(this).is(":checked")){
            $("#"+master).prop('checked',true);
            $("#"+div + " .submodule").prop('checked',true);
            $("#"+div + " .all_actions").prop('checked',true);
            $("#"+div + " .all_actions").prop('disabled',false);
            $("#"+div + " .insert_actions").prop('disabled',true);
        }else{
            $("#"+master).prop('checked',false);
            $("#"+div + " .submodule").prop('checked',false);
            $("#"+div + " .all_actions").prop('checked',false);
            $("#"+div + " .all_actions").prop('disabled',true);
        }
        checkchange();
    });
    $(".submodule").on("click",function(){
        var div = $(this).attr('data-div');
        if($(this).is(":checked")){
            $("#"+div + " .all_actions").prop('disabled',false);
            $("#"+div + " .insert_actions").prop('disabled',true);
            $("#"+div + " .insert_actions").prop('checked',true);
            $(this).parents('.submodule-container').find('.check_sub_action').prop('disabled',false);
        }else{
            $("#"+div + " .all_actions").prop('disabled',true);
            $("#"+div + " input:checkbox").prop('checked',false);
            $("#"+div + " .module_actions").prop('checked',false);
            $(this).parents('.submodule-container').find('.check_sub_action').prop('disabled',true);
            $(this).parents('.submodule-container').find('.check_sub_action').prop('checked',false);
        }
        checkchange();
    });
    $(".check_sub_action").on("click",function(){
        var div = $(this).attr('data-div');
        if($(this).is(":checked")){
            $("#"+div + " .all_actions").prop('checked',true);
        }else{
            $("#"+div + " .all_actions").prop('checked',false);
            $("#"+div + " .insert_actions").prop('checked',true);
        }
        checkchange();
    });
    $(".all_actions").on("click",function(){
        checkchange();
    });
    function checkchange(){
        formSubmitting = true;
        $.each($(".submodule"), function(){  
            var div = $(this).attr('data-div');
            var cnt = $("#"+div+" input:checkbox:checked").length;
            var inputcnt = $("#"+div+" input:checkbox").length;
            if(cnt == 0){
                $(this).prop('checked',false);
            }else{
                $(this).prop('checked',true);   
                if(cnt == inputcnt){
                    $(this).parents('.submodule-container').find('.all_actions').prop('checked',true);
                }else{
                    $(this).parents('.submodule-container').find('.all_actions').prop('checked',false);
                }
            }
        });
        $.each($(".masters"), function(){  
            var div = $(this).val();
            var inputcnt = $("#"+div+" input:checkbox").length;
            var cnt = $("#"+div+" input:checkbox:checked").length;
            if(cnt == 0){
                $(this).prop('checked',false);
                $(this).parents('.master-container').find('.check_all_action').prop('checked',false);
                $(this).parents('.master-container').find('.check_all_action').prop('disabled',true);
            }else{
                $(this).parents('.master-container').find('.check_all_action').prop('disabled',false);
                $(this).prop('checked',true); 
                if(cnt == inputcnt){
                    $(this).parents('.master-container').find('.check_all_action').prop('checked',true);
                }else{
                    $(this).parents('.master-container').find('.check_all_action').prop('checked',false);
                }
            }
        });
    }
</script>