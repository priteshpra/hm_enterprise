<?php //pr($data);exit;?>
<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/question') ?>"><strong><?php echo label('msg_lbl_title_question')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/question/'.$page_name) ?>">
            <input id="QuestionID" name="QuestionID" value="<?php echo isset($data->QuestionID)?$data->QuestionID:0; ?>" type="hidden"  />
            <div class="row">
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_question');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input type="text" id="Question" name="Question" class=" empty_validation_class" value="<?php echo @$data->Question; ?>" />
                    <label for="Question"><?php echo label('msg_lbl_question')?></label>
                </div>
            </div>
            <div class="row">
                <div class=" col s12 m12">
                    <span><?php echo label('msg_lbl_answer_type')?> : </span>
                    <input type="radio" name="Type" class=" empty_validation_class" id="TypeRadio" value="Radio" checked="checked"/>
                    <label for="TypeRadio"><?php echo label('msg_lbl_radio')?></label>
                    <input type="radio" name="Type" class=" empty_validation_class" id="TypeCheckbox" value="Checkbox" />
                    <label for="TypeCheckbox"><?php echo label('msg_lbl_checkbox')?></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m12">
                <?php if(isset($data->Questionoption)) { ?>
                    <?php 
                        $ansers = explode(',',$data->Questionoption);
                        $count = 0;
                    ?>
                    <div class="row">
                        <div class="col s1 m1 offset-m11 offset-m11 center-align">
                            <a class="btn-floating  waves-effect waves-light green accent-6 add_question" href="#">
                                <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                            </a>
                        </div>
                    </div>
                    <?php foreach($ansers as $item) { ?>
                        <?php if($count == 0) { ?>
                            <div class="option_one">
                        <?php } else if($count == 1) { ?>
                            </div>
                            <div class="more_options">
                        <?php } ?> 
                            <div class="row">
                                <div class="input-field col s11 m11">
                                    <input type="text" name="Questionoption[]" class=" empty_validation_class" value="<?php echo $item; ?>" />
                                    <label><?php echo label('msg_lbl_answer')?></label>
                                </div>
                                <div class="input-field col s1 m1 center-align">
                                    <a class="btn-floating  waves-effect waves-light red accent-6 remove_question" href="#">
                                        <i class="mdi-content-remove tooltipped" data-position="top" data-delay="50" data-tooltip="Remove"></i>
                                    </a>
                                </div>
                            </div>
                        <?php $count++; ?>
                    <?php } ?>
                    <?php if($count == 1) { ?>
                        <div class="more_options"></div>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <?php } else {?>
            <div class="row">
                <div class="input-field col s12 m12">
                    <div class="option_one">
                        <div class="row">
                            <div class="input-field col s11 m11 right-align">
                                <input type="text" name="Questionoption[]" class=" empty_validation_class" value="<?php echo @$data->Question; ?>" />
                                <label><?php echo label('msg_lbl_answer')?></label>
                            </div>
                            <div class="input-field col s1 m1">
                                <a class="btn-floating  waves-effect waves-light green accent-6 add_question" href="#">
                                    <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                                </a>
                                <a class="btn-floating  waves-effect waves-light red accent-6 remove_question" href="#">
                                    <i class="mdi-content-remove tooltipped" data-position="top" data-delay="50" data-tooltip="Remove"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="more_options">
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="checkbox" class=""  name="Status" id="Status"   
                    <?php
                    if (isset($data->Status) && @$data->Status == INACTIVE) {
                        echo "";
                    } else {
                        echo "checked='checked'";
                    }
                    ?>>
                    <label for="Status"><?php echo label('msg_lbl_status');?></label>     
                </div>
                <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit');?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/masters/question') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
