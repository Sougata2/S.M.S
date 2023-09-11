<?php
require "includes/database.php";
$conn = getDB();
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo "<pre>";
print_r($students);


foreach ($students as $student) {
    $email = strtolower($student['name']) . "@tcs.com";
    $id = $student['id'];
    $update_query = "UPDATE students SET  email=? WHERE id =?";
    $stmt = mysqli_prepare($conn, $update_query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $email, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "{$student['name']} passed <br>";
        } else {
            echo "{$student['name']} failed <br>";
        }
    } else {
        echo "Error <br>";
        echo mysqli_error($conn) . "<br>";
    }
}
