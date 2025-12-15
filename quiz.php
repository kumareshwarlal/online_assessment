<?php
session_start();
if (!isset($_SESSION['user_id'])) header("Location: student_login.php");

$conn = new mysqli("localhost", "root", "", "questionsdb");

// Load ALL active questions
$result = $conn->query("SELECT * FROM questionstable WHERE ACTIVE=1 ORDER BY SNO");

$questions = [];
while ($row = $result->fetch_assoc()) {

    // Convert A/B/C/D → 1/2/3/4
    $correctNumber = match($row["CORRECT_ANSWER"]) {
        'A' => 1,
        'B' => 2,
        'C' => 3,
        'D' => 4,
        default => null
    };

    $questions[] = [
        "question" => $row["QUESTIONS"],
        "option1" => $row["OPTION_A"],
        "option2" => $row["OPTION_B"],
        "option3" => $row["OPTION_C"],
        "option4" => $row["OPTION_D"],
        "correct" => $correctNumber
    ];
}

$_SESSION["questions"] = $questions;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Mesmerizing Quiz</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(-45deg, #ff9a9e, #fad0c4, #fbc2eb, #a6c1ee);
    background-size: 400% 400%;
    animation: gradientBG 12s ease infinite;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding-top: 20px;
    height: 100vh;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.container {
    width: 900px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(15px);
    padding: 40px;
    border-radius: 25px;
    box-shadow: 0px 25px 60px rgba(0,0,0,0.25);
    animation: fadeIn 1s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

.heading {
    text-align: center;
    font-size: 55px;
    font-weight: 900;
    color: #333;
    letter-spacing: 2px;
}

.timer-box {
    font-size: 22px;
    background: #333;
    color: #fff;
    padding: 10px 22px;
    width: max-content;
    border-radius: 30px;
    float: right;
}

.question {
    font-size: 26px;
    margin-top: 40px;
    font-weight: 600;
}

/* NON-OVERLAPPING OPTIONS FIX */
.option {
    display: flex;
    align-items: center;
    gap: 14px;
    background: #f0f0f0;
    padding: 16px;
    border-radius: 12px;
    margin: 12px 0;
    cursor: pointer;
    transition: 0.3s ease;
    font-size: 18px;
    line-height: 22px;
    width: 100%;
    box-sizing: border-box;
}

.option input {
    transform: scale(1.3);
}

.option:hover {
    background: #e4e4e4;
    transform: translateX(5px);
}

.buttons {
    margin-top: 30px;
}

button {
    padding: 12px 25px;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    cursor: pointer;
    margin-right: 10px;
    transition: 0.3s;
    color: white;
}

.prev { background: #6a5acd; }
.next { background: #4fa3f7; }
.submit { background: #ff4d4d; }

button:hover { transform: scale(1.05); }
</style>

<script>
let questions = <?php echo json_encode($questions); ?>;
let index = 0;
let answers = Array(questions.length).fill(null);
let timer = 600;

function startTimer() {
    setInterval(() => {
        let min = Math.floor(timer / 60);
        let sec = timer % 60;
        document.getElementById("timer").innerHTML =
            min + ":" + (sec < 10 ? "0" + sec : sec);

        if (timer <= 0) submitQuiz();
        timer--;
    }, 1000);
}

function loadQuestion() {
    let q = questions[index];

    document.getElementById("questionText").innerHTML =
        "Q" + (index + 1) + ": " + q.question;

    document.getElementById("opt1").innerHTML = q.option1;
    document.getElementById("opt2").innerHTML = q.option2;
    document.getElementById("opt3").innerHTML = q.option3;
    document.getElementById("opt4").innerHTML = q.option4;

    document.querySelectorAll("input[name='opt']").forEach(r => r.checked = false);

    if (answers[index] !== null) {
        document.getElementById("r" + answers[index]).checked = true;
    }
}

function choose(opt) { answers[index] = opt; }
function nextQ() { if (index < questions.length - 1) { index++; loadQuestion(); } }
function prevQ() { if (index > 0) { index--; loadQuestion(); } }

function submitQuiz() {
    document.getElementById("finalAnswers").value =
        JSON.stringify(answers);
    document.getElementById("quizForm").submit();
}

window.onload = () => { startTimer(); loadQuestion(); }
</script>

</head>
<body>

<div class="container">

<div class="heading">✨ QUIZ TIME ✨</div>

<div class="timer-box" id="timer">10:00</div>

<div class="question" id="questionText"></div>

<label class="option"><input type="radio" id="r1" name="opt" onclick="choose(1)"> <span id="opt1"></span></label>
<label class="option"><input type="radio" id="r2" name="opt" onclick="choose(2)"> <span id="opt2"></span></label>
<label class="option"><input type="radio" id="r3" name="opt" onclick="choose(3)"> <span id="opt3"></span></label>
<label class="option"><input type="radio" id="r4" name="opt" onclick="choose(4)"> <span id="opt4"></span></label>

<div class="buttons">
<button class="prev" onclick="prevQ()">Previous</button>
<button class="next" onclick="nextQ()">Next</button>
<button class="submit" onclick="submitQuiz()">Submit</button>
</div>

<form id="quizForm" action="result.php" method="POST">
    <input type="hidden" id="finalAnswers" name="answers">
</form>

</div>

</body>
</html>
