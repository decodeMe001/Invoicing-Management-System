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
	<h4 align="center" class="animated fadeInDown">Sales & Inventory App [Products]</h4><br/>	 
	<div align="right">
		<a href="#" data-toggle="modal" data-target="#create" class="create-product btn btn-info btn-md">CREATE</a>
		<a href="expired" class="view-expired-product btn btn-danger btn-md">VIEW EXPIRED</a>
		<br/>
	</div>
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
			function sixMonthsPrior($date){
				$going_soon = strtotime($date.'- 6 months');
				$current_date = strtotime('today midnight');
				
				return ($going_soon < $current_date);
			}
			function getExpiredDate($date){
				$d = strtotime($date);
				$current_date = strtotime('today midnight');
				
				return ($d <= $current_date);
			}
			$no=0;
			if($total_rows > 0)
			{
				foreach ($product_data as $row)  { 
					$status = getExpiredDate($row["expiry_date"]) ? "Expired" : (sixMonthsPrior($row["expiry_date"]) ? "Going soon" : "Active");
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
							<td class="status"><?= $status ?></td>
							<td class="text-center">
								<a href="#" class="show-product btn btn-info btn-sm"
									data-qty_in_stock="<?=$row['qty_in_stock']?>"
									data-pharmacological_class="<?=$row['pharmacological_class']?>"
									data-market_price="&#8358;<?=number_format($row["market_price"], 2, '.', ',');?>"
									data-selling_price="&#8358;<?=number_format($row["selling_price"], 2, '.', ',');?>"
									data-profit_margin="&#8358;<?=number_format($row["selling_price"] - $row["market_price"], 2, '.', ',');?>"
									data-expiry_date="<?=$row['expiry_date']?>"
									data-entry_date="<?=$row['entry_date']?>"
									data-edited_by="<?=$row['edited_by']?>"
									data-dosage_form_id="<?=$row2['name']?>">
									<i class="fa fa-eye"></i>
								</a>
							</td>
							<td class="text-center">
								<a class="edit-product btn btn-warning btn-sm" 
									onclick="showAjaxModal('<?= base_url();?>modal/popup/update_product/<?= $row["id"]?>');" >
									<i class="fa fa-edit"></i>
								</a>
							</td>
							<td>
								<a href="product/delete/<?=$row['id'] ?>" class="delete-product btn btn-danger btn-sm">
									<i class="fa fa-trash-o"></i>
								</a>
							</td>
						</tr>
				<?php } }
			}?>
			</tbody>
		  </table>
	</div>
<br>

<?php
$category_data = $this->db->get('store_category ')->result_array();
foreach ($category_data as $row) {
?>
<!-- Modal Form Create Product -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Create Product</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
            </div>
            <div class="modal-body">
				<form class="form-horizontal" action="<?php echo base_url();?>admin/product/create" method="post">
					<div class="form-group">
						<div class="row">
							<label class="control-label col-sm-4"for="title">Name:</label>
							<div class="col-sm-8">
								<input type="text" name="title" id="title" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="brand_name">Brand:</label>
							<div class="col-md-8">
								<input type="text" name="brand_name" id="brand_name" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="pharmacological_class">Pharm. Class:</label>
							<div class="col-md-8">
								<input type="text" name="pharmacological_class" id="pharmacological_class" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="market_price">Market Price:</label>
							<div class="col-md-8">
								<input type="number" name="market_price" id="market_price" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="selling_price">Selling Price:</label>
							<div class="col-md-8">
								<input type="number" name="selling_price" id="selling_price" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="qty_in_stock">Quantity:</label>
							<div class="col-md-8">
								<input type="number" name="qty_in_stock" id="qty_in_stock" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="expiry_date">Expiry Date:</label>
							<div class="col-md-8">
								<input type="date" name="expiry_date" id="expiry_date" class="form-control" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-md-4" for="dosage_form_id">Form:</label>
							<div class="col-md-8">
								<select name="dosage_form_id" id="dosage_form_id" class="form-control" required>
									<?php foreach ($category_data as $row2) {?>
										<option value="<?php echo $row2['id']; ?>">
											 <?=$row2['name'] ?>
										</option>
									 <?php } ?>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12n pull-right" style="margin:5px 10px;">
							<button class="btn btn-success" type="submit" id="add">
								<span class="fa fa-plus"></span> Save Data
							</button>
							<button class="btn btn-danger" type="button" data-dismiss="modal">
								<span class="fa fa-times"></span>Close
							</button>
						</div>
					</div>
            	</form>
			</div>
			<div class="modal-footer">
				Sales & Inventory App 
					[<?php date_default_timezone_set("Africa/Lagos"); echo date("d-m-Y h:i:s A");?>]
            </div>
		</div>
	</div>
</div>
<?php } ?>
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
					<label class="col-md-4" for="">Profit Margin:</label>
					<b id="s-profit_margin"/>
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
					<label class="col-md-4" for="">Edited By:</label>
					<b id="s-edited_by"/>
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
		});
	});
	
	
	//show modal for staff
	$(document).on('click', '.show-product', function() {
		$('#show-product').modal('show');
		$('#s-qty_in_stock').text($(this).data('qty_in_stock'));
		$('#s-pharmacological_class').text($(this).data('pharmacological_class'));
		$('#s-market_price').text($(this).data('market_price'));
		$('#s-selling_price').text($(this).data('selling_price'));
		$('#s-profit_margin').text($(this).data('profit_margin'));
		$('#s-expiry_date').text($(this).data('expiry_date'));
		$('#s-entry_date').text($(this).data('entry_date'));
		$('#s-dosage_form_id').text($(this).data('dosage_form_id'));
		$('#s-edited_by').text($(this).data('edited_by'));
		$('.modal-title').text('Product Information');
	});
	
	$(document).ready(function(){
		$(document).on('click', '.edit-product', function() {
			$('.modal-title').text('Update Product Information');
			$('.product-form').show();
		});
	});
</script>

