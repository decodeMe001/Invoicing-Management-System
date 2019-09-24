<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $page_title;?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="container-fluid animated fadeInUp">
      <h4 align="center" style="margin-top:10.5px;color:2ef2ef;">
		  BLESSED STAN DIGITAL PHOTO LAB LIMITED
	  </h4><br/>
		<b style="color:f2f2f2;">CASH INVOICE</b>
      <br/>
      
        <br/>
      <table class="table table-bordered table-striped display" id="data-table" style="width:100%">
        <thead>
	        <tr>
					  <th width="10%">Sr No.</th>
					  <th width="5%">ID.</th>
					  <th width="15%">Item Name</th>
					  <th width="10%">Type</th>
					  <th width="10%">Size</th>
					  <th width="5%">Quantity</th>
					  <th width="12%">Price</th>
					  <th width="12%">Amount</th>
					  <th width="18%">Created-At</th>
					</tr>
        </thead>
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
						<td>'.$row["item_name"].'</td>
						<td>'.$row["order_photo_type"].'</td>
						<td>'.$row["order_photo_size"].'</td>
						<td>'.$row["order_item_quantity"].'</td>
						<td>'.$row["order_item_price"].'</td>
						<td>'.$row["order_item_actual_amount"].'</td>
						<td>'.$row["created_at"].'</td>
					  </tr>';
				}
		}

        ?>
      </table>
</div>
<br>
