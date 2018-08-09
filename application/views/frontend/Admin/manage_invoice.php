<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $page_title;?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
      <h3 align="center">GEOMUD NIGERIA LIMITED</h3><br/>
		<p>BANK/CASH VOUCHER</p>
      <br />
      <div align="right">
        <a href="<?php echo base_url();?>admin/create/" class="btn btn-primary btn-md">CREATE</a>
      </div>
      <br/>
	<div class="table table-responsive">
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Invoice No.</th>
            <th>Invoice Date</th>
            <th>Receiver Name</th>
            <th>Invoice Total</th>
            <th>PDF</th>
            <th>Edit</th>
			  <th>Delete</th>
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
					<td>'.$row["order_total_after_tax"].'</td>
					<td><a href="print_pdf/'.$row["order_id"].'">PDF</a></td>
					<td><a href="update/'.$row["order_id"].'"><span class="glyphicon glyphicon-edit"></span></a></td>
					<td><a href="invoice/delete/'.$row["order_id"].'" class="delete"><span class="glyphicon glyphicon-remove"></span></a></td>
				  </tr>
				';
			}
		}
		  else {
				echo '<tr><td colspan="7">No Invoice Data Entry</td><tr>';
			}
        ?>
      </table>
	</div>
</div>
<br>