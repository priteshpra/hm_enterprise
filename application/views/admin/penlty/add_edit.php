<?php //pr($users_combo);exit;?>
<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/penlty') ?>"><strong><?php echo label('msg_lbl_penlty')?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/penlty/add') ?>">
            <div id="more_fields" class="row">
                <div class="row">
                    <div class="col s12 m6">
                        <span><?php echo label('msg_lbl_sitesname');?></span><br />
                        <?php echo getSitesComboBox(@$data->SiteID); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12">
                        <span><?php echo label('msg_lbl_reason');?></span><br />
                        <?php foreach($reasons as $item) { ?>
                        <div class="input-field col s6 m3 ">
                            <input type="checkbox" name="Reasons[]" id="<?=$item->ReasonID?>"  value="<?=$item->Reason?>">
                            <label for="<?=$item->ReasonID?>"><?=$item->Reason?></label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 right-align">
                        <div class="clearfix"></div>
                        <a class="btn-floating  waves-effect waves-light green accent-6 modal-trigger" href="#modal1">
                            <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m12">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit"
                        type="button"><?php echo label('msg_lbl_submit');?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/penlty') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Employee</h4>
        <div class="user_row">
            <div class="col m11 s12">
                <div class="row">
                    <div class="input-field col s6">
                        <select class="select2_class" id="AddUser">
                            <option value="" disabled selected>Choose user</option>
                            <?php foreach($users as $item) { ?>
                            <option value="<?=$item->UserID?>"><?=$item->FirstName?> <?=$item->LastName?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-field col s6">
                        <label>Amount</label>
                        <input type="text" value="" id="AddAmount" class="NumberOnly" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="modal-close waves-effect waves-green btn-flat" id="AddRow">Add</a>
    </div>
</div>