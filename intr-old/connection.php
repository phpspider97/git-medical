<?php
$servername = "68.178.238.97";
$username = "bbg-secret-menu1";
$password = "JIBdHC3v^wP#";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>