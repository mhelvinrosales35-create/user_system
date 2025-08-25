<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include "config.php";
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
    <form action="add_record.php" method="POST">
        <input type="text" name="name" placeholder="Enter Name" required class="input-text">
        <textarea name="details" placeholder="Enter Details" class="input-text"></textarea>
        <button type="submit" name="add" class="btn">Add Record</button>
    </form>
    <a href="logout.php" class="logout-link">Logout</a>
<br><br><br>
    <h3>Records</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
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
                    <td>{$row['name']}</td>
                    <td>{$row['details']}</td>
                    <td>{$row['date_created']}</td>
                    <td><a href='delete_record.php?id={$row['record_id']}'>Delete</a></td>
                  </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>