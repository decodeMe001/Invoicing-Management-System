<?php
	$invoice_order_total = $this->db->count_all('invoice_order');
	$invoice_order_item_total = $this->db->count_all('invoice_order_item');
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-envelope fa-4x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $invoice_order_total ?></div>
						<div>Voucher Order</div>
					</div>
				</div>
			</div>
			<a href="<?php  echo base_url();?>admin/invoice">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-tasks fa-4x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $invoice_order_item_total ?></div>
						<div>Voucher Item Bank</div>
					</div>
				</div> 
			</div>
			<a href="<?php  echo base_url();?>admin/items">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-user fa-4x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Profile</div>
						<div>Manage Profile</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/profile">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-gears fa-4x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">System</div>
						<div>System Settings</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/settings">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>
