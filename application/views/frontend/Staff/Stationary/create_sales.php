<?php
	 function getSalesCode(){
		$len = 6;
		$char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$rand = '';

		for($i = 0; $i < $len; $i++){
			$rand .= $char[rand(0, strlen($char) - 1)];
		}
		return $rand;
	}

?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $page_title;?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<form method="post" id="invoice_form" action="<?php echo base_url();?>staff/stationary/create">
  <div class="table-responsive">
	<table class="table table-bordered table-striped display">
	  <tr>
		<center><h2 style="margin-top:10.5px;color:2ef2ef;">Create Stationary Invoice</h2></center>
	  </tr>
		<tr>
			<div class="row">
				<div class="col-md-6">
					<b>Payment Date</b>
					<input type="text" name="payment_date" id="payment_date" data-provide="datepicker" value="<?php $date = new DateTime('today'); $date->modify('-1 day'); echo $date->format("Y-m-d");?>" class="form-control input-sm"/>
				</div>
				<div class="col-md-6">
				  <b>Sales Code:</b>
				  <input type="text" name="sales_code" id="sales_code" class="form-control input-sm" value="<?php echo getSalesCode(); ?>" style="font-weight:bold;" readonly />
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
				<tr>
					<td><span id="sr_no">1</span></td>
					<td>
						<select name="category[]" id="category1" class="form-control input-sm" required>
							<option value='' <?php if($total_category_rows > 0) { ?>>--select--</option>
								<?php foreach($category_list as $cat) { ?>
							<option value="<?=$cat['id'] ?>"><?=$cat['category_name'] ?></option>
							<?php } }else {?>
							<option value="">No entry yet</option>
							<?php } ?>
						</select>
					</td>
					<td>
						<select name="product_id[]" id="product_id1" class="form-control input-sm product_id" required>
							<option value='' <?php if($total_product_rows > 0) { ?>>--select--</option>
								<?php foreach($get_product_array as $product) { ?>
							<option value="<?=$product['id'] ?>"><?=$product['id'] ?></option>
							<?php } }else {?>
							<option value="">No entry yet</option>
							<?php } ?>
						</select>
					</td>
					<td>
						<input type="text" name="item_name[]" id="item_name1" data-srno="1" class="form-control input-sm item_name" readonly />
					</td>
					<td>
						<input type="number" name="order_item_quantity[]" id="order_item_quantity1" data-srno="1" class="form-control input-sm order_item_quantity" required />
					</td>
					<td>
						<input type="number" name="unit_price[]" id="unit_price1" placeholder="&#8358;" data-srno="1" class="form-control input-sm unit_price" readonly required />
					</td>
					<td>
						<input type="number" name="selling_price[]" id="selling_price1" placeholder="&#8358;" data-srno="1" class="form-control input-sm selling_price" required readonly />
					</td>
					<td>
						<input type="number" name="total_cost_price[]" id="total_cost_price1" placeholder="&#8358;" data-srno="1" class="form-control input-sm total_cost_price" readonly />
					</td>
					<td>
						<input type="number" name="total_selling_price[]" id="total_selling_price1" placeholder="&#8358;" data-srno="1" class="form-control input-sm total_selling_price" readonly />
						<input type="hidden" name="qty_left[]" id="qty_left1" class="form-control input-sm" />
						<input type="hidden" name="qty_stocked[]" id="qty_stocked1" class="form-control input-sm" />
						<input type="hidden" name="quantity_sold[]" id="quantity_sold1" class="form-control input-sm" />
					</td>
				</tr>
		  </table>
		  <div align="right" style="margin: 2px 5px;">
			<button type="button" name="add_row" id="add_row" class="btn btn-success btn-sm">+</button>
		  </div>
		</tr>
		<tr>
			<div class="row" style="margin: 10px 15px;">
				<b class="col-md-4">Grand Total Selling Price: </b>
			    <input type="number" name="final_amt" id="final_amt" class="form-control col-md-8 input-sm final_amt" placeholder="&#8358;" readonly required >
			</div>
		</tr>
		<tr>
			<div class="row" style="margin: 10px 15px;">
				<b class="col-md-4">Cash Paid:</b>
				<input type="number" name="cash_paid" id="cash_paid" class="form-control col-md-8 input-sm cash_paid" placeholder="&#8358;" required />
			</div>
		</tr>
		<tr>
			<div class="row" style="margin: 10px 15px;">
				<b class="col-md-4">Balance:</b>
				<b><span id="balance" class="col-md-8">&#8358;</span></b>
			</div>
		</tr>
		<tr>
			<div class="row" style="margin: 10px 15px;">
				<b class="col-md-4">Total Profit:</b>
				<input type="number" name="total_profit" id="total_profit" class="form-control col-md-8 input-sm total_profit" placeholder="&#8358;" readonly required >
			</div>
		</tr>
		<tr>
			<td rowspan="2"></td>
		</tr>
		<tr>
			<center>
				<input type="hidden" name="total_item" id="total_item" value="1" />
				<button name="create_invoice" id="create_invoice" class="btn btn-info btn-lg">Create </button>
			</center>
		</tr>
	</table>
</div>
</form>
<script type="text/javascript">
      $(document).ready(function(){
        $('#final_amt').val(0);
        $('#total_profit').val(0);
        var count = 1;
		$(document).on('change', '.product_id', function() {
			var selected_product = $(this).val();
			var url = '<?=base_url(); ?>';
			$.ajax({
				method: 'POST',
				url: url + 'staff/get_product_details',
				dataType: 'json',
				data: {selected_product: selected_product},
				success: function(data){
					$('#unit_price'+count).val(data.unit_price);
					$('#qty_left'+count).val(data.quantity_left);
					$('#qty_stocked'+count).val(data.quantity_in_stock);
					$('#quantity_sold'+count).val(data.quantity_sold);
					$('#item_name'+count).val(data.item_name);
					$('#selling_price'+count).val(data.selling_price);
					if(data.quantity_left <= 10){
						alert('Quantity left in stock is low! Please Restock');
					}
				}
			});
		});
		
        $(document).on('click', '#add_row', function(){
			count++;
			$('#total_item').val(count);
			var html_code = '';
			html_code += '<tr id="row_id_'+count+'">';
			html_code += '<td><span id="sr_no">'+count+'</span></td>';

			html_code += '<td><select name="category[]" id="category'+count+'" class="form-control input-sm" required><option value="" <?php if($total_category_rows > 0) { ?>>--select--</option><?php foreach($category_list as $cat) { ?><option value="<?= $cat['id'] ?>" ><?= $cat['category_name'] ?></option><?php } }else { ?><option value="">No entry yet</option><?php } ?></select></td>';

			html_code += '<td><select name="product_id[]" id="product_id'+count+'" class="form-control input-sm product_id" required><option value="" <?php if($total_product_rows > 0) { ?>>--select--</option><?php foreach($get_product_array as $product) { ?><option value="<?= $product['id'] ?>" ><?= $product['id'] ?></option><?php } }else { ?><option value="">No entry yet</option><?php } ?></select></td>';
			html_code += '<td><input type="text" name="item_name[]" id="item_name'+count+'" data-srno="'+count+'" class="form-control input-sm number_only item_name" readonly /></td>';

			html_code += '<td><input type="number" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" required /></td>';
			html_code += '<td><input type="number" name="unit_price[]" id="unit_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only unit_price" readonly required /></td>';
			html_code += '<td><input type="number" name="selling_price[]" id="selling_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only selling_price" readonly required /></td>';

			html_code += '<td><input type="number" name="total_cost_price[]" id="total_cost_price'+count+'" data-srno="'+count+'" class="form-control input-sm total_cost_price" readonly required/></td>';
			html_code += '<td><input type="number" name="total_selling_price[]" id="total_selling_price'+count+'" data-srno="'+count+'" class="form-control input-sm total_selling_price" readonly required/></td>';
			html_code += '<td><input type="hidden" name="qty_left[]" id="qty_left'+count+'" data-srno="'+count+'" class="form-control input-sm" /><input type="hidden" name="qty_stocked[]" id="qty_stocked'+count+'" data-srno="'+count+'" class="form-control input-sm" /><input type="hidden" name="quantity_sold[]" id="quantity_sold'+count+'" data-srno="'+count+'" class="form-control input-sm" /></td>'

			html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger remove_row" style="font-size:14px;">X</button></td>';
			html_code += '</tr>';
			$('#invoice-item-table').append(html_code);
        });

        $(document).on('click', '.remove_row', function(){
			var row_id = $(this).attr("id");
			var total_item_amount = $('#total_selling_price'+row_id).val();
			var final_amount = $('#final_amt').val();
			var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
			$('#final_amt').val(result_amount);
			$('#row_id_'+row_id).remove();
			count--;
			$('#total_item').val(count);
        });

        function cal_final_total(count)
        {
          var total_item_sum = 0;
		  var total_profit = 0;
          for(j=1; j<=count; j++)
          {
            var quantity = 0;
            var unit_price = 0;
            var selling_price = 0;
            let TSP = 0;
            let TCP = 0;
            var profit = 0;
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

        $(document).on('keyup', '.order_item_quantity', function(){
          cal_final_total(count);
        });
		
		  var received = 0;
		  var total = 0;

		 $(document).on('keyup', '.cash_paid', function(){
			 received = $(this).val();
		  	 total = $('#final_amt').val();
			$('#balance').html(parseFloat(total) - parseFloat(received));
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
