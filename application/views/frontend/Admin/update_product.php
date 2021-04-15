<?php
$product_info = $this->db->get_where('products', array('id' => $param2))->result_array();
$get_category_array = $this->db->get('category')->result_array();
foreach ($product_info as $row) {
?>
   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>admin/product/update/<?=$row['id']; ?>" method="post" enctype="multipart/form-data">
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
				<label class="control-label col-md-4" for="field-1">Category ID:</label>
				<div class="col-md-8">
					<select name="category_id" id="category_id" class="form-control input-sm" required>
						<option value="" <?php if($get_category_array) { foreach($get_category_array as $value) { ?>>--select--</option>
						<option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option>
						<?php } } else { ?>
							<option>No Category Data Entry Yet</option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<label class="control-label col-md-4" for="field-1">Product Code:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="product_code" id="field-1" required readonly value="<?= $row['product_code']; ?>"/>
				</div>
			</div>
		</div>
		
		<div class="form-group">
		  <div class="row">
			<label class="control-label col-md-4" for="field-1">Product Name:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="product_name" id="field-1" required value="<?= $row['product_name']; ?>"/>
				</div>
		  </div>
		</div>
		
		<div class="form-group">
		  <div class="row">
			<label class="control-label col-md-4" for="field-1">Description:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="description" id="field-1" required value="<?= $row['description']; ?>"/>
				</div>
		  </div>
		</div>
		
		<div class="form-group">
		  <div class="row">
			<label class="col-md-4 control-label" for="field-ta">Quantity In Stock:</label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="quantity_in_stock" id="e-quantity" required value="<?= $row['quantity_in_stock'];?>"/>
			</div>
		  </div>
		</div>
		
		<div class="form-group">
		  <div class="row">
			<label class="col-md-4 control-label" for="field-ta">Unit Price:</label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="unit_price" id="e-price" required value="<?= $row['unit_price'];?>"/>
			</div>
		  </div>
		</div>
		
		<div class="form-group">
		  <div class="row">
			<label class="col-md-4 control-label" for="field-ta">Selling Price:</label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="selling_price" id="e-price" required value="<?= $row['selling_price'];?>"/>
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
