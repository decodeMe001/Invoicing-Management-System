<div class="row">
	<div class="col-md-12" style="margin-top:15px; font-size:16px;">
		<?php
        $success_msg = $this->session->flashdata('supplier_success_msg');
        $error_msg  = $this->session->flashdata('error_msg');
        if($success_msg){
            echo $success_msg;
        }else {
			$error_msg;
		}
    ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?php echo $page_title;?></h2>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
      <h4 align="center" class="animated fadeInDown">STRATUMWORLD RESOURCES LIMITED</h4><br/>
      <br />
	  <div align="right">
        <a href="#" class="create-supplier btn btn-primary btn-md">CREATE</a>
      </div>
	  <br/>
      <table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
          <tr>
			<th>Sr No.</th>
            <th>Name</th>
            <th>Product</th>
            <th>Total</th>
            <th>VAT</th>
			<th>Paid</th>
			<th>Balance</th>
			<th>Show</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <?php
	    
		if($total_rows > 0)
		{
			$no=1;
			foreach ($get_supplier_data as $row) 
			{ ?>
				  <tr>
					<td><?=$no++ ?></td>
					<td><?=$row["name"]?></td>
					<td><?=$row["product"]?></td>
					<td>&#8358;<?=number_format($row["total"], 2, '.', ',')?></td>
					<td>&#8358;<?=number_format($row["vat"], 2, '.', ',')?></td>
					<td>&#8358;<?=number_format($row["amount_paid"], 2, '.', ',')?></td>
					<td>&#8358;<?=number_format($row["amount_paid"] - $row["total"], 2, '.', ',')?></td>
					<td class="text-center">
						<a href="#" class="show-supplier btn btn-info btn-sm"
							data-id="<?=$row['id']?>"
							data-name="<?=$row['name']?>"
                            data-date="<?=$row['payment_date']?>"
							data-phone="<?=$row['phone']?>"
							data-product="<?=$row['product']?>"
                            data-total="<?=$row['total']?>"
                            data-vat="<?=$row['vat']?>"
							data-paid="<?=$row['amount_paid']?>"
							data-balance="<?=$row["amount_paid"] - $row["total"]?>">
					<i class="fa fa-eye"></i>
						</a>
					</td>
					<td class="text-center"><a onclick="showAjaxModal('<?=base_url(); ?>modal/popup/update_supplier/<?=$row["id"]?>');"
						class="edit-supplier btn btn-success btn-sm">
						<i class="fa fa-edit"></i></a></td>

					<td><a href="supplier/delete/<?=$row["id"] ?>" class="delete-supplier btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
				  </tr>
			<?php 
			}
		}
		else {
			echo '<tr><td colspan="8">No Supplier Data Entry</td><tr>';
		}
        ?>
      </table>
</div>
<br>

<!-- Modal Form show supplier -->
<div id="show-supplier" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="exampleModalLabel"></h4>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
			</button>
		</div>
      <div class="modal-body">
            <div class="form-group">
           	 	<label class="col-md-4" for="">ID:</label>
		  		<span id="s-id"></span>
            </div>
            <div class="form-group">
           	 <label class="col-md-4" for="">Payment-Date:</label>
				<span id="s-date"></span>
            </div>
			<div class="form-group">
            	<label class=" col-md-4" for="">Supplier-Name:</label>
				<span id="s-name"></span>
            </div>
			<div class="form-group">
            	<label class=" col-md-4" for="">Product:</label>
				<span id="s-product"></span>
            </div>
			<div class="form-group">
			    <label class="col-md-4" for="">Total:</label>
				&#8358; <span id="s-total"></span>
            </div>
			<div class="form-group">
			    <label class="col-md-4" for="s-vat">VAT:</label>
				&#8358; <span id="s-vat"></span>
            </div>
			<div class="form-group">
				<label class="col-md-4" for="">Amount Paid:</label>
				&#8358; <span id="s-paid"></span>
			</div>
			<div class="form-group">
				<label class="col-md-4" for="">Balance:</label>
				&#8358; <span id="s-balance"></span>
			</div>
			<div class="form-group">
				<label class="col-md-4" for="">Phone:</label>
				<span id="s-phone"></span>
			</div>
            </div>
			<div class="modal-footer">
				StratumWorld Resources App, 2021
		  </div>
         </div>
    </div>
</div>

<!-- Modal Form Create photo -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"></h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
            </div>
            <div class="modal-body">
             <form class="form-horizontal" action="<?php echo base_url();?>admin/supplier/create" method="post">
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="title">Name:</label>
						<div class="col-md-8">
							<input name="name" id="name" class="form-control" required/>
						</div>
					</div>
                </div>

                <div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="title">Phone:</label>
						<div class="col-md-8">
							<input name="phone" id="phone" class="form-control" required/>
						</div>
					</div>
                </div>
				
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="title">Product:</label>
						<div class="col-md-8">
							<input name="product" id="product" class="form-control" required/>
						</div>
					</div>
                </div>

                <div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="body">Total:</label>
						<div class="col-md-8">
							<input name="total" id="total" type="number" class="form-control" required/>
						</div>
					</div>
                </div>
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="body">VAT:</label>
						<div class="col-md-8">
							<input name="vat" id="vat" type="number" class="form-control" required/>
						</div>
					</div>
                </div>
				
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="body">Amount Paid:</label>
						<div class="col-md-8">
							<input name="amount_paid" id="amount_paid" type="number" class="form-control" required/>
						</div>
					</div>
                </div>
				
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="body">Payment-Date:</label>
						<div class="col-md-8">
							<input type="text" name="payment_date" id="payment_date" data-provide="datepicker" value="<?php $date = new DateTime('today'); $date->modify('0 day'); echo $date->format("Y-m-d");?>" class="form-control input-sm"/>
						</div>
					</div>
                </div>

                <div class="form-group">
                    <div class="col-md-12n pull-right" style="margin:5px 10px;">
                        <button class="btn btn-success fa fa-plus" type="submit" id="add">Save Data
                        </button>
                        <button class="btn btn-danger fa fa-times" type="button" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
					StratumWorld Resources App, 2021.
			  </div>
        </div>
    </div>
</div>
<!--Modal Form Closed-->

<script type="text/javascript">

	//Date Object
	$(document).ready(function() {
		$('#payment_date').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true
		});
	});
	
    //Delete Content
	$(document).on('click', '.delete-supplier', function(){
      var id = $(this).attr("id");
		  if(confirm("Are you sure you want to remove this?"))
		  {
			window.location.href = base_url("admin/supplier");
			toastr.success('Delete Sales', 'Data Deleted Successfully!!!', {timeOut: 5000});
		  }
		  else
		  {
			return false;
		  }
    });
	
	//Call to the form-modal
	$(document).on('click','.create-supplier', function() {
		$('#create').modal('show');
		$('.form-horizontal').show();
		$('.modal-title').text('Create New Supplier');
	});

	//show modal for supplier
        $(document).on('click', '.show-supplier', function() {
            $('#show-supplier').modal('show');
            $('#s-id').text($(this).data('id'));
            $('#s-date').text($(this).data('date'));
            $('#s-name').text($(this).data('name'));
            $('#s-total').text($(this).data('total').toLocaleString('en-US'));
            $('#s-vat').text($(this).data('vat').toLocaleString('en-US'));
			$('#s-paid').text($(this).data('paid').toLocaleString('en-US'));
			$('#s-balance').text($(this).data('balance').toLocaleString('en-US'));
			$('#s-phone').text($(this).data('phone'));
			$('#s-product').text($(this).data('product'));
            $('.modal-title').text('Supplier Data Information');
        });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		//Edit Supplier
		$(document).on('click', '.edit-supplier', function() {
			$('.modal-title').text('Update Supplier Information');
			$('.form-horizontal').show();
		});
	});
</script>
