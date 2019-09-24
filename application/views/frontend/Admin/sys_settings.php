<?php $company_list = $this->db->get('settings')->result_array(); ?>
<?php
echo form_open(base_url() . 'admin/settings/do_update',
                array('method' => 'post', 'class' => 'form-horizontal form-groups-bordered validate', 'id' => 'submit_form', 'target' => '_top', 'enctype' => 'multipart/form-data'));
?>
<div class="row">
	<div class="col-md-12" style="margin-top:15px; font-size:16px;">
		<?php
                $success_msg = $this->session->flashdata('success_msg');
                $error_msg  = $this->session->flashdata('error_msg');
                if($success_msg){
                    echo $success_msg;
                }
            ?>
	</div>
</div>
<div class="row animated slideInDown">
	<div class="col-md-12">
		<h2 class="page-header"><?php echo $page_title;?></h2>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row animated slideInUp">
    <div class="col-md-12">
        <div class="card mb-3" >
            <div class="card-header">
                <div class="panel-title">
                    <?php echo 'System Settings'; ?>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo 'System Name'; ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="system_name"
                               value="<?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo 'System Title'; ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="system_title"
                               value="<?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo 'Address'; ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="address"
                               value="<?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo 'Phone'; ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone"
                               value="<?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo 'System Email'; ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="system_email"
                               value="<?php echo $this->db->get_where('settings', array('type' => 'system_email'))->row()->description; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo 'Language'; ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="language"
                               value="<?php echo $this->db->get_where('settings', array('type' => 'language'))->row()->description; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo 'Company'; ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="company"
                               value="<?php echo $this->db->get_where('settings', array('type' => 'company'))->row()->description; ?>">
                    </div>
                </div>

				<!--<div class="form-group">
                    <label  class="col-sm-3 control-label"></label>
                    <div class="col-sm-5">
                        <form id="file_upload" action="#" method="get" enctype="multipart/form-data">
							<p><input type="file" name="logo"/></p>

						</form>
                    </div>
                </div>-->

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-success btn-lg"><?php echo 'Save'; ?></button>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<?php echo form_close();?>
