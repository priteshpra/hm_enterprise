<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/user/employee') ?>"><strong><?php echo label('msg_lbl_title_employee_training') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/user/employee/' . $page_name) ?>">
            <input id="UserID" name="UserID" value="<?php echo isset($UserID) ? $UserID : 0; ?>" type="hidden" />
            <div class="row">

                <div class="input-field col s6 m6">
                    <select id="TrainingDateTimeID" name="TrainingDateTimeID" class="select2_class service_select2" required>
                        <option value="">Select training type</option>
                        <?php foreach ($TrainingDateTime as $item) { ?>
                            <option value="<?= $item->TrainingDateTimeID ?>"><?= $item->Training.' - '.$item->TrainingDate.' - '.$item->TrainingTime ?> </option>
                        <?php } ?>
                    </select>
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
                <div class="input-field col s12 m6 right">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/user/employee') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>