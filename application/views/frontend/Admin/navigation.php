<style>
	.active{
		background-color: #ccc;
		border: none;
		background-size: cover;
	}
	.active:focus {
		background-color: #ccc;
		border: none; 
		background-size: cover;
	}
</style>
<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
			<li class="sidebar-search">
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button">
						<i class="fa fa-search"></i>
					</button>
				</span>
				</div>
				<!-- /input-group -->
			</li>
			<!-- DASHBOARD -->
			<li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
				<a href="<?php echo base_url(); ?>admin/dashboard">
					<i class="fa fa-desktop"></i>
					<span><?php echo 'Dashboard'; ?></span>
				</a>
			</li>
			<!-- REGISTER VOTERS -->
			<li class="<?php if ($page_name == 'manage_invoice') echo 'active'; ?> ">
				<a href="<?php echo base_url(); ?>admin/invoice">
					<i class="fa fa-envelope"></i>
					<span><?php echo 'Manage Invoice'; ?></span>
				</a>
			</li>
			
			<!-- REGISTER VOTERS -->
			<li class="<?php if ($page_name == 'invoice_items') echo 'active'; ?> ">
				<a href="<?php echo base_url(); ?>admin/items">
					<i class="fa fa-home"></i>
					<span><?php echo 'Invoice Bank'; ?></span>
				</a>
			</li>

			<!-- SETTINGS -->
			<li class="<?php if ($page_name == 'sys_settings') echo 'active'; ?> ">
				<a href="<?php echo base_url(); ?>admin/settings">
					<i class="fa fa-gears"></i>
					<span> <?php echo 'System Settings'; ?></span>
				</a>
			 </li>

			 <!-- ACCOUNT -->
			<li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
				<a href="<?php echo base_url(); ?>admin/profile">
					<i class="fa fa-user"></i>
					<span><?php echo 'Profile'; ?></span>
				</a>
			</li>

		</ul>
	</div>
	<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
