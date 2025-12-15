<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: student_login.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Student Dashboard</title>
<style>
  body{margin:0;font-family:Arial;background:linear-gradient(135deg,#ffecd2,#fcb69f);height:100vh;display:flex;align-items:center;justify-content:center}
  .card{background:white;padding:26px;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,.12);text-align:center;width:480px}
  button{padding:12px 20px;border-radius:8px;border:none;background:#6a5acd;color:white;cursor:pointer;font-size:16px}
  .info{margin-bottom:16px}
</style>
</head>
<body>
  <div class="card">
    <div class="info"><h2>Welcome, <?=htmlspecialchars($_SESSION['username'])?></h2>
      <p>Click start to begin the quiz (10 minutes)</p></div>
    <form action="quiz.php" method="POST">
      <!-- optionally pass user id or use session -->
      <input type="hidden" name="start" value="1">
      <button type="submit">Start Quiz</button>
    </form>
    <p style="margin-top:12px;"><a href="choose.php">Back</a> | <a href="logout.php">Logout</a></p>
  </div>
</body>
</html>
