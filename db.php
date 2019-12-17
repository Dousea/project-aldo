<?php

$link = mysqli_connect("localhost", "root", "", "dealership");

if (!$link)
  echo "Can't connect to MySQL!<br>" . mysqli_error($link);