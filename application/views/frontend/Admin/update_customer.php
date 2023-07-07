<?php
$_info = $this->db->get_where('customers', array('customerID' => $param2))->result_array();
foreach ($_info as $row) {
?>

   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>admin/customers/update/<?=$row['customerID']; ?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="row">
				<label for="field-1" class="col-md-4 control-label">ID:</label>
				<div class="col-md-8">
					<b><?=$row['customerID'];?></b>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="field-1">Company:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="company" id="field-1" required value="<?= $row['companyName']; ?>"/>
				</div>
			</div>
		</div>
        <div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="field-1">Address:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="address" id="field-1" required value="<?= $row['address']; ?>"/>
				</div>
			</div>
		</div>
        <div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="field-1">City:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="city" id="field-1" required value="<?= $row['city']; ?>"/>
				</div>
			</div>
		</div>
        <div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="field-1">Phone:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="phone" id="field-1" required value="<?= $row['phone']; ?>"/>
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
