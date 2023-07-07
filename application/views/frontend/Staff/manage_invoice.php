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
<div class="container-fluid">
      <h4 align="center" class="animated fadeInDown">BLESSED STAN DIGITAL PHOTO LAB LIMITED</h4><br/>
		<b>CASH INVOICE</b>
      <br />
      <div align="right">
        <a href="<?php echo base_url();?>admin/create/" class="btn btn-primary btn-md">CREATE</a>
      </div>
      <br/>
      <table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
          <tr>
            <th>Invoice No.</th>
            <th>Date</th>
            <th>Customer Name</th>
            <th>Total</th>
			<th>Amount Paid</th>
			<th>Balance</th>
            <th>Print</th>
			<th>Show</th>
          </tr>
        </thead>
        <?php
		  $result1 = $this->db->get('invoice_order')->result_array();
		  $total_rows = $this->db->count_all('invoice_order');
		if($total_rows > 0)
		{
			foreach ($result1 as $row) {
				echo '
				  <tr>
					<td>'.$row["order_no"].'</td>
					<td>'.$row["order_date"].'</td>
					<td>'.$row["order_receiver_name"].'</td>
					<td>'.$row["order_total"].'</td>
					<td>'.$row["paid"].'</td>
					<td>'.$row["balance"].'</td>
					<td class="text-center"><a href="print_invoice/'.$row["order_id"].'" class="btn btn-primary btn-sm"><i class="fa fa-book"></i></a></td>
					<td class="text-center"><a href="#" class="show-invoice btn btn-info btn-sm"
							data-id ="'.$row['order_no'].'"
                            data-date="'.$row['order_date'].'"
							data-name="'.$row['order_receiver_name'].'"
                            data-total="'.$row['order_total'].'"
							data-paid="'.$row['paid'].'"
							data-balance="'.$row['balance'].'"
							data-phone="'.$row['order_receiver_phone'].'">
					<i class="fa fa-eye"></i>
						</a>
					</td>
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
<br>

<!-- Modal Form show staff -->
<div id="show-invoice" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="exampleModalLabel"></h4>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
      <div class="modal-body">
            <div class="form-group">
           	 	<label class="col-md-4" for="">Order No:</label>
		  				<b id="s-id"/>
            </div>
            <div class="form-group">
           	 <label class="col-md-4" for="">Order-Date:</label>
		  				<b id="s-date"/>
            </div>
						<div class="form-group">
            	<label class=" col-md-4" for="">Client-Name:</label>
					  				<b id="s-name"/>
            </div>
						<div class="form-group">
	              <label class="col-md-4" for="">Invoice Total:</label>
					 				<b id="s-total"/>
            </div>
			    	<div class="form-group">
	              <label class="col-md-4" for="">Amount Paid:</label>
					 	<b id="s-paid"/>
                </div>
			  	<div class="form-group">
	              <label class="col-md-4" for="">Balance:</label>
					 	<b id="s-balance"/>
                </div>
			  	<div class="form-group">
	              <label class="col-md-4" for="">Phone:</label>
					 	<b id="s-phone"/>
                </div>
            </div>
			<div class="modal-footer">
				Blessed Stan Digital Photo App 2019
		  </div>
         </div>
    </div>

</div>
<script type="application/javascript">
    //Delete Content
	$(document).on('click', '.delete-invoice', function(){
      var id = $(this).attr("id");
		  if(confirm("Are you sure you want to remove this?"))
		  {
			window.location.href = base_url("admin/invoice");
		  }
		  else
		  {
			return false;
		  }
    });

	//show modal for staff
        $(document).on('click', '.show-invoice', function() {
            $('#show-invoice').modal('show');
            $('#s-id').text($(this).data('id'));
            $('#s-date').text($(this).data('date'));
            $('#s-name').text($(this).data('name'));
            $('#s-total').text($(this).data('total'));
						$('#s-paid').text($(this).data('paid'));
						$('#s-balance').text($(this).data('balance'));
						$('#s-phone').text($(this).data('phone'));
            $('.modal-title').text('Invoice Data Information');
        });
</script>
