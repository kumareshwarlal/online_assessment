<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Login</title>
  <style>
    body{margin:0; font-family:Arial; background:linear-gradient(135deg,#e0c3fc,#8ec5fc); height:100vh;display:flex;align-items:center;justify-content:center}
    .box{background:white;padding:28px;border-radius:12px;width:360px;box-shadow:0 8px 20px rgba(0,0,0,.12);}
    input, button{width:100%;padding:10px;margin-top:10px;border-radius:8px;border:1px solid #ddd;font-size:15px}
    button{background:#ff6b6b;color:#fff;border:none;cursor:pointer}
  </style>
</head>
<body>
  <div class="box">
    <h2>Admin Login</h2>
    <form action="login_process_admin.php" method="POST">
      <input name="username" placeholder="Admin Username" required>
      <input name="password" type="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p style="margin-top:12px;"><a href="choose.php">Back</a></p>
  </div>
</body>
</html>
