<?php require_once "db.php" ?>
<div class=" pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Cars</h1>
</div>
<div class="row row-cols-1 row-cols-md-3">
<?php
  if ($result = mysqli_query($link, "SELECT make, model, model_year, price FROM cars")) {
    while ($car = mysqli_fetch_array($result)) {
?>
  <div class="col mb-4">
    <div class="card h-100 shadow-sm">
      <h5 class="card-header"><?php echo $car["model"] ?></h5>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <small class="d-block text-muted">Make</small>
          <?php echo $car["make"] ?>
        </li>
        <li class="list-group-item">
          <small class="d-block text-muted">Model Year</small>
          <?php echo $car["model_year"] ?>
        </li>
        <li class="list-group-item">
          <small class="d-block text-muted">Price</small>
          $<?php echo $car["price"] ?>
        </li>
      </ul>
    </div>
  </div>
<?php
    }
  }
?>
</div>