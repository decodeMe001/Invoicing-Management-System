<?php
$staff_data = $this->db->get('admin ')->result_array();
$get_expense_data = $this->db->get_where('expenses', array('id' => $param2))->result_array();
foreach ($get_expense_data as $row) {
$get_staff_data = $this->db->get_where('admin', array('name' => $row["staff"]))->result_array();
?>

   <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>admin/expenses/update/<?=$row['id']; ?>" method="post" enctype="multipart/form-data">
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
			 <label class="col-md-4 control-label" for="field-1">Staff:</label>
			  <div class="col-md-8">
				<select name="staff" id="staff" class="form-control" required>
				 <?php foreach ($get_staff_data as $row2) {?>
					<option value="<?php echo $row2['name']; ?>">
						 <?=$row2['name'] ?>
					</option>
				 <?php } ?>
				 <?php foreach ($staff_data as $row2) {?>
					<option value="<?php echo $row2['name']; ?>">
						 <?=$row2['name'] ?>
					</option>
				 <?php } ?>
			   </select>
			  </div>
		   </div>
	   </div>
		<div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="field-1">Category:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="category" id="field-1" required value="<?=$row['category']; ?>"/>
				</div>
			</div>
		</div>
        <div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="field-1">Details:</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="details" id="field-1" required value="<?=$row['details']; ?>"/>
				</div>
			</div>
		</div>
        <div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="field-1">Amaount:</label>
				<div class="col-md-8">
					<input type="number" class="form-control" name="amount" id="field-1" required value="<?=$row['amount']; ?>"/>
				</div>
			</div>
		</div>
        <div class="form-group">
			<div class="row">
			<label class="control-label col-md-4" for="field-1">Expens Date:</label>
				<div class="col-md-8">
					<input type="date" class="form-control" name="expense_date" id="field-1" required value="<?=$row['expense_date']; ?>"/>
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
