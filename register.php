<?php
include "config.php";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username','$password')";
    if ($conn->query($sql)) {
        echo "User registered! <a href='index.php'>Login now</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<link rel="stylesheet" href="style.css"> 
<body>
<h2>Register Account</h2>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" name="register">Register</button>
</form>
<p>Already have an account? <a href="index.php">Login here</a></p>
</body>
</html>