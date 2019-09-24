<?php
$single_customer_info = $this->db->get_where('record_debt', array('id' => $param2))->result_array();
foreach ($single_customer_info as $row) {
  ?>
   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>admin/customer_record_debt/update/<?=$row['id']; ?>" method="post" enctype="multipart/form-data">
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
        <label class="control-label col-md-4" for="field-1">Customer-Name</label>
  			<div class="col-md-8">
  				<input type="text" class="form-control" name="customer_name" id="field-1" required value="<?= $row['customer_name']; ?>"/>
  			</div>
      </div>

		</div>
		<div class="form-group">
      <div class="row">
        <label class="control-label col-md-4" for="field-1">Paid</label>
  			<div class="col-md-8">
  				<input type="text" class="form-control" name="paid" id="field-1" required value="<?= $row['amount_paid']; ?>"/>
  			</div>
      </div>

		</div>
		<div class="form-group">
      <div class="row">
        <label class="col-md-4 control-label" for="field-ta">Balance</label>
  			<div class="col-md-8">
  				<input type="text" class="form-control" name="balance" id="e-balance" required value="<?=$row["balance"] ?>"/>
  			</div>
      </div>

		</div>

		<div class="form-group">
			<div class="col-md-12n pull-right" style="margin:5px 15px;">
				<button type="submit" class="btn btn-success">
					<span class="fa fa-plus"> Update</span>
				</button>

				<button type="button" class="btn btn-danger" data-dismiss="modal">
					<span class="fa fa-times"></span> Cancel
				</button>
			</div>
		 </div>
	</form>

<?php } ?>

<script type="text/javascript">
//Delete Content
$(document).on('click', '.delete-debt', function(){
    var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
   window.location.href = base_url("admin/customer_record_debt");
   }
   else
   {
   return false;
   }
  });

//Edit Modal for debt
$(document).on('click', '.edit-debt', function() {
    $('.modal-title').text('Update Customer Debt Record');
    $('.form-horizontal').show();
});
</script>
