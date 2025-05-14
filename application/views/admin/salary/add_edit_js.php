<script>
    window.submitflag = 0;
    $(document).ready(function () {
        setTimeout(function(){ $('#CityName').focus(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
        ?>     
        <?php if (isset($this->session->userdata['postsuccess'])) {
         echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
        ?>     
    })

    $('#UserID').on('change', function() {
        getAttandance()
        $('#Advance_Receive').prop('checked', true);
        $('#AdvanceAmount').parent().show()
    })
    $('#StartDate').on('change', function() {
        getAttandance()
    })
    $('#EndDate').on('change', function() {
        getAttandance()
    })
    $('#AdvanceAmount').parent().hide()
    $('input[name="Advance"]').on('change', function() {
        $('#AdvanceAmount').parent().hide()
        if($(this).val() != "None") {
            $('#AdvanceAmount').parent().show()
        } else {
            $('#AdvanceAmount').val('0')
        }
        getAttandance();
    })
    $('#AdvanceAmount').on('change', function() {
        getAttandance();
    })
    $('#Penalty').on('change', function() {
        getAttandance();
    })
    function getAttandance() {
        $.ajax({
            type:"post",
            url: base_url + "admin/salary/getAttandance",
            data:{
                StartDate: $('#StartDate').val(),
                EndDate: $('#EndDate').val(),
                UserID: $('#UserID').val()
            },
            dataType: 'json',
            success:function(data){
                if(data.Message === undefined) {
                    total_present_days = parseFloat(data.PresentCount) + parseFloat(data.AbsentCount) + parseFloat(data.HalfDayCount) + parseFloat(data.HalfOverTime) + parseFloat(data.FullOverTime);
                    
                    $('#PresentCount').val(data.PresentCount)
                    $('#AbsentCount').val(data.AbsentCount)
                    $('#HalfdayCount').val(data.HalfDayCount)
                    $('#HalfdayOvertime').val(data.HalfOverTime)
                    $('#FulldayOvertime').val(data.FullOverTime)
                    $('#AdvanceAmountLabel').html(data.Advance)
                    $('#PenaltyAmountLabel').html(data.Penalty)

                    if($('#AdvanceAmount').val() == "") {
                        $('#AdvanceAmount').val('0')
                    }
                    if($('#Penalty').val() == "") {
                        $('#Penalty').val('0')
                    }
                    advance_type = $('input[name="Advance"]:checked').val()
                    advance_amt = parseInt($('#AdvanceAmount').val())
                    penalty_amt = parseInt($('#Penalty').val())
                    
                    salary = parseFloat(data.Salary)
                    if(Salary != 0) {
                        perday_salary = (salary/30).toFixed(2);
                        $('#Salary').val(addCommas(salary))
                        $('#PerDaySalary').val(addCommas(perday_salary))

                        total_payable = (perday_salary * total_present_days);
                        if(advance_type == "Received") {
                            total_payable = total_payable - advance_amt;
                        } else if(advance_type == "Paid") {
                            total_payable = total_payable + advance_amt;
                        }
                        total_payable = total_payable - penalty_amt;
                        
                        total_payable = (Math.round(total_payable * 100) / 100).toFixed(2);
                        //total_payable = total_payable.toFixed(2)
                        $('#PayAmount').val(total_payable)
                    }
                    
                    $('#PresentCount').addClass('active')
                    $('#PresentCount').focus()
                    $('#AbsentCount').addClass('active')
                    $('#AbsentCount').focus()
                    $('#HalfdayCount').addClass('active')
                    $('#HalfdayCount').focus()
                    $('#HalfdayOvertime').addClass('active')
                    $('#HalfdayOvertime').focus()
                    $('#FulldayOvertime').addClass('active')
                    $('#FulldayOvertime').focus()
                    $('#PerDaySalary').addClass('active')
                    $('#PerDaySalary').focus()
                    $('#Salary').addClass('active')
                    $('#Salary').focus()
                    $('#Penalty').addClass('active')
                    $('#Penalty').focus()
                    $('#AdvanceAmount').addClass('active')
                    $('#AdvanceAmount').focus()
                    $('#PayAmount').addClass('active')
                    $('#PayAmount').focus()

                } else {
                    $('#PresentCount').val('')
                    $('#AbsentCount').val('')
                    $('#HalfdayCount').val('')
                    $('#HalfdayOvertime').val('')
                    $('#FulldayOvertime').val('')
                    $('#Salary').val('')
                    $('#PerDaySalary').val('')
                    $('#PayAmount').val('')
                    $('#Penalty').val('')
                    $('#AdvanceAmount').val('')
                }
            },error:function($data){
                submitflag = 0;
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            },
        });
    }

    $('#button_submit').on('click', function (){
        var error = checkValidations();
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            $('#button_submit').addClass('hide');
            $('#button_submit_loading').removeClass('hide');
            alertify.success("<?php echo label('please_wait');?>");
            $('#AddForm').submit();
        }
    });
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>