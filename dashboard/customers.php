<?php require_once "db.php" ?>
<div class=" pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Customers</h1>
</div>
<div class="row row-cols-1 row-cols-md-3">
<?php
  if ($result = mysqli_query($link, "SELECT full_name, company, job_title FROM customers")) {
    while ($customer = mysqli_fetch_array($result)) {
?>
  <div class="col mb-4">
    <div class="card h-100 shadow-sm">
      <h5 class="card-header"><?php echo $customer["full_name"] ?></h5>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <small class="d-block text-muted">Company</small>
          <?php echo $customer["company"] ?>
        </li>
        <li class="list-group-item">
          <small class="d-block text-muted">Job Title</small>
          <?php echo $customer["job_title"] ?>
        </li>
      </ul>
    </div>
  </div>
<?php
    }
  }
?>
</div>