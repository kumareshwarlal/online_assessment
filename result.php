<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: student_login.php");

$answers = json_decode($_POST['answers'], true);
$questions = $_SESSION['questions'] ?? [];
$score = 0;
$total = count($questions);

for($i=0;$i<$total;$i++){
    // answers array contains numbers 1..4 or null
    if(isset($answers[$i]) && $answers[$i] !== null){
        // compare with question's correct (string "1"/"2"...)
        if((string)$answers[$i] === (string)$questions[$i]['correct']) $score++;
    }
}
// store attempt
$conn = new mysqli("localhost","root","","questionsdb");
$stmt = $conn->prepare("INSERT INTO attempts (user_id,score,total_questions) VALUES (?,?,?)");
$stmt->bind_param("iii", $_SESSION['user_id'], $score, $total);
$stmt->execute();

$_SESSION['userAnswers'] = $answers;
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Score</title>
<style>
body{font-family:Arial;background:linear-gradient(135deg,#ff9a9e,#fad0c4);height:100vh;display:flex;align-items:center;justify-content:center}
.box{background:white;padding:24px;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,.12);text-align:center}
button{padding:10px 14px;border-radius:8px;border:none;background:#6a5acd;color:#fff;cursor:pointer}
</style>
</head>
<body>
<div class="box">
  <h2>Your Score</h2>
  <h1><?= $score ?> / <?= $total ?></h1>
  <form action="view_answers.php" method="POST"><button type="submit">View Answers</button></form>
  <p style="margin-top:12px"><a href="student_dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
