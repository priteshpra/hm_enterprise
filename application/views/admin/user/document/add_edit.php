<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/user/customer/details/' . $data->CustomerID . '#Document' ) ?>"><strong><?php echo label('msg_lbl_document') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/user/document/' . $page_name) ?>" enctype="multipart/form-data">
            
            <input id="SitesID" name="SitesID" value="<?php echo isset($data->SitesID) ? $data->SitesID : 0; ?>" type="hidden" />
            <input id="CustomerID" name="CustomerID" value="<?php echo isset($data->CustomerID) ? $data->CustomerID : 0; ?>" type="hidden" />
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="Title" name="Title" type="text" class="empty_validation_class" value="<?php echo @$data->Title; ?>" maxlength="100" />
                    <label for="Title"><?php echo label('msg_lbl_document') ?></label>
                </div>
                
            <div class="row">
                <?php
                    if (@$data->Document != null && (file_exists(BASEPATH . '../' . DOCUMENT_UPLOAD_PATH . @$data->Document))) {
                        $ext = substr(@$data->Document, strrpos(@$data->Document, '.')+1);
                        if($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'ppt') {
                            $path1 = $path = site_url(DEFAULT_IMAGE);
                        } else {
                            $path1 = site_url(DOCUMENT_UPLOAD_PATH . $data->Document);
                        }
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
                                value='<?php echo @$data->Document; ?>' readonly />
                            <div class="btn">
                                <span>File</span>
                                <input accept=".jpg,.jpeg,.png,.ppt,.doc,.docx,.xls,.xlsx,.pdf" type="file" name="userfile" id="userfile" class="imagesdocs"
                                    data-cross="PhotoURLCross" data-img="PhotoURLPreview" data-edit="editProfilePicture"
                                    data-type="image" />
                            </div>
                        </div>
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
                <div class="input-field col s12 m6 right">
                    <button class="btn waves-effect waves-light right button_submit" id="button_submit" name="button_submit" type="button" data-val="Submit"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/user/customer/details/' . $data->CustomerID . '#Document') ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>