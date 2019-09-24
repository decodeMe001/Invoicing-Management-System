<?php
	$invoice_order_total = $this->db->count_all('invoice_order');
	$invoice_order_item_total = $this->db->count_all('invoice_order_item');
	$total_customers = $this->db->count_all('customers');

?>
<!-- Breadcrumbs-->
	<ol class="breadcrumb animated slideInDown">
	  <li class="breadcrumb-item">
	    <a href="<?php echo base_url(); ?>admin/dashboard" style="text-decoration:none;">Dashboard</a>
	  </li>
	  <li class="breadcrumb-item active">Overview</li>
	</ol>

<!-- /.row -->
<!-- Icon Cards-->
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3 animated fadeInLeft">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-envelope fa-1x"></i>
        </div>
        <div class="mr-5"><b>[<?= $invoice_order_total ?>]</b> Invoice Order</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php  echo base_url();?>admin/invoice">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-arrow-circle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3 animated fadeInLeft">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-tasks fa-1x"></i>
        </div>
        <div class="mr-5"><b>[<?= $invoice_order_item_total ?>]</b> Total Sales</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php  echo base_url();?>admin/sales">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-arrow-circle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3 animated fadeInRight">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-users fa-1x"></i>
        </div>
        <div class="mr-5"><b>[<?= $total_customers;?>]</b> Manage Customers</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url();?>admin/customer">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-arrow-circle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3 animated fadeInRight">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-gears fa-1x"></i>
        </div>
        <div class="mr-5">System Settings</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url();?>admin/settings">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-arrow-circle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>
