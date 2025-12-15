🧠 Smart Online Quiz System

The Smart Online Quiz System is a full-stack web application developed using PHP, MySQL, HTML, CSS, and JavaScript.
It enables users to attempt timed quizzes, submit answers, view scores instantly, and review correct solutions.
Administrators are provided with a dedicated panel to efficiently manage quiz questions.
🚀 Key Features
👤 User Module

Secure user login using PHP sessions

Time-based quiz with live countdown timer

Navigate using Next and Previous buttons

Automatic submission when time runs out

Instant score calculation after submission

Detailed result analysis including:

Selected answer

Correct answer

Option to restart and retake the quiz
🧰 Technology Stack

Frontend: HTML5, CSS3, JavaScript

Backend: PHP (Procedural with Sessions)

Database: MySQL

Server: Apache (XAMPP)

Version Control: Git & GitHub
🔐 User Roles

User:

Attempt quizzes

View scores and detailed results

Admin:

Manage quiz questions

Control quiz visibility and answers
quiz_app/
│
├── admin_login.php
├── manage_questions.php
├── add_question.php
├── edit_question.php
│
├── quiz.php
├── submit.php
├── preview.php
│
├── login.php
├── start.php
├── db.php
│
├── assets/
│   ├── css/
│   └── images/
│
├── quiz_app.sql
└── README.md

