<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/trainingdatetime') ?>"><strong><?php echo label('msg_lbl_trainingdatetime') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/trainingdatetime/' . $page_name) ?>">
            <input id="TrainingDateTimeID" name="TrainingDateTimeID" value="<?php echo isset($data->TrainingDateTimeID) ? $data->TrainingDateTimeID : 0; ?>" type="hidden" />
            <div class="row">

                <div class="input-field col s12 m6">
                    <input type="text" name="TrainingDate" id="TrainingDate" class="form-control empty_validation_class datepicker" value="<?php echo @$data->TrainingDate; ?>">
                    <label name="TrainingDate" class=""><?php echo label('msg_lbl_trainingdate'); ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="TrainingTime" id="TrainingTime" class="form-control empty_validation_class timepicker" value="<?php echo @$data->TrainingTime; ?>">
                    <label name="TrainingTime" class=""><?php echo label('msg_lbl_trainingtime'); ?></label>
                </div>

                <div class="input-field col s12 m6">
                    <select name="TrainingID" id="TrainingID" class="select2_class">
                        <option value="" selected disabled>Choose your option</option>
                        <?php foreach ($Trainings as $item) { ?>
                            <option value="<?= $item->TrainingID ?>" <?= $item->TrainingID == @$data->TrainingID ? 'selected' : '' ?>><?= $item->Training ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-field col s12 m4 hide">
                    <?php echo @$Country; ?>
                </div>
                <div class="input-field col s12 m4 hide">
                    <?php echo @$State; ?>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$City; ?>
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
                    <a href="<?php echo site_url('admin/masters/trainingdatetime') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>