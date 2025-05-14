<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/salary') ?>"><strong><?php echo label('msg_lbl_salary') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/salary/' . $page_name) ?>">
            <div class="row">
                <div class="input-field col s12 m12">
                    <b>User</b>
                    <div class="row">
                        <div class="input-field col s12 m3">
                            <?php echo @$users; ?>
                        </div>
                        <div class="input-field col s12 m3">
                            <input type="text" name="StartDate" id="StartDate" value="<?= date('01-m-Y') ?>" maxlength="20" class="form-control datepicker empty_validation_class">
                            <label name="StartDate" class=""><?php echo label('msg_lbl_startdate'); ?></label>
                        </div>
                        <div class="input-field col s12 m3">
                            <input type="text" name="EndDate" id="EndDate" value="<?= date('d-m-Y') ?>" maxlength="20" class="form-control datepicker empty_validation_class">
                            <label name="EndDate" class=""><?php echo label('msg_lbl_enddate'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="input-field col s12 m12">
                    <b><?php echo label('msg_lbl_salary'); ?></b>
                    <div class="row">
                        <div class="input-field col s12 m2">
                            <input type="text" name="Salary" id="Salary" class="NumberOnly empty_validation_class" value="" maxlength="20" readOnly>
                            <label for="Salary" class=""><?php echo label('msg_lbl_paymentamount'); ?></label>
                        </div>
                        <div class="input-field col s12 m2">
                            <input type="text" name="Rate" id="PerDaySalary" class="NumberOnly" value="" maxlength="20" readOnly>
                            <label for="PerDaySalary" class=""><?php echo label('msg_lbl_salaryperday'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="input-field col s12 m12">
                    <b><?php echo label('msg_lbl_attendance'); ?></b>
                    <div class="row">
                        <div class="input-field col s12 m2">
                            <input type="text" name="Present" id="PresentCount" class="NumberOnly empty_validation_class" value="" maxlength="20" readOnly>
                            <label for="PresentCount" class="" required><?php echo label('msg_lbl_presentcount'); ?></label>
                        </div>
                        <div class="input-field col s12 m2">
                            <input type="text" name="Absent" id="AbsentCount" class="NumberOnly empty_validation_class" value="" maxlength="20" readOnly>
                            <label for="AbsentCount" class="" required><?php echo label('msg_lbl_absentcount'); ?></label>
                        </div>
                        <div class="input-field col s12 m2">
                            <input type="text" name="HalfDay" id="HalfdayCount" class="NumberOnly empty_validation_class" value="" maxlength="20" readOnly>
                            <label for="HalfdayCount" class="" required><?php echo label('msg_lbl_halfleavecount'); ?></label>
                        </div>
                        <div class="input-field col s12 m2">
                            <input type="text" name="HalfOverTime" id="HalfdayOvertime" class="NumberOnly empty_validation_class" value="" maxlength="20" readOnly>
                            <label for="HalfdayOvertime" class="" required><?php echo label('msg_lbl_halfovertimecount'); ?></label>
                        </div>
                        <div class="input-field col s12 m2">
                            <input type="text" name="FullOverTime" id="FulldayOvertime" class="NumberOnly empty_validation_class" value="" maxlength="20" readOnly>
                            <label for="FulldayOvertime" class="" required><?php echo label('msg_lbl_fullovertimecount'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="input-field col s12 m12">
                    <b>Payment</b>
                    <div class="row total">
                        <div class="input-field col s12 m2 ">
                            <input type="text" name="PayAmount" id="PayAmount" class="NumberOnly empty_validation_class" value="" maxlength="20">
                            <label for="PayAmount" class="" required><?php echo label('msg_lbl_payamount'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="input-field col s12 m12">
                    <b>Advance</b>
                    <div class="row total">
                        <div class="input-field col s12 m12 ">
                        </div>
                        <div class="input-field col s12 m1 ">
                            <input type="radio" name="Advance" id="Advance_Receive" class="empty_validation_class" value="Received">
                            <label for="Advance_Receive" required><?php echo label('msg_lbl_received'); ?></label>
                        </div>
                        <div class="input-field col s12 m1 ">
                            <input type="radio" name="Advance" id="Advance_Paid" class="empty_validation_class" value="Paid">
                            <label for="Advance_Paid" required><?php echo label('msg_lbl_paid'); ?></label>
                        </div>
                        <div class="input-field col s12 m1 ">
                            <input type="radio" name="Advance" id="Advance_None" class="empty_validation_class" value="None" checked>
                            <label for="Advance_None" required><?php echo label('msg_lbl_none'); ?></label>
                        </div>
                        <div class="input-field col s12 m2 ">
                            <input type="text" name="AdvanceAmount" id="AdvanceAmount" class="NumberOnly empty_validation_class" value="" maxlength="20">
                            <label for="AdvanceAmount" class="" required><?php echo label('msg_lbl_advance'); ?></label>
                            <b><span>Advance Amount: Rs.<span id="AdvanceAmountLabel"></span><span></b>
                        </div>
                    </div>
                </div>
                <div class="input-field col s12 m12">
                    <b>Penalty</b>
                    <div class="row total">
                        <div class="input-field col s12 m2 ">
                            <input type="text" name="Penalty" id="Penalty" class="NumberOnly empty_validation_class" value="" maxlength="20">
                            <label for="Penalty" class="" required><?php echo label('msg_lbl_penalty'); ?></label>
                            <span>Penalty Amount: Rs.<span id="PenaltyAmountLabel"></span><span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                if (isset($data->Status) && @$data->Status == INACTIVE) {
                                                                                    echo "";
                                                                                } else {
                                                                                    echo "checked='checked'";
                                                                                }
                                                                                ?>>
                    <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/salary') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>