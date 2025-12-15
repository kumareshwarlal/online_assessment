<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Dashboard</title>
<style>
body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(135deg,#f6d365,#fda085);
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}
.card{
    background:white;
    padding:26px;
    border-radius:14px;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
    width:900px;
}
.card h2{
    margin-top:0;
}
.actions{
    display:flex;
    gap:14px;
    margin-bottom:18px;
}
.actions a{
    display:inline-block;
    padding:12px 18px;
    border-radius:8px;
    background:#6a5acd;
    color:#fff;
    text-decoration:none;
    font-weight:bold;
}
.actions a:hover{
    background:#5848c2;
}
.logout{
    background:#ff6b6b !important;
}
.small{
    font-size:14px;
    color:#555;
    margin-top:10px;
}
.msg{
    padding:10px;
    background:#e8fff1;
    color:#2e7d32;
    border-radius:8px;
    margin-bottom:12px;
}
</style>
</head>

<body>
<div class="card">

  <h2>Admin Panel — <?= htmlspecialchars($_SESSION['admin_name']) ?></h2>

  <!-- SUCCESS MESSAGE AFTER DELETE -->
  <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
      <div class="msg">Question deleted successfully.</div>
  <?php endif; ?>

  <div class="actions">
    <a href="manage_questions.php">Manage Questions</a>
    <a href="view_attempts.php">View Attempts</a>
    <a href="logout.php" class="logout">Logout</a>
  </div>

  <p class="small">
    Use <b>Manage Questions</b> to <b>add / edit / delete</b> questions.  
    Use <b>View Attempts</b> to see student quiz history.
  </p>

</div>
</body>
</html>
