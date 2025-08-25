<?php
include "config.php";

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $details = $_POST['details'];

    $sql = "INSERT INTO records (name, details, date_created) VALUES ('$name', '$details', NOW())";
    if ($conn->query($sql)) {
        header("Location: dashboard.php");
        exit(); // importante para tumigil agad
    } else {
        echo "Error: " . $conn->error;
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
            <label for="name"> Name </label>
            <input type="text" name="name" required>

            <label for="details">Details</label>
            <textarea name="details" required></textarea>

            <button type="submit" name="add">Add Record</button>
        </form>
        <p><a href="dashboard.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
✅ Fix 2 (gamitin prepared statement — mas safe)
php
Copy
Edit
<?php
include "config.php";

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $details = $_POST['details'];

    $stmt = $conn->prepare("INSERT INTO records (name, details, date_created) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $name, $details);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>