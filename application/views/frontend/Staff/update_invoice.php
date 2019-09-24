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
	  $('#phone').val("<?php echo $row["order_receiver_phone"]; ?>");
	  $('#order_amt_received').val("<?= $row["paid"]; ?>")
	});
</script>
	<form method="post" id="invoice_form" action="<?php echo base_url();?>admin/invoice/update/<?=$row['order_id']; ?>">
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
				  <b>Phone-No:</b><br />
				  <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Enter Customer Phone" required />
				</div>
			  </div>
			  <br />
			  <table id="invoice-item-table" class="table table-bordered">
				<tr>
				  <th width="6%">Sr No.</th>
				  <th width="15%">Item Name</th>
				  <th width="12%">Photo-Size</th>
				  <th width="12%">Photo-Type</th>
				  <th width="8%">Quantity</th>
				  <th width="12%">Price</th>
				  <th width="18%">Amount</th>
				  <th width="18%" rowspan="2">Total</th>
				  <th width="3%"></th>
				</tr>
				<tr></tr>
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

					<td>
					<select name="photo_size[]" id="photo_size<?php echo $m; ?>" class="form-control input-sm" required>
							<?php foreach($get_array as $photo) { ?>
						<option value="<?=$photo['photo_size'] ?>"><?=$photo['photo_size'] ?></option>
						<?php } ?>
					</select>
				  </td>
					<td>
					<select name="photo_type[]" id="photo_type<?php echo $m; ?>" class="form-control input-sm" required>
							<?php foreach($get_array as $photo) { ?>
						<option value="<?=$photo['photo_type'] ?>"><?=$photo['photo_type'] ?></option>
						<?php }?>
					</select>
				  </td>

				  <td><input type="text" name="order_item_quantity[]" id="order_item_quantity<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_quantity" value = "<?php echo $sub_row["order_item_quantity"]?>"/></td>

				  <td>
					<select name="order_item_price[]" id="order_item_price<?php echo $m; ?>" class="form-control input-sm price" data-srno="<?php echo $m; ?>" required>
					<?php foreach($get_array as $photo) { ?>
						<option value="<?= $photo['unit_price'] ?>"><?= $photo['unit_price'] ?></option>
							<?php }?>
					</select>
				  </td>

				  <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_actual_amount" value="<?php echo $sub_row["order_item_actual_amount"];?>" readonly /></td>

				  <td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" readonly class="form-control input-sm order_item_final_amount" value="<?php echo $sub_row["order_item_actual_amount"]; ?>" /></td>

				  <td></td>
				</tr>
				<?php } ?>
			  </table>
			  <div align="right">
				<button type="button" name="add_row" id="add_row" class="btn btn-success btn-sm">+</button>
			  </div>
			</td>
		  </tr>
		  <tr>
				  <td align="right"><b>Total</b></td>
                <td align="right"><b><span style="margin-right:10px;" id="final_total_amt"><?= $row["order_total"] ?></span></b></td>
              </tr>
			  <tr>
			  	<td align="right"><b>Amount Paid</b></td>
                <td align="right"><input type="text" name="order_amt_received" id="order_amt_received" class="form-control input-sm order_amt_received" required/></td>
			  </tr>
              <tr>
				  <td align="right"><b>Balance</b></td>
                <td align="right"><b><span style="margin-right:10px;" id="balance"><?= $row["balance"] ?></span></b></td>
              </tr>
		  <tr>
			<td colspan="2"></td>
		  </tr>
		  <tr>
			<td colspan="2" align="center">
			  <input type="hidden" name="total_item" id="total_item" value="<?php echo $m; ?>" />
			  <input type="hidden" name="order_id" id="order_id" value="<?php echo $row["order_id"]; ?>" />
			  <input type="submit" name="update_invoice" id="create_invoice" class="btn btn-info fa fa-plus" value="Update" />
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

	  html_code += '<td><select name="photo_size[]" id="photo_size'+count+'" class="form-control input-sm"><option value="">--select--</option><?php foreach($get_array as $photo) { ?><option value="<?= $photo['photo_size'] ?>"><?= $photo['photo_size'] ?></option><?php } ?></select></td>';

	  html_code += '<td><select name="photo_type[]" id="photo_type'+count+'" class="form-control input-sm"><option value="">--select--</option><?php foreach($get_array as $photo) { ?><option value="<?= $photo['photo_type'] ?>" ><?= $photo['photo_type'] ?></option><?php } ?></select></td>';

	  html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" /></td>';

	  html_code += '<td><select name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only price"><option value="">--select--</option><?php foreach($get_array as $photo) { ?><option value="<?= $photo['unit_price'] ?>" ><?= $photo['unit_price'] ?></option><?php } ?></select></td>';

	 html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount" readonly /></td>';

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
            var item_total = 0;
            quantity = $('#order_item_quantity'+j).val();
            if(quantity > 0)
            {
				price = $('#order_item_price'+j).val();
              if(price > 0)
				  {
					actual_amount = parseFloat(quantity) * parseFloat(price);
					$('#order_item_actual_amount'+j).val(actual_amount);
					item_total = parseFloat(actual_amount);
					final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
					$('#order_item_final_amount'+j).val(item_total);
				  }
            }
          }
          $('#final_total_amt').text(final_item_total);
        }

	  $(document).on('change', '.price', function(){
          cal_final_total(count);
        });
		  var received = 0;
		  var total = 0;

		 $(document).on('keyup', '.order_amt_received', function(){
			 received = $(this).val();
		  	 total = $('#final_total_amt').text();
			$('#balance').html(parseFloat(total) - parseFloat(received));
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
