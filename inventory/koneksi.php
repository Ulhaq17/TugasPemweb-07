<?php

$host="localhost";
$user="root";
$password="";
$db="inventory";

$connection = mysqli_connect($host,$user,$password,$db);

if (!$connection) {
  die("Koneksi Gagal:".mysqli_connect_error());
}