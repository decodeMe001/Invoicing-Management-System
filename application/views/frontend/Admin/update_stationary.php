<?php
$result1 = $this->db->get_where('stationary_sales', array('id' => $id))->result_array();
foreach ($result1 as $row) {
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $page_title;?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<form method="post" id="invoice_form" action="<?php echo base_url();?>admin/stationary/update/<?=$id ?>">
	<div class="table-responsive">
	  <table class="table table-bordered">
		<tr>
		  <td colspan="2" align="center"><h2 style="margin-top:10.5px">Edit Invoice</h2></td>
		</tr>
		<tr>
			<div class="row">
				<div class="col-md-6">
					<b>Payment Date</b>
					<input type="text" name="payment_date" id="payment_date" data-provide="datepicker" value="<?=$row['payment_date']; ?>" class="form-control input-sm"/>
				</div>
				<div class="col-md-6">
				  <b>Sales Code:</b>
				  <input type="text" name="sales_code" id="sales_code" class="form-control input-sm" value="<?=$row['sales_code']; ?>" style="font-weight:bold;" readonly />
				</div>

				<table id="invoice-item-table" class="table table-bordered table-striped display">
				<tr>
					<th width="5%">Sr No.</th>
					<th width="10%">Category</th>
					<th width="10%">Product</th>
					<th width="12%">Name</th>
					<th width="5%">Quantity</th>
					<th width="10%">Unit Price</th>
					<th width="10%">Selling Price</th>
					<th width="20%">TCP</th>
					<th width="22%">TSP</th>
				</tr>
				<tr></tr>
				<?php
		  			$result2 = $this->db->get_where('stationary_sales_order', array('sales_id' => $id))->result_array();
                    $m = 0;
                    foreach($result2 as $sub_row)
                    {
                      $m = $m + 1;
                 ?>
				<tr>
				  <td><span id="sr_no"><?=$m; ?></span></td>
					<td>
						<select name="category[]" id="category<?php echo $m; ?>" class="form-control input-sm category" >
							<?php foreach($category_list as $cat) { ?>
								<option value="<?=$cat['id'] ?>"><?=$cat['category_name'] ?></option>
							<?php }?>
						</select>
					</td>
					<td>
						<select name="product_id[]" id="product_id<?=$m ?>" class="form-control input-sm product_id" >
							<option value="<?=$sub_row['product_id'] ?>"><?=$sub_row['product_id'] ?></option>
						</select>
					</td>
					<td>
						<input type="text" name="item_name[]" id="item_name<?=$m ?>" data-srno="<?=$m ?>" class="form-control input-sm item_name" value="<?=$sub_row["item_name"];?>" required />
					</td>
					<td>
						<input type="number" name="order_item_quantity[]" id="order_item_quantity<?=$m; ?>" data-srno="<?=$m; ?>" value="<?=$sub_row["order_item_quantity"];?>" class="form-control input-sm order_item_quantity" required />
					</td>
					<td>
						<input type="number" name="unit_price[]" id="unit_price<?=$m; ?>" placeholder="&#8358;" data-srno="<?=$m; ?>" class="form-control input-sm unit_price" value="<?=$sub_row['unit_price']?>" required />
					</td>
					<td>
						<input type="number" name="selling_price[]" id="selling_price<?=$m; ?>" placeholder="&#8358;" data-srno="<?=$m; ?>" class="form-control input-sm selling_price" value="<?=$sub_row['selling_price']?>" required />
					</td>
					<td>
						<input type="number" name="total_cost_price[]" id="total_cost_price<?=$m; ?>" placeholder="&#8358;" data-srno="<?=$m; ?>" class="form-control input-sm total_cost_price" value="<?=$sub_row['total_cost_price']?>" required />
					</td>
					<td>
						<input type="number" name="total_selling_price[]" id="total_selling_price<?=$m; ?>" placeholder="&#8358;" data-srno="<?=$m; ?>" class="form-control input-sm total_selling_price" value="<?=$sub_row['total_selling_price']?>" required />
						<input type="hidden" name="qty_left[]" id="qty_left<?=$m; ?>" class="form-control input-sm" />
						<input type="hidden" name="qty_stocked[]" id="qty_stocked<?=$m; ?>" class="form-control input-sm" />
					</td>
				</tr>
				<?php } ?>
		  </table>
		</tr>
		<tr>
			<div class="row" style="margin: 10px 15px;">
				<b class="col-md-4">Grand Total Selling Price: </b>
			    <input type="number" name="final_amt" id="final_amt" class="form-control col-md-8 input-sm final_amt" value="<?=$row["total_selling_price"];?>" required >
			</div>
		</tr>
		<tr>
			<div class="row" style="margin: 10px 15px;">
				<b class="col-md-4">Cash Paid:</b>
				<input type="number" name="cash_paid" id="cash_paid" class="form-control col-md-8 input-sm cash_paid" value="<?=$row["cash_paid"];?>" required />
			</div>
		</tr>
		<tr>
			<div class="row" style="margin: 10px 15px;">
				<b class="col-md-4">Total Profit:</b>
				<input type="number" name="total_profit" id="total_profit" class="form-control col-md-8 input-sm total_profit" placeholder="&#8358;" required >
			</div>
		</tr>
		<tr>
			<td rowspan="2"></td>
		</tr>
		<tr>
			<center>
				<input type="hidden" name="total_item" id="total_item" value="1" />
				<button name="create_invoice" id="create_invoice" class="btn btn-info btn-lg">Update </button>
			</center>
		</tr>
	  </table>
	</div>
  </form>
<script type="text/javascript">
	$(document).ready(function(){
		var count = Number('<?=$m ?>');
		
		$('#product_id'+count).on('change', function() {
			let selected_product = $('.product_id').val();
			let url = '<?=base_url(); ?>';
			$.ajax({
				method: 'POST',
				url: url + 'admin/get_product_details',
				dataType: 'json',
				data: {selected_product: selected_product},
				success: function(data){
					$('#qty_left'+count).val(data.quantity_left);
					$('#qty_stocked'+count).val(data.quantity_in_stock);
					$('#item_name'+count).val(data.item_name);
					if(data.quantity_left <= 10){
						alert('Quantity left in stock is low! Please Restock');
					}
				}
			});
		});
		
	cal_final_total(count);
	
	function cal_final_total(count)
	{
		let total_item_sum = 0;
		let total_profit = 0;
		for(j=1; j<=count; j++){
			let quantity = 0;
			let unit_price = 0;
			let selling_price = 0;
			let TSP = 0;
			let TCP = 0;
			let profit = 0;
			quantity = $('#order_item_quantity'+j).val();
			if(quantity > 0)
			{
				unit_price = $('#unit_price'+j).val();
				selling_price = $('#selling_price'+j).val();
				if(selling_price > 0)
				{
					TSP = parseFloat(quantity) * parseFloat(selling_price);
					TCP = parseFloat(quantity) * parseFloat(unit_price);
					profit = TSP - TCP;
					$('#total_selling_price'+j).val(TSP.toFixed(2));
					$('#total_cost_price'+j).val(TCP.toFixed(2));
					total_item_sum += parseFloat(TSP.toFixed(2));
					total_profit += parseFloat(profit.toFixed(2));
				}
			}
		}
		$('#final_amt').val(total_item_sum.toFixed(2));
		$('#total_profit').val(total_profit.toFixed(2));
	}

	$(document).on('keyup', '.cash_paid', function(){
		received = $(this).val();
		total = $('#final_amt').val();
		$('#balance').val(parseFloat(total) - parseFloat(received));
	});
	
	$('#create_invoice').click(function(e){
		e.preventDefault();

		if($.trim($('#payment_date').val()).length == 0)
		{
			alert("Please Select Invoice Date");
			return false;
		}
		
		if($.trim($('#cash_paid').val()).length == 0)
		{
			alert("Please enter cash paid");
			return false;
		}
		
	for(var no=1; no<=count; no++)
		{
			if($.trim($('#order_item_quantity'+no).val()).length == 0)
			{
				alert("Please Enter Quantity");
				$('#order_item_quantity'+no).focus();
				return false;
			}

			if($.trim($('#selling_price'+no).val()).length == 0)
			{
				alert("Please Enter Price");
				$('#selling_price'+no).focus();
				return false;
			}
			
			if($.trim($('#product_id'+no).val()).length == 0)
			{
				alert("Please select product");
				return false;
			}
			if($.trim($('#category'+no).val()).length == 0)
			{
				alert("Please select category");
				return false;
			}

		}

		$('#invoice_form').submit();
	});
});
</script>
<?php }?>
