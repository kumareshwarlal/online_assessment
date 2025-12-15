<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Student Login</title>
  <style>
    body{margin:0; font-family:Arial; background: linear-gradient(135deg,#fdfbfb,#ebedee); height:100vh; display:flex; align-items:center; justify-content:center;}
    .box{background:linear-gradient(135deg,#fff,#f8f8ff); padding:28px; border-radius:12px; width:360px; box-shadow:0 8px 20px rgba(0,0,0,.12);}
    input, button{width:100%; padding:10px; margin-top:10px; border-radius:8px; border:1px solid #ddd; font-size:15px}
    button{background:#6a5acd; color:#fff; border:none; cursor:pointer}
    .link{margin-top:12px; font-size:14px; text-align:center}
  </style>
</head>
<body>
  <div class="box">
    <h2>Student Login</h2>
    <form action="login_process_student.php" method="POST">
      <input name="username" placeholder="Username" required>
      <input name="password" type="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <div class="link"><a href="choose.php">Back</a></div>
  </div>
</body>
</html>
