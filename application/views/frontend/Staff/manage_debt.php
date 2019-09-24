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
		<h2 class="page-header"><?php echo $page_title;?></h2>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="container-fluid animated fadeInUp">
	<form method="post" id="invoice_form" action="<?php echo base_url();?>admin/customer_record_debt/create">
	  <div class="table-responsive">
	    <table class="table table-bordered">
	      <tr>
	        <td colspan="2" align="center"><h3 style="margin-top:10.5px;color:2ef2ef;">Customer Record</h3></td>

	      </tr>
	      <tr>
	        <td colspan="2">
	          <div class="row">
	            <div class="col-md-5">
	              For,<br />
	                <b>CUSTOMER</b><br />
							<select name="order_receiver_name" id="order_receiver_name" class="form-control input-sm" required>
								<option value="" <?php if($customer) { foreach($customer as $value) { ?>>--select--</option>
								<option value="<?= $value['order_receiver_name'] ?>"><?= $value['order_receiver_name'] ?></option>
									<?php } } else { ?>
									<option value="">No Data</option>
								<?php } ?>
							</select>
							<b>Amount Paid</b>
							<select name="amount_paid" id="amount_paid" class="form-control input-sm" required>
								<option value="" <?php if($customer) { foreach($customer as $value) { ?>>--select--</option>
								<option value="<?= $value['paid'] ?>"><?= $value['paid'] ?></option>
								<?php } } else { ?>
									<option value="">No Data</option>
								<?php } ?>
							</select>
	          			</div>
						<div class="col-md-6">
							<br/><b>Date Issued</b><br/>
						  <select name="date" id="date" class="form-control input-sm" required>
							<option value="" <?php if($customer) { foreach($customer as $value) { ?>>--select--</option>
								<option value="<?= $value['order_date'] ?>"><?= $value['order_date'] ?></option>
								<?php } } else { ?>
									<option value="">No Data</option>
								<?php } ?>
							</select>
						  <b>Balance</b>
						  <select name="balance" id="balance" class="form-control input-sm" required>
							<option value="" <?php if($customer) { foreach($customer as $value) { ?>>--select--</option>
								<option value="<?= $value['balance'] ?>"><?= $value['balance'] ?></option>
								<?php } } else { ?>
									<option value="">No Data</option>
								<?php } ?>
							</select>
						</div>
						</div>
					</td>
				</tr>
			</table>
	        <table id="invoice-item-table" class="table table-bordered">
	            <tr>
	              <td colspan="2"></td>
	            </tr>
	            <tr>
	              <td colspan="2" align="center">
	                <input type="hidden" name="total_item" id="total_item" value="1" />
	                <input type="submit" name="create_invoice" id="create_invoice" class="btn btn-primary btn-lg" value="Create" />
	              </td>
	            </tr>
	          </table>
	    </div>
	</form>
	<br><br>
<div class="container-fluid">
	<table id="data-table" class="table table-bordered table-striped display">
	  <thead>
	    <tr>
	      <th>Sr No.</th>
	      <th>Customer Name</th>
	      <th>Paid</th>
	      <th>Balance</th>
	      <th>Date Issued</th>
	      <th>Date/Time Paid</th>
	      <th>Edit</th>
	    </tr>
	  </thead>
	  	<?php
				$total_rows = $this->db->count_all('record_debt');
				$debt_info = $this->db->get('record_debt')->result_array();
			if($total_rows > 0)
			{
			$no=1;
			foreach ($debt_info as $row) { ?>
		    <tr>
		      <td><?=$no++?></td>
		      <td><?=$row["customer_name"] ?></td>
		      <td><?=$row["amount_paid"] ?></td>
		      <td><?=$row["balance"] ?></td>
		      <td><?=$row["date_received"] ?></td>
		      <td><?=$row["date_created"] ?></td>

		      <td class="text-center">
		        <a  onclick="showAjaxModal('<?= base_url();?>modal/popup/update_debt/<?= $row["id"]?>');"
		          class="edit-debt btn btn-info btn-sm">
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
        var final_total_amt = $('#final_total_amt').text();
        var count = 1;

    		 $(document).on('change', '#order_receiver_name', function(){
    				var selected_name = $(this).val();//selected name for the post request
    			 	var url = '<?php echo base_url(); ?>';
    			 	$.ajax({
    					method: 'POST',
    					url: url + 'admin/get_customer_debt_record',
    					dataType: 'json',
    					data: {selected_name : selected_name}, //Array of data(selected_value) posted to get_customer
    					success:function(data){
    						$('#amount_paid').val(data.paid);
    						$('#balance').val(data.balance);
							$('#date').val(data.order_date);
    					}
    				});
    		 });
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
				 //Edit Modal for pricing
         $(document).on('click', '.edit-debt', function() {
             $('.modal-title').text('Update Customer Debt Info');
             $('.form-horizontal').show();
         });

      });
  </script>