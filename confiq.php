<?php
  define('SERVER', 'localhost');
  define('USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'lendingmanagementsystem');

  $conn = mysqli_connect (SERVER, USERNAME, DB_PASSWORD, DB_NAME);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>