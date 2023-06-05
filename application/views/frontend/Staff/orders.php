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
      <h4 align="center" class="animated fadeInDown">Sales & Inventory App [Orders]</h4><br/>
	  <h5>Manage Order:</h5>
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


