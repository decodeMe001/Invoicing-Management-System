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
	  <?php
		if($this->session->userdata("login_type") != "staff"){
	  ?>
		<div align="right">
			<h5>Daily Sales Amount: <b>&#8358;<?=number_format($total_sales, 2, '.', ',');?></b></h5>
		</div>
		<div align="right">
			<h5>Cash: <b>&#8358;<?=number_format($total_daily_cash, 2, '.', ',');?></b></h5>
		</div>
		<div align="right">
			<h5>POS: <b>&#8358;<?=number_format($total_daily_pos, 2, '.', ',');?></b></h5>
		</div>
		<div align="right">
			<h5>Transfer: <b>&#8358;<?=number_format($total_daily_transfer, 2, '.', ',');?></b></h5>
		</div>
	  <?php } ?> 
	  <br/>
      <table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
          <tr>
			<th width="5%">Sr/No.</th>
            <th width="7%">Order ID</th>
            <th width="5%">Date</th>
            <th>Total</th>
			<th>CASH</th>
			<th>POS</th>
			<th>TRANSFER</th>
			<th>Cashier</th>
			<th>Time</th>
            <th width="5%">Detail</th>
            <th width="5%">Edit</th>
            <th width="5%">Delete</th>
          </tr>
        </thead>
        <?php
		if($total_rows > 0)
		{
			$no = 1;
			foreach ($invoice_data as $row) {
				echo '
				  <tr>
					<td>'.$no++.'</td>
					<td>'.$row["order_id"].'</td>
					<td>'.$row["order_date"].'</td>
					<td>&#8358;'.number_format($row["order_total"], 2, '.', ',').'</td>
					<td>&#8358;'.number_format($row["method_by_cash"], 2, '.', ',').'</td>
					<td>&#8358;'.number_format($row["method_by_pos"], 2, '.', ',').'</td>
					<td>&#8358;'.number_format($row["method_by_transfer"], 2, '.', ',').'</td>
					<td>'.$row["cashier"].'</td>
					<td>'.$row["time"].'</td>
					<td class="text-center">
						<a href="#" class="show-orders btn btn-info btn-sm" 
						data-id="'.$row['order_id'].'"
						data-order_date="'.$row['order_date'].'"
						data-cashier="'.$row['cashier'].'"
						data-time="'.$row['time'].'"
						data-pos="&#8358;'.number_format($row["method_by_pos"], 2, '.', ',').'"
						data-cash="&#8358;'.number_format($row["method_by_cash"], 2, '.', ',').'"
						data-transfer="&#8358;'.number_format($row["method_by_transfer"], 2, '.', ',').'"
						>
							<i class="fa fa-eye"></i>
						</a>
					</td>
					<td class="text-center"><a href="update_sales/'.$row["order_id"].'" class="edit-appointment btn btn-warning btn-sm" >
					<i class="fa fa-edit"></i></a></td>

					<td><a href="sales_order/delete/'.$row["order_id"].'" class="delete-invoice btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
				  </tr>
				';
			}
		}
		  else {
				echo '<tr><td colspan="8">No Invoice Data Entry</td><tr>';
			}
        ?>
      </table>
</div>

<div id="show-orders" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<b id="s-order_id"/>
				</div>
				<div class="form-group">
				 <label class="col-md-4" for="">Date:</label>
					<b id="s-order_date"/>
				</div>
				<div class="form-group">
					<label class=" col-md-4" for="">Cashier:</label>
					<b id="s-cashier"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Time:</label>
					<b id="s-time"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Payment By POS:</label>
					<b id="s-method_by_pos"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Payment By Cash:</label>
					<b id="s-method_by_cash"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Payment By Transfer:</label>
					<b id="s-method_by_transfer"/>
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

	$(document).on('click', '.show-orders', function() {
		$('#show-orders').modal('show');
		$('#s-order_id').text($(this).data('id'));
		$('#s-order_date').text($(this).data('order_date'));
		$('#s-cashier').text($(this).data('cashier'));
		$('#s-time').text($(this).data('time'));
		$('#s-method_by_pos').text($(this).data('pos'));
		$('#s-method_by_cash').text($(this).data('cash'));
		$('#s-method_by_transfer').text($(this).data('transfer'));
		$('.modal-title').text('Order Information');
	});

	$(document).on('click', '.delete-invoice', function(){
      var id = $(this).attr("id");
		  if(confirm("Are you sure you want to remove this?"))
		  {
			window.location.href = base_url("admin/sales_order");
		  }
		  else
		  {
			return false;
		  }
    });

</script>
