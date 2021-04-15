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
	<div class="col-md-12" style="margin-top:15px; font-size:16px;">
		<?php
        $success_msg = $this->session->flashdata('product_success_msg', 60);
        $error_msg  = $this->session->flashdata('product_error_msg');
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
	<div class="row">
		<div class="col-md-12">
			<b>MANAGE PRODUCTS</b>
			<br />
			  <div align="right">
				<a href="#" class="create-product btn btn-secondary btn-md">CREATE</a>
			  </div>
			<br/>
			<table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
			<thead>
			  <tr>
				<th width="3%">Sr No.</th>
				<th>Name</th>
				<th>Description</th>
				<th width="5%">Qty in Stock</th>
				<th width="5%">Qty Sold</th>
				<th>Unit Price</th>
				<th>Selling Price</th>
				<th>Show</th>
				<th>Edit</th>
				<th>Delete</th>
			  </tr>
			</thead>
			<?php
			if($total_product_rows > 0)
			{
				$no=1;
				foreach ($get_product_array as $row) 
				{ ?>
					  <tr>
						<td><?=$no++ ?></td>
						<td><?=$row["product_name"]?></td>
						<td><?=$row["description"]?></td>
						<td style="<?=($row['quantity_in_stock']) > 3 ? 'background:#00ff23; color:#fff;': 'background:#B80F0A; color:#fff;' ?>"><?=$row["quantity_in_stock"]?></td>
						<td><?=$row["quantity_sold"]?></td>
						<td>&#8358;<?=number_format($row["unit_price"], 2, '.', ','); ?></td>
						<td>&#8358;<?=number_format($row["selling_price"], 2, '.', ','); ?></td>
						<td class="text-center"><a href="#" class="show-product btn btn-info btn-sm"
								data-id ="<?=$row['id']?>"
								data-cat_id ="<?=$row['category_id']?>"
								data-code ="<?=$row['product_code']?>"
								data-name ="<?=$row['product_name']?>"
								data-description="<?=$row['description']?>"
								data-quantity="<?=$row['quantity_in_stock']?>"
								data-qtysold="<?=$row['quantity_sold']?>"
								data-up="<?=$row['unit_price']?>"
								data-sp="<?=$row["selling_price"]?>">
							<i class="fa fa-eye"></i>
							</a>
						</td>
						<td class="text-center"><a  onclick="showAjaxModal('<?= base_url();?>modal/popup/update_product/<?= $row["id"]?>');"
							class="edit-product btn btn-success btn-sm">
							<i class="fa fa-edit"></i></a></td>

						<td><a href="product/delete/<?=$row["id"] ?>" class="delete-product btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
					  </tr>
				<?php 
				}
			}
			else {
				echo '<tr><td colspan="8">No Product Data Entry</td><tr>';
			}
			?>
			</table>
		</div>
	</div>
</div>
<br>

<!-- Modal Form show Product -->
<div id="show-product" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				<label class="col-md-4" for="">Category ID:</label>
				<span id="s-cat_id"></span>
			</div>
			<div class="form-group">
				<label class=" col-md-4" for="">Product Code:</label>
				<span id="s-code"></span>
			</div>
			<div class="form-group">
				<label class=" col-md-4" for="">Product Name:</label>
				<span id="s-name"></span>
			</div>
			<div class="form-group">
				<label class="col-md-4" for="">Description:</label>
				<span id="s-description"></span>
			</div>
			<div class="form-group">
				<label class="col-md-4" for="">Quantity in Stock:</label>
				<span id="s-quantity"></span>
			</div>
			<div class="form-group">
				<label class="col-md-4" for="">Quantity Sold:</label>
				<span id="s-qtysold"></span>
			</div>
			<div class="form-group">
				<label class="col-md-4" for="">Unit Price:</label>
				&#8358; <span id="s-up"></span>
			</div>
			<div class="form-group">
				<label class="col-md-4" for="">Selling Price:</label>
				&#8358; <span id="s-sp"></span>
			</div>
			</div>
			<div class="modal-footer">
				StratumWorld Resources App, 2021
			</div>
		</div>
    </div>
</div>

<!-- Modal Form Create PRODUCTS -->
<div id="create-product" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"></h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
            </div>
            <div class="modal-body">
			<form class="form-horizontal" action="<?php echo base_url();?>admin/product/create" method="post">
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="title">Category ID:</label>
						<div class="col-md-8">
							<select name="category_id" id="category_id" class="form-control input-sm" required>
							<option value="" <?php if($get_category_array) { foreach($get_category_array as $value) { ?>>--select--</option>
							<option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option>
							<?php } } else { ?>
								<option>No Category Data Entry Yet</option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="title">Product Code:</label>
						<div class="col-md-8">
							<input type="text" name="product_code" id="product_code" class="form-control input-sm" value="<?php echo getSalesCode(); ?>" style="font-weight:bold;" readonly />
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="title">Product Name:</label>
						<div class="col-md-8">
							<input name="product_name" id="product_name" class="form-control" required />
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="title">Description:</label>
						<div class="col-md-8">
							<input name="description" id="description" class="form-control" required/>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="body">Quantity In Stock:</label>
						<div class="col-md-8">
							<input name="quantity_in_stock" id="quantity_in_stock" type="number" class="form-control" required />
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="body">Unit Price:</label>
						<div class="col-md-8">
							<input type="text" name="unit_price" id="unit_price" class="form-control input-sm" required />
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="body">Selling Price:</label>
						<div class="col-md-8">
							<input type="text" name="selling_price" id="selling_price" class="form-control input-sm" required />
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12n pull-right" style="margin:5px 10px;">
						<button class="btn btn-success fa fa-plus" type="submit" id="add"> Save </button>
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
	$(document).on('click', '.delete-product', function(){
      var id = $(this).attr("id");
		  if(confirm("Are you sure you want to remove this?"))
		  {
			window.location.href = base_url("admin/product");
		  }
		  else
		  {
			return false;
		  }
    });
	
	//Call to the form-modal for product
	$(document).on('click','.create-product', function() {
		$('#create-product').modal('show');
		$('.form-horizontal').show();
		$('.modal-title').text('Create New PRODUCT');
	});
	
	//Edit Product
	$(document).on('click', '.edit-product', function() {
		$('.modal-title').text('Update PRODUCT Information');
		$('.form-horizontal').show();
	});


	//show modal for product
        $(document).on('click', '.show-product', function() {
            $('#show-product').modal('show');
            $('#s-id').text($(this).data('id'));
            $('#s-cat_id').text($(this).data('cat_id'));
            $('#s-code').text($(this).data('code'));
            $('#s-name').text($(this).data('name'));
			$('#s-description').text($(this).data('description'));
			$('#s-quantity').text($(this).data('quantity'));
			$('#s-qtysold').text($(this).data('qtysold'));
			$('#s-up').text($(this).data('up').toLocaleString('en-US'));
			$('#s-sp').text($(this).data('sp').toLocaleString('en-US'));
            $('.modal-title').text('PRODUCT Data Information');
        });
</script>
