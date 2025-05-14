<script type="text/javascript">
    $(document).ready(function() {
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
    });
    $(document).on('click', '.export-excel', function() {
        var div = $(this).attr('data-div');
        $("#" + div + " #ExportForm").submit();
    })
    window.PageSize = 10;
    window.CurrentPage = 1;
    window.ActivitylogName = '';
    window.ActivityDate = '';
    window.div = '';
    window.UserID = '<?php echo $UserID; ?>';

    function ajax_activity(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/configuration/activitylog/ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                ActivitylogName: ActivitylogName,
                ActivityDate: ActivityDate,
                UserID: UserID,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#ActivityLog .TableBody').html(obj.listing);
                $('#ActivityLog .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_checkin(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/user/employee/getCheckin/" + PageSize + "/" + CurrentPage,
            data: {
                Status: -1,
                UserID: UserID,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#CheinIn .TableBody').html(obj.listing);
                $('#CheinIn .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_advance(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/user/employee/getAdvance/" + PageSize + "/" + CurrentPage,
            data: {
                Status: -1,
                UserID: UserID,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#Advance .TableBody').html(obj.listing);
                $('#Advance .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_salary(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/user/employee/getSalary/" + PageSize + "/" + CurrentPage,
            data: {
                Status: -1,
                UserID: UserID,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#Salary .TableBody').html(obj.listing);
                $('#Salary .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    //---------pagiing and search----------//     
    $(document).ready(function() {
        ajax_activity(PageSize, CurrentPage);
        getUniform(PageSize, CurrentPage);
        getRoom(PageSize, CurrentPage);
        getTraining(PageSize, CurrentPage);
        getAttandance(PageSize, CurrentPage);
        ajax_checkin(PageSize, CurrentPage);
        ajax_advance(PageSize, CurrentPage);
        ajax_salary(PageSize, CurrentPage);
    })

    $('.SearchSubmit').on('click', function() {
        div = $(this).attr('data-div');
        if (div == "ActivityLog") {
            ActivitylogName = $('#ActivitylogName').val();
            ActivityDate = $('#ActivityDate').val();
            ajax_activity(PageSize, 1);
        }
    })

    $('.PageSize').on('change', function() {
        PageSize = $(this).val();
        div = $(this).attr('data-div');
        if (div == "ActivityLog") {
            ajax_activity(PageSize, 1);
        }
    })

    $('.PaginationDiv').on('click', '.pagination_buttons', function() {
        var page = $(this).attr('data-page-number');
        if (div == "ActivityLog") {
            ajax_activity(PageSize, page);
        } else if (div == "Uniform") {
            getUniform(PageSize, page);
        } else if (div == "RoomAllocation") {
            getRoom(PageSize, page);
        } else if (div == "Training") {
            getTraining(PageSize, page);
        } else if (div == "Attendance") {
            getAttandance(PageSize, page);
        } else if (div == "CheinIn") {
            ajax_checkin(PageSize, page);
        } else if (div == "Advance") {
            ajax_advance(PageSize, page);
        } else if (div == "Salary") {
            ajax_salary(PageSize, page);
        }
    });
    $(document).on('click', ".tabclick", function() {

        div = $(this).attr('data-div');
        if (div == "ActivityLog") {
            PageSize = $('#' + div + ' #PageSize').val();
            ajax_activity(PageSize, 1);
        } else if (div == "Uniform") {
            PageSize = $('#' + div + ' #PageSize').val();
            getUniform(PageSize, 1);
        } else if (div == "RoomAllocation") {
            PageSize = $('#' + div + ' #PageSize').val();
            getRoom(PageSize, 1);
        } else if (div == "Training") {
            PageSize = $('#' + div + ' #PageSize').val();
            getTraining(PageSize, 1);
        } else if (div == "Attendance") {
            PageSize = $('#' + div + ' #PageSize').val();
            getAttandance(PageSize, 1);
        } else if (div == "CheinIn") {
            PageSize = $('#' + div + ' #PageSize').val();
            ajax_checkin(PageSize, 1);
        } else if (div == "Advance") {
            PageSize = $('#' + div + ' #PageSize').val();
            ajax_advance(PageSize, 1);
        } else if (div == "Salary") {
            PageSize = $('#' + div + ' #PageSize').val();
            ajax_salary(PageSize, 1);
        }
    });
    $(document).on('click', '#button_change_password', function() {
        var error = checkValidations("#ChangePassword");
        if (error == "yes") {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            var newp = $("#new_password").val();
            var confirm = $("#confirm_password").val();
            if (newp != confirm) {
                alertify.error("<?php echo label('new_password_conf_not_macth'); ?>");
                return false;
            }
            var flag = isPassword($('#new_password').val());
            if (flag == 1) {
                alertify.error("<?php echo label('password_8_32_long_min_1_char_spc_digit'); ?>");
            } else {
                $.ajax({
                    type: "post",
                    datatype: "JSON",
                    url: base_url + "admin/user/employee/ChangePassword",
                    data: {
                        Passowrd: newp,
                        UserID: UserID,
                    },
                    success: function(data) {
                        var obj = JSON.parse(data);
                        if (obj.Status == "Success") {
                            ResetDiv("ChangePassword");
                            alertify.success(obj.Message);
                        } else {
                            alertify.error(obj.Message);
                        }
                    },
                    error: function(data) {
                        alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
                    }
                })
            }
        }
    });


    function getUniform(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/user/employee/getUniform/" + PageSize + "/" + CurrentPage,
            data: {
                Status: 1,
                UserID: UserID,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#Uniform .TableBody').html(obj.listing);
                $('#Uniform .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function getRoom(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/user/employee/getRoom/" + PageSize + "/" + CurrentPage,
            data: {
                Status: 1,
                UserID: UserID,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#RoomAllocation .TableBody').html(obj.listing);
                $('#RoomAllocation .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function getTraining(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/user/employee/getTraining/" + PageSize + "/" + CurrentPage,
            data: {
                Status: 1,
                UserID: UserID,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#Training .TableBody').html(obj.listing);
                $('#Training .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function getAttandance(PageSize, CurrentPage) {
        $.ajax({
            type: "post",
            datatype: "JSON",
            url: base_url + "admin/user/employee/getAttandance/" + PageSize + "/" + CurrentPage,
            data: {
                Status: 1,
                UserID: UserID,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#Attendance .TableBody').html(obj.listing);
                $('#Attendance .PaginationDiv').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }
</script>