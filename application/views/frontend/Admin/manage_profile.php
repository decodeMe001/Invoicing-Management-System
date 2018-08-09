<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $page_title;?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo 'Edit Profile';?>
                </div>
            </div>
            <div class="panel-body">
                <?php 
                foreach($edit_data as $row):
                    ?>
                    <?php echo form_open(base_url().'admin/profile/update_profile_info' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo 'Username';?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" value="<?php echo $row['user_name'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo 'Access Role';?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="role" value="<?php echo $row['role'];?>" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-3 col-sm-5">
                              <button type="submit" class="btn btn-info"><?php echo 'Update Profile';?></button>
                          </div>
                        </div>
                    <?php echo form_close();?>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
	

<!--password-->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo 'Change Password';?>
                </div>
            </div>
            <div class="panel-body">
					<?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url().'admin/profile/change_password' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo 'Current Password';?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo 'New Password';?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo 'Confirm New Password';?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo 'Update Password';?></button>
                              </div>
							</div>
                        <?php echo form_close();?>
						<?php
                    endforeach;
                    ?>
            </div>
        </div>
    </div>
</div>