<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/rolemapping/index/'.$RoleID) ?>"><strong><?php echo label('msg_lbl_rolemapping')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/rolemapping/'.$page_name) ?>">
            <div class="row">
                <input type="hidden" name="RoleID" id="RoleID" value="<?php echo $RoleID;?>" />
                <div class="input-field col s6">
                    <?php echo $User; ?>
                </div>   
                <div class="clearfix"></div>
                <div class="input-field col s12 m6 right">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit');?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/rolemapping/index/'.$RoleID) ?>" class="clear-all right">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
