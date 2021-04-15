<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
	<li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="row">
	<div class="col-xl-6 col-md-6">
		<div class="card bg-primary text-white mb-4">
			<div class="card-body">Ice-cream Profit: [&#8358;<span id="ice_cream"></span>] ---- ----[VAT: &#8358;<span id="vat"> </span>]</div>
			<div class="card-footer d-flex align-items-center justify-content-between">
				<a class="small text-white stretched-link" href="<?php echo base_url(); ?>staff/ice_cream">View Details</a>
				<div class="small text-white"><i class="fa fa-angle-right"></i></div>
			</div>
		</div>
	</div>
	<div class="col-xl-6 col-md-6">
		<div class="card bg-success text-white mb-4">
			<div class="card-body">Stationary Profit: &#8358;<span id="stationary"></span></div>
			<div class="card-footer d-flex align-items-center justify-content-between">
				<a class="small text-white stretched-link" href="<?php echo base_url(); ?>staff/stationary">View Details</a>
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
			url: url + 'staff/get_ice_cream_list',
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
			url: url + 'staff/get_stationary_list',
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
		url: url + 'staff/get_profit_margin',
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

</script>
