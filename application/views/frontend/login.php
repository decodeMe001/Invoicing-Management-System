<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
	$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Web-based Invoicing Management System" />
    <meta name="author" content="StacksTechnology Group" />
 
    <title><?php echo $page_title?> | <?php echo $system_title?></title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/home-16.png">
    <?php include 'include_top.php';?>
     
</head>
	<body>
		
		<div class="content-wrapper">
			<div class="container">
				<div class="panel-body">
					<div class="login-content">
							<a href="<?php echo base_url(); ?>">
								<img src="<?php echo base_url();?>assets/img/admin.png" height="60" alt="" />
							</a>
							<span>
							<h2 style="color:#cacaca; font-weight: 500;">
								<?php echo $system_name; ?>
							</h2>
							</span>
							<!-- progress bar indicator -->
					</div>
				<?php $attributes = array('method'=>'post','class'=>'login'); echo form_open('account/login', $attributes);?>
					<fieldset>
						<legend class="legend">Login</legend>
						<div class="panel-body">
							<div class="msg"></div>
								<div class="input">
									<div class="form-group">
										<input class="form-control" id="user_name" placeholder="Username" name="user_name" type="text" autocomplete="off"/>
										<span><i class="fa fa-user"></i></span>
									</div>
								</div>
								<div class="input">
									<div class="form-group">
										<input class="form-control" id="password" placeholder="Password" name="password" type="password" autocomplete="off" />
										<span><i class="fa fa-lock"></i></span>
									</div>
								</div>
								<hr>
							<button type="submit" class="submit"><i class="fa fa-long-arrow-right"></i></button>
						</div>
					</fieldset>
					<div class="loading">
						login successful<br/> redirecting...
					</div>

				<?php echo form_close();?>
				</div>
			</div> 
		</div>
		<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.easing.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/validator.js"></script>
		<script src="<?php echo base_url();?>assets/js/login.js"></script>
		<script src="<?php echo base_url();?>assets/js/custom.js"></script>
	</body>
</html>