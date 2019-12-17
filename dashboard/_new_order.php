<?php

require_once "../db.php";

$err = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $customer_id = intval($_POST["customer_id"]);

  // It means that it's a new customer, not an existing one
  if ($customer_id == 0) {
    if (empty(trim($_POST["customer_full_name"]))) {
      $err["customer_full_name"] = "Please enter the customer's full name.";
    } else {
      $customer_full_name = trim($_POST["customer_full_name"]);
    }

    if (empty(trim($_POST["customer_company"]))) {
      $err["customer_company"] = "Please enter the customer's company.";
    } else {
      $customer_company = trim($_POST["customer_company"]);
    }

    if (empty(trim($_POST["customer_job_title"]))) {
      $err["customer_job_title"] = "Please enter the customer's job title.";
    } else {
      $customer_job_title = trim($_POST["customer_job_title"]);
    }
  }

  if (count($err) == 0) {
    if ($customer_id == 0) {
      $query = "INSERT INTO customers (full_name, company, job_title) VALUES (?, ?, ?)";
      
      if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "sss", $param_full_name, $param_company, $param_job_title);
        $param_full_name = $customer_full_name;
        $param_company = $customer_company;
        $param_job_title = $customer_job_title;
        
        if (mysqli_stmt_execute($stmt)) {
          $customer_id = mysqli_insert_id($link);
        } else {
          $err["sql"] = mysqli_stmt_error($stmt);
        }
      
        mysqli_stmt_close($stmt);
      }
    }

    // Let's get the car's ID
    if ($stmt = mysqli_prepare($link, "SELECT id FROM cars WHERE make = ? AND model = ?")) {
      mysqli_stmt_bind_param($stmt, "ss", $param_make, $param_model);
      $param_make = $_POST["car_make"];
      $param_model = $_POST["car_model"];
      
      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $car_id);
        mysqli_stmt_fetch($stmt);
      } else {
        $err["sql"] = mysqli_stmt_error($stmt);
      }

      mysqli_stmt_close($stmt);
    }

    if (isset($customer_id) && isset($car_id)) {
      $query = "INSERT INTO orders (customer_id, car_id, date) VALUES (?, ?, CURDATE())";
      
      if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "ii", $param_customer_id, $param_car_id);
        $param_customer_id = $customer_id;
        $param_car_id = $car_id;
        
        if (!mysqli_stmt_execute($stmt)) {
          $err["sql"] = mysqli_stmt_error($stmt);
        }
      
        mysqli_stmt_close($stmt);
      }
    }
  }
}

if (!isset($err["sql"]) && !empty(mysqli_error($link)))
  $err["sql"] = mysqli_error($link);

echo json_encode($err);