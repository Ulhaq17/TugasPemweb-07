<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM items WHERE id=$id";
    $result = $connection->query($sql);
    $item = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    $sql = "UPDATE items SET name='$name', stock=$stock, price=$price WHERE id=$id";
    $connection->query($sql);
    header("Location: inventory.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Barang</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <a href="#">Inventory</a>
            </div>
            <ul class="navbar-menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Update Barang</h1>
        <form action="update.php" method="post" class="form-update-item">
            <input type="hidden" name="update" value="1">
            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
            <label for="name">Nama Barang:</label>
            <input type="text" id="name" name="name" value="<?php echo $item['name']; ?>" required><br><br>

            <label for="stock">Stok Barang:</label>
            <input type="number" id="stock" name="stock" value="<?php echo $item['stock']; ?>" required><br><br>

            <label for="price">Harga Barang:</label>
            <input type="number" step="1" id="price" name="price" value="<?php echo $item['price']; ?>" required><br><br>

            <input type="submit" value="Update Barang">
        </form>
    </div>
</body>
</html>

<?php $connection->close(); ?>