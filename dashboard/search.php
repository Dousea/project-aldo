<?php
  require_once "db.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["q"])) {
    $pattern = "%$_GET[q]%";

    $orders = array();
    $cars = array();
    $customers = array();
    
    // Orders
    $query = "SELECT orders.date, customers.full_name AS customer, CONCAT(cars.make, ' ', cars.model) AS car
              FROM orders
              LEFT JOIN cars ON orders.car_id = cars.id
              LEFT JOIN customers ON orders.customer_id = customers.id
              WHERE
              customers.full_name LIKE '$pattern' OR
              customers.company LIKE '$pattern' OR
              customers.job_title LIKE '$pattern' OR
              cars.model LIKE '$pattern' OR
              cars.make LIKE '$pattern'
              ORDER BY date DESC";

    if ($result = mysqli_query($link, $query)) {
      while ($order = mysqli_fetch_array($result)) {
        array_push($orders, $order);
      }
    }

    // Cars
    $query = "SELECT make, model, model_year, price FROM cars
              WHERE
              make LIKE '$pattern' OR
              model LIKE '$pattern' OR
              model_year LIKE '$pattern' OR
              price LIKE '$pattern'";
    
    if ($result = mysqli_query($link, $query)) {
      while ($car = mysqli_fetch_array($result)) {
        array_push($cars, $car);
      }
    }

    // Customers
    $query = "SELECT full_name, company, job_title FROM customers
              WHERE
              full_name LIKE '$pattern' OR
              company LIKE '$pattern' OR
              job_title LIKE '$pattern'";
    
    if ($result = mysqli_query($link, $query)) {
      while ($customer = mysqli_fetch_array($result)) {
        array_push($customers, $customer);
      }
    }
  }
?>

<div class="pt-3 mb-1 border-bottom">
  <h1 class="h2">Search</h1>
</div>

<?php
  if (isset($pattern)) {
?>
<div class="mb-3">
  <small class="text-muted">
    <?php echo (count($orders) + count($cars) + count($customers)) . " results found." ?>
  </small>
</div>

<?php
    if (count($orders) > 0) {
?>
<h5>Orders</h5>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>Date</th>
        <th>Customer</th>
        <th>Car</th>
      </tr>
    </thead>
    <tbody>
<?php
      foreach ($orders as $order) {
?>
      <tr>
        <td><?php echo $order["date"] ?></td>
        <td><?php echo $order["customer"] ?></td>
        <td><?php echo $order["car"] ?></td>
      </tr>
<?php
      }
?>
    </tbody>
  </table>
</div>
<?php
    }
?>

<?php
    if (count($cars) > 0) {
?>
<h5>Cars</h5>
<div class="row row-cols-1 row-cols-md-3">
<?php
      foreach ($cars as $car) {
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
?>
</div>
<?php
    }
?>

<?php
    if (count($customers) > 0) {
?>
<h5>Customers</h5>
<div class="row row-cols-1 row-cols-md-3">
<?php
      foreach ($customers as $customer) {
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
?>
</div>
<?php
    }
?>

<?php
  } else {
?>
<p>No query found</p>
<?php
  }
?>