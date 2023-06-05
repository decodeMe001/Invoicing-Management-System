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
		<h2 class="page-header"><?php echo $page_title;?></h2>
	</div>
</div>
<div class="container-fluid">
	<h4 align="center" class="animated fadeInDown">Sales & Inventory App [Category]</h4>
	<br/>
	<div align="right">
		<a href="#" data-toggle="modal" data-target="#create" class="create-category btn btn-primary btn-md">CREATE</a>
	</div><br/>
	<table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
        <thead>
			<tr>
				<th>Sr.No.</th>
				<th>Name</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
        </thead>
		<tbody>
		<?php
			$total_rows = $this->db->count_all('store_category');
			if($total_rows > 0)
			{
				$no=1;
				foreach ($category_data as $row) { ?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$row["name"] ?></td>
						<td class="text-center">
							<a  onclick="showAjaxModal('<?= base_url();?>modal/popup/update_category/<?= $row["id"]?>');" class="edit-category btn btn-info btn-sm">
								<i class="fa fa-edit"></i>
							</a>
						</td>
						<td>
							<a href="category/delete/<?=$row['id'] ?>" class="delete-category btn btn-danger btn-sm">
								<i class="fa fa-trash-o"></i>
							</a>
						</td>
					</tr>
			<?php } }?>
		</tbody>
    </table>
</div>

<!-- Modal Form Create Category -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Create Category</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
            </div>
            <div class="modal-body">
				<form class="form-horizontal" action="<?php echo base_url();?>admin/category/create" method="post">
					<div class="form-group">
						<div class="row">
							<label class="control-label col-sm-4"for="name">Name:</label>
							<div class="col-sm-8">
								<input type="text" name="name" id="name" class="form-control" required/>
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

<!--Modal Form Closed-->

<script type="application/javascript">
		$(document).ready(function(){
			//Delete Content
			$(document).on('click', '.delete-category', function(){
					var id = $(this).attr("id");
					if(confirm("Are you sure you want to remove this?"))
					{
					window.location.href = base_url("admin/category");
					}
					else
					{
					return false;
					}
				});

		});

</script>
<script type="text/javascript">
		$(document).ready(function(){
			//Edit Modal for pricing
			$(document).on('click', '.edit-category', function() {
					$('.modal-title').text('Update Category Information');
					$('.form-horizontal').show();
			});
		});
</script>
