<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "questionsdb");

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']);

// Fetch existing question
$res = $conn->query("SELECT * FROM questionstable WHERE SNO = $id");
if ($res->num_rows == 0) {
    die("Question not found.");
}
$row = $res->fetch_assoc();

// Handle Update
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $question = $_POST['question'];
    $optA = $_POST['optionA'];
    $optB = $_POST['optionB'];
    $optC = $_POST['optionC'];
    $optD = $_POST['optionD'];
    $correct = $_POST['correct']; // A/B/C/D

    $stmt = $conn->prepare("
        UPDATE questionstable
        SET QUESTIONS=?, OPTION_A=?, OPTION_B=?, OPTION_C=?, OPTION_D=?, CORRECT_ANSWER=?
        WHERE SNO=?
    ");
    $stmt->bind_param("ssssssi", $question, $optA, $optB, $optC, $optD, $correct, $id);
    $stmt->execute();

    header("Location: manage_questions.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Question</title>
<style>
body {
    font-family: Arial;
    background: linear-gradient(135deg,#c9e9ff,#f7d0ff);
    padding: 30px;
}
.container {
    width: 700px;
    margin: auto;
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.2);
}
label {
    font-weight: bold;
}
input[type=text], textarea, select {
    width: 100%;
    padding: 10px;
    margin: 8px 0 15px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
}
button {
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    background: #6c63ff;
    color: white;
    cursor: pointer;
    font-size: 16px;
}
a { color:#444; text-decoration:none; }
</style>
</head>
<body>

<div class="container">
<h2>Edit Question</h2>
<p><a href="manage_questions.php">⟵ Back</a></p>

<form method="POST">

    <label>Question</label>
    <textarea name="question" required><?= $row['QUESTIONS'] ?></textarea>

    <label>Option A</label>
    <input type="text" name="optionA" value="<?= $row['OPTION_A'] ?>" required>

    <label>Option B</label>
    <input type="text" name="optionB" value="<?= $row['OPTION_B'] ?>" required>

    <label>Option C</label>
    <input type="text" name="optionC" value="<?= $row['OPTION_C'] ?>" required>

    <label>Option D</label>
    <input type="text" name="optionD" value="<?= $row['OPTION_D'] ?>" required>

    <label>Correct Answer</label>
    <select name="correct" required>
        <option value="A" <?= $row['CORRECT_ANSWER']=="A"?"selected":"" ?>>A</option>
        <option value="B" <?= $row['CORRECT_ANSWER']=="B"?"selected":"" ?>>B</option>
        <option value="C" <?= $row['CORRECT_ANSWER']=="C"?"selected":"" ?>>C</option>
        <option value="D" <?= $row['CORRECT_ANSWER']=="D"?"selected":"" ?>>D</option>
    </select>

    <button type="submit">Update Question</button>

</form>

</div>
</body>
</html>
