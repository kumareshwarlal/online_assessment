<?php
// choose.php - choose Student or Admin
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Choose Login</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">

<style>
*{
    box-sizing: border-box;
}

body{
    margin:0;
    height:100vh;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(-45deg,#89f7fe,#66a6ff,#ff9a9e,#fad0c4);
    background-size: 400% 400%;
    animation: bgMove 10s ease infinite;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* Background animation */
@keyframes bgMove{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

/* Decorative lines */
body::before,
body::after{
    content:"";
    position:absolute;
    width:280px;
    height:280px;
    border-radius:50%;
    background:rgba(255,255,255,0.15);
}
body::before{top:-80px; left:-80px;}
body::after{bottom:-80px; right:-80px;}

/* Main card */
.card{
    background:white;
    padding:40px 30px;
    border-radius:20px;
    width:420px;
    box-shadow:0 25px 50px rgba(0,0,0,.25);
    text-align:center;
    position:relative;
    z-index:1;
}

h2{
    margin:0 0 25px;
    font-size:32px;
    font-weight:800;
    color:#333;
}

/* Login boxes */
.login-box{
    padding:22px;
    border-radius:16px;
    margin-bottom:20px;
    transition:0.35s ease;
    color:white;
}

.login-box:hover{
    transform:translateY(-6px) scale(1.02);
    box-shadow:0 15px 30px rgba(0,0,0,.25);
}

.student{
    background:linear-gradient(135deg,#6a5acd,#836fff);
}

.admin{
    background:linear-gradient(135deg,#ff6b6b,#ff8e8e);
}

.login-box h3{
    margin:0 0 14px;
    font-size:22px;
    font-weight:700;
}

/* Buttons */
.login-box button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:rgba(255,255,255,.25);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.login-box button:hover{
    background:rgba(255,255,255,.4);
}
</style>
</head>

<body>

<div class="card">
    <h2>Sign in as</h2>

    <div class="login-box student">
        <h3>Student Login</h3>
        <form action="student_login.php" method="get">
            <button type="submit">Continue</button>
        </form>
    </div>

    <div class="login-box admin">
        <h3>Admin Login</h3>
        <form action="admin_login.php" method="get">
            <button type="submit">Continue</button>
        </form>
    </div>
</div>

</body>
</html>
