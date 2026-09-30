<?php

session_start();

if (!isset($_SESSION["student_id"])) {

    header("Location: login.php");
    exit;

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>StudentHub Dashboard</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>StudentHub</h1>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION["name"]); ?>!</h2>

    <p>
        Username:
        <?php echo htmlspecialchars($_SESSION["username"]); ?>
    </p>

    <a href="students.php">
        View Students
    </a>

    <a href="logout.php">
        Logout
    </a>

</div>

</body>

</html>