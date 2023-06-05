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
<div class="container-fluid">
	<h4 align="center" class="animated fadeInDown">Sales & Inventory App [Expired Products]</h4><br/>	 
	<br/>
	<table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Brand Name</th>
				<th>Qty</th>
				<th>SP</th>
				<th>Form</th>
				<th>Status</th>
				<th>Show</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
        </thead>
		<tbody>
        <?php		
			$no=0;
			foreach ($product_data as $row)  { 
				$status = "Expired";
				$qty_status_background_color = $row["qty_in_stock"] < 5 ? '#A91B0D' : '#fff';
				$qty_status_font_color = $row["qty_in_stock"] < 5 ? '#fff' : '#000';
				$get_category_data = $this->db->get_where('store_category', array('id' => $row['dosage_form_id']))->result_array();
				foreach ($get_category_data as $row2) { ?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$row["title"]?></td>
						<td><?=$row["brand_name"]?></td>
						<td style="background-color: <?=$qty_status_background_color?>; font-weight: bold; text-align: center; color: <?=$qty_status_font_color?>"><?=$row["qty_in_stock"]?></td>
						<td>&#8358;<?=number_format($row["selling_price"], 2, '.', ',');?></td>
						<td><?=$row2["name"]?></td>
						<td class="status"><?=$status;?></td>
						<td class="text-center">
							<a href="#" class="show-product btn btn-info btn-sm"
								data-id="<?=$row['id']?>"
								data-title="<?=$row['title']?>"
								data-brand_name="<?=$row['brand_name']?>"
								data-qty_in_stock="<?=$row['qty_in_stock']?>"
								data-pharmacological_class="<?=$row['pharmacological_class']?>"
								data-market_price="&#8358;<?=number_format($row["market_price"], 2, '.', ',');?>"
								data-selling_price="&#8358;<?=number_format($row["selling_price"], 2, '.', ',');?>"
								data-expiry_date="<?=$row['expiry_date']?>"
								data-entry_date="<?=$row['entry_date']?>"
								data-dosage_form_id="<?=$row2['name']?>">
								<i class="fa fa-eye"></i>
							</a>
						</td>
						<td class="text-center">
							<a onclick="showAjaxModal('<?= base_url();?>modal/popup/update_product/<?= $row["id"]?>');" class="edit-product btn btn-warning btn-sm" >
								<i class="fa fa-edit"></i>
							</a>
						</td>
						<td>
							<a href="product/delete/<?=$row['id'] ?>" class="delete-product btn btn-danger btn-sm">
								<i class="fa fa-trash-o"></i>
							</a>
						</td>
					</tr>
			<?php } 
			}?>
			</tbody>
		  </table>
	</div>
<br>

<!-- Modal Form: Show Product -->
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
					<b id="s-id"/>
				</div>
				<div class="form-group">
				 <label class="col-md-4" for="">Title:</label>
					<b id="s-title"/>
				</div>
				<div class="form-group">
					<label class=" col-md-4" for="">Brand-Name:</label>
					<b id="s-brand_name"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for=""> Pharma. Class:</label>
					<b id="s-pharmacological_class"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Quantity:</label>
					<b id="s-qty_in_stock"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Market Price:</label>
					<b id="s-market_price"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Selling Price:</label>
					<b id="s-selling_price"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Expiry Date:</label>
					<b id="s-expiry_date"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Entry Date:</label>
					<b id="s-entry_date"/>
				</div>
				<div class="form-group">
					<label class="col-md-4" for="">Form:</label>
					<b id="s-dosage_form_id"/>
				</div>
				<div class="modal-footer">
					Sales & Inventory App 
					[<?php date_default_timezone_set("Africa/Lagos"); echo date("d-m-Y h:i:s A");?>]
				</div>
			</div>
         </div>
    </div>
</div>

<script type="text/javascript">

    //Delete Content
	$(document).on('click', '.delete-product', function(){
      var id = $(this).attr("id");
		  if(confirm("Are you sure you want to remove this?")){
			window.location.href = base_url("admin/product");
		  }
		  else{
			return false;
		  }
    });
	
	$(document).ready(function(){
		$(".status").each(function(){
			var colorText = $(this).text();
			if( colorText == 'Active') {
				$(this).addClass("greenBg");
			}else if(colorText == 'Going soon'){
				$(this).addClass("yellowBg");
			}else {
				$(this).addClass("redBg");
			}
			//colorText === 'going soon' && $(this).addClass("yellowBg");
			//colorText === 'expired' && $(this).addClass("redBg");
		});
	});
	
	
	//show modal for staff
	$(document).on('click', '.show-product', function() {
		$('#show-product').modal('show');
		$('#s-id').text($(this).data('id'));
		$('#s-title').text($(this).data('title'));
		$('#s-brand_name').text($(this).data('brand_name'));
		$('#s-qty_in_stock').text($(this).data('qty_in_stock'));
		$('#s-pharmacological_class').text($(this).data('pharmacological_class'));
		$('#s-market_price').text($(this).data('market_price'));
		$('#s-selling_price').text($(this).data('selling_price'));
		$('#s-expiry_date').text($(this).data('expiry_date'));
		$('#s-entry_date').text($(this).data('entry_date'));
		$('#s-dosage_form_id').text($(this).data('dosage_form_id'));
		$('.modal-title').text('Product Information');
	});
	
	$(document).ready(function(){
		//Edit Modal for product
			$(document).on('click', '.edit-product', function() {
					$('.modal-title').text('Update Product Information');
					$('.form-horizontal').show();
			});
	});
</script>

