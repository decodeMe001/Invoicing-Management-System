<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $page_title;?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
      <h3 align="center" style="margin-top:10.5px;color:2ef2ef;">GEOMUD NIGERIA LIMITED</h3><br/>
		<p style="color:f2f2f2;">BANK/CASH VOUCHER</p>
      <br />
      
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
			  <th width="8%">Item ID.</th>
			  <th width="8%">Order ID.</th>
			  <th width="20%">Item Name</th>
			  <th width="5%">Quantity</th>
			  <th width="5%">Price</th>
			  <th width="10%">Actual Amt.</th>
			  <th width="12.5%" colspan="2">Tax1 (%)</th>
			  <th width="12.5%" colspan="2">Tax2 (%)</th>
			  <th width="12.5%" colspan="2">Tax3 (%)</th>
			  <th width="10%">Total</th>
			</tr>
			<tr>
			  <th></th>
			  <th></th>
			  <th></th>
			  <th></th>
			  <th></th>
			  <th></th>
			  <th>Rate</th>
			  <th>Amt.</th>
			  <th>Rate</th>
			  <th>Amt.</th>
			  <th>Rate</th>
			  <th>Amt.</th>
			  <th></th>
			</tr>
        </thead>
        <?php
		  $result1 = $this->db->get('invoice_order_item')->result_array();
		 $total_rows = $this->db->count_all('invoice_order_item'); 
		if($total_rows > 0)
		{
			foreach ($result1 as $row) {
				echo '<tr>
						<td>'.$row["order_item_id"].'</td>
						<td>'.$row["order_id"].'</td>
						<td>'.$row["item_name"].'</td>
						<td>'.$row["order_item_quantity"].'</td>
						<td>'.$row["order_item_price"].'</td>
						<td>'.$row["order_item_actual_amount"].'</td>
						<td>'.$row["order_item_tax1_rate"].'</td>
						<td>'.$row["order_item_tax1_amount"].'</td>
						<td>'.$row["order_item_tax2_rate"].'</td>
						<td>'.$row["order_item_tax2_amount"].'</td>
						<td>'.$row["order_item_tax3_rate"].'</td>
						<td>'.$row["order_item_tax3_amount"].'</td>
						<td>'.$row["order_item_final_amount"].'</td>
					  </tr>';
				}		
		}
		  
        ?>
      </table>
</div>
<br>