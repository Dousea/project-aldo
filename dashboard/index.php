<?php require_once "db.php" ?>

<div class="pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard</h1>
</div>

<canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="574" height="242" style="display: block; width: 574px; height: 242px;"></canvas>

<h2>Orders Last 6 Months</h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>Date</th>
        <th>Customer</th>
        <th>Car</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
<?php
  $query = "SELECT orders.date,
                   customers.full_name AS customer,
                   CONCAT(cars.make, ' ', cars.model) AS car,
                   cars.price
            FROM orders
            LEFT JOIN customers ON orders.customer_id = customers.id
            LEFT JOIN cars ON orders.car_id = cars.id
            WHERE TIMESTAMPDIFF(MONTH, orders.date, CURDATE()) < 6
            ORDER BY date DESC";
  
  if ($result = mysqli_query($link, $query)) {
    while ($order = mysqli_fetch_array($result)) {
?>
      <tr>
        <td><?php echo $order["date"] ?></td>
        <td><?php echo $order["customer"] ?></td>
        <td><?php echo $order["car"] ?></td>
        <td>$<?php echo $order["price"] ?></td>
      </tr>
<?php
    }
  }
?>
    </tbody>
  </table>
</div>
