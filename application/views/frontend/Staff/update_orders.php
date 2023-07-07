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
		$('#payment_method').val("<?php echo $row["payment_method"]; ?>");
	});
</script>
	<form method="post" id="invoice_form" action="<?php echo base_url();?>admin/sales_order/update/<?=$row['order_id']; ?>">
	<div class="table-responsive">
	    <table class="table table-bordered">
			<tr>
			  <td colspan="2" align="center"><h2 style="margin-top:10.5px">Edit Order</h2></td>
			</tr>
			<tr>
				<td colspan="2">
				  <div class="row">
					<div class="col-md-12">
						<input type="text" name="order_no" id="order_no" value="<?=$row["order_no"]?>" class="form-control input-sm" readonly />
						<input type="date" name="order_date" id="order_date" value="<?=$row["order_date"]?>" class="form-control input-sm" placeholder="Select Invoice Date" />
					</div>
				  </div>
				  <br />
				  <table id="invoice-item-table" class="table table-bordered">
						<tr>
						  <th width="6%">Sr.No.</th>
						  <th width="15%">Item Name</th>
						  <th width="8%">Quantity</th>
						  <th width="20%">Selling Price</th>
						  <th width="20%" rowspan="2">Total</th>
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
						  <td><input type="text" name="item_name[]" id="item_name<?php echo $m; ?>" class="form-control input-sm" value="<?php echo $sub_row["item_name"]; ?>" readonly /></td>
						  <td><input type="number" name="order_item_quantity[]" id="order_item_quantity<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_quantity" value = "<?php echo $sub_row["order_item_quantity"]?>"/></td>
						  <td><input type="number" name="order_item_price[]" id="order_item_price<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_price" value="<?php echo $sub_row["order_item_price"];?>" readonly /></td>
						  <td><input type="number" name="order_item_final_amount[]" id="order_item_final_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" readonly class="form-control input-sm order_item_final_amount" value="<?php echo $sub_row["order_item_actual_amount"]; ?>" /></td>
						</tr>
						
						<?php } ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td rowspan="3">
								CASH: <input type="number" value="<?=$row["method_by_cash"]?>" name="method_by_cash" id="other_payment_method_by_CASH" class="form-control input-sm" required />
								TRANSFER: <input type="number" value="<?=$row["method_by_transfer"]?>" name="method_by_transfer" id="other_payment_method_by_TRANSFER" class="form-control input-sm" required />
								POS: <input type="number" value="<?=$row["method_by_pos"]?>" name="method_by_pos" id="other_payment_method_by_POS" class="form-control input-sm" required />
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
			<td align="right" rowspan="1"><b>Total</b></td>
			<td align="right"><b><span style="margin-right:10px;" id="final_total_amt"><?= $row["order_total"] ?></span></b></td>
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
		for(j=1; j<=count; j++)
		{
			$('#order_item_quantity'+j).bind('keyup mouseup change', function(){
				cal_final_total(count);
			});
		}
		var received = 0;
		var total = 0;
		  
        $('#create_invoice').click(function(){
      
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
