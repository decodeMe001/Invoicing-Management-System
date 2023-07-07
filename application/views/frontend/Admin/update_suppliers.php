<?php
$_info = $this->db->get_where('suppliers', array('supplierID' => $param2))->result_array();
foreach ($_info as $row) {
?>

   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>admin/suppliers/update/<?=$row['supplierID']; ?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="row">
				<label for="field-1" class="col-md-4 control-label">ID:</label>
				<div class="col-md-8">
					<b><?=$row['supplierID'];?></b>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="company">Company:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="companyName" id="company" disabled value="<?= $row['companyName']; ?>"/>
				</div>
			</div>
		</div>
        <div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="purchase">Purchase Amount:</label>
				<div class="col-md-8">
					<input type="number" class="form-control" name="purchase_amount" id="purchase" required value="<?= $row['purchase_amount']; ?>"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="balance">Balance Amount:</label>
				<div class="col-md-8">
					<input type="number" class="form-control" name="balance" id="purchase" required value="<?= $row['balance']; ?>"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="discount">Discount Amount:</label>
				<div class="col-md-8">
					<input type="number" class="form-control" name="discount" id="purchase" required value="<?= $row['discount']; ?>"/>
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
