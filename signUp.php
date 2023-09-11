<?php
require "includes/database.php";
require "includes/url.php";
require "includes/student.php";
require "includes/validate.php";
$errors = [];
function signUP()
{
    global $errors;
    $conn = getDB();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $std_email = $_POST["email"];
        $std_username = $_POST["username"];
        $std_name = $_POST['name'];
        $std_roll_no = $_POST['roll_no'];
        $std_phone_no = $_POST['phone_number'];
        $password = $_POST["passwd"];

        // validation
        $errors = validate($std_name, $std_roll_no, $std_phone_no, $std_email, $std_username, $conn);

        if (empty($errors)) {
            $sql_query = "INSERT INTO students(name, roll_no, phone_number, password, username, email) VALUES (?, ?, ?, ?, ?, ?)";
            $prepared_stmt = mysqli_prepare($conn, $sql_query);
            if (!$prepared_stmt) {
                echo mysqli_error($conn);
            } else {
                mysqli_stmt_bind_param($prepared_stmt, "sissss", $std_name, $std_roll_no, $std_phone_no, $password, $std_username, $std_email);
                if (mysqli_stmt_execute($prepared_stmt)) {
                    $id = mysqli_insert_id($conn);
                    redirect("profile.php?id=$id" . "&&new_student=1");
                } else {
                    mysqli_stmt_error($prepared_stmt);
                }
            }
        }
    }
}

signUP();
?>

<?php require "includes/signUpForm.php" ?>