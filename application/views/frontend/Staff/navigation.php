<!-- Sidebar -->
<<<<<<< HEAD
<ul class="sidebar navbar-nav">
  <li class="nav-item <?php if ($page_name == 'dashboard') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>staff/dashboard">
      <i class="fa fa-desktop"></i>
      <span><?php echo 'Dashboard'; ?></span>
    </a>
  </li>
  <li class="nav-item <?php if ($page_name == 'manage_category') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>staff/category">
      <i class="fa fa-sitemap"></i>
      <span><?php echo 'Category'; ?></span>
    </a>
  </li>
  <li class="nav-item <?php if ($page_name == 'checkout') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>staff/checkout">
      <i class="fa fa-shopping-cart"></i>
      <span><?php echo 'Checkout'; ?></span>
    </a>
  </li>
  <li class="nav-item <?php if ($page_name == 'orders') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>staff/sales_order">
      <i class="fa fa-pencil"></i>
      <span><?php echo 'Order'; ?></span>
    </a>
  </li>
  <li class="nav-item <?php if ($page_name == 'cart_items') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>staff/sales_item">
      <i class="fa fa-book"></i>
      <span><?php echo 'Sales Records'; ?></span>
    </a>
  </li>
</ul>
=======
<?php $account_type = $this->session->userdata('login_type'); ?>
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
	<div class="sb-sidenav-menu">
		<div class="nav">
			<div class="sb-sidenav-menu-heading">Business</div>
			<a class="nav-link <?=($page_name == 'dashboard') ? 'active': '' ?>" href="<?php echo base_url(); ?>staff/dashboard">
				<div class="sb-nav-link-icon">
					<i class="fa fa-desktop"></i>
				</div>
				<span><?php echo 'Dashboard'; ?></span>
			</a>
			<a class="nav-link collapsed <?=($page_name == 'supplier') || ($page_name == 'vendor')  ? 'active': '' ?>" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
				<div class="sb-nav-link-icon">
					<i class="fa fa-money"></i>
				</div>
				<span><?php echo 'Merchants'; ?></span>
				<div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
			</a>
			<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
				<nav class="sb-sidenav-menu-nested nav">
					<a class="nav-link <?=($page_name == 'vendor') ? 'active': '' ?>" href="<?php echo base_url(); ?>staff/vendor"><span><?php echo 'vendor'; ?></span></a>
					<a class="nav-link <?=($page_name == 'supplier') ? 'active': '' ?>" href="<?php echo base_url(); ?>staff/supplier"><span><?php echo 'supplier'; ?></span></a>
				</nav>
			</div>
			<a class="nav-link <?=($page_name == 'product') || ($page_name == 'category') ? 'active' : '' ?> collapsed" href="#" data-toggle="collapse" data-target="#products" aria-expanded="false" aria-controls="collapseLayouts">
				<div class="sb-nav-link-icon">
					<i class="fa fa-tasks"></i>
				</div>
				<span><?php echo 'Products'; ?></span>
				<div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
			</a>
			<div class="collapse" id="products" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
				<nav class="sb-sidenav-menu-nested nav">
					<a class="nav-link <?=($page_name == 'category') ? 'active' : '' ?>" href="<?php echo base_url(); ?>staff/category"><span><?php echo 'category'; ?></span></a>
					<a class="nav-link <?=($page_name == 'product') ? 'active' : '' ?>" href="<?php echo base_url(); ?>staff/product"><span><?php echo 'products'; ?></span></a>
				</nav>
			</div>
			
			<a class="nav-link <?=($page_name == 'icecream/create_sales') || ($page_name == 'stationary/create_sales') || ($page_name == 'icecream/ice_cream_sales_list') || ($page_name == 'stationary/stationary_sales_list') || ($page_name == 'icecream/items') || ($page_name == 'stationary/items') ? 'active': ''; ?> collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
				<div class="sb-nav-link-icon"><i class="fa fa-book"></i></div>
				<?php echo 'Sales Record'; ?>
				<div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
			</a>
			<div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
				<nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
					<a class="nav-link <?=($page_name == 'icecream/ice_cream_sales_list') || ($page_name == 'icecream/items') || ($page_name == 'icecream/update_sales') || ($page_name == 'icecream/create_sales') ? 'active': ''; ?> collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
						Ice-cream
						<div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
					</a>
					<div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
						<nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link <?=($page_name == 'icecream/ice_cream_sales_list') ? 'active': ''; ?>" href="<?php echo base_url(); ?>staff/ice_cream">Order</a>
							<a class="nav-link <?=($page_name == 'icecream/items') ? 'active': ''; ?>" href="<?php echo base_url(); ?>staff/ice_cream_items">Items</a>
						</nav>
					</div>
					<a class="nav-link <?=($page_name == 'stationary/stationary_sales_list') || ($page_name == 'stationary/items') || ($page_name == 'stationary/update_sales') || ($page_name == 'stationary/create_sales')  ? 'active': ''; ?> collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
						Stationary
						<div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
					</a>
					<div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
						<nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link <?=($page_name == 'stationary/stationary_sales_list') ? 'active': ''; ?>" href="<?php echo base_url(); ?>staff/stationary">Order</a>
							<a class="nav-link <?=($page_name == 'stationary/items') ? 'active': ''; ?>" href="<?php echo base_url(); ?>staff/stationary_items">Items</a>
						</nav>
					</div>
				</nav>
			</div>
		</div>
	</div>
	<div class="sb-sidenav-footer">
		<div class="small">Logged in as:</div>
		<?=$account_type ?>	
	</div>
</nav>

>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
