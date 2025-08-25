<?php
session_start();
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM records WHERE record_id=$id";
    if ($conn->query($sql)) {
        header("Location: dashboard.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>