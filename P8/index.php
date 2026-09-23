<!DOCTYPE html>

<html>

<head>

    <title>StudentHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>StudentHub</h1>

    <h2>Student Registration</h2>

    <form action="register.php" method="POST">

        <label>Name:</label>

        <input
            type="text"
            name="name"
            placeholder="Enter student name"
            required
        >


        <label>Email:</label>

        <input
            type="email"
            name="email"
            placeholder="Enter email"
            required
        >


        <button type="submit">
            Register Student
        </button>

    </form>


    <br>

    <a href="students.php">
        View Students
    </a>

</div>

</body>

</html>