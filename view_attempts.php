<?php
session_start();
if(!isset($_SESSION['admin_id'])) header("Location: admin_login.php");
$conn = new mysqli("localhost","root","","questionsdb");
$res = $conn->query("SELECT a.*, u.username FROM attempts a LEFT JOIN users u ON a.user_id=u.id ORDER BY a.attempt_time DESC");
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Attempts</title>
<style>body{font-family:Arial;background:linear-gradient(135deg,#fdfbfb,#ebedee);padding:20px} .wrap{max-width:900px;margin:auto;background:white;padding:16px;border-radius:12px;box-shadow:0 8px 20px rgba(0,0,0,.12)} table{width:100%;border-collapse:collapse} th,td{padding:8px;border-bottom:1px solid #eee}</style>
</head><body>
<div class="wrap">
<h2>Student Attempts</h2>
<p><a href="admin_dashboard.php">Back</a></p>
<table><tr><th>ID</th><th>Student</th><th>Score</th><th>Total</th><th>Date/Time</th></tr>
<?php while($r=$res->fetch_assoc()): ?>
<tr>
<td><?=$r['id']?></td>
<td><?=htmlspecialchars($r['username'])?></td>
<td><?=$r['score']?></td>
<td><?=$r['total_questions']?></td>
<td><?=$r['attempt_time']?></td>
</tr>
<?php endwhile; ?>
</table>
</div>
</body></html>
