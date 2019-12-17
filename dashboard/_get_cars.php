<?php

require_once "../db.php";

$data = array();
$query = "SELECT make, model FROM cars ORDER BY make ASC";

if ($result = mysqli_query($link, $query)) {
  while ($datum = mysqli_fetch_array($result)) {
    $make = $datum["make"];
    $model = $datum["model"];
    
    if (!array_key_exists($make, $data))
      $data[$make] = array();
    
    array_push($data[$make], $model);
  }
}

echo json_encode($data);