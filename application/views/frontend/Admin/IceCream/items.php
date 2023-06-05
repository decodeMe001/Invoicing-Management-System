
<div class="row">
	<div class="col-lg-12">
	<br/>
		<h2 class="page-header"><?php echo $page_title;?></h2>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="container-fluid">
	<h4 align="center" class="animated fadeInDown">STRATUMWORLD RESOURCES LIMITED</h4><br/>
      <br />
      <table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
          <tr>
            <th width="5%">Sr. No.</th>
            <th width="8%">Sales ID</th>
            <th width="8%">Category ID</th>
            <th width="8%">Product ID</th>
			<th width="20%">Item</th>
			<th width="5%">Qty</th>
			<th>Unit Price</th>
			<th width="12%">TCP</th>
			<th width="12%">TSP</th>
          </tr>
        </thead>
        <?php
		$no = 0;
		if($total_rows > 0)
		{
			foreach ($get_data as $row) {
			$no++;
				echo '
				  <tr>
					<td>'.$no.'</td>
					<td>'.$row["sales_id"].'</td>
					<td>'.$row["category_id"].'</td>
					<td>'.$row["product_id"].'</td>
					<td>'.$row["item_name"].'</td>
					<td>'.$row["order_item_quantity"].'</td>
					<td>&#8358;'.number_format($row["unit_price"], 2, ".", ",").'</td>
					<td>&#8358;'.number_format($row["total_cost_price"], 2, ".", ",").'</td>
					<td>&#8358;'.number_format($row["total_selling_price"], 2, ".", ",").'</td>
				  </tr>
				';
			}
		}
		  else {
				echo '<tr><td colspan="8">No Ice-Cream Data Entry</td><tr>';
			}
        ?>
      </table>
</div>