<!-- Sidebar -->
<ul class="sidebar navbar-nav">
  <li class="nav-item <?php if ($page_name == 'dashboard') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>admin/dashboard">
      <i class="fa fa-desktop"></i>
      <span><?php echo 'Dashboard'; ?></span>
    </a>
  </li>
  <li class="nav-item <?php if ($page_name == 'customers') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>admin/customers">
      <i class="fa fa-users"></i>
      <span><?php echo 'Product Suppliers'; ?></span>
    </a>
  </li>
  <li class="nav-item <?php if ($page_name == 'suppliers') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>admin/suppliers">
      <i class="fa fa-users"></i>
      <span><?php echo 'Market Vendor'; ?></span>
    </a>
  </li>
  <li class="nav-item <?php if ($page_name == 'expenses') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>admin/expenses">
      <i class="fa fa-cogs"></i>
      <span><?php echo 'Expenses'; ?></span>
    </a>
  </li>
  <li class="nav-item <?php if ($page_name == 'manage_category') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>admin/category">
      <i class="fa fa-sitemap"></i>
      <span><?php echo 'Category'; ?></span>
    </a>
  </li>

  <li class="nav-item <?php if ($page_name == 'manage_product') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>admin/product">
      <i class="fa fa-tasks"></i>
      <span><?php echo 'Manage Products'; ?></span>
    </a>
  </li>
  <li class="nav-item <?php if ($page_name == 'checkout') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>admin/checkout">
      <i class="fa fa-shopping-cart"></i>
      <span><?php echo 'Checkout'; ?></span>
    </a>
  </li>
  <li class="nav-item <?php if ($page_name == 'orders') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>admin/sales_order">
      <i class="fa fa-pencil"></i>
      <span><?php echo 'Orders'; ?></span>
    </a>
  </li>
  <li class="nav-item <?php if ($page_name == 'cart_items') echo 'active'; ?>">
    <a class="nav-link" href="<?php echo base_url(); ?>admin/sales_item">
      <i class="fa fa-book"></i>
      <span><?php echo 'Sales Record'; ?></span>
    </a>
  </li>

  <!-- ACCOUNT -->
  <li class="nav-item <?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
    <a class="nav-link" href="<?php echo base_url(); ?>admin/profile">
      <i class="fas fa-fw fa fa-user"></i>
      <span><?php echo 'Staff'; ?></span>
    </a>
  </li>

  <!-- SETTINGS -->
  <li class="nav-item <?php if ($page_name == 'sys_settings') echo 'active'; ?> ">
    <a class="nav-link" href="<?php echo base_url(); ?>admin/settings">
      <i class="fa fa-gears"></i>
      <span> <?php echo 'Settings'; ?></span>
    </a>
   </li>
</ul>
