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
	<!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
      <h4 align="center" class="animated fadeInDown">BLESSED STAN DIGITAL PHOTO LAB LIMITED</h4><br/>
		<b>MANAGE CUSTOMER INFO.</b>
      <br/>
			<div align="right">
        <a href="#" data-toggle="modal" data-target="#create" class="create-customer btn btn-primary btn-md">CREATE</a>
      </div>
      <br/>
      <table id="data-table" class="table table-bordered table-striped display animated fadeInUp">
        <thead>
          <tr>
            <th>Sr No.</th>
            <th>Customer Name</th>
            <th>Address</th>
						<th>Phone No.</th>
						<th>Status</th>
            <th>Edit</th>
						<th>Delete</th>
          </tr>
        </thead>
        <?php
		  $total_rows = $this->db->count_all('customers');
		if($total_rows > 0)
		{
			$no=1;
			foreach ($customer_info as $row) { ?>

				  <tr>
					<td><?=$no++?></td>
					<td><?=$row["customer_name"] ?></td>
					<td><?=$row["address"] ?></td>
					<td><?=$row["phone"] ?></td>
					<td><?=$row["status"] ?></td>

					<td class="text-center">
						<a  onclick="showAjaxModal('<?= base_url();?>modal/popup/update_customer/<?= $row["id"]?>');"
                        class="edit-customer btn btn-info btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
					</td>
					<td>
						<a href="customer/delete/<?=$row['id'] ?>" class="delete-customer btn btn-danger btn-sm">
							<i class="fa fa-trash-o"></i>
						</a>
					</td>
				  </tr>
			<?php } }?>
      </table>
</div>

<!-- Modal Form Create Customer -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
							<h4 class="modal-title" id="exampleModalLabel">Create Customers</h4>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
            </div>
            <div class="modal-body">

            <form class="form-horizontal" action="<?php echo base_url();?>admin/customer/create" method="post">
                <div class="form-group">
									<div class="row">
										<label class="control-label col-sm-4"for="title">Name:</label>
										<div class="col-sm-8">
												<input name="customer_name" id="name" class="form-control" required/>
										</div>
									</row>
                </div>
							</div>

                <div class="form-group">
									<div class="row">
										<label class="control-label col-md-4" for="body">Address :</label>
										<div class="col-md-8">
												<input name="customer_address" id="address" class="form-control" required/>
										</div>
									</div>
                </div>

								<div class="form-group">
									<div class="row">
										<label class="control-label col-md-4" for="body">Phone :</label>
										<div class="col-md-8">
												<input name="customer_phone" id="tell" class="form-control" required/>
										</div>
									</div>
                </div>

                <div class="form-group">
									<div class="row">
										<label class="control-label col-md-4" for="title">Status :</label>
										<div class="col-md-8">
												<select name="status" id="status" class="form-control" required>
														<option value="Regular">Regular</option>
														<option value="New">New</option>
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
							Blessed Stan Digital Photo App 2019
            </div>
					</div>

        </div>
    </div>
</div>

<!--Modal Form Closed-->

<script type="application/javascript">
		$(document).ready(function(){
			//Delete Content
			$(document).on('click', '.delete-customer', function(){
					var id = $(this).attr("id");
					if(confirm("Are you sure you want to remove this?"))
					{
					window.location.href = base_url("admin/customer");
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
				$(document).on('click', '.edit-customer', function() {
						$('.modal-title').text('Update Customer Information');
						$('.form-horizontal').show();
				});
		});
</script>
