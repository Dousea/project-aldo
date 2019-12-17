<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link <?php echo $tab === "index" ? "active" : "" ?>" href="dashboard.php">
          <i data-feather="bar-chart-2"></i>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $tab === "orders" ? "active" : "" ?>" href="dashboard.php?tab=orders">
          <i data-feather="file"></i>
          Orders
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $tab === "cars" ? "active" : "" ?>" href="dashboard.php?tab=cars">
          <i data-feather="truck"></i>
          Cars
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $tab === "customers" ? "active" : "" ?>" href="dashboard.php?tab=customers">
          <i data-feather="users"></i>
          Customers
        </a>
      </li>
    </ul>
  </div>
</nav>