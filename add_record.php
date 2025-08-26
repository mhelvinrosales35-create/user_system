<?php
include "config.php";

if (isset($_POST['add'])) {
    $username   = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $details    = $_POST['details'];

   
    $stmt = $conn->prepare("INSERT INTO records (username, first_name, last_name, details, date_created) 
                            VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $username, $first_name, $last_name, $details);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Add Record</h2>
        <form method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" required>

            <label for="first_name">First Name</label>
            <input type="text" name="first_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" required>

            <label for="details">Details</label>
            <textarea name="details" required></textarea>

            <button type="submit" name="add">Add Record</button>
        </form>
        <p><a href="dashboard.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
