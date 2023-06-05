<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?=$page_title;?></h2>
	</div>	
</div>
<div class="container-fluid">
	<h4 align="center" class="animated fadeInDown">Sales & Inventory App [Monthly Sales Record]</h4><br/>
	<table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
			<tr>
				<th>Sr./No.</th>
				<th>Date</th>
				<th>Total Sales (Daily)</th>
				<th>Profit Margin (Daily)</th>
				<th>POS</th>
				<th>CASH</th>
				<th>TRANSFER</th>
			</tr>
        </thead>
		<tbody>
		<?php		
		if($total_rows > 0)
			{ 
				$no=1;
				foreach ($results as $row) { ?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$row["sales_date"]?></td>
						<td>&#8358;<?=number_format($row["total_sales"], 0, '.', ',');?></td>
						<td>&#8358;<?=number_format($row["total_daily_profit"], 0, '.', ',');?></td>
						<td>&#8358;<?=number_format($row["total_daily_pos"], 0, '.', ',');?></td>
						<td>&#8358;<?=number_format($row["total_daily_cash"], 0, '.', ',');?></td>
						<td>&#8358;<?=number_format($row["total_daily_transfer"], 0, '.', ',');?></td>
					</tr>		
			<?php } } ?>
		</tbody>
	  </table>
	</div>
</div>


