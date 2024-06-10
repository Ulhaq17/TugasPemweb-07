<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
    <h2>Login</h2>
        <form action="index.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <div class="button-container">
                <input type="submit" name="login" value="Login">
                <a href="register.php" class="register-btn">Register</a>
            </div>
        </form>
        <?php
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $conn = new mysqli('localhost', 'root', '', 'inventory');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM user WHERE username='$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    session_start();
                    $_SESSION['username'] = $username;
                    header("Location: ../inventory/inventory.php");
                    exit();
                } else {
                    echo "<p class='message'>Invalid password.</p>";
                }
            } else {
                echo "<p class='message'>No user found with that username.</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
