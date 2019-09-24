<?php
$staff_info = $this->db->get_where('admin', array('role' => 'staff'))->result_array();
$single_staff_info = $this->db->get_where('admin', array('admin_id' => $param2))->result_array();
foreach ($single_staff_info as $row) {
?>

   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>admin/staff/update/<?=$row['admin_id']; ?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
      <div class="row">
        <label for="field-1" class="col-md-4 control-label">ID:</label>
  			<div class="col-md-8">
  				<b><?=$row['admin_id'];?></b>
  			</div>
      </div>

		</div>

		<div class="form-group">
      <div class="row">
        <label class="control-label col-md-4" for="field-1">Staff-Name</label>

  			<div class="col-md-8">
  				<input type="text" class="form-control" name="staff_name" id="field-1" required value="<?= $row['name']; ?>"/>
  			</div>
      </div>

		</div>
		<div class="form-group">
      <div class="row">
        <label class="control-label col-md-4" for="field-1">Username</label>

  			<div class="col-md-8">
  				<input type="text" class="form-control" name="staff_username" id="field-1" required value="<?= $row['user_name']; ?>"/>
  			</div>
      </div>

		</div>
		<div class="form-group">
      <div class="row">
        <label class="col-md-4 control-label" for="field-ta">Email</label>

  			<div class="col-md-8">
  				<input type="text" class="form-control" name="staff_email" id="e-price" required value="<?=$row["email"] ?>"/>
  			</div>
      </div>

		</div>
	   <div class="form-group">
       <div class="row">
         <label class="col-md-4 control-label" for="field-ta">Password</label>

   			<div class="col-md-8">
   				<input type="text" class="form-control" name="password" id="password" required value="<?=$row["password"] ?>"/>
   			</div>
       </div>

		</div>
	   <div class="form-group">
       <div class="row">
         <label class="col-md-4 control-label" for="field-1">Role</label>
   		   <div class="col-md-8">
   		   <select name="staff_role" id="staff_role" class="form-control" required>
   				<?php foreach ($staff_info as $row2) {
   			   			?>

   					<option value="<?php echo $row2['role']; ?>" <?php if ($row['admin_id'] == $row2['admin_id']) echo 'selected'; ?>>
   						<?=$row2['role'] ?>
   					</option>
   				<?php } ?>
   			</select>
   		   </div>
       </div>

	   </div>

		<div class="form-group">
			<div class="col-md-12n pull-right" style="margin:5px 15px;">
				<button type="submit" class="btn btn-success">
					<span class="fa fa-plus"> Update</span>
				</button>

				<button type="button" class="btn btn-danger" data-dismiss="modal">
					<span class="fa fa-times"></span>Cancel
				</button>
			</div>
		 </div>
	</form>

<?php } ?>
