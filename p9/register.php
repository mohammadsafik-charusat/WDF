<?php

require "db.php";

$name = $_POST["name"] ?? "";
$username = $_POST["username"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

$name = trim($name);
$username = trim($username);
$email = trim($email);

if ($name == "") {
    die("Name is required.");
}

if ($username == "") {
    die("Username is required.");
}

if ($email == "") {
    die("Email is required.");
}

if ($password == "") {
    die("Password is required.");
}

if (strlen($username) < 3 || strlen($username) > 50) {
    die("Username must be between 3 and 50 characters.");
}

if (strlen($password) < 6) {
    die("Password must be at least 6 characters.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}


// Check duplicate email or username

$sql = "SELECT student_id
        FROM students
        WHERE email = ? OR username = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $email, $username);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $stmt->close();
    $conn->close();

    die("Email or username already exists.");
}

$stmt->close();


// Hash password

$hashed_password = password_hash(
    $password,
    PASSWORD_DEFAULT
);


// Insert student

$sql = "INSERT INTO students
        (name, username, email, password)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssss",
    $name,
    $username,
    $email,
    $hashed_password
);


// Execute

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