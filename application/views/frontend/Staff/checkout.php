<div class="row">
	<div class="col-md-12" style="margin-top:15px; font-size:16px;">
		<?php
        $success_msg = $this->session->flashdata('success_msg');
        $error_msg  = $this->session->flashdata('error_msg');
        if($success_msg){
            echo $success_msg;
        }
    ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?=$page_title;?></h2>
	</div>	
</div>
<div class="container-fluid" id="container-fluid">
	<h4 align="center" class="animated fadeInDown">Sales & Inventory App [Checkout]</h4><br/>	 
	
	<table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
          <tr>
            <th>ID</th>
            <th width="15%">Title</th>
            <th width="15%">Brand Name</th>
            <th>Stock</th>
			<th>SP[&#8358;]</th>
			<th>Prescrition[&#8358;]</th>
            <th width="10%">Qty</th>
            <th>ADD</th>
          </tr>
        </thead>
        <?php		
			function sixMonthsPrior($date){
				$going_soon = strtotime($date.'- 6 months');
				$current_date = strtotime('today midnight');
				
				return ($going_soon < $current_date);
			}
			function getExpiredDate($date){
				$d = strtotime($date);
				$current_date = strtotime('today midnight');
				
				return ($d === $current_date);
			}
			if($total_rows > 0)
			{
				$no=1;
				foreach ($product_data as $row)  { 
					$status = getExpiredDate($row["expiry_date"]) ? "Expired" : (sixMonthsPrior($row["expiry_date"]) ? "Going soon" : "Active");
					$get_category_data = $this->db->get_where('store_category', array('id' => $row['dosage_form_id']))->result_array();
					?>
					<tr>
						<td><?=$no; ?></td>
						<td><?=$row["title"]?></td>
						<td><?=$row["brand_name"]?></td>
						<td><?=$row["qty_in_stock"]?></td>
						<td>&#8358;<?=number_format($row["selling_price"], 2, '.', ',');?></td>
						<td><input type="number" name="prescription_price" class="form-control" value="0" id="prescription_price<?=$row["id"]?>"/></td>
						<td><input type="number" name="quantity" class="form-control quantity" id="<?=$row["id"]?>"/></td>
						<td class="text-center">
							<button type="button" name="add_cart" class="btn btn-success btn-sm add_cart" data-title="<?=$row["title"]?>" 
								data-selling_price="<?=$row["selling_price"]?>" data-id="<?=$row["id"]?>" data-profit_margin="<?=$row["selling_price"] - $row["market_price"]?>"
								data-brand_name="<?=$row["brand_name"]?>" data-qty_left_in_stock="<?=$row["qty_in_stock"]?>" 
								<?php if ($row["qty_in_stock"] <= 0){ ?> disabled <?php } ?>
							/>
								<i class="fa fa-plus" style="color: #fff;"></i>
							</button>
						</td>
						
					</tr>
				<?php $no++; } }?>
		  </table>
	</div>
<br/><br/><br/>

<?php
	 function getInvoiceNumber(){
		$len = 8;
		$char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$rand = '';

		for($i = 0; $i < $len; $i++){
			$rand .= $char[rand(0, strlen($char) - 1)];
		}
		return $rand;
	}
?>

<div class="container-fluid" id="container-fluid">
	<form method="post" id="invoice_form" action="<?=base_url();?>admin/checkout/create">
		<div class="table-responsive">
			<div class="col-md-12 col-md-12">
				<h2><b>Shopping Cart</b></h2><br/><hr/>
			</div>
			<div class="row">
				<div class="col-md-6">
					<b>Order Date:</b><br/>
					<input type="date" name="order_date" id="order_date" data-provide="datepicker" value="<?=date("Y-m-d");?>" class="form-control input-sm"/>
				</div>
				<div class="col-md-6">
					<b>Order No.:</b><br/>
					<input type="text" name="order_no" id="order_no" class="form-control input-sm" value="<?=getInvoiceNumber(); ?>" style="font-weight:bold;" readonly />
				</div>
				
			</div><br/><br/><hr/>
			<b class="text-center"><h5>Other Pay Method</h5></b><hr/>
			<table class="table table-bordered table-striped display">    
				<thead>
					<tr>
						<th>Payment by CASH</th>
						<th>Payment by TRANSFER</th>
						<th>Payment by POS</th>
					</tr>
				</thead>
				<tr>
					<td>
						Amount: <input type="number" placeholder="&#8358;0.00" name="method_by_cash" id="other_payment_method_by_CASH" class="form-control input-sm"/>
					</td>
					<td>
						Amount: <input type="number" placeholder="&#8358;0.00" name="method_by_transfer" id="other_payment_method_by_TRANSFER" class="form-control input-sm"/>
					</td>
					<td>
						Amount: <input type="number" placeholder="&#8358;0.00" name="method_by_pos" id="other_payment_method_by_POS" class="form-control input-sm"/>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right">
					</td>
					<td>
						<b>Total: <span id="other_pay_total"></span></b>
					</td>
				</tr>
			</table>
		</div>
		<div id="cart_details"></div>
	</form>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		var NGNaira = new Intl.NumberFormat('en-NG', {style: 'currency', currency: 'NGN'});
		$('#other_pay_total').text(NGNaira.format(0.00));
	});	

	$(document).ready(function(){
		function updateResult() {
			var cash = parseInt($("#other_payment_method_by_CASH").val()) || 0;
			var pos = parseInt($("#other_payment_method_by_POS").val()) || 0;
			var transfer = parseInt($("#other_payment_method_by_TRANSFER").val()) || 0;
			var total = cash + pos + transfer; 
			var NGNaira = new Intl.NumberFormat('en-NG', {style: 'currency', currency: 'NGN'});
			$('#other_pay_total').text(NGNaira.format(total));

			if (NGNaira.format(total) === $('#cart_total').val()) {
				$('#checkButton').prop("disabled", false);
			} else {
				$('#checkButton').prop("disabled", true);
			}	
		}

		$('#other_payment_method_by_CASH').on('input', updateResult);
		$('#other_payment_method_by_POS').on('input', updateResult);
		$('#other_payment_method_by_TRANSFER').on('input', updateResult);
	});

	$(document).ready(function(){
		var count = 1;
        var final_total_amt = $('#final_total_amt').text();
		$('.summary_list span').text($('#payment_method').val());
		$('#payment_method').bind('keyup mouseup change', function(){
			$('.summary_list span').text($('#payment_method').val());
		});
		
		$('.add_cart').on('click', function(){
			var id = $(this).data("id");
			if($(this).data("qty_left_in_stock") < $('#' + id).val()){
				alert("QUANTITY INSUFFICIENT! Please Restock product!!");
				return;
			}else{
				var title = $(this).data("title");
				var brand_name = $(this).data("brand_name");
				var qty_in_stock = $(this).data("qty_left_in_stock");
				var profit_margin = $(this).data("profit_margin");
				var price = parseFloat($(this).data("selling_price")) + parseFloat($('#prescription_price' + id).val());
				var qty = $('#' + id).val();
				if(qty != '' && qty > 0)
				{
				   $.ajax({
						url:"<?=base_url(); ?>admin/add_to_cart",
						method:"POST",
						data:{id:id, title:title, price:price, qty:qty, brand_name:brand_name, qty_in_stock:qty_in_stock, profit_margin:profit_margin*qty},
						success:function(data)
						{
						 $('#cart_details').html(data);
						 $('#' + id).val('');
						 $('#prescription_price' + id).val('');
						}
				   });
				  }
				else{
					alert("Please Enter QUANTITY");
				}
			}
		 });
		
		 $('#cart_details').load("<?=base_url(); ?>admin/load_cart");

		 $(document).on('click', '.remove_inventory', function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to remove this?"))
			{
			   $.ajax({
					url:"<?=base_url(); ?>admin/remove_from_cart",
					method:"POST",
					data:{ id : id },
					success:function(data)
					{
					 alert("Product removed from Cart");
					 $('#cart_details').html(data);
					}
				});
			}
			else
			{
				return false;
			}
		 });

		 $(document).on('click', '#clear_cart', function(){
			if(confirm("Are you sure you want to clear cart?")){
				$.ajax({
					url:"<?=base_url(); ?>admin/clear_cart",
					success:function(data)
					{
					alert("Your cart has been cleared...");
					$('#cart_details').html(data);
					}
				});
			}else{
				return false;
			}
		 });
		
		$("#invoice_form").submit(function(e){
			e.preventDefault();
			$('#checkButton').prop("disabled", true);
			var form = $(this);
			var url = form.attr("action");
			$.ajax({
				method: 'POST',
				url: url,
				data: form.serialize(),
				success:function(data){
					location.reload();
				}
			});
		 });
	});
  </script>
