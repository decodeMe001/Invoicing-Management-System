<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?=$page_title;?></h2>
	</div>	
</div>
<div class="container-fluid">
	<h4 align="center" class="animated fadeInDown">Sales & Inventory App [Daily Staff Sales Record]</h4><br/>
	<div align="right">
        <?php
            $total = 0;
            foreach($sales_record as $record){
                $total += $record["order_total"];
            }
        ?>
        <h5>Sales Amount (Today): <b>&#8358;<?=number_format($total, 2, '.', ',');?></b></h5>
	</div>
    <br/>
	<table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
			<tr>
				<th>Sr. No.</th>
				<th>Cashier</th>
				<th>Sales</th>   
				<th>POS</th>
				<th>CASH</th>
				<th>TRANSFER</th>
			</tr>
        </thead>
		<tbody>
            <?php
            $no = 1;
            foreach ($sales_record as $row)  { 
            ?>
                <tr>
                    <td><?=$no++; ?></td>
                    <td><?=$row["cashier"]?></td>
                    <td>&#8358;<?=number_format($row["order_total"], 2, '.', ',');?></td>
                    <td>&#8358;<?=number_format($row["method_by_pos"], 2, '.', ',');?></td>
                    <td>&#8358;<?=number_format($row["method_by_cash"], 2, '.', ',');?></td>
                    <td>&#8358;<?=number_format($row["method_by_transfer"], 2, '.', ',');?></td>
                </tr>
			<?php } ?>
		</tbody>
	  </table>
	</div>
</div>


