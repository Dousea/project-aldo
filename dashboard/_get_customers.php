<?php

require_once "../db.php";

$data = array();
$query = "SELECT * FROM customers";

if ($result = mysqli_query($link, $query)) {
  while ($datum = mysqli_fetch_array($result)) {
    $data[intval($datum["id"])] = array(
      "full_name" => $datum["full_name"],
      "company" => $datum["company"],
      "job_title" => $datum["job_title"]
    );
  }
}

echo json_encode($data);