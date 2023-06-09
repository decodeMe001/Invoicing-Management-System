<!-- Sidebar -->
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
