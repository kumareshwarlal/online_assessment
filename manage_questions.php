<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "questionsdb");
if ($conn->connect_error) {
    die("Database connection failed");
}

/* ===============================
   DELETE QUESTION LOGIC
   =============================== */
if (isset($_GET['del'])) {
    $sno = intval($_GET['del']);

    $stmt = $conn->prepare("DELETE FROM questionstable WHERE SNO = ?");
    $stmt->bind_param("i", $sno);
    $stmt->execute();

    header("Location: manage_questions.php?msg=deleted");
    exit();
}

/* ===============================
   ACTIVATE / DEACTIVATE LOGIC
   =============================== */
if (isset($_GET['id']) && isset($_GET['act'])) {
    $id = intval($_GET['id']);
    $active = intval($_GET['act']);

    $stmt = $conn->prepare("UPDATE questionstable SET ACTIVE=? WHERE SNO=?");
    $stmt->bind_param("ii", $active, $id);
    $stmt->execute();

    header("Location: manage_questions.php");
    exit();
}

$result = $conn->query("SELECT * FROM questionstable ORDER BY SNO ASC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Questions</title>
<style>
body { font-family: Arial; background:#c8edf0; padding:20px; }
.container {
    width: 90%;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.2);
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}
th, td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: left;
    vertical-align: top;
}
button {
    background:#6c63ff;
    color:white;
    padding:6px 12px;
    border-radius:8px;
    border:none;
    cursor:pointer;
}
.status-active { color: green; font-weight: bold; }
.status-inactive { color: red; font-weight: bold; }

a.action-btn {
    padding:6px 12px;
    border-radius:6px;
    color:white;
    text-decoration:none;
    margin-right:6px;
    display:inline-block;
}
.edit { background:#4fa3f7; }
.deact { background:#ff9800; }
.activate { background:#4caf50; }
.delete { background:#f44336; }
.msg {
    background:#e8fff1;
    color:#2e7d32;
    padding:10px;
    border-radius:8px;
    margin-bottom:12px;
}
</style>
</head>
<body>

<div class="container">
<h2>Manage Questions</h2>

<a href="admin_dashboard.php">⬅ Back</a> |
<a href="add_question.php"><button>Add Question</button></a>

<?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
    <div class="msg">Question deleted successfully.</div>
<?php endif; ?>

<table>
<tr>
    <th>SNO</th>
    <th>Question</th>
    <th>Options</th>
    <th>Correct</th>
    <th>Active</th>
    <th>Actions</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['SNO'] ?></td>

    <td><?= htmlspecialchars($row['QUESTIONS']) ?></td>

    <td>
       A. <?= htmlspecialchars($row['OPTION_A']) ?><br>
       B. <?= htmlspecialchars($row['OPTION_B']) ?><br>
       C. <?= htmlspecialchars($row['OPTION_C']) ?><br>
       D. <?= htmlspecialchars($row['OPTION_D']) ?>
    </td>

    <td><b><?= htmlspecialchars($row['CORRECT_ANSWER']) ?></b></td>

    <td class="<?= $row['ACTIVE'] ? 'status-active' : 'status-inactive' ?>">
        <?= $row['ACTIVE'] ? 'Yes' : 'No' ?>
    </td>

    <td>
        <a class="action-btn edit" href="edit_question.php?id=<?= $row['SNO'] ?>">Edit</a>

        <?php if ($row['ACTIVE'] == 1): ?>
            <a class="action-btn deact"
               href="manage_questions.php?id=<?= $row['SNO'] ?>&act=0">
               Deactivate
            </a>
        <?php else: ?>
            <a class="action-btn activate"
               href="manage_questions.php?id=<?= $row['SNO'] ?>&act=1">
               Activate
            </a>
        <?php endif; ?>

        <!-- DELETE BUTTON -->
        <a class="action-btn delete"
           href="manage_questions.php?del=<?= $row['SNO'] ?>"
           onclick="return confirm('Are you sure you want to permanently delete this question?');">
           Delete
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>
</div>

</body>
</html>
