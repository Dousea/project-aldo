<?php

require_once "../db.php";

$data = array();
$query = "SELECT MONTH(date) AS month, SUM(cars.price) AS sum
          FROM orders LEFT JOIN cars ON orders.car_id = cars.id
          WHERE TIMESTAMPDIFF(MONTH, date, CURDATE()) < 6
          GROUP BY month";

if ($result = mysqli_query($link, $query)) {
  while ($datum = mysqli_fetch_array($result)) {
    array_push($data, array(
      "month" => $datum["month"],
      "sum" => $datum["sum"]
    ));
  }
}

echo json_encode($data);