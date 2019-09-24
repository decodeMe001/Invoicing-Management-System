<?php
	 function getInvoiceNumber(){
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

	<form method="post" id="invoice_form" action="<?php echo base_url();?>admin/invoice/create">
	  <div class="table-responsive">
	    <table class="table table-bordered table-striped display">
	      <tr>
	        <center><h2 style="margin-top:10.5px;color:2ef2ef;">Create Invoice</h2></center>
	      </tr>
    <tr>
        <div class="row">
          <div class="col-md-5">
            To,<br />
              <b>RECEIVER (BILL TO)</b><br />
						<select name="order_receiver_name" id="order_receiver_name" class="form-control input-sm" required>
							<option value="" <?php if($customer) { foreach($customer as $value) { ?>>--select--</option>
							<option value="<?= $value['customer_name'] ?>"><?= $value['customer_name'] ?></option>
						<?php } } else { ?>
							<option>No Data</option>
						<?php } ?>
						</select>
						<b>Address</b>
						<select name="order_receiver_address" id="order_receiver_address" class="form-control input-sm" required>
							<option value="" <?php if($customer){ foreach($customer as $value) { ?>>--select--</option>
							<option value="<?= $value['address'] ?>"><?= $value['address'] ?></option>
							<?php } } else { ?>
								<option>No Data</option>
							<?php } ?>
						</select>
          </div>
					<div class="col-md-5">
						<br/><b>Order Date</b><br/>
					  <input type="text" name="order_date" id="order_date" data-provide="datepicker" value="<?php $date = new DateTime('today'); $date->modify('-1 day'); echo $date->format("Y-m-d");?>" class="form-control input-sm"/>
					  <b>Customer Phone</b>
					  <select name="phone" id="phone" class="form-control input-sm" required>
						<option value="" <?php if($customer) { foreach($customer as $value) { ?>>--select--</option>
							<option value="<?= $value['phone'] ?>"><?= $value['phone'] ?></option>
							<?php } } else { ?>
								<option>No Data</option>
							<?php } ?>
						</select>
					</div>
			        <div class="col-md-2">
			          <b>Order No</b><br />
			          <input type="text" name="order_no" id="order_no" class="form-control input-sm" value="<?php echo getInvoiceNumber(); ?>" style="font-weight:bold;" readonly />
			        </div>

			      <table id="invoice-item-table" class="table table-bordered table-striped display">
			        <tr>
			          <th width="6%">Sr No.</th>
			          <th width="18%">Item Name</th>
							  <th width="15%">Photo-Size</th>
							  <th width="15%">Photo-Type</th>
			          <th width="8%">Quantity</th>
			          <th width="12%">Price</th>
			          <th width="15%">Amount</th>
			          <th width="15%" rowspan="2">Total</th>
			          <th width="3%"></th>
			        </tr>
			        <tr></tr>
			        <tr>
			          <td><span id="sr_no">1</span></td>
			          <td><input type="text" name="item_name[]" id="item_name1" class="form-control input-sm" /></td>
							  <td>
									<select name="photo_size[]" id="photo_size1" class="form-control input-sm" required>
										<option value='' <?php if($total_rows > 0) { ?>>--select--</option>
											<?php foreach($get_array as $photo) { ?>
										<option value="<?=$photo['photo_size'] ?>"><?=$photo['photo_size'] ?></option>
										<?php } }else {?>
										<option value="">No entry yet</option>
										<?php } ?>
									</select>
					      </td>
							  <td>
										<select name="photo_type[]" id="photo_type1" class="form-control input-sm" required>
											<option value='' <?php if($total_rows > 0) { ?>>--select--</option>
												<?php foreach($get_array as $photo) { ?>
											<option value="<?=$photo['photo_type'] ?>"><?=$photo['photo_type'] ?></option>
											<?php } }else {?>
											<option value="">No entry yet</option>
											<?php } ?>
										</select>
					      </td>
			              <td>
											<input type="text" name="order_item_quantity[]" id="order_item_quantity1" data-srno="1" class="form-control input-sm order_item_quantity" /></td>
			              <td>
											<select name="order_item_price[]" data-srno="1" id="order_item_price1" class="form-control input-sm price" required>
												<option value='' <?php if($total_rows > 0) { ?>>--select--</option>
													<?php foreach($get_array as $photo) { ?>
												<option value="<?= $photo['unit_price'] ?>" ><?= $photo['unit_price'] ?></option>
												<?php } }else { ?>
												<option value="">No entry yet</option>
												<?php } ?>
											</select>
							      </td>
			          <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount1" data-srno="1" class="form-control input-sm order_item_actual_amount" readonly /></td>
			          <td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount1" data-srno="1" readonly class="form-control input-sm order_item_final_amount" /></td>
			          <td></td>
			    </tr>
			  </table>
      <div align="right" style="margin: 2px 5px;">
        <button type="button" name="add_row" id="add_row" class="btn btn-success btn-sm">+</button>
      </div>
  	</tr>
				<tr>
					<div class="row" style="margin: 10px 15px;">
				  		<b class="col-md-4">Total: </b>
              <b><span id="final_total_amt" class="col-md-8"></span></b>
					</div>
				</tr>
			  <tr>
					<div class="row" style="margin: 10px 15px;">
			  	<b class="col-md-4">Amount Paid:</b>
            <input type="text" name="order_amt_received" id="order_amt_received" class="form-control col-md-8 input-sm order_amt_received" required/>
					</div>
				</tr>
        <tr>
					<div class="row" style="margin: 10px 15px;">
					  <b class="col-md-4">Balance:</b>
	          	<b><span id="balance" class="col-md-8"></span></b>
					</div>
        </tr>
              <tr>
                <td rowspan="2"></td>
              </tr>
              <tr>
                <center>
                  <input type="hidden" name="total_item" id="total_item" value="1" />
                  <input type="submit" name="create_invoice" id="create_invoice" class="btn btn-info btn-lg" value="Create" />
                </center>
              </tr>
        </table>
    </div>
</form>
      <script type="text/javascript">
      $(document).ready(function(){
        var final_total_amt = $('#final_total_amt').text();
        var count = 1;

		 $(document).on('change', '#order_receiver_name', function(){
				var selected_name = $(this).val(); //selected name for the post request
			 	var url = '<?php echo base_url(); ?>';
			 	$.ajax({
					method: 'POST',
					url: url + 'admin/get_customer',
					dataType: 'json',
					data: {selected_name : selected_name}, //Array of data(selected_value) posted to get_customer
					success:function(data){
						$('#order_receiver_address').val(data.address);
						$('#phone').val(data.phone);
					}
				});
		 });

        $(document).on('click', '#add_row', function(){
          count++;
          $('#total_item').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td><span id="sr_no">'+count+'</span></td>';

          html_code += '<td><input type="text" name="item_name[]" id="item_name'+count+'" class="form-control input-sm" /></td>';
          html_code += '<td><select name="photo_size[]" id="photo_size'+count+'" class="form-control input-sm" required><option value="" <?php if($total_rows > 0) { ?>>--select--</option><?php foreach($get_array as $photo) { ?><option value="<?= $photo['photo_size'] ?>" ><?= $photo['photo_size'] ?></option><?php } }else { ?><option value="">No entry yet</option><?php } ?></select></td>';

		  html_code += '<td><select name="photo_type[]" id="photo_type'+count+'" class="form-control input-sm" required><option value="" <?php if($total_rows > 0) { ?>>--select--</option><?php foreach($get_array as $photo) { ?><option value="<?= $photo['photo_type'] ?>" ><?= $photo['photo_type'] ?></option><?php } }else { ?><option value="">No entry yet</option><?php } ?></select></td>';

          html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" /></td>';

          html_code += '<td><select name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only price" required><option value="" <?php if($total_rows > 0) { ?>>--select--</option><?php foreach($get_array as $photo) { ?><option value="<?= $photo['unit_price'] ?>" ><?= $photo['unit_price'] ?></option><?php } }else { ?><option value="">No entry yet</option><?php } ?></select></td>';

          html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount" readonly /></td>';

          html_code += '<td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_final_amount" /></td>';
          html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger remove_row" style="font-size:14px;">X</button></td>';
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
