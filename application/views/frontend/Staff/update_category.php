<?php
$single_cat_info = $this->db->get_where('store_category', array('id' => $param2))->result_array();
foreach ($single_cat_info as $row) {
?>

   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>admin/category/update/<?=$row['id']; ?>" method="post" enctype="multipart/form-data">
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
			<label class="control-label col-md-4" for="field-1">Name</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="name" id="field-1" required value="<?= $row['name']; ?>"/>
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
