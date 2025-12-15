<?php
session_start();
if(!isset($_SESSION['admin_id'])) header("Location: admin_login.php");
$conn = new mysqli("localhost","root","","questionsdb");
$id = intval($_GET['id'] ?? 0);
$act = intval($_GET['act'] ?? 0);
$stmt = $conn->prepare("UPDATE questionstable SET ACTIVE=? WHERE id=?");
$stmt->bind_param("ii",$act,$id);
$stmt->execute();
header("Location: manage_questions.php");
exit();
?>
