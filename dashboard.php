<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
<div class="card">
    <h3>Add Record</h3>
    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required class="input-text">
        <input type="text" name="first_name" placeholder="Enter First Name" required class="input-text">
        <input type="text" name="last_name" placeholder="Enter Last Name" required class="input-text">
        <textarea name="details" placeholder="Enter Details" class="input-text" required></textarea>
        <button type="submit" name="add" class="btn">Add Record</button>
    </form>
    <a href="logout.php" class="logout-link">Logout</a>
<br><br><br>
    <h3>Records</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Details</th>
            <th>Date Created</th>
            <th>Action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM records ORDER BY record_id DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['record_id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['details']}</td>
                    <td>{$row['date_created']}</td>
                    <td><a href='delete_record.php?id={$row['record_id']}'
                           onclick=\"return confirm('Are you sure you want to delete this record?');\">
                           Delete</a></td>
                  </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
