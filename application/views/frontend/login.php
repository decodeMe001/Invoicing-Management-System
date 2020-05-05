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
	<style>
		span{
			font-size: 10px;
		}
	</style>
     
</head>
	<body>
		<div class="content-wrapper">
			<div class="container">
				<div class="panel-body">
					<div class="login-content">
						<center>
							<span>
							<h2 style="color:#cacaca; font-weight: 500;">
								<?php echo $system_name; ?>
							</h2>
							</span>
						</center>
					</div>
				<form id="logForm" class="login">
					<fieldset>
						<legend class="legend"><span class="fa fa-lock fa-2x"></span> Login</legend>
							<div class="panel-body">
								<div id="messages"></div>
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
								<center>
									<span id="logText" style="color:#2482e4;"></span><br/>
								</center>
								<hr>
								<button type="submit" class="submit" id="access"><i class="fa fa-long-arrow-right"></i></button>
							</div>
					</fieldset>
				</form>
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
<script type="text/javascript">
	$(document).ready(function(){
		$('.login').unbind('submit').bind('submit', function (e) {
			e.preventDefault();
			
			var url = '<?php echo base_url(); ?>';
			var form = $(this);
			var login = function(){
				$.ajax({
					type: 'POST',
					url: url + 'account/login',
					dataType: 'json',
					data: form.serialize(),
					success:function(response){
						
						if(response.success == true) {
							$(".text-danger").remove();
							$(".form-group").removeClass('has-error').removeClass('has-success');
							window.location.href = response.redirect_url;	
							
						}
						else {
						 	if(response.messages instanceof Object) {
								$.each(response.messages, function(index, value) {
									var element = $("#"+index);

									$(element)
									.closest('.form-group')
									.removeClass('has-error')
									.removeClass('has-success')
									.addClass(value.length > 0 ? 'has-error' : 'has-success')
									.find('.text-danger').remove();

									$(element).after(value);
									$("#logText").hide();
								});
							} 
							else {						
								$("#messages").html('<div class="alert alert-danger alert-dismissible" role="alert" style="font-size:12px;">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								response.messages+
							'</div>');

								$(".text-danger").remove();
								$(".form-group").removeClass('has-error').removeClass('has-success');		
								$("#logText").hide();			
							}	
						}
					}
				});
			};
			/* execute login func after 3secs */
			setTimeout(login, 3000);
		});

//		$(document).on('click', '#clearMsg', function(){
//			$('#messages').hide();
//		});
	});
</script>