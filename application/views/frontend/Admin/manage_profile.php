<div class="row">
	<div class="col-md-12" style="margin-top:10px; font-size:16px;">
		<?php
                $success_msg = $this->session->flashdata('profile_success_msg');
                $error_msg  = $this->session->flashdata('profile_error_msg');
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
<<<<<<< HEAD
		<h4 align="center" class="animated fadeInDown">Sales & Inventory App [Staff]</h4><br/>
		<b>MANAGE STAFF INFO.</b>
		<br/>
		<div align="right">
			<a href="#" class="create-staff btn btn-primary btn-md">CREATE</a>
	    </div>
		<br/>
=======
      <h4 align="center" class="animated slideInDown">STRATUMWORLD RESOURCES LIMITED</h4><br/>
		<b>MANAGE STAFF INFO.</b>
      <br/>
	  <div align="right">
        <a href="#" class="create-staff btn btn-primary btn-md">CREATE</a>
      </div>
      <br/>
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
      <table id="data-table" class="table table-bordered table-striped aniamated slideInUp">
        <thead>
          <tr>
            <th>Sr No.</th>
            <th>Staff Name</th>
            <th>Email</th>
			<th>Username</th>
			<th>Role</th>
            <th>Show</th>
            <th>Edit</th>
			<th>Delete</th>
          </tr>
        </thead>
        <?php
<<<<<<< HEAD
		$query = "role='staff' OR role='manager'"; 
		$result1 = $this->db->get_where('admin', $query)->result_array();
		$total_rows = $this->db->count_all('admin');
=======
		  
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
		if($total_rows >= 1)
		{
			$no=1;
			foreach ($staff as $row) { ?>

				<tr>
				<td><?= $no++ ?></td>
				<td><?= $row["name"] ?></td>
				<td><?= $row["email"] ?></td>
				<td><?= $row["user_name"] ?></td>
				<td><?= $row["role"] ?></td>
				<td class="text-center"><a href="#" class="show-staff btn btn-info btn-sm"
						data-staff-id ="<?= $row['admin_id'] ?>"
						data-staff-name="<?= $row['name'] ?>"
						data-staff-mail="<?= $row['email'] ?>"
						data-staff-username="<?= $row['user_name'] ?>"
						data-role="<?= $row['role'] ?>">
				<i class="fa fa-eye"></i>
					</a>
				</td>

				<td class="text-center">
					<a onclick="showAjaxModal('<?= base_url();?>modal/popup/update_staff/<?= $row["admin_id"]?>');" class="edit-staff btn btn-success btn-sm">
						<i class="fa fa-edit"></i>
					</a>
				</td>

<<<<<<< HEAD
				<td><a href="staff/delete/<?=$row['admin_id'] ?>" class="delete-staff btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
				</tr>
		<?php } }?>
	</table>
=======
				<td><a href="profile/delete/<?=$row['admin_id'] ?>" class="delete-staff btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
			  </tr>
			<?php 
			}
		}
		else {
			echo '<tr><td colspan="8">No Data Entry</td><tr>';
		}
        ?>
      </table>
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
<br><br>
<div class="card mb-3 animated slideInUp">
  <div class="card-header">
    <?php echo 'Edit Admin Profile';?>
  </div>
  <div class="card-body">
    <?php
    foreach($update_admin as $row):
        ?>
        <?php echo form_open(base_url().'admin/profile/update_profile_info' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>
            <div class="form-group">
				<div class="row">
<<<<<<< HEAD
				<label class="col-sm-3 control-label"><?php echo 'Username';?></label>
				<div class="col-sm-5">
				<input type="text" class="form-control" name="name" value="<?php echo $row['user_name'];?>"/>
				</div>
=======
					<label class="col-sm-3 control-label"><?php echo 'Username';?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" value="<?php echo $row['user_name'];?>"/>
					</div>
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
				</div>
            </div>
            <div class="form-group">
				<div class="row">
					<label class="col-sm-3 control-label"><?php echo 'Access Role';?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="role" value="<?php echo $row['role'];?>" readonly/>
					</div>
				</div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info fa fa-plus"><?php echo ' Update';?></button>
              </div>
            </div>
            <?php echo form_close();?>
            <?php
        endforeach;
        ?>
    </div>
</div>

<div class="card mb-3 animated slideInUp">
    <div class="card-header">
            <?php echo 'Change Admin Password';?>
    </div>
    <div class="card-body">
			<?php
      foreach($update_admin as $row):
          ?>
          <?php echo form_open(base_url().'admin/profile/change_password' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>
<<<<<<< HEAD
			<div class="form-group">
				<div class="row">
					<label class="col-sm-3 control-label"><?php echo 'Current Password';?></label>
					<div class="col-sm-5">
					<input type="password" class="form-control" name="password" value=""/>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label class="col-sm-3 control-label"><?php echo 'New Password';?></label>
					<div class="col-sm-5">
						<input type="password" class="form-control" name="new_password" value=""/>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label class="col-sm-3 control-label"><?php echo 'Confirm New Password';?></label>
					<div class="col-sm-5">
						<input type="password" class="form-control" name="confirm_new_password" value=""/>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="submit" class="btn btn-info fa fa-plus"><?php echo ' Update';?></button>
				</div>
			</div>
			<?php echo form_close();?>
			<?php endforeach;?>
=======
              <div class="form-group">
					<div class="row">
						<label class="col-sm-3 control-label"><?php echo 'Current Password';?></label>
						<div class="col-sm-5">
						  <input type="password" class="form-control" name="password" value=""/>
						</div>
					</div>
              </div>
              <div class="form-group">
					<div class="row">
						<label class="col-sm-3 control-label"><?php echo 'New Password';?></label>
						<div class="col-sm-5">
						  <input type="password" class="form-control" name="new_password" value=""/>
						</div>
					</div>
              </div>
				<div class="form-group">
					<div class="row">
						<label class="col-sm-3 control-label"><?php echo 'Confirm New Password';?></label>
						<div class="col-sm-5">
						  <input type="password" class="form-control" name="confirm_new_password" value=""/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-info fa fa-plus"><?php echo ' Update';?></button>
					</div>
				</div>
          <?php echo form_close();?>
				<?php
        	endforeach;
        ?>
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
    </div>
</div>

<!-- Modal Form show profile -->
<div id="show-staff" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"></h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<div class="card-body">
				<div class="form-group">
					<div class="row">
						<label class="col-md-4" for="">ID:</label>
						<b id="s-id"/>
					</div>
				</div>
<<<<<<< HEAD
				<div class="form-group">
					<div class="row">
						<label class="col-md-4" for="">Staff-Name:</label>
						<b id="s-name"/>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class=" col-md-4" for="">Staff-Username:</label>
						<b id="s-user"/>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class="col-md-4" for="">Staff-Email:</label>
						<b id="s-mail"/>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class="col-md-4" for="">Role:</label>
						<b id="s-role"/>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				Sales & Inventory App 
				[<?php date_default_timezone_set("Africa/Lagos"); echo date("d-m-Y h:i:s A");?>]
			</div>
=======
				<div class="card-body">
					<div class="form-group">
						<div class="row">
							<label class="col-md-4" for="">ID:</label>
								<b id="s-id"/>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-md-4" for="">Staff-Name:</label>
							<b id="s-name"/>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class=" col-md-4" for="">Staff-Username:</label>
								<b id="s-user"/>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-md-4" for="">Staff-Email:</label>
								<b id="s-mail"/>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-md-4" for="">Role:</label>
								<b id="s-role"/>
						</div>
					</div>

				</div>
				<div class="modal-footer">
				StratunWorld Resources App, 2021.
				</div>
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
         </div>
    </div>

</div>

<!-- Modal Form Create staff -->
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

<<<<<<< HEAD
            <form class="form-horizontal" action="<?php echo base_url();?>admin/staff/create" method="post">
				<div class="form-group">
=======
            <form class="form-horizontal" action="<?php echo base_url();?>admin/profile/create" method="post">
                <div class="form-group">
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
					<div class="row">
						<label class="control-label col-sm-4"for="title">Name:</label>
						<div class="col-sm-8">
							<input name="staff_name" id="name" class="form-control" required/>
						</div>
					</div>
<<<<<<< HEAD
				</div>

				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="body">Username :</label>
						<div class="col-md-8">
							<input name="staff_username" id="username" class="form-control" required/>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="body">Email :</label>
						<div class="col-md-8">
							<input name="staff_email" id="email" class="form-control" required/>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="title">Role :</label>
						<div class="col-md-8">
							<select name="staff_role" id="role" class="form-control" required>
								<option>--select role--</option>
								<option value="staff">staff</option>
								<option value="manager">manager</option>
								<option value="" disabled>admin</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
=======
                </div>

                <div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="body">Username :</label>
                    <div class="col-md-8">
							<input name="staff_username" id="username" class="form-control" required/>
						</div>
					</div>
                </div>

				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="body">Email :</label>
                    <div class="col-md-8">
							<input name="staff_email" id="email" class="form-control" required/>
						</div>
					</div>
                </div>

                <div class="form-group">
					<div class="row">
						<label class="control-label col-md-4" for="title">Role :</label>
						<div class="col-md-8">
							<select name="staff_role" id="role" class="form-control" required>
								<option value="staff" selected>staff</option>
								<option value="" disabled>admin</option>
							</select>
						</div>
					</div>
                </div>

				<div class="form-group">
					<div class="row">
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
						<label class="control-label col-md-4" for="title">Password :</label>
						<div class="col-md-8">
							<input name="password" id="password" class="form-control" required/>
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
<<<<<<< HEAD
				Sales & Inventory App 
					[<?php date_default_timezone_set("Africa/Lagos"); echo date("d-m-Y h:i:s A");?>]
=======
				StratumWorld Resources App, 2021.
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
            </div>
        </div>
    </div>
</div>
</div>
<!--Modal Form Closed-->

<script type="application/javascript">
		//Delete Content
	$(document).on('click', '.delete-staff', function(){
      var id = $(this).attr("id");
		  if(confirm("Are you sure you want to remove this?"))
		  {
			window.location.href = base_url("admin/profile");
		  }
		  else
		  {
			return false;
		  }
    });

	//show modal for staff
        $(document).on('click', '.show-staff', function() {
            $('#show-staff').modal('show');
            $('#s-id').text($(this).data('staff-id'));
            $('#s-name').text($(this).data('staff-name'));
            $('#s-user').text($(this).data('staff-username'));
            $('#s-mail').text($(this).data('staff-mail'));
			$('#s-role').text($(this).data('role'));
			// $('#s-password').text($(this).data('password'));
<<<<<<< HEAD
            $('.modal-title').text('Staff Information');
=======
            $('.modal-title').text('Staff Data Information');
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
        });

        //Edit Modal for pricing
        $(document).on('click', '.edit-staff', function() {
            $('.modal-title').text('Update Information');
            $('.form-horizontal').show();
        });

	//Call to the form-modal
        $(document).on('click','.create-staff', function() {
            $('#create').modal('show');
            $('.form-horizontal').show();
			$('.modal-title').text('Create New Staff');
        });


</script>
