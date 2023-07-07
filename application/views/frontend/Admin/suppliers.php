<div class="row">
	<div class="col-md-12" style="margin-top:15px; font-size:16px;">
		<?php
        $success_msg = $this->session->flashdata('success_msg');
        $error_msg  = $this->session->flashdata('error_msg');
		$customer = $this->db->get("customers")->result_array();
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
	<h4 align="center" class="animated fadeInDown">Sales & Inventory App [Market Vendor]</h4><br/>	 
	<div align="right">
		<a href="#" data-toggle="modal" data-target="#create" class="create-product btn btn-info btn-md">CREATE</a><br/>
	</div>
	<br/>
	<table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
			<tr>
                <th>Sr.</th>
				<th>Company</th>
				<th>Purchase Amount</th>
				<th>Balance</th>
				<th>Discount</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
        </thead>
		<tbody>
        <?php		
			if($total_rows > 0)
			{ 
				$no=1;
				foreach ($supplier_data as $row) { ?>
				<tr>
					<td><?=$no++?></td>
					<td><?=$row["companyName"]?></td>
					<td>&#8358;<?=number_format($row["purchase_amount"], 2, '.', ',');?></td>
					<td>&#8358;<?=number_format($row["balance"], 2, '.', ',');?></td>
					<td>&#8358;<?=number_format($row["discount"], 2, '.', ',');?></td>
					<td class="text-center">
						<a class="edit-suppliers btn btn-secondary btn-sm" onclick="showAjaxModal('<?=base_url();?>modal/popup/update_suppliers/<?=$row["supplierID"]; ?>')">
							<i class="fa fa-edit"></i>
						</a>
					</td>
					<td class="text-center">
						<a href="suppliers/delete/<?=$row['supplierID'];?>" class="delete-suppliers btn btn-danger btn-sm">
							<i class="fa fa-trash-o"></i>
						</a>
					</td>
				</tr>		
			<?php } } ?>
			</tbody>
		  </table>
	</div>
<br>

<!-- Modal Form Create Customers -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Create suppliers</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
            </div>
            <div class="modal-body">
				<form class="form-horizontal" action="<?php echo base_url();?>admin/suppliers/create" method="post">
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="company">Company Name:</label>
							<div class="col-md-8">
							<select name="companyName" id="company" class="form-control input-sm" required>
								<option value="" <?php if($customer) { foreach($customer as $value) { ?>>--select--</option>
								<option value="<?= $value['companyName'] ?>"><?= $value['companyName'] ?></option>
								<?php } } else { ?>
									<option>No Company Record</option>
								<?php } ?>	
							</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="purchase">Purchase Amount:</label>
							<div class="col-md-8">
								<input type="number" placeholder="&#8358;0.00" name="purchase_amount" id="purchase" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="balance">Balance:</label>
							<div class="col-md-8">
								<input type="number" placeholder="&#8358;0.00" name="balance" id="balance" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="discount">Discount:</label>
							<div class="col-md-8">
								<input type="number" placeholder="&#8358;0.00" name="discount" id="discount" class="form-control" required/>
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

<script type="text/javascript">

    //Delete Content
	$(document).on('click', '.delete-suppliers', function(){
      var id = $(this).attr("id");
		  if(confirm("Are you sure you want to remove this?")){
			window.location.href = base_url("admin/suppliers");
		  }
		  else{
			return false;
		  }
    });
		
	$(document).ready(function(){
		//Edit Modal for product
			$(document).on('click', '.edit-suppliers', function() {
				$('.modal-title').text('Update Suppliers Information');
				$('.form-horizontal').show();
			});
	});
</script>

