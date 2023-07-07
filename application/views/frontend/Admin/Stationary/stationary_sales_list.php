<div class="row">
	<div class="col-md-12" style="margin-top:15px; font-size:16px;">
		<?php
        $success_msg = $this->session->flashdata('stationary_success_msg');
        $error_msg  = $this->session->flashdata('stationary_error_msg');
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
      <h4 align="center" class="animated fadeInDown">STRATUMWORLD RESOURCES LIMITED</h4><br/>
		<b>CASH INVOICE</b>
      <br />
      <div align="right">
        <a href="<?php echo base_url();?>admin/create_stationary/" class="btn btn-primary btn-md">CREATE</a>
      </div>
      <br/>
      <table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
          <tr>
            <th width="5%">Sr.No.</th>
            <th width="15%">Total CP</th>
            <th width="15%">Total SP</th>
            <th width="15%">Profit</th>
			<th width="15%">Cash Paid</th>
			<th width="15%">Balance</th>
            <th width="4%">Show</th>
            <th width="4%">Edit</th>
            <th width="4%">Delete</th>
          </tr>
        </thead>
        <?php
		  
		if($total_rows > 0)
		{
			$no=1;
			foreach ($get_data as $row)
			{ ?>
				  <tr>
					<td><?=$no++; ?></td>
					<td>&#8358;<?=number_format($row["total_cost_price"], 2, ".", ",")?></td>
					<td>&#8358;<?=number_format($row["total_selling_price"], 2, ".", ",")?></td>
					<td>&#8358;<?=number_format($row["profit"], 2, ".", ",")?></td>
					<td>&#8358;<?=number_format($row["cash_paid"], 2, ".", ",")?></td>
					<td>&#8358;<?=number_format($row["total_selling_price"] - $row["cash_paid"], 2, ".", ",")?></td>
					<td class="text-center">
						<a href="#" class="show_stationary btn btn-info btn-sm" data-id="<?=$row['sales_code']?>" data-date="<?=$row['payment_date']?>">
							<i class="fa fa-eye"></i>
						</a>
					</td>
					<td class="text-center">
						<a href="update_stationary/<?=$row["id"]?>" class="edit-stationary btn btn-primary btn-sm" ><i class="fa fa-edit"></i></a>
					</td>
					<td class="text-center"><a href="stationary/delete/<?=$row["id"]?>" class="delete-stationary btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
				  </tr>
				<?php 
			}
		}else {
			echo '<tr><td colspan="8">No Stationary Data Entry</td><tr>';
		}
        ?>
      </table>
</div>
<br>

<!-- Modal Form show stationary -->
<div id="show_stationary" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
           	 	<label class="col-md-4" for="">Sales Code:</label>
		  		<span id="s-id"></span>
            </div>
            <div class="form-group">
				<label class="col-md-4" for="">Payment-Date:</label>
		  		<span id="s-date"></span>
            </div>
        </div>
		<div class="modal-footer">
				StratumWorld Resources App, 2021.
		  </div>
         </div>
    </div>
</div>
<script type="text/javascript">
    //Delete Content
	$(document).on('click', '.delete-stationary', function(){
      var id = $(this).attr("id");
		  if(confirm("Are you sure you want to remove this?"))
		  {
			window.location.href = base_url("admin/stationary");
		  }
		  else
		  {
			return false;
		  }
    });

	//show modal for stationary
	$(document).on('click', '.show_stationary', function() {
		$('#show_stationary').modal('show');
		$('#s-id').text($(this).data('id'));
		$('#s-date').text($(this).data('date'));
		$('.modal-title').text('Stationary Data Information');
	});
</script>
