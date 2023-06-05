<?php
$supplier_info = $this->db->get_where('supplier', array('id' => $param2))->result_array();
foreach ($supplier_info as $row) {
?>

   <form class="form-horizontal" action="<?=base_url(); ?>admin/supplier/update/<?=$row['id']; ?>" method="post">
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
        <label class="control-label col-md-4" for="field-1">Name:</label>

  			<div class="col-md-8">
  				<input type="text" class="form-control" name="name" id="field-1" required value="<?= $row['name']; ?>"/>
  			</div>
      </div>

		</div>
		<div class="form-group">
      <div class="row">
        <label class="control-label col-md-4" for="field-1">Phone</label>

  			<div class="col-md-8">
  				<input type="text" class="form-control" name="phone" id="field-1" required value="<?= $row['phone']; ?>"/>
  			</div>
      </div>

		</div>
		<div class="form-group">
      <div class="row">
        <label class="col-md-4 control-label" for="field-ta">Product</label>

  			<div class="col-md-8">
  				<input type="text" class="form-control" name="product" id="e-price" required value="<?=$row["product"] ?>"/>
  			</div>
      </div>

		</div>
	   <div class="form-group">
		   <div class="row">
			 <label class="col-md-4 control-label" for="field-ta">Total</label>

				<div class="col-md-8">
					<input type="text" class="form-control" name="total" required value="<?=$row["total"] ?>"/>
				</div>
		   </div>
		</div>
		<div class="form-group">
		   <div class="row">
			 <label class="col-md-4 control-label" for="field-ta">VAT</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="vat" required value="<?=$row["vat"] ?>"/>
				</div>
		   </div>
		</div>
	   <div class="form-group">
			<div class="row">
			 <label class="col-md-4 control-label" for="field-ta">Cash Paid</label>

				<div class="col-md-8">
					<input type="text" class="form-control" name="amount_paid" required value="<?=$row["amount_paid"] ?>"/>
				</div>
		   </div>
	   </div>
	   
	   <div class="form-group">
			<div class="row">
			 <label class="col-md-4 control-label" for="field-ta">Date</label>

				<div class="col-md-8">
					<input type="text" name="payment_date" id="payment_date" data-provide="datepicker" value="<?php $date = new DateTime('today'); $date->modify('0 day'); echo $date->format("Y-m-d");?>" class="form-control input-sm"/>
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
