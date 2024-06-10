<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="post">
            Username: <input type="text" name="username" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" name="register" value="Register">
        </form>
        <?php
        if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $conn = new mysqli('localhost', 'root', '', 'inventory');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $check_username_query = "SELECT * FROM user WHERE username = '$username'";
            $check_username_result = $conn->query($check_username_query);
            if ($check_username_result->num_rows > 0) {
                echo "<p class='message'>Error: Username already exists</p>";
                $conn->close();
                exit;
            }

            if(strlen($username) < 6) {
                echo "<p class='message'>Username must be at least 8 characters long</p>";
                exit;
            }
            if (strlen($password) < 8) {
                echo "<p class='message'>Password must be at least 8 characters long</p>";
                exit;
            }

            $password = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

            if ($conn->query($sql) === TRUE) {
                header("Location: index.php");
            } else {
                echo "<p class='message'>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
