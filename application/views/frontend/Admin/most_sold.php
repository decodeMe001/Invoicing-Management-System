<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?=$page_title;?></h2>
	</div>	
</div>
<div class="container-fluid">
	<h4 align="center" class="animated fadeInDown">Sales & Inventory App [Monthly Most Sold Products In Record]</h4><br/>
	<table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
			<tr>
				<th>Month</th>
				<th>Product</th>
				<th>Total Sold</th>
				<th>Total Amount Sold</th>
			</tr>
        </thead>
		<tbody>
		<?php		
		if($total_rows > 0)
			{ 
				foreach ($results as $row) { ?>
					<tr>
						<td><?=date('m')?></td>
						<td><?=$row["item_name"]?></td>
						<td><?=(int)$row["total_sold"]?></td>
						<td>&#8358;<?=number_format($row["total_amount_sold"], 0, '.', ',');?></td>
					</tr>		
			<?php } } ?>
		</tbody>
	  </table>
	</div>
</div>


