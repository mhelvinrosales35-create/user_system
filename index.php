<?php
session_start();
include "config.php";

if (isset($_POST['submit'])) {
    $action = $_POST['action']; // login or register
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($action == "login") {
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
        } else {
            $error = "Invalid Username or Password!";
        }
    } elseif ($action == "register") {
        $check = $conn->query("SELECT * FROM users WHERE username='$username'");
        if ($check->num_rows > 0) {
            $error = "Username already taken!";
        } else {
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            if ($conn->query($sql)) {
                $success = "Registration successful! You can now log in.";
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login & Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <form method="POST" class="login-box">
            <h2>Login / Register</h2>
            
            <?php 
                if (!empty($error)) echo "<p class='error'>$error</p>"; 
                if (!empty($success)) echo "<p class='success'>$success</p>"; 
            ?>
            
            <input type="text" name="username" placeholder="Username" required class="input-text">
            <input type="password" name="password" placeholder="Password" required class="input-text">
            
            <select name="action" class="input-text">
                <option value="login">Login</option>
                <option value="register">Register</option>
            </select>
            
            <button type="submit" name="submit" class="btn">Submit</button>
        </form>
    </div>
</body>
</html>