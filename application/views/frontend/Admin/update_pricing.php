<?php
$single_pricing_info = $this->db->get_where('pricing_rate_item', array('rate_id' => $param2))->result_array();
foreach ($single_pricing_info as $row) {
?>

   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>admin/pricing/update/<?=$row['rate_id']; ?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
      <div class="row">
        <label for="field-1" class="col-md-4 control-label">ID:</label>
  			<div class="col-md-8">
  				<b><?=$row['rate_id'];?></b>
  			</div>
      </div>

		</div>

		<div class="form-group">
      <div class="row">
        <label class="control-label col-md-4" for="field-1">Photo-Type</label>
  			<div class="col-md-8">
  				<input type="text" class="form-control" name="photo_type" id="field-1" required value="<?= $row['photo_type']; ?>"/>
  			</div>
      </div>

		</div>
		<div class="form-group">
      <div class="row">
        <label class="control-label col-md-4" for="field-1">Photo-Size</label>

  			<div class="col-md-8">
  				<input type="text" class="form-control" name="photo_size" id="field-1" required value="<?= $row['photo_size']; ?>"/>
  			</div>
      </div>

		</div>
		<div class="form-group">
      <div class="row">
        <label class="col-md-4 control-label" for="field-ta">Unit-Price:</label>

  			<div class="col-md-8">
  				<input type="text" class="form-control" name="unit_price" id="e-price" required value="<?= $row['unit_price'];?>"/>
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
