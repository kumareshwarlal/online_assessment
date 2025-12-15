<?php
session_start();
if (!isset($_SESSION['user_id'])) header("Location: student_login.php");

$questions = $_SESSION['questions'] ?? [];
$userAnswers = $_SESSION['userAnswers'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Answer Review</title>

<style>
body {
    font-family: Arial;
    background: linear-gradient(135deg,#a8edea,#fed6e3);
    padding: 30px;
}
.container {
    max-width: 900px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.2);
}
.qbox {
    margin: 20px 0;
}
.correct { color: green; font-weight: bold; }
.wrong { color: red; font-weight: bold; }
</style>

</head>
<body>

<div class="container">
<h2>Answer Review</h2>
<hr>

<?php
for ($i = 0; $i < count($questions); $i++) {

    $q = $questions[$i];

    $selected = $userAnswers[$i] ?? null;

    // Selected answer text
    if ($selected === null) {
        $selectedText = "Not Answered";
    } else {
        $selectedText = $q["option" . $selected];   // FIXED
    }

    // Correct answer text
    $correctText = $q["option" . $q["correct"]];    // FIXED

    // Apply color
    $class = ($selected == $q["correct"]) ? "correct" : "wrong";

    echo "
    <div class='qbox'>
        <strong>Q".($i+1).":</strong> ".htmlspecialchars($q['question'])."<br><br>

        Your Answer: <span class='$class'>".htmlspecialchars($selectedText)."</span><br>
        Correct Answer: <strong>".htmlspecialchars($correctText)."</strong>
    </div>
    <hr>
    ";
}
?>

<a href='student_dashboard.php'>Back</a>

</div>
</body>
</html>
