<?php

$username = $_POST['username'];
$password = $_POST['password'];

$valid_username = "admin";
$valid_password = "adminpassword";

if ($username == $valid_username && $password == $valid_password) {
  echo "Login Berhasil";
  header("Location: ../inventory/inventory.php");
  exit();
} else {
  echo "Username atau password salah. Silakan coba lagi.";
}

?>