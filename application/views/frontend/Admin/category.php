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
        $success_msg = $this->session->flashdata('category_success_msg', 60);
        $error_msg  = $this->session->flashdata('category_error_msg');
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
			<b>MANAGE CATEGORY</b>
			<div align="right">
				<a href="#" class="create-category btn btn-primary btn-md">CREATE</a>
			</div>
			<br/>
			<table id="data-table" class="table table-bordered table-striped display animated fadeInUp" style="width:100%;">
				<thead>
				  <tr>
					<th>Sr No.</th>
					<th>Category Name</th>
					<th>Description</th>
					<th>Edit</th>
					<th>Delete</th>
				  </tr>
				</thead>
				<?php

				if($total_category_rows > 0)
				{
					$no=1;
					foreach ($get_category_array as $row) 
					{ ?>
						  <tr>
							<td><?=$no++ ?></td>
							<td><?=$row["category_name"]?></td>
							<td><?=$row["description"]?></td>
							<td class="text-center"><a  onclick="showAjaxModal('<?= base_url();?>modal/popup/update_category/<?= $row["id"]?>');"
								class="edit-category btn btn-success btn-sm">
								<i class="fa fa-edit"></i></a></td>

							<td><a href="category/delete/<?=$row["id"] ?>" class="delete-category btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
						  </tr>
					<?php 
					}
				}
				else {
					echo '<tr><td colspan="8">No Category Data Entry Yet</td><tr>';
				}
				?>
			</table>
		</div>
	</div>
	<br />
</div>

<!-- Modal Form show CATEGORY -->
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
			 <label class="col-md-4" for="">Category Name:</label>
				<b id="s-cat"/>
			</div>
			<div class="form-group">
				<label class=" col-md-4" for="">Description:</label>
				<b id="s-cat_description"/>
			</div>
			
			</div>
			<div class="modal-footer">
				StratumWorld Resources App, 2021
			</div>
		</div>
    </div>
</div>

<!-- Modal Form Create CATEGORY -->
<div id="create-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"></h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
            </div>
            <div class="modal-body">
			<form class="form-horizontal" action="<?=base_url();?>admin/category/create" method="post">
				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="title">Category Name:</label>
						<div class="col-md-8">
							<input name="category_name" id="category_name" class="form-control" required />
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="title">Description:</label>
						<div class="col-md-8">
							<input name="description" id="description" class="form-control" required />
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12n pull-right" style="margin:5px 10px;">
						<button class="btn btn-success fa fa-plus" type="submit" id="add">Save
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

<script type="application/javascript">

	//Date Object
	$(document).ready(function() {
		$('#payment_date').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true
		});
	});
	
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
	
	//Call to the form-modal for category
	$(document).on('click','.create-category', function() {
		$('#create-category').modal('show');
		$('.form-horizontal').show();
		$('.modal-title').text('Create New CATEGORY');
	});
	
	//Edit Category
	$(document).on('click', '.edit-category', function() {
		$('.modal-title').text('Update CATEGORY Information');
		$('.form-horizontal').show();
	});
</script>
