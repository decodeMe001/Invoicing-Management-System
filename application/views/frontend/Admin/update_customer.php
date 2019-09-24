<?php
$customer_info = $this->db->get('customers ')->result_array();
$single_customer_info = $this->db->get_where('customers', array('id' => $param2))->result_array();
foreach ($single_customer_info as $row) {
?>

   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>admin/customer/update/<?=$row['id']; ?>" method="post" enctype="multipart/form-data">
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
  				<input type="text" class="form-control" name="customer_name" id="field-1" required value="<?= $row['customer_name']; ?>"/>
  			</div>
      </div>

		</div>
		<div class="form-group">
      <div class="row">
        <label class="control-label col-md-4" for="field-1">Address</label>

  			<div class="col-md-8">
  				<input type="text" class="form-control" name="customer_address" id="field-1" required value="<?= $row['address']; ?>"/>
  			</div>
      </div>

		</div>
		<div class="form-group">
      <div class="row">
        <label class="col-md-4 control-label" for="field-ta">Phone</label>

        <div class="col-md-8">
          <input type="text" class="form-control" name="customer_phone" id="e-price" required value="<?=$row["phone"] ?>"/>
        </div>
      </div>

		</div>
	   <div class="form-group">
       <div class="row">
         <label class="col-md-4 control-label" for="field-1">Status</label>
          <div class="col-md-8">
            <select name="status" id="status" class="form-control" required>
             <?php foreach ($customer_info as $row2) {
                   ?>

               <option value="<?php echo $row2['status']; ?>" <?php if ($row['id'] == $row2['id']) echo 'selected'; ?>>
                 <?=$row2['status'] ?>
               </option>
             <?php } ?>
              <option value="New">New</option>
              <option value="Regular">Regular</option>
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
