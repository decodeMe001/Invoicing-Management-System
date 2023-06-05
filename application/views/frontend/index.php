<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
<head>
	<?php
		$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
		$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
		$account_type   = $this->session->userdata('login_type');
		if($this->session->userdata('login_type') == 'admin' || $this->session->userdata('login_type') == 'manager'){
			$account_type = 'admin';
		}else{
			$account_type = 'staff';
		}
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Web-based Invoicing Management System" />
    <meta name="author" content="Dada Abiola R." />

    <title><?php echo $page_title?> | <?=$system_title?></title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/home-16.png">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.min.css">
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- Page level plugin CSS-->
    <link href="<?php echo base_url();?>assets/css/dataTables.bootstrap4.css" rel="stylesheet">
		<!-- Custom fonts for this template-->
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">

	<link href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css" rel="stylesheet">
	<!-- Custom styles for this template-->
    <link href="<?php echo base_url();?>assets/css/sb-admin.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/metisMenu.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/metisMenu.min.css" rel="stylesheet">

	<style>
		*{
			margin: 0;
			padding: 0;
			-webkit-font-smoothing: antialiased;
			-webkit-text-shadow: rgba(0, 0, 0, .01) 0 0 1px;
			text-shadow: rgba(0, 0, 0, .1) 0 0 1px;
			box-sizing: border-box;
		}

		 body {
			 max-width:100%;
			 font-family: serif;
			 font-weight: 400 !important;
			 font-size: 14px !important;
		 }
		 label {
		 	font-weight: 500;
			font-size: 14px;
		 }
		 .fa-edit {
		 	color:#fff;
		 }
		 
		.greenBg{
			background-color: #5d8f92;
			color: #fff;
			font-weight: 600;
			text-align: center;
			text-transform: capitalize;
			border: 1px solid #5d8f92;
		}
		.redBg{
			background-color: #e04851;
			color: #fff;
			font-weight: 600;
			text-align: center;
			text-transform: capitalize;
			border: 1px solid #e04851;
		}
		.yellowBg{
			background-color: #ef9e95;
			color: #fff;
			font-weight: 600;
			text-align: center;
			text-transform: capitalize;
			border: 1px solid #ef9e95;
		}

		.is-hidden{
			display:none;
		}
		
		.printerHeader {
			text-align: center;
			margin-bottom: 15px;
			line-height: 18px;
		}

		.printerTable{
			width: 100% !important;
		}

		.printerLabel {
			font-size: 12px;
			font-weight: 600;
		}

		.printerAddress, .printerPhone {
			font-size: 10px;
		}

		.printerDate{
			font-size: 7px;
		}
		
		td.quantity,
		th.quantity {
			font-weight: normal;
			font-size: 9px;
			margin-right: 5px;
		}

		td.description,
		th.description {
			font-weight: normal;
			font-size: 10px;
		}

		td.price,
		th.price {
			font-weight: normal;
			font-size: 10px;
		}

		td.bdBottom{
			border-bottom: 1px solid #e4e4e4;
		}

		.centered {
			text-align: center;
			align-content: center;
		}
		.summary_list {
			text-align: right;
			font-size: 12px;
		}

		.remark {
			font-size: 12px;
			text-align: center;
		}

		@media print{
			header, footer {
				display: none;
			}
			.row, 
			.sidebar,
			#container-fluid, 
			.table-responsive *{
				display: none !important;
				max-width:100%;
			}
			.print_hide{
				display: none;
			}
			#printerID {
				position: absolute;
				max-width: 100%!important;
				margin:0!important;  
				padding:0!important;  
				text-align:center;
				justify-content:center;
				font-size: 18px;
				line-height: 18px;
			}
		}
		@page{
			font-family: Verdana, Geneva, Tahoma, sans-serif;
			margin: 2cm;
		}
		.print_preview {
			display: none;
			justify-content: center;
			text-align: center;
		}
		

    </style>
</head>
<body id="page-top">

	<!-- Navigation -->
	<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
		<?php
			if($account_type == 'admin' || $account_type == 'manager'){
				echo '<a class="navbar-brand mr-1" href="">Administrator</a>';
			} else{
				echo '<a class="navbar-brand mr-1" href="">Cashier</a>';
			}
		?>
		<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
			<i class="fa fa-bars"></i>
		</button>
		<?php include 'header.php'; ?>
		<?php include 'include_bottom.php'; ?>
	</nav>
	<div id="wrapper">
			<?php include $account_type . '/navigation.php'; ?>
		<!-- Dashboard -->
		<div id="content-wrapper">
			<div class="container-fluid">
				<?php include $account_type . '/' . $page_name . '.php'; ?>
			</div>
			<?php include 'footer.php'; ?>
		</div>
		<!-- End Content-Wrapper  -->
	</div>
<!-- End Wrapper  -->
	<!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#">
      <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </a>
	<?php include 'modal.php'; ?>

	</body>
</html>
	<link href="<?php echo base_url();?>assets/css/datepicker.css">
	<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
=======
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
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3

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
<<<<<<< HEAD
		//DataTable
		$('#data-table').DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			],
			"pageLength": 25,
			order: [[0, "desc"]],
		});

		// scroll body to 0px on click
		$('.scroll-to-top').click(function () {
			$('body, html').animate({
=======

		// scroll body to 0px on click
		$('.scroll-to-top').click(function () {
			$('body,html').animate({
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
				scrollTop: 0
			}, 800);
			return false;
		});
<<<<<<< HEAD
	});
=======
});
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
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
			if ((charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
				(charCode < 48 || charCode > 57))
				return false;
				return true;
			}
			});
</script>

