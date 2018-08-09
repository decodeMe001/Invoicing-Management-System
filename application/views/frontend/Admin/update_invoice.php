<?php
$result1 = $this->db->get_where('invoice_order', array('order_id' => $param2))->result_array();
foreach ($result1 as $row) {
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $page_title;?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<script>
	$(document).ready(function(){
	  $('#order_no').val("<?php echo $row["order_no"]; ?>");
	  $('#order_date').val("<?php echo $row["order_date"]; ?>");
	  $('#order_receiver_name').val("<?php echo $row["order_receiver_name"]; ?>");
	  $('#order_receiver_address').val("<?php echo $row["order_receiver_addr"]; ?>");
	});
</script>
	<form method="post" id="invoice_form" action="<?php echo base_url();?>admin/invoice/update/<?php echo $row['order_id']; ?>">
	<div class="table-responsive">
	  <table class="table table-bordered">
		<tr>
		  <td colspan="2" align="center"><h2 style="margin-top:10.5px">Edit Invoice</h2></td>
		</tr>
		<tr>
			<td colspan="2">
			  <div class="row">
				<div class="col-md-8">
				  To,<br />
					<b>RECEIVER (BILL TO)</b><br />
					<input type="text" name="order_receiver_name" id="order_receiver_name" class="form-control input-sm" placeholder="Enter Receiver Name" />
					<textarea name="order_receiver_address" id="order_receiver_address" class="form-control" placeholder="Enter Billing Address"></textarea>
				</div>
				<div class="col-md-4">
				  Reverse Charge<br />
				  <input type="text" name="order_no" id="order_no" class="form-control input-sm" readonly/>
				  <input type="text" name="order_date" id="order_date" class="form-control input-sm" readonly placeholder="Select Invoice Date" />
				</div>
			  </div>
			  <br />
			  <table id="invoice-item-table" class="table table-bordered">
				<tr>
				  <th width="5%">Sr No.</th>
				  <th width="18%">Item Name</th>
				  <th width="5%">Quantity</th>
				  <th width="8%">Price</th>
				  <th width="11%">Actual Amt.</th>
				  <th width="12.5%" colspan="2">Tax1 (%)</th>
				  <th width="12.5%" colspan="2">Tax2 (%)</th>
				  <th width="12.5%" colspan="2">Tax3 (%)</th>
				  <th width="12.5%" rowspan="2">Total</th>
				  <th width="2%" rowspan="2"></th>
				</tr>
				<tr>
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
				</tr>
				<?php
		  			$result2 = $this->db->get_where('invoice_order_item', array('order_id' => $param2))->result_array();
                    $m = 0;
                    foreach($result2 as $sub_row)
                    {
                      $m = $m + 1;
                 ?>
				<tr>
				  <td><span id="sr_no"><?php echo $m; ?></span></td>
				  <td><input type="text" name="item_name[]" id="item_name<?php echo $m; ?>" class="form-control input-sm" value="<?php echo $sub_row["item_name"]; ?>" /></td>
				  <td><input type="text" name="order_item_quantity[]" id="order_item_quantity<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_quantity" value = "<?php echo $sub_row["order_item_quantity"]?>"/></td>
				  <td><input type="text" name="order_item_price[]" id="order_item_price<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm number_only order_item_price" value="<?php echo $sub_row["order_item_price"]; ?>" /></td>
				  <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_actual_amount" value="<?php echo $sub_row["order_item_actual_amount"];?>" readonly /></td>
				  <td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm number_only order_item_tax1_rate" value="<?php echo $sub_row["order_item_tax1_rate"]; ?>" /></td>
				  <td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" readonly class="form-control input-sm order_item_tax1_amount" value="<?php echo $sub_row["order_item_tax1_amount"];?>" /></td>
				  <td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm number_only order_item_tax2_rate" value="<?php echo $sub_row["order_item_tax2_rate"];?>" /></td>
				  <td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" readonly class="form-control input-sm order_item_tax2_amount" value="<?php echo $sub_row["order_item_tax2_amount"]; ?>" /></td>
				  <td><input type="text" name="order_item_tax3_rate[]" id="order_item_tax3_rate<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm number_only order_item_tax3_rate" value="<?php echo $sub_row["order_item_tax3_rate"]; ?>" /></td>
				  <td><input type="text" name="order_item_tax3_amount[]" id="order_item_tax3_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" readonly class="form-control input-sm order_item_tax3_amount" value="<?php echo $sub_row["order_item_tax3_amount"]; ?>" /></td>
				  <td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" readonly class="form-control input-sm order_item_final_amount" value="<?php echo $sub_row["order_item_final_amount"]; ?>" /></td>
				  <td></td>
				</tr>
				<?php
				}
				?>
			  </table>
			</td>
		  </tr>
		  <tr>
			  <td align="right"><b>Total</b></td>
			<td align="right"><b><span id="final_total_amt"><?php echo $row["order_total_after_tax"]; ?></span></b></td>
		  </tr>
		  <tr>
			<td colspan="2"></td>
		  </tr>
		  <tr>
			<td colspan="2" align="center">
			  <input type="hidden" name="total_item" id="total_item" value="<?php echo $m; ?>" />
			  <input type="hidden" name="order_id" id="order_id" value="<?php echo $row["order_id"]; ?>" />
			  <input type="submit" name="update_invoice" id="create_invoice" class="btn btn-info" value="Update" />
			</td>
		  </tr>
	  </table>
	</div>
  </form>
  <script>
  $(document).ready(function(){
	var final_total_amt = $('#final_total_amt').text();
	var count = "<?php echo $m; ?>";

	$(document).on('click', '#add_row', function(){
	  count++;
	  $('#total_item').val(count);
	  var html_code = '';
	  html_code += '<tr id="row_id_'+count+'">';
	  html_code += '<td><span id="sr_no">'+count+'</span></td>';

	  html_code += '<td><input type="text" name="item_name[]" id="item_name'+count+'" class="form-control input-sm" /></td>';

	  html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" /></td>';
	  html_code += '<td><input type="text" name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_price" /></td>';
	  html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount" readonly /></td>';

	  html_code += '<td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_tax1_rate" /></td>';
	  html_code += '<td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_tax1_amount" /></td>';
	  html_code += '<td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_tax2_rate" /></td>';
	  html_code += '<td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_tax2_amount" /></td>';
	  html_code += '<td><input type="text" name="order_item_tax3_rate[]" id="order_item_tax3_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_tax3_rate" /></td>';
	  html_code += '<td><input type="text" name="order_item_tax3_amount[]" id="order_item_tax3_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_tax3_amount" /></td>';
	  html_code += '<td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_final_amount" /></td>';
	  html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
	  html_code += '</tr>';
	  $('#invoice-item-table').append(html_code);
	});

	$(document).on('click', '.remove_row', function(){
	  var row_id = $(this).attr("id");
	  var total_item_amount = $('#order_item_final_amount'+row_id).val();
	  var final_amount = $('#final_total_amt').text();
	  var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
	  $('#final_total_amt').text(result_amount);
	  $('#row_id_'+row_id).remove();
	  count--;
	  $('#total_item').val(count);
	});

	function cal_final_total(count)
	{
	  var final_item_total = 0;
	  for(j=1; j<=count; j++)
	  {
		var quantity = 0;
		var price = 0;
		var actual_amount = 0;
		var tax1_rate = 0;
		var tax1_amount = 0;
		var tax2_rate = 0;
		var tax2_amount = 0;
		var tax3_rate = 0;
		var tax3_amount = 0;
		var item_total = 0;
		quantity = $('#order_item_quantity'+j).val();
		if(quantity > 0)
		{
		  price = $('#order_item_price'+j).val();
		  if(price > 0)
		  {
			actual_amount = parseFloat(quantity) * parseFloat(price);
			$('#order_item_actual_amount'+j).val(actual_amount);
			tax1_rate = $('#order_item_tax1_rate'+j).val();
			if(tax1_rate > 0)
			{
			  tax1_amount = parseFloat(actual_amount)*parseFloat(tax1_rate)/100;
			  $('#order_item_tax1_amount'+j).val(tax1_amount);
			}
			tax2_rate = $('#order_item_tax2_rate'+j).val();
			if(tax2_rate > 0)
			{
			  tax2_amount = parseFloat(actual_amount)*parseFloat(tax2_rate)/100;
			  $('#order_item_tax2_amount'+j).val(tax2_amount);
			}
			tax3_rate = $('#order_item_tax3_rate'+j).val();
			if(tax3_rate > 0)
			{
			  tax3_amount = parseFloat(actual_amount)*parseFloat(tax3_rate)/100;
			  $('#order_item_tax3_amount'+j).val(tax3_amount);
			}
			item_total = parseFloat(actual_amount) + parseFloat(tax1_amount) + parseFloat(tax2_amount) + parseFloat(tax3_amount);
			final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
			$('#order_item_final_amount'+j).val(item_total);
		  }
		}
	  }
	  $('#final_total_amt').text(final_item_total);
	}

	$(document).on('blur', '.order_item_price', function(){
	  cal_final_total(count);
	});

	$(document).on('blur', '.order_item_tax1_rate', function(){
	  cal_final_total(count);
	});

	$(document).on('blur', '.order_item_tax2_rate', function(){
	  cal_final_total(count);
	});

	$(document).on('blur', '.order_item_tax3_rate', function(){
	  cal_final_total(count);
	});

	$('#create_invoice').click(function(){
	  if($.trim($('#order_receiver_name').val()).length == 0)
	  {
		alert("Please Enter Reciever Name");
		return false;
	  }

	  if($.trim($('#order_no').val()).length == 0)
	  {
		alert("Please Enter Invoice Number");
		return false;
	  }

	  if($.trim($('#order_date').val()).length == 0)
	  {
		alert("Please Select Invoice Date");
		return false;
	  }

	  for(var no=1; no<=count; no++)
	  {
		if($.trim($('#item_name'+no).val()).length == 0)
		{
		  alert("Please Enter Item Name");
		  $('#item_name'+no).focus();
		  return false;
		}

		if($.trim($('#order_item_quantity'+no).val()).length == 0)
		{
		  alert("Please Enter Quantity");
		  $('#order_item_quantity'+no).focus();
		  return false;
		}

		if($.trim($('#order_item_price'+no).val()).length == 0)
		{
		  alert("Please Enter Price");
		  $('#order_item_price'+no).focus();
		  return false;
		}

	  }

	  $('#invoice_form').submit();

	});

  });
</script>
<?php }?>