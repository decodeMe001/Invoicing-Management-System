<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?=$page_title;?></h2>
	</div>
</div>
<div class="container-fluid animated fadeInUp">
      <h4 align="center" style="margin-top:10.5px;color:2ef2ef;">
		  <h4 align="center" class="animated fadeInDown">Sales & Inventory App [Sales Items]</h4><br/>
	  </h4>
      
        <br/>
      <table class="table table-bordered table-striped display" id="data-table" style="width:100%">
        <thead>
	        <tr>
				<th width="5%">Sr.No.</th>
				<th width="5%">ID.</th>
				<th width="10%">Date</th>
				<th width="15%">Item Name</th>
				<th width="15%">Quantity</th>
				<th width="15%">Price</th>
				<th width="15%">Total</th>
			</tr>
        </thead>
		<tbody>
			<?php
				$result1 = $this->db->get('invoice_order_item')->result_array();
				$total_rows = $this->db->count_all('invoice_order_item');
				if($total_rows > 0)
				{
					$no = 1;
					foreach ($result1 as $row) {
						echo '<tr>
								<td>'.$no++.'</td>
								<td>'.$row["order_id"].'</td>
								<td>'.$row["created_at"].'</td>
								<td>'.$row["item_name"].'</td>
								<td>'.$row["order_item_quantity"].'</td>
								<td>&#8358;'.number_format($row["order_item_price"], 2, '.', ',').'</td>
								<td>&#8358;'.number_format($row["order_item_actual_amount"], 2, '.', ',').'</td>
							  </tr>';
						}
				}

			?>
		</tbody>
	</table>
</div>
<br/>
