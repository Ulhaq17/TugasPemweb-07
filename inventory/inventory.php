<?php
include 'koneksi.php';

// Menambahkan barang baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    // Cek apakah nama barang sudah ada
    $sql = "SELECT COUNT(*) AS count FROM items WHERE name = '$name'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        $error_message = "Nama barang sudah ada. Tidak bisa menambah barang yang sama.";
    } else {
        // Mendapatkan ID terakhir yang digunakan dan menambahkannya dengan 1
        $sql = "SELECT MAX(id) AS max_id FROM items";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $new_id = $row['max_id'] + 1;

        $sql = "INSERT INTO items (id, name, stock, price) VALUES ($new_id, '$name', $stock, $price)";
        if ($connection->query($sql) === TRUE) {
            $success_message = "Barang berhasil ditambahkan.";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $connection->error;
        }
    }
}

// Mengambil data barang dari database
$sql = "SELECT * FROM items";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
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
        <h1>Inventory Management</h1>

        <h2>Tambah Barang</h2>
        <form action="inventory.php" method="post" class="form-add-item">
            <label for="name">Nama Barang:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="stock">Stok Barang:</label>
            <input type="number" id="stock" name="stock" required><br><br>

            <label for="price">Harga Barang:</label>
            <input type="number" step="1" id="price" name="price" required><br><br>

            <input type="submit" value="Tambah Barang"><br><br>

            <?php
            if (!empty($error_message)) {
                echo '<div class="error-message">' . $error_message . '</div>';
            }
            if (!empty($success_message)) {
                echo '<div class="success-message">' . $success_message . '</div>';
            }
            ?>
        </form>

        <h2>Daftar Barang</h2>
        <table class="item-table">
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Stok Barang</th>
                <th>Harga Barang</th>
                <th>Aksi</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                    <a href="update.php?id=<?php echo $row['id']; ?>">Update</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

<?php $connection->close(); ?>