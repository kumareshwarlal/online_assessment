<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "questionsdb");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $question = $_POST['question'];
    $optA = $_POST['optionA'];
    $optB = $_POST['optionB'];
    $optC = $_POST['optionC'];
    $optD = $_POST['optionD'];
    $correct = $_POST['correct'];   // A/B/C/D

    $stmt = $conn->prepare("
        INSERT INTO questionstable 
        (QUESTIONS, OPTION_A, OPTION_B, OPTION_C, OPTION_D, CORRECT_ANSWER, ACTIVE)
        VALUES (?, ?, ?, ?, ?, ?, 1)
    ");
    $stmt->bind_param("ssssss", $question, $optA, $optB, $optC, $optD, $correct);
    $stmt->execute();

    header("Location: manage_questions.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Question</title>
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
a { text-decoration: none; color: #444; }
</style>
</head>
<body>

<div class="container">
<h2>Add New Question</h2>
<p><a href="manage_questions.php">⟵ Back</a></p>

<form method="POST">

    <label>Question</label>
    <textarea name="question" required></textarea>

    <label>Option A</label>
    <input type="text" name="optionA" required>

    <label>Option B</label>
    <input type="text" name="optionB" required>

    <label>Option C</label>
    <input type="text" name="optionC" required>

    <label>Option D</label>
    <input type="text" name="optionD" required>

    <label>Correct Answer</label>
    <select name="correct" required>
        <option value="">-- Select --</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select>

    <button type="submit">Save Question</button>

</form>

</div>
</body>
</html>
