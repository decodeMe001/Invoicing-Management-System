<div class="row">
	<div class="col-md-12" style="margin-top:15px; font-size:16px;">
		<?php
        $success_msg = $this->session->flashdata('success_msg');
        $error_msg  = $this->session->flashdata('error_msg');
        if($success_msg){
            echo $success_msg;
        }
    ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?=$page_title;?></h2>
	</div>	
</div>
<div class="container-fluid">
	<h4 align="center" class="animated fadeInDown">Sales & Inventory App [Expenses]</h4><br/>	 
	<div align="right">
		<a href="#" data-toggle="modal" data-target="#create" class="create-product btn btn-info btn-md">CREATE</a><br/>
	</div>
	<br/>
	<table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
			<tr>
                <th width="5%">Sr.No.</th>
				<th width="15%">Staff</th>
				<th width="10%">Category</th>
				<th width="20%">Details</th>
				<th width="8%">Amount</th>
				<th width="5%">Date</th>
                <th>Show</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
        </thead>
		<tbody>
        <?php		
			if($total_rows > 0)
			{ 
				$no=1;
				foreach ($expense_data as $row) { ?>
				<tr>
					<td><?=$no++?></td>
					<td><?=$row["staff"]?></td>
					<td><?=$row["category"] ?></td>
					<td><?=$row["details"]?></td>
					<td>&#8358;<?=number_format($row["amount"], 2, '.', ',');?></td>
					<td><?=$row["expense_date"]?></td>
					<td class="text-center">
						<a href="#" class="show-expenses btn btn-info btn-sm"
							data-id="<?=$row['id']?>"
							data-staff="<?=$row['staff']?>"
							data-category="<?=$row['category']?>"
							data-details="<?=$row['details']?>"
							data-amount="&#8358;<?=number_format($row["amount"], 2, '.', ',');?>"
							data-created_at="<?=$row['created_at']?>">
							<i class="fa fa-eye"></i>
						</a>
					</td>
					<td class="text-center">
						<a class="edit-expenses btn btn-secondary btn-sm" onclick="showAjaxModal('<?=base_url();?>modal/popup/update_expenses/<?=$row["id"]?>')">
							<i class="fa fa-edit"></i>
						</a>
					</td>
					<td class="text-center">
						<a href="expenses/delete/<?=$row['id'] ?>" class="delete-expenses btn btn-danger btn-sm">
							<i class="fa fa-trash-o"></i>
						</a>
					</td>
				</tr>		
			<?php } } ?>
			</tbody>
		  </table>
	</div>
<br>
<?php
$staff_data = $this->db->get('admin ')->result_array();
?>
<!-- Modal Form Create Customers -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Create Expenses</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
            </div>
            <div class="modal-body">
				<form class="form-horizontal" action="<?php echo base_url();?>admin/expenses/create" method="post">
					<div class="form-group">
						<div class="row">
							<label class="col-md-4 control-label" for="field-1">Staff:</label>
							<div class="col-md-8">
								<select name="staff" id="staff" class="form-control" required>
								<?php foreach ($staff_data as $row) {?>
									<option value="<?=$row['name']; ?>">
										<?=$row['name'] ?>
									</option>
								<?php } ?>
	
							</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="category">Category:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="category" id="category" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="details">Details:</label>
							<div class="col-md-8">
								<input type="text" name="details" id="details" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="phone">Amount:</label>
							<div class="col-md-8">
								<input type="number" name="amount" id="amount" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="expense_date">Expense Date:</label>
							<div class="col-md-8">
								<input type="date" name="expense_date" id="expense_date" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12n pull-right" style="margin:5px 10px;">
							<button class="btn btn-success" type="submit" id="add">
								<span class="fa fa-plus"></span> Submit
							</button>
							<button class="btn btn-danger" type="button" data-dismiss="modal">
								<span class="fa fa-times"></span>Close
							</button>
						</div>
					</div>
            	</form>
			</div>
			<div class="modal-footer">
				Sales & Inventory App 
					[<?php date_default_timezone_set("Africa/Lagos"); echo date("d-m-Y h:i:s A");?>]
            </div>
		</div>
	</div>
</div>

<!-- Modal Form: Show  -->
<div id="show-expenses" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"></h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-md-4" for="">ID:</label>
					<b id="s-id"/>
				</div>
				<div class="form-group">
				 <label class="col-md-4" for="">Staff:</label>
					<b id="s-staff"/>
				</div>
				<div class="form-group">
					<label class=" col-md-4" for="">Category:</label>
					<b id="s-category"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Details:</label>
					<b id="s-details"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Amount:</label>
					<b id="s-amount"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Date-Time:</label>
					<b id="s-created_at"/>
				</div>
				<div class="modal-footer">
					Sales & Inventory App 
					[<?php date_default_timezone_set("Africa/Lagos"); echo date("d-m-Y h:i:s A");?>]
				</div>
			</div>
         </div>
    </div>
</div>



<script type="text/javascript">

    //Delete Content
	$(document).on('click', '.delete-expenses', function(){
      var id = $(this).attr("id");
		  if(confirm("Are you sure you want to remove this?")){
			window.location.href = base_url("admin/expenses");
		  }
		  else{
			return false;
		  }
    });
	

	//show modal for staff
	$(document).on('click', '.show-expenses', function() {
		$('#show-expenses').modal('show');
		$('#s-id').text($(this).data('id'));
		$('#s-staff').text($(this).data('staff'));
		$('#s-category').text($(this).data('category'));
		$('#s-details').text($(this).data('details'));
		$('#s-amount').text($(this).data('amount'));
		$('#s-created_at').text($(this).data('created_at'));
		$('.modal-title').text('Expenses Information');
	});
	
	$(document).ready(function(){
		//Edit Modal for product
			$(document).on('click', '.edit-expenses', function() {
				$('.modal-title').text('Update Expenses Information');
				$('.form-horizontal').show();
			});
	});
</script>

