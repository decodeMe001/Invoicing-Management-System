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
<div class="container-fluid table-responsive">
      <h4 align="center" class="animated fadeInDown">BLESSED STAN DIGITAL PHOTO LAB LIMITED</h4><br/>
		<b>MANAGE PHOTO INFO.</b>
      <br/>
			<div align="right">
        <a href="#" class="create-price btn btn-primary btn-md">CREATE</a>
      </div>
      <br/>
      <table id="data-table" class="table table-bordered table-striped animated fadeInUp" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Sr No.</th>
            <th>Photo Type</th>
            <th>Photo Size</th>
						<th>Unit Price</th>
            <th>Show</th>
            <th>Edit</th>
						<th>Delete</th>
          </tr>
        </thead>
        <?php
		  $result1 = $this->db->get('pricing_rate_item')->result_array();
		  $total_rows = $this->db->count_all('pricing_rate_item');
		if($total_rows > 0)
		{
			$no=1;
			foreach ($result1 as $row) { ?>

				  <tr>
					<td><?=$no++ ?></td>
					<td><?=$row["photo_type"] ?></td>
					<td><?=$row["photo_size"] ?></td>
					<td><?=$row["unit_price"] ?></td>
					<td class="text-center"><a href="#" class="show-pricing btn btn-info btn-sm"
							data-rate-id ="<?=$row['rate_id'] ?>"
                            data-photo-type="<?=$row['photo_type'] ?>"
							data-photo-size="<?=$row['photo_size'] ?>"
                            data-unit-price="<?=$row['unit_price'] ?>">
					<i class="fa fa-eye"></i>
						</a>
					</td>
					<td class="text-center">
						<a  onclick="showAjaxModal('<?= base_url();?>modal/popup/update_pricing/<?= $row['rate_id']?>');"
              class="edit-pricing btn btn-success btn-sm">
                  <i class="fa fa-edit"></i>
              </a>
					</td>
					<td><a href="pricing/delete/<?=$row["rate_id"] ?>" class="delete-pricing btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
					</tr>
		<?php } }?>
      </table>
</div>
<br>

<!-- Modal Form show appointment -->
<div id="show-pricing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<div class="modal-header" >
			<h4 class="modal-title" id="exampleModalLabel"></h4>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
          <div class="modal-body">
            <div class="form-group">
           	 <label class="control-label col-md-4" for="">ID:</label>
						 	<b id="s-id"></b>
            </div>
            <div class="form-group">
           	 <label class="control-label col-md-4" for="">Photo-Type:</label>
						 	<b id="s-type"></b>
            </div>
						<div class="form-group">
            	<label class="control-label col-md-4" for="">Photo-Size:</label>
								<b id="s-size"></b>
            </div>
						<div class="form-group">
              <label class="control-label col-md-4" for="">Unit-Price:</label>
								<b id="s-price"></b>
            </div>
          </div>
					<div class="modal-footer">
						Blessed Stan Digital Photo App 2019
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
									<span aria-hidden="true">×</span>
								</button>
            </div>
            <div class="modal-body">
             <form class="form-horizontal" action="<?php echo base_url();?>admin/pricing/create" method="post">

				 		 		<div class="form-group">
									<div class="row">
										<label class="control-label col-md-4" for="title">Photo-Type:</label>
                    <div class="col-md-8">
                        <input name="photo_type" id="photo_id" class="form-control" required/>
                    </div>
									</div>

                </div>

                <div class="form-group">
									<div class="row">
										<label class="control-label col-md-4" for="title">Photo-Size:</label>
                    <div class="col-md-8">
                        <input name="photo_size" id="photo_id" class="form-control" required/>
                    </div>
									</div>

                </div>

                <div class="form-group">
									<div class="row">
										<label class="control-label col-md-4" for="body">Pricing :</label>
										<div class="col-md-8">
												<input name="unit_price" id="photo_id" class="form-control" required/>
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
					Blessed Stan Digital Photo App 2019
			  </div>
        </div>
    </div>
</div>
<!--Modal Form Closed-->

<script type="application/javascript">
		//Delete Content
	$(document).on('click', '.delete-pricing', function(){
      var id = $(this).attr("id");
		  if(confirm("Are you sure you want to remove this?"))
		  {
			window.location.href = base_url("admin/pricing");
		  }
		  else
		  {
			return false;
		  }
    });

	//show modal for pricing
        $(document).on('click', '.show-pricing', function() {
            $('#show-pricing').modal('show');
            $('#s-id').text($(this).data('rate-id'));
            $('#s-type').text($(this).data('photo-type'));
            $('#s-size').text($(this).data('photo-size'));
            $('#s-price').text($(this).data('unit-price'));
            $('.modal-title').text('Photo-Pricing Information');
        });

	//Edit Modal for pricing
        $(document).on('click', '.edit-pricing', function() {
            $('.modal-title').text('Update Photo-Pricing Information');
            $('.form-horizontal').show();
        });

	//Call to the form-modal
        $(document).on('click','.create-price', function() {
            $('#create').modal('show');
            $('.form-horizontal').show();
			$('.modal-title').text('Create New Photo-Pricing Order');
        });

</script>
