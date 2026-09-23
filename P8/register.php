<?php

require "db.php";


$name = $_POST["name"] ?? "";

$email = $_POST["email"] ?? "";


$name = trim($name);

$email = trim($email);


if ($name == "") {

    die("Name is required.");

}


if ($email == "") {

    die("Email is required.");

}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    die("Invalid email address.");

}


// --------------------------------------
// SQL QUERY
// --------------------------------------

$sql = "INSERT INTO students (name, email)
        VALUES (?, ?)";


// --------------------------------------
// PREPARE STATEMENT
// --------------------------------------

$stmt = $conn->prepare($sql);


// --------------------------------------
// BIND VALUES
// --------------------------------------

$stmt->bind_param("ss", $name, $email);


// --------------------------------------
// EXECUTE
// --------------------------------------

if ($stmt->execute()) {

    echo "<h2>Student registered successfully!</h2>";

    echo "<a href='index.php'>Register Another Student</a>";

    echo "<br><br>";

    echo "<a href='students.php'>View Students</a>";

} else {

    echo "Error: " . $stmt->error;

}


$stmt->close();

$conn->close();

?>