<?php //pr($data);exit;?>
<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/inspection') ?>"><strong><?php echo label('msg_lbl_inspection')?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" enctype="multipart/form-data"
            action="<?php echo site_url('admin/inspection/add/'.$page_name) ?>">
            <input id="InspectionID" name="InspectionID"
                value="<?php echo isset($data->InspectionID)?$data->InspectionID:0; ?>" type="hidden" />

            <div class="row">
                <div class="input-field col s12 m6">
                    <?=@$sites?>
                </div>
                <div class="input-field col s12 m6">
                    <?=@$FieldOperator?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <?=@$OperationManager?>
                </div>
                <div class="input-field col s12 m6">
                    <?=@$QualityManager?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m12">
                    <?php foreach($Questions as $item) { ?>
                    <?php 
                        $QuestionID = $item->QuestionID;
                        $Question = $item->Question;
                        $Questionoption = explode(',',$item->Questionoption);
                        $Type = $item->Type;
                    ?>
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <p><?=$Question?></p>
                            <div class="row">
                                <?php foreach($Questionoption as $key=>$opt) { ?>
                                <div class="input-field col s6 m2">
                                    <input type="<?=$Type?>" name="<?=$QuestionID?>[]"
                                        id="Que-<?=$QuestionID?>-<?=$key?>" value="<?=$opt?>">
                                    <label for="Que-<?=$QuestionID?>-<?=$key?>">
                                        <span><?=$opt?></span>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="row">
                <?php
                    if (@$data->Image != null && (file_exists(BASEPATH . '../' . USERDOCUMENT_UPLOAD_PATH . @$data->Image))) {
                        $path1 = site_url(USERDOCUMENT_UPLOAD_PATH . $data->Image);
                    } else {
                        $path1 = $path = site_url(DEFAULT_IMAGE);
                    } 
                ?>
                <div class="m-t-20 col s12 m12">
                    <label class="imageview-label"><?php echo label('msg_lbl_image'); ?></label>
                    <div class="row">
                        <div class="input-field m-t-0 col s12 m2 imageview1">
                            <img width="150" id="PhotoURLPreview" src='<?php echo $path1; ?>'>
                            <a id="PhotoURLCross" class="cross1 hide" data-img="PhotoURLPreview" data-file="userfile"
                                data-edit="editProfilePicture"><i id="cal" class="fa fa-times"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="file-field input-fieldcol col s12 m10 m-t-10">
                            <input tabindex="999" class="file-path empty_validation_class" type="text"
                                id="editProfilePicture" name="editProfilePicture"
                                value='<?php echo @$data->Image; ?>' readonly />
                            <div class="btn">
                                <span>File</span>
                                <input accept="image/*" type="file" name="userfile" id="userfile" class="images"
                                    data-cross="PhotoURLCross" data-img="PhotoURLPreview" data-edit="editProfilePicture"
                                    data-type="image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50"
                        data-tooltip="<?php echo label('msg_lbl_please_enter_reason');?>"><i
                            class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <textarea id="Remarks" name="Remarks" type="text"
                        class="materialize-textarea empty_validation_class"><?php echo @$data->Reason; ?></textarea>
                    <label for="Remarks"><?php echo label('msg_lbl_remark')?></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="checkbox" class="" name="Status" id="Status" <?php
                    if (isset($data->Status) && @$data->Status == INACTIVE) {
                        echo "";
                    } else {
                        echo "checked='checked'";
                    }
                    ?>>
                    <label for="Status"><?php echo label('msg_lbl_status');?></label>
                </div>
                <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit"
                        type="button"><?php echo label('msg_lbl_submit');?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/inspection') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>