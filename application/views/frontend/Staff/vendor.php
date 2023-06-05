<div class="row">
	<div class="col-md-12" style="margin-top:15px; font-size:16px;">
		<?php
          $success_msg = $this->session->flashdata('vendor_success_msg');
          $error_msg  = $this->session->flashdata('vendor_error_msg');
          if($success_msg){
              echo $success_msg;
          }
      ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?php echo $page_title;?></h2>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
	<form method="post" id="invoice_form" action="<?php echo base_url();?>staff/vendor/create">
	  <div class="table-responsive">
	    <table class="table" style="width:100%;">
				<tr>
					<td colspan="2" align="center"><h3 style="margin-top:10.5px;color:2ef2ef;">Vendor Record</h3></td>

				</tr>
				<tr>
					<td colspan="2">
						<div class="row">
							<div class="col-md-5">
							  For,<br />
								<b>Full Name:</b><br />
								<input type="text" name="name" placeholder="Enter vendor full name" class="form-control input-sm" required />		
							</div>
							<div class="col-md-5">
								<br/><b>Phone:</b><br/>
								<input type="text" name="phone" placeholder="Enter vendor phone number" class="form-control input-sm" required />									  
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<br /><b>Debt:</b><br />
								<input type="number" name="debt" placeholder="Enter vendor Debt" class="form-control input-sm" required />		
							</div>
							<div class="col-md-5">
								<br/><b>Credit Limit:</b><br/>
								<input type="number" name="credit_limit" placeholder="Enter vendor credit limit" class="form-control input-sm" required />									  
							</div>
						</div>
					</td>
				</tr>
			</table>
			<input type="hidden" name="total_item" id="total_item" value="1" />
			<input type="submit" name="create_vendor" id="create_vendor" class="btn btn-primary btn-md" value="Create" style="margin: 25px;;" />
	    </div>
	</form>
	<br><br>
	<div class="container-fluid">
		<table class="table table-bordered table-striped display" id="data-table" style="width:100%;">
		  <thead>
			<tr>
			  <th>Sr No.</th>
			  <th>Vendor Name</th>
			  <th>Phone</th>
			  <th>Debt</th>
			  <th>Credit Limit</th>
			  <th>Edit</th>
			</tr>
		  </thead>
			<?php
				
			if($total_vendor_rows > 0)
			{
				$no=1;
				foreach($vendor_list as $row) { ?>
				<tr>
					<td><?=$no++?></td>
					<td><?=$row["name"] ?></td>
					<td><?=$row["phone"] ?></td>
					<td>&#8358;<?=number_format($row["debt"], 2, '.', ',') ?></td>
					<td>&#8358;<?=number_format($row["credit_limit"], 2, '.', ',') ?></td>
					<td class="text-center">
						<a onclick="showAjaxModal('<?= base_url();?>modal/popup/update_vendor/<?= $row["id"]?>');"
						  class="edit-vendor btn btn-info btn-sm">
						  <i class="fa fa-edit"></i>
					  </a>
					</td>
				</tr>
			<?php } }?>
		</table><br><br>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		//Edit Vendor
		$(document).on('click', '.edit-vendor', function() {
			$('.modal-title').text('Update Vendor Information');
			$('.form-horizontal').show();
		});
	});
</script>
