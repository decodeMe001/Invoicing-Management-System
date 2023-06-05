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
	<h4 align="center" class="animated fadeInDown">Sales & Inventory App [Vendors]</h4><br/>	 
	<div align="right">
		<a href="#" data-toggle="modal" data-target="#create" class="create-product btn btn-info btn-md">CREATE</a><br/>
	</div>
	<br/>
	<table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
			<tr>
                <th width="5%">Sr.No.</th>
				<th width="20%">Company</th>
				<th width="20%">Address</th>
				<th width="5%">City</th>
				<th width="5%">Phone</th>
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
				foreach ($customer_data as $row) { ?>
				<tr>
					<td><?=$no++?></td>
					<td><?=$row["companyName"]?></td>
					<td><?=$row["address"]?></td>
					<td><?=$row["city"]?></td>
					<td><?=$row["phone"] ?></td>
					<td class="text-center">
						<a href="#" class="show-customer btn btn-info btn-sm"
							data-id="<?=$row['customerID']?>"
							data-company="<?=$row['companyName']?>"
							data-address="<?=$row['address']?>"
							data-city="<?=$row['city']?>"
							data-phone="<?=$row['phone']?>">
							<i class="fa fa-eye"></i>
						</a>
					</td>
					<td class="text-center">
						<a class="edit-customer btn btn-secondary btn-sm" onclick="showAjaxModal('<?=base_url();?>modal/popup/update_customer/<?=$row["customerID"]?>')">
							<i class="fa fa-edit"></i>
						</a>
					</td>
					<td class="text-center">
						<a href="customers/delete/<?=$row['customerID'] ?>" class="delete-customer btn btn-danger btn-sm">
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
				<h4 class="modal-title" id="exampleModalLabel">Create Customers</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
            </div>
            <div class="modal-body">
				<form class="form-horizontal" action="<?php echo base_url();?>admin/customers/create" method="post">
					<div class="form-group">
						<div class="row">
							<label class="control-label col-sm-4" for="company">Company:</label>
							<div class="col-sm-8">
								<input type="text" name="company" id="comapny" class="form-control" required />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="address">Address:</label>
							<div class="col-md-8">
								<input type="text" name="address" id="address" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="city">City:</label>
							<div class="col-md-8">
								<input type="text" name="city" id="city" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="phone">Phone:</label>
							<div class="col-md-8">
								<input type="text" name="phone" id="phone" class="form-control" required/>
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
<div id="show-customer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				 <label class="col-md-4" for="">Company:</label>
					<b id="s-company"/>
				</div>
				<div class="form-group">
					<label class=" col-md-4" for="">Address:</label>
					<b id="s-address"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for=""> City:</label>
					<b id="s-city"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Phone:</label>
					<b id="s-phone"/>
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
	$(document).on('click', '.delete-customer', function(){
      var id = $(this).attr("id");
		  if(confirm("Are you sure you want to remove this?")){
			window.location.href = base_url("admin/customers");
		  }
		  else{
			return false;
		  }
    });
	

	//show modal for staff
	$(document).on('click', '.show-customer', function() {
		$('#show-customer').modal('show');
		$('#s-id').text($(this).data('id'));
		$('#s-company').text($(this).data('company'));
		$('#s-address').text($(this).data('address'));
		$('#s-city').text($(this).data('city'));
		$('#s-phone').text($(this).data('phone'));
		$('.modal-title').text('Customer Information');
	});
	
	$(document).ready(function(){
		//Edit Modal for product
			$(document).on('click', '.edit-customer', function() {
				$('.modal-title').text('Update Customer Information');
				$('.form-horizontal').show();
			});
	});
</script>

