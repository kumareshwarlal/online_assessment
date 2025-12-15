<?php
session_start();

$conn = new mysqli("localhost","root","","questionsdb");
if ($conn->connect_error) die("DB err");

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// prepared statement
$stmt = $conn->prepare("SELECT id,username FROM users WHERE username=? AND password=? AND role='student' LIMIT 1");
$stmt->bind_param("ss",$username,$password);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 1) {
    $row = $res->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    header("Location: student_dashboard.php");
    exit();
} else {
    echo "<p style='font-family:Arial;padding:20px;color:#900'>Invalid student credentials. <a href='student_login.php'>Try again</a></p>";
}
?>
