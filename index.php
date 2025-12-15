<?php
// index.php - Splash title page
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome - Online Assessment Quiz</title>
  <meta http-equiv="refresh" content="4;url=choose.php"> <!-- auto-redirect after 4s -->
  <style>
    body{
      margin:0;
      height:100vh;
      display:flex;
      justify-content:center;
      align-items:center;
      background: linear-gradient(135deg,#ffafbd,#ffc3a0,#c3cfe2);
      background-size:400% 400%;
      animation: bg 8s ease infinite;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    @keyframes bg {0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
    h1{font-size:56px; margin:0; color:#fff; text-shadow:0 3px 10px rgba(0,0,0,0.2); text-align:center}
    p{color:#fff; margin-top:12px; font-size:18px;}
    .box{ text-align:center; padding:30px; border-radius:14px; background:rgba(255,255,255,0.08); }
  </style>
</head>
<body>
  <div class="box">
    <h1>Welcome to Online Assessment Quiz</h1>
    <p style="opacity:.95">Starting soon... (You will be redirected)</p>
  </div>
</body>
</html>
