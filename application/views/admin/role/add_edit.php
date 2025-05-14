<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header"><a href="<?php echo site_url('admin/role'); ?>"><strong>Roles</strong></a></h4>
            <form id="edit_rolemapping_form" method="post" action="<?php echo site_url('admin/role/'.$page_name); ?>">
                <div class="row">
                    <input type="hidden" name="RoleID" id="RoleID" value="<?php echo @$RoleID;?>" />
                    <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_rolename');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="Name" name="Name" type="text"  maxlength="50" class="empty_validation_class LetterOnly" value="<?php echo @$role->RoleName?>"/>
                        <label for="Name"><?php echo label('msg_lbl_rolename');?></label>
                    </div>
                    <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_roledescription');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="Description" name="Description" type="text"  maxlength="200" class="empty_validation_class LetterOnly" value="<?php echo @$role->Description?>"/>
                        <label for="Description"><?php echo label('msg_lbl_roledescription');?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light right" name="button_submit" id="button_submit" type="button">Submit
                                
                            </button>
                        <?php echo $loading_button; ?>
                        <a href="<?php echo site_url('admin/role'); ?>" class="right close-button">Cancel</a>
                    </div>
                </div>
                <div class="col s12 m4 l4 main_div">
                    <?php
                    $web = 0;
                    $mob = 0;

                    foreach ($parent_modules as $parent) {
                        $other_action = "";
                        if($parent->ModuleName == "Dashboard" || $parent->ModuleName == "Reports") {
                            $other_action = "hide";
                        }
                        if($parent->Type== "Web"){
                            $web++;
                        }else{
                            $mob++;
                        }
                        if($web == 1){
                            echo "<h4>Web</h4>";
                        }else if($mob == 1){
                            echo "<h4>Mobile</h4>";
                        }

                        if(@$parent->is_edit == 1){
                            $mchecked = " checked ";
                        }else{
                            $mchecked = "";
                        }
                        if(@$parent->is_view == 1){
                            $m_checked = " checked ";
                        }else{
                            $m_checked = "";
                        }
                        
                        ?>
                        <div class="row">
                            <div class="container master-container">
                                <input <?php echo $m_checked;?> class="filled-in masters" id="<?php echo "master_" . $parent->ModuleID; ?>" name="<?php echo "master_" . $parent->ModuleID; ?>" value="<?php echo "div" . $parent->ModuleID; ?>" type="checkbox">
                                <label style="color:black;font-weight: 500;font-size: 18px;" for="<?php echo "master_" . $parent->ModuleID; ?>"><?php echo $parent->ModuleName; ?></label>
                                <div class="right">
                                    <input  <?php echo $mchecked; ?> class="filled-in check_all_action" id="<?php echo "m_all_" .$parent->ModuleID ; ?>" value="<?php echo "div" . $parent->ModuleID; ?>" type="checkbox" data-master="master_<?php echo $parent->ModuleID;?>" disabled>
                                    <label for="<?php echo "m_all_" .$parent->ModuleID ; ?>">Check All</label>
                                </div>
                            </div>
                            <div style="padding-top:10px"></div>
                            <ul id="<?php echo "div" . $parent->ModuleID; ?>" class="container collection" id="projects-collection" >
                                <?php
                                $j = 0;
                                foreach ($sub_modules as $child) {
                                    if ($parent->ModuleID == $child->ParentID) {
                                        if(@$child->is_view == 1){
                                            $cchecked = " checked ";
                                            $disabled = " disaled='true' ";
                                        }else{
                                            $cchecked = "";
                                            $disabled = "";
                                        }
                                        if(@$child->is_view && @$child->is_insert  && @$child->is_edit && @$child->is_status && @$child->is_export){
                                            $all_chk =  " checked ";
                                        }else{
                                            $all_chk =  "";
                                        }
                                        ?>
                                        <li class="collection-item">
                                            <div class="container submodule-container">
                                                <input <?php echo $cchecked; ?> class="filled-in submodule" name="<?php echo "m_" . $child->ModuleID; ?>" id="<?php echo "m_" . $child->ModuleID; ?>" value="<?php echo $parent->ModuleID; ?>" type="checkbox" data-div="<?php echo "div" . $child->ModuleID; ?>">
                                                <label style="color:black;font-size: 16px;" for="<?php echo "m_" . $child->ModuleID; ?>"><?php echo $child->ModuleName; ?></label>
                                                <div class="right">
                                                    <input class="filled-in check_sub_action all_actions" <?php echo @$all_chk; if(@$child->is_view){echo $disabled;}else{ echo " disabled='true' ";}?> value="<?php echo "m_$child->ModuleID"; ?>" id="<?php echo "m_$child->ModuleID" . "c_all"; ?>" type="checkbox" data-div="<?php echo "div" . $child->ModuleID; ?>">
                                                    <label for="<?php echo "m_$child->ModuleID" . "c_all"; ?>">Check All</label>
                                                </div>
                                            </div>
                                            <div class="row" id="<?php echo "div" . $child->ModuleID; ?>">
                                                <div id="" class="col s10 right">
                                                    <div class="col s2 mobile_devices_sx">
                                                        <input disabled='true' <?php if(@$child->is_view == 1){echo " checked ";}?>name="<?php echo "view" . $child->ModuleID; ?>" class="filled-in insert_actions all_actions" id="<?php echo "m_$child->ModuleID" . "view"; ?>" type="checkbox">
                                                        <label for="<?php echo "m_$child->ModuleID" . "view"; ?>">View</label>
                                                    </div>
                                                    <?php 
                                                    if($other_action == ""){
                                                    ?>
                                                    <div class="col s2 mobile_devices_sx">
                                                        <input <?php if(@$child->is_insert == 1){echo " checked ";} if(@$child->is_view){echo $disabled;}else{ echo " disabled='true' ";}?> name="<?php echo "insert" . $child->ModuleID; ?>" class="filled-in module_actions all_actions" id="<?php echo "m_$child->ModuleID" . "insert"; ?>" type="checkbox">
                                                        <label for="<?php echo "m_$child->ModuleID" . "insert"; ?>">Insert</label>
                                                    </div>
                                                    <div class="col s2 mobile_devices_sx">
                                                        <input <?php if(@$child->is_edit == 1){echo " checked ";} if(@$child->is_view){echo $disabled;}else{ echo " disabled='true' ";}?> name="<?php echo "edit" . $child->ModuleID; ?>" class="filled-in module_actions all_actions" id="<?php echo "m_$child->ModuleID" . "edit"; ?>" type="checkbox">
                                                        <label for="<?php echo "m_$child->ModuleID" . "edit"; ?>">Edit</label>
                                                    </div>
                                                    <div class="col s2 mobile_devices_sx">
                                                        <input <?php if(@$child->is_status == 1){echo " checked ";} if(@$child->is_view){echo $disabled;}else{ echo " disabled='true' ";}?> name="<?php echo "status" . $child->ModuleID; ?>" class="filled-in module_actions all_actions" id="<?php echo "m_$child->ModuleID" . "status"; ?>" type="checkbox">
                                                        <label for="<?php echo "m_$child->ModuleID" . "status"; ?>">Status</label>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="col s2 mobile_devices_sx">
                                                        <input <?php if(@$child->is_export == 1){echo " checked ";} if(@$child->is_view){echo $disabled;}else{ echo " disabled='true' ";}?> name="<?php echo "export" . $child->ModuleID; ?>" class="filled-in module_actions all_actions" id="<?php echo "m_$child->ModuleID" . "export"; ?>" type="checkbox">
                                                        <label for="<?php echo "m_$child->ModuleID" . "export"; ?>">Export</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                        $j++;
                                    }
                                }
                                echo "<input type='hidden' name='cnt_$parent->ModuleID' value='$j'>"
                                ?>
                            </ul>
                        </div>
                        <?php
                        echo "<div style='padding-top:30px;'></div>";
                    }
                    ?>
                </div>
                
            </form>
        </div>
    </div>
</div>