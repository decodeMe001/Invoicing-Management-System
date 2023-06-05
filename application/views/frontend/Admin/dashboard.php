<<<<<<< HEAD
<?php
	$total_1 = 0;
	$total_2 = 0;
	$total_3 = 0;
	$total_4 = 0;
	$total_5 = 0;
	$total_6 = 0;
	$total_7 = 0;
	$total_8 = 0;
	$total_9 = 0;
	$total_10 = 0;
	$total_11 = 0;
	$total_12 = 0;
	
	$jan_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 1))->result_array();
	$feb_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 2))->result_array();
	$mar_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 3))->result_array();
	$april_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 4))->result_array();
	$may_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 5))->result_array();
	$june_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 6))->result_array();
	$july_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 7))->result_array();
	$aug_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 8))->result_array();
	$sept_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 9))->result_array();
	$oct_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 10))->result_array();
	$nov_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 11))->result_array();
	$dec_sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => 12))->result_array();
	
	foreach($jan_sales_amt as $sales){
		$total_1 += $sales['order_total'];
	}
	foreach($feb_sales_amt as $sales){
		$total_2 += $sales['order_total'];
	}
	foreach($mar_sales_amt as $sales){
		$total_3 += $sales['order_total'];
	}
	foreach($april_sales_amt as $sales){
		$total_4 += $sales['order_total'];
	}
	foreach($may_sales_amt as $sales){
		$total_5 += $sales['order_total'];
	}
	foreach($june_sales_amt as $sales){
		$total_6 += $sales['order_total'];
	}
	foreach($july_sales_amt as $sales){
		$total_7 += $sales['order_total'];
	}
	foreach($aug_sales_amt as $sales){
		$total_8 += $sales['order_total'];
	}
	foreach($sept_sales_amt as $sales){
		$total_9 += $sales['order_total'];
	}
	foreach($oct_sales_amt as $sales){
		$total_10 += $sales['order_total'];
	}
	foreach($nov_sales_amt as $sales){
		$total_11 += $sales['order_total'];
	}
	foreach($dec_sales_amt as $sales){
		$total_12 += $sales['order_total'];
	}
?>
<?php
	$total = 0;
	foreach($staff_sales_record as $record){
		$total += $record["order_total"];
	}
	$this->db->select("expiry_date");
	$this->db->from("store_product");
	$this->db->where(array('expiry_date <=' => date('Y-m-d')));
	$expired_product_count = $this->db->count_all_results();
?>

<?php
	$sixMonthsFromNow = date('Y-m-d', strtotime('+6 months'));
	$this->db->select('*');
	$this->db->from('store_product');
	$this->db->where('expiry_date >=', date('Y-m-d'));
	$this->db->where('expiry_date <=', $sixMonthsFromNow);
	$query = $this->db->get();
	$total_rows_going_soon = $query->num_rows();
?>

<a id="sales_id" style="display: none;"
	data-jan_sales_amt="<?=$total_1?>"
	data-feb_sales_amt="<?=$total_2?>"
	data-mar_sales_amt="<?=$total_3?>"
	data-april_sales_amt="<?=$total_4?>"
	data-mar_sales_amt="<?=$total_5?>"
	data-june_sales_amt="<?=$total_6?>"
	data-july_sales_amt="<?=$total_7?>"
	data-aug_sales_amt="<?=$total_8?>"
	data-sept_sales_amt="<?=$total_9?>"
	data-oct_sales_amt="<?=$total_10?>"
	data-nov_sales_amt="<?=$total_11?>"
	data-dec_sales_amt="<?=$total_12?>"
	></a>
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
  <div class="col-xl-4 col-sm-12 mb-4 animated fadeInLeft">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-money fa-1x"></i>
        </div>
        <div class="mr-5"><h6>View Most Sold Product</h6></div>
      </div>
	  <a class="card-footer text-white clearfix small z-1" href="<?php  echo base_url();?>admin/most_sold_products">
        <span class="float-left">View Products</span>
        <span class="float-right">
          <i class="fa fa-arrow-circle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-4 col-sm-12 mb-4 animated fadeInRight">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-money fa-1x"></i>
        </div>
        <div class="mr-5"><h6><b>Total Monthly Sales<br/>[&#8358;<?=number_format($monthly_record, 0, '.', ',');?>]</b></h6></div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-sm-12 mb-4 animated fadeInRight">
    <div class="card text-white bg-info o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-money fa-1x"></i>
        </div>
        <div class="mr-5"><h6><b>Monthly Sales Record</b></h6></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php  echo base_url();?>admin/monthly_sales_record">
        <span class="float-left">View Current Month</span>
        <span class="float-right">
          <i class="fa fa-arrow-circle-right"></i>
        </span>
      </a>
    </div>
  </div>
  
</div>

<div class="row">
	<div class="col-xl-4 col-sm-12 mb-4 animated fadeInLeft">
		<div class="card text-white bg-secondary o-hidden h-100">
		  <div class="card-body">
			<div class="card-body-icon">
			  <i class="fa fa-money fa-1x"></i>
			</div>
			<div class="mr-5"><h6><b>All Product Selling Price<br/>[&#8358;<?=number_format($total_sp, 0, '.', ',');?>]</b></h6></div>
		  </div>
		</div>
	</div>
  
  <div class="col-xl-4 col-sm-12 mb-4 animated fadeInLeft">
    <div class="card text-white bg-info o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-money fa-1x"></i>
        </div>
        <div class="mr-5"><h6><b>All Product Market Price<br/>[&#8358;<?=number_format($total_cp, 0, '.', ','); ?>]</b></h6></div>
      </div>
    </div>
  </div>
  
  <div class="col-xl-4 col-sm-12 mb-4 animated fadeInLeft">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-money fa-1x"></i>
        </div>
        <div class="mr-5"><h6><b>Total Product Profit (Stock)<br/>[&#8358;<?=number_format($total_profit, 0, '.', ','); ?>]</b></h6></div>
      </div>
    </div>
  </div>
</div>
<br/><br/>

<div class="row">
	<div class="col-xl-4 col-sm-12 mb-4 animated fadeInLeft">
		<div class="card text-white bg-info o-hidden h-100">
		  <div class="card-body">
			<div class="card-body-icon">
			  <i class="fa fa-money fa-1x"></i>
			</div>
			<div class="mr-5">Total No.: <b>[<?=$total_rows_going_soon;?>]</b></div>
		  </div>
		  <a class="card-footer text-white clearfix small z-1" href="<?php  echo base_url();?>admin/going_soon">
			<span class="float-left">Products Going soon >></span>
			<span class="float-right">
				<i class="fa fa-arrow-circle-right"></i>
			</span>
		  </a>
		</div>
	</div>
  
  <div class="col-xl-4 col-sm-12 mb-4 animated fadeInLeft">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-money fa-1x"></i>
        </div>
        <div class="mr-5">Total No.: <b>[<?=$expired_product_count; ?>]</b></div>
      </div>
	  <a class="card-footer text-white clearfix small z-1" href="<?php  echo base_url();?>admin/expired">
			<span class="float-left">Products Expired >></span>
			<span class="float-right">
				<i class="fa fa-arrow-circle-right"></i>
			</span>
		  </a>
    </div>
  </div>
  
  <div class="col-xl-4 col-sm-12 mb-4 animated fadeInLeft">
    <div class="card text-white bg-secondary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-money fa-1x"></i>
        </div>
        <div class="mr-5"><h6><b>Sales Amount (Daily): &#8358;<?=number_format($total, 2, '.', ',');?></b></h6></div>
      </div>
		<a class="card-footer text-white clearfix small z-1" href="<?php  echo base_url();?>admin/daily_staff_sales_record">
			<span class="float-left">Staff Shift Report >></span>
			<span class="float-right">
				<i class="fa fa-arrow-circle-right"></i>
			</span>
		</a>
    </div>
  </div>
</div>
<br/><br/>

<div class="row">
	<div class="col-sm-12 col-mb-12 col-xl-12">
		<canvas id="myChart"></canvas>
	</div>
</div>
<br/><br/>

<script type="text/javascript">

	const jan_sales_amt = $("#sales_id").data("jan_sales_amt");
	const feb_sales_amt = $("#sales_id").data("feb_sales_amt");
	const mar_sales_amt = $("#sales_id").data("mar_sales_amt");
	const april_sales_amt = $("#sales_id").data("april_sales_amt");
	const may_sales_amt = $("#sales_id").data("may_sales_amt");
	const june_sales_amt = $("#sales_id").data("june_sales_amt");
	const july_sales_amt = $("#sales_id").data("july_sales_amt");
	const aug_sales_amt = $("#sales_id").data("aug_sales_amt");
	const sept_sales_amt = $("#sales_id").data("sept_sales_amt");
	const oct_sales_amt = $("#sales_id").data("oct_sales_amt");
	const nov_sales_amt = $("#sales_id").data("nov_sales_amt");
	const dec_sales_amt = $("#sales_id").data("dec_sales_amt");
	
	const labels = [
		"January",
		"February",
		"March",
		"April",
		"May",
		"June",
		"July",
		"August",
		"September",
		"October",
		"November",
		"December",
		];
		
	const data = {
		labels: labels,
		datasets: [{
			label: "Monthly Sales Report",
			backgroundColor: "rgb(255, 99, 132)",
			borderColor: "rgb(255, 99, 132)",
			data: [jan_sales_amt, feb_sales_amt, mar_sales_amt, 
					april_sales_amt, may_sales_amt, june_sales_amt, 
					july_sales_amt, aug_sales_amt, sept_sales_amt, 
					oct_sales_amt, nov_sales_amt, dec_sales_amt],
		}]
	};
	
	const config = {
		type: "bar",
		data: data,
		options: {}
	};
	
	const myChart = new Chart(document.getElementById("myChart"), config);
=======
<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
	<li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="row">
	<div class="col-xl-6 col-md-6">
		<div class="card bg-primary text-white mb-4">
			<div class="card-body">Ice-cream Profit: [&#8358;<span id="ice_cream"></span>] ---- ----[VAT: &#8358;<span id="vat"> </span>]</div>
			<div class="card-footer d-flex align-items-center justify-content-between">
				<a class="small text-white stretched-link" href="<?php echo base_url(); ?>admin/ice_cream">View Details</a>
				<div class="small text-white"><i class="fa fa-angle-right"></i></div>
			</div>
		</div>
	</div>
	<div class="col-xl-6 col-md-6">
		<div class="card bg-success text-white mb-4">
			<div class="card-body">Stationary Profit: &#8358;<span id="stationary"></span></div>
			<div class="card-footer d-flex align-items-center justify-content-between">
				<a class="small text-white stretched-link" href="<?php echo base_url(); ?>admin/stationary">View Details</a>
				<div class="small text-white"><i class="fa fa-angle-right"></i></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-6">
		<div class="card mb-4">
			<div class="card-header">
				<i class="fa fa-chart-bar mr-1"></i>
				Monthly IceCream Revenue Chart
			</div>
			<div class="card-body"><canvas id="ice_cream_chart" width="100%" height="40"></canvas></div>
		</div>
	</div>
	<div class="col-xl-6">
		<div class="card mb-4">
			<div class="card-header">
				<i class="fa fa-chart-bar mr-1"></i>
				Monthly Stationary Revenue Chart
			</div>
			<div class="card-body"><canvas id="stationary_chart" width="100%" height="40"></canvas></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-12">
		<div class="card mb-4">
			<div class="card-header">
				<i class="fa fa-chart-bar mr-1"></i>
				Profit Margin
			</div>
			<div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// Set new default font family and font color to mimic Bootstrap's default styling
	Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#292b2c';
	
	$(document).ready(function(){
		var url = '<?=base_url(); ?>';
		let ice_cream_data = [];
		$.ajax({
			method: 'GET',
			url: url + 'admin/get_ice_cream_list',
			dataType: 'json',
			success: function(response){
				ice_cream_data = [...response.data];
				let jan_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "01").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let feb_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "02").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let mar_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "03").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let apr_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "04").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let may_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "05").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let jun_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "06").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let jly_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "07").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let aug_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "08").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let sept_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "09").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let oct_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "10").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let nov_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "11").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let dec_count = ice_cream_data.filter(item => item.payment_date.split('-')[1] === "12").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				// Bar Chart Ice-cream
				var ctx = document.getElementById("ice_cream_chart");
				var myLineChart = new Chart(ctx, {
				  type: 'bar',
				  data: {
					labels: ["January", "February", "March", "April", "May", "June", "June", "July", "August", "September", "October", "November", "December"],
					datasets: [{
					  label: "Revenue",
					  backgroundColor: "rgba(2,117,216,1)",
					  borderColor: "rgba(2,117,216,1)",
					  data: [jan_count, feb_count, mar_count, apr_count, may_count, jun_count, jly_count, aug_count, sept_count, oct_count, nov_count, dec_count],
					}],
				  },
				options: {
					scales: {
					  xAxes: [{
						time: {
						  unit: 'month'
						},
						gridLines: {
						  display: false
						},
						ticks: {
						  maxTicksLimit: 12
						}
					  }],
					  yAxes: [{
						ticks: {
						  min: 0,
						  max: 1000000,
						  maxTicksLimit: 6
						},
						gridLines: {
						  display: true
						}
					  }],
					},
					legend: {
					  display: false
					}
				}
				});
			}
		});
			
		let stationary_data = [];
		$.ajax({
			method: 'GET',
			url: url + 'admin/get_stationary_list',
			dataType: 'json',
			success: function(response){
				stationary_data = [...response.data];
				let jan_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "01").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let feb_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "02").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let mar_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "03").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let apr_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "04").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let may_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "05").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let jun_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "06").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let jly_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "07").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let aug_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "08").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let sept_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "09").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let oct_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "10").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let nov_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "11").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				let dec_count = stationary_data.filter(item => item.payment_date.split('-')[1] === "12").reduce((sum, item) => sum += item.total_selling_price - 0, 0);
				// Bar Chart Ice-cream
				var ctx = document.getElementById("stationary_chart");
				var myLineChart = new Chart(ctx, {
				  type: 'bar',
				  data: {
					labels: ["January", "February", "March", "April", "May", "June", "June", "July", "August", "September", "October", "November", "December"],
					datasets: [{
					  label: "Revenue",
					  backgroundColor: "rgba(2,117,216,1)",
					  borderColor: "rgba(2,117,216,1)",
					  data: [jan_count, feb_count, mar_count, apr_count, may_count, jun_count, jly_count, aug_count, sept_count, oct_count, nov_count, dec_count],
					}],
				  },
				  options: {
					scales: {
					  xAxes: [{
						time: {
						  unit: 'month'
						},
						gridLines: {
						  display: false
						},
						ticks: {
						  maxTicksLimit: 12
						}
					  }],
					  yAxes: [{
						ticks: {
						  min: 0,
						  max: 1000000,
						  maxTicksLimit: 6
						},
						gridLines: {
						  display: true
						}
					  }],
					},
					legend: {
					  display: false
					}
				  }
				});
			}
		});
	
	//PieChart for Profit Margin
	let ice_cream_profit_margin = [];
	let stationary_profit_margin = [];
	let vat_on_ice_cream = [];
	
	$.ajax({
		method: 'GET',
		url: url + 'admin/get_profit_margin',
		dataType: 'json',
		success: function(response){
			ice_cream_profit_margin = [...response.data.ice_cream];
			stationary_profit_margin = [...response.data.stationary];
			vat_on_ice_cream = [...response.data.vat];
			let ice_cream_profit = ice_cream_profit_margin.reduce((sum, item) => sum += item.profit - 0, 0);
			let stationary_profit = stationary_profit_margin.reduce((sum, item) => sum += item.profit - 0, 0);
			let vat = vat_on_ice_cream.reduce((sum, item) => sum += item.vat - 0, 0);
			let ice_cream_profit_after_vat = ice_cream_profit - vat;
			$('#ice_cream').text(ice_cream_profit_after_vat.toLocaleString('en-US'));
			$('#vat').text(vat.toLocaleString('en-US'));
			$('#stationary').text(stationary_profit.toLocaleString('en-US'));
			let ctx = document.getElementById("myPieChart");
			let myPieChart = new Chart(ctx, {
			  type: 'pie',
			  data: {
				labels: ["Stationary", "Ice-cream"],
				datasets: [{
				  data: [stationary_profit, ice_cream_profit_after_vat],
				  backgroundColor: ['#dc3545', '#28a745'],
				}],
			  },
			});
		}
	});
	
});

>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
</script>
