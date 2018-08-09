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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Web-based Invoicing Management System" />
    <meta name="author" content="StacksTechnology Group" />
 
    <title><?php echo $page_title?> | <?php echo $system_title?></title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/home-16.png">
		<!--Google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.min.css">
	<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- CONTENT-WRAPPER SECTION END-->
    <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"></script>

	
	
	<link href="<?php echo base_url();?>assets/css/dataTables.bootstrap.min.css">
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/sb-admin-2.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/metisMenu.min.css" rel="stylesheet">
	<!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/js/sb-admin-2.min.js"></script>
	
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/js/metisMenu.min.js"></script>	
	
     <style>
      /* Remove the navbar's default margin-bottom and rounded borders */ 
      .navbar {
      margin-bottom: 4px;
      border-radius: 0;
      }
      /* Add a gray background color and some padding to the footer */
      footer {
      background-color: #f2f2f2;
      padding: 25px;
      }
      .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
      }
      .navbar-brand
      {
      padding:5px 40px;
      }
      .navbar-brand:hover
      {
      background-color:#ffffff;
      }
      /* Hide the carousel text when the screen is less than 600 pixels wide */
      @media (max-width: 600px) {
      .carousel-caption {
      display: none; 
      }
      }
    </style>
</head>
<body style="font-family: Georgia; font-weight:500;">
	<style>
		.box{
			width: 100%;
			border-radius: 5px;
			border: 1px solid #ccc;
			padding: 15px;
			margin: 0 auto;
			margin-top: 50px;
			box-sizing: border-box;
		}
		.dataTables_filter {
			float: right !important;
		}
		.btn-send {
			font-weight: 300;
			text-transform: uppercase;
			letter-spacing: 0.1em;
			margin-bottom: 20px;
		}
	</style>
	<link href="<?php echo base_url();?>assets/css/datepicker.css">
	<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
	<script>
		$(document).ready(function(){
			$('#order_date').datepicker({
				format: "dd-mm-yyyy",
				autoclose: true
			});
		});
	</script>

	<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<?php include 'header.php'; ?>
			<?php include $account_type .'/'. 'navigation.php'; ?>
		</nav>
		<!-- Dashboard -->
		<div id="page-wrapper">
			<?php include $account_type . '/' . $page_name . '.php'; ?>
		</div>
	</div>
	<?php include 'footer.php'; ?>
    
    
</body>
</html>
 <script type="text/javascript">
  $(document).ready(function(){
    var table = $('#data-table').DataTable({
          "order":[],
          "columnDefs":[
          {
            "targets":[4, 5, 6],
            "orderable":false,
          },
        ],
        "pageLength": 25
        });
	  
    $(document).on('click', '.delete', function(){
      var id = $(this).attr("id");
      if(confirm("Are you sure you want to remove this?"))
      {
        window.location.href = base_url("admin/invoice");
      }
      else
      {
        return false;
      }
    });
  });

</script>

<script>
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
