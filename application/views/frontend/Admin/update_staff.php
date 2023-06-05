<?php
$staff_info = $this->db->get_where('admin', array('role' => 'staff'))->result_array();
$single_staff_info = $this->db->get_where('admin', array('admin_id' => $param2))->result_array();
foreach ($single_staff_info as $row) {
?>
<<<<<<< HEAD
   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>admin/staff/update/<?=$row['admin_id']; ?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="row">
				<label for="field-1" class="col-md-4 control-label">ID:</label>
					<div class="col-md-8">
						<b><?=$row['admin_id'];?></b>
					</div>
=======

   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>admin/profile/update/<?=$row['admin_id']; ?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="row">
			<label for="field-1" class="col-md-4 control-label">ID:</label>
				<div class="col-md-8">
					<b><?=$row['admin_id'];?></b>
				</div>
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
			</div>
		</div>
		<div class="form-group">
			<div class="row">
<<<<<<< HEAD
				<label class="control-label col-md-4" for="field-1">Staff-Name</label>
=======
			<label class="control-label col-md-4" for="field-1">Staff-Name</label>
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
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
				<option value="<?=$row['role']; ?>"><?=$row['role'] ?></option>
				<option value="staff">staff</option>
				<option value="manager">manager</option>
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
