<?php
session_start();

// Admin protection (optional but recommended)
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "questionsdb");
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM questionstable WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record";
    }
}
?>
