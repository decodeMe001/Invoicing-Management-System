<?php
<<<<<<< HEAD
$category_data = $this->db->get('store_category ')->result_array();
$get_product_data = $this->db->get_where('store_product', array('id' => $param2))->result_array();
foreach ($get_product_data as $row) {
	$get_category_data = $this->db->get_where('store_category', array('id' => $row["dosage_form_id"]))->result_array();
?>

   <form role="form" class="product-form" action="<?= base_url(); ?>admin/product/update/<?=$row['id']; ?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="row">
				<label class="control-label col-md-4" for="field-1">Title:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="title" id="field-1" required value="<?= $row['title']; ?>"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="control-label col-md-4" for="field-1">Brand:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="brand_name" id="field-1" required value="<?= $row['brand_name']; ?>"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="control-label col-md-4" for="field-1">Pharm Class:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="pharmacological_class" id="field-1" required value="<?= $row['pharmacological_class']; ?>"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="control-label col-md-4" for="field-1">Qty in stock:</label>
				<div class="col-md-8">
					<input type="number" class="form-control" name="qty_in_stock" id="field-1" required value="<?= $row['qty_in_stock']; ?>"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="control-label col-md-4" for="field-1">Market Price:</label>
				<div class="col-md-8">
					<input type="number" class="form-control" name="market_price" id="field-1" required value="<?= $row['market_price']; ?>"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="control-label col-md-4" for="field-1">Selling Price:</label>
				<div class="col-md-8">
					<input type="number" class="form-control" name="selling_price" id="field-1" required value="<?= $row['selling_price']; ?>"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="control-label col-md-4" for="field-1">Entry Date:</label>
				<div class="col-md-8">
					<span class="form-control"><?= $row['entry_date']; ?></span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="control-label col-md-4" for="field-1">Expiry Date:</label>
				<div class="col-md-8">
					<input type="date" class="form-control" name="expiry_date" id="field-1" required value="<?= $row['expiry_date']; ?>"/>
				</div>
			</div>
		</div>
	   <div class="form-group">
		   <div class="row">
			 <label class="col-md-4 control-label" for="field-1">Form:</label>
			  <div class="col-md-8">
				<select name="dosage_form_id" id="dosage_form_id" class="form-control" required>
				 <?php foreach ($get_category_data as $row2) {?>
					<option value="<?php echo $row2['id']; ?>">
						 <?=$row2['name'] ?>
					</option>
				 <?php } ?>
				 <?php foreach ($category_data as $row2) {?>
					<option value="<?php echo $row2['id']; ?>">
						 <?=$row2['name'] ?>
					</option>
				 <?php } ?>
			   </select>
			  </div>
		   </div>
	   </div>
=======
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

>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3

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
