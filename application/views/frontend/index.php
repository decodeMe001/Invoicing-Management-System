<!DOCTYPE html>
<html lang="en">
    <head>
		<?php
		$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
		$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
		$account_type   = $this->session->userdata('login_type');
		?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="Web-based Invoicing Management System" />
		<meta name="author" content="Dada Abiola R." />

		<title><?php echo $page_title?> | <?php echo $system_title?></title>
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/home-16.png">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.min.css">
		<link href="<?php echo base_url();?>assets/css/sb-admin.css" rel="stylesheet">
		<!-- Page level plugin CSS-->
		<link href="<?php echo base_url();?>assets/css/dataTables.bootstrap4.css" rel="stylesheet">
		<!-- Custom fonts for this template-->
		<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/fonts/fontawesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">

		<link href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css" rel="stylesheet">
		<!-- Custom styles for this template-->
		<link href="<?php echo base_url();?>assets/css/styles.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/metisMenu.min.css" rel="stylesheet">
    </head>
    <body class="sb-nav-fixed">
		<?php if ($account_type !== null) { ?>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark static-top">
            <a class="navbar-brand mr-1" href="<?php echo base_url(); ?>admin/dashboard">Admin</a>
			<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
				<i class="fa fa-bars"></i>
			</button>
			<?php include 'header.php'; ?>
			<?php include 'include_bottom.php'; ?>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php include $account_type . '/navigation.php'; ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
						<?php include $account_type . '/' . $page_name . '.php'; ?>
					</div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <?php include 'footer.php'; ?>
                </footer>
            </div>
        </div>
		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#">
		  <i class="fa fa-arrow-up" aria-hidden="true"></i>
		</a>
		<?php include 'modal.php'; ?>
		<?php } else { include 'login.php' ?>
			
		<?php } ?>
    </body>
</html>

<script type="text/javascript">
	//DataTable
	$(document).ready(function() {
		$('#data-table').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"pageLength": 25
		});
	});
	
 	//Date Object
	$(document).ready(function() {
		$('#order_date').datepicker({
			format: "dd/mm/yyyy",
			autoclose: true
		});

		// scroll body to 0px on click
		$('.scroll-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
});
</script>

<script>
		//Validationon key press
		$(document).ready(function(){
			$('.number_only').keypress(function(e){
			return isNumbers(e, this);
			});
			function isNumbers(evt, element)
			{
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if (
				(charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
				(charCode < 48 || charCode > 57))
				return false;
				return true;
			}
			});
</script>

