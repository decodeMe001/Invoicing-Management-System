<?php
$vendor_info = $this->db->get_where('vendor', array('id' => $param2))->result_array();
foreach ($vendor_info as $row) {
?>

   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>staff/vendor/update/<?=$row['id']; ?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
      <div class="row">
        <label for="field-1" class="col-md-4 control-label">ID:</label>
  			<div class="col-md-8">
  				<b><?=$row['id'];?></b>
  			</div>
      </div>

		</div>

		<div class="form-group">
      <div class="row">
        <label class="control-label col-md-4" for="field-1">Vendor-Name:</label>

  			<div class="col-md-8">
  				<input type="text" class="form-control" name="name" id="field-1" required value="<?= $row['name']; ?>"/>
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
      <div class="row">
        <label class="col-md-4 control-label" for="field-ta">Debt:</label>

  			<div class="col-md-8">
  				<input type="text" class="form-control" name="debt" id="e-price" required value="<?=$row["debt"] ?>"/>
  			</div>
      </div>

		</div>
	   <div class="form-group">
		   <div class="row">
			 <label class="col-md-4 control-label" for="field-ta">Credit Limit:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="credit_limit" required value="<?=$row["credit_limit"] ?>"/>
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
