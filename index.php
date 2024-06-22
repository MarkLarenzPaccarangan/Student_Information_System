<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
    .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: white;
        background-color: black;
        border: 2px solid black;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .button:hover {
        background-color: white;
        color: black;
    }
    </style>
    <title>User Dashboard</title>
</head>
<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;"> 
<h1 style="font-family: 'Courier New', Courier, monospace;">STUDENT INFORMATION SYSTEM</h1>
</nav>
<hr>
<a href="setup.php" class="button">SETUP</a>
<a href="enroll.php" class="button">TRANSACTION</a>
<a href="reports.php" class="button">REPORTS</a>
<a href="about.php" class="button">ABOUT</a>
<a href="logout.php" class="button">LOGOUT</a>

</body>
</html>
