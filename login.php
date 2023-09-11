<?php
require "includes/database.php";
require "includes/url.php";
$new_student = false;
$loged_in = false;
$account_holder_name = "John Doe";
$entered_incorrect_password = false;
$email = "";
function login()
{
    $conn = getDB();
    global $email, $new_student, $loged_in, $account_holder_name, $entered_incorrect_password;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $username = $_POST["email"];
        $password = $_POST["password"];
        $query = "SELECT * FROM students WHERE email = ? OR username = ?";
        $stmt = mysqli_prepare($conn, $query);
        if (!$stmt) {
            echo mysqli_error($conn);
            exit;
        }
        mysqli_stmt_bind_param($stmt, "ss", $email, $username);
        if (!mysqli_stmt_execute($stmt)) {
            echo mysqli_error($conn);
            exit;
        }
        $result = mysqli_stmt_get_result($stmt);
        $profile = mysqli_fetch_assoc($result);
        // print_r($profile);
        if (!empty($profile)) {
            if ($profile['password'] == $password) {
                $account_holder_name = ucfirst($profile['name']);
                $loged_in = true;
                session_start();
                $_SESSION['id'] = $profile['id'];
                $_SESSION['name'] = ucfirst($profile['name']);
                redirect("");
            } else {
                $entered_incorrect_password = true;
            }
        } else {
            $new_student = true;
        }
    }
}
login();
?>
<?php require "includes/loginForm.php" ?>

