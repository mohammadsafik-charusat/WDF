<?php
session_start();

if (isset($_SESSION["student_id"])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>

<html>

<head>

    <title>StudentHub Login</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>StudentHub</h1>

    <h2>Student Login</h2>

    <form action="login.php" method="POST">

        <label>Username:</label>

        <input
            type="text"
            name="username"
            placeholder="Enter username"
            required
        >

        <label>Password:</label>

        <input
            type="password"
            name="password"
            placeholder="Enter password"
            required
        >

        <button type="submit">
            Login
        </button>

    </form>

    <a href="index.php">
        Register Student
    </a>

</div>

</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require "db.php";

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username == "" || $password == "") {

        die("Username and password are required.");

    }


    // Find user

    $sql = "SELECT student_id, name, username, password
            FROM students
            WHERE username = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();


    if ($result->num_rows == 1) {

        $student = $result->fetch_assoc();


        // Verify password

        if (password_verify($password, $student["password"])) {

            $_SESSION["student_id"] = $student["student_id"];
            $_SESSION["name"] = $student["name"];
            $_SESSION["username"] = $student["username"];

            header("Location: dashboard.php");
            exit;

        } else {

            echo "<p>Invalid username or password.</p>";

        }

    } else {

        echo "<p>Invalid username or password.</p>";

    }


    $stmt->close();

    $conn->close();
}

?>