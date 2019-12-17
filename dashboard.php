<?php
  if ($_SERVER["REQUEST_METHOD"] == "GET")
    $tab = &$_GET["tab"];

  $tab = isset($tab) ? $tab : "index";

  if (!file_exists("dashboard/$tab.php"))
    $tab = "index";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "dashboard/_metadata.php" ?>
  <link href="stylesheets/dashboard.css" rel="stylesheet">
  <title>Dashboard · Car Dealership</title>
</head>

<body>
  <?php include "dashboard/_nav.php" ?>

  <div class="container-fluid">
    <div class="row">
      <?php include "dashboard/_sidebar.php" ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <?php include "dashboard/$tab.php" ?>
      </main>
    </div>
  </div>

  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  
  <script>
    feather.replace()
  </script>
  
  <?php
    if (file_exists("dashboard/$tab.js"))
      echo "<script src='dashboard/$tab.js'></script>";
  ?>
</body>

</html>