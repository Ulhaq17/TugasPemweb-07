<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM items WHERE id=$id";
    $connection->query($sql);

    $sql = "SET @count = 0";
    $connection->query($sql);
    $sql = "UPDATE items SET id = @count := @count + 1";
    $connection->query($sql);
    $sql = "ALTER TABLE items AUTO_INCREMENT = 1";
    $connection->query($sql);
}

header("Location: inventory.php");
exit();

$connection->close();
?>
