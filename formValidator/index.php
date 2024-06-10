<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Validator</title>
</head>
<body>
  <h1>Praktikum Form Validator</h1>
  <form action="validator.php" method="post">
    <label for="username">Username: </label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password: </label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="submit">
  </form>
</body>
</html>