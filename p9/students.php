<?php

require "db.php";


$sql = "SELECT student_id, name, email
        FROM students";

$result = $conn->query($sql);

?>

<!DOCTYPE html>

<html>

<head>

    <title>Students</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>Registered Students</h1>


    <table>

        <tr>

            <th>ID</th>

            <th>Name</th>

            <th>Email</th>

        </tr>


        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                echo "<tr>";

                echo "<td>"
                    . htmlspecialchars($row["student_id"])
                    . "</td>";

                echo "<td>"
                    . htmlspecialchars($row["name"])
                    . "</td>";

                echo "<td>"
                    . htmlspecialchars($row["email"])
                    . "</td>";

                echo "</tr>";

            }

        } else {

            echo "<tr>";

            echo "<td colspan='3'>No students found.</td>";

            echo "</tr>";

        }

        ?>

    </table>


    <br>

    <a href="index.php">
        Register Student
    </a>

</div>

</body>

</html>

<?php

$conn->close();

?>