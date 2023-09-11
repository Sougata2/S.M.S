<?php
require "includes/database.php";
require "includes/sessionEnd.php";
require "includes/url.php";
$conn = getDB();
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $delete_id = $_POST["delete_id"];
    $session_id = $_SESSION["id"];
    $sql_query = "DELETE FROM students WHERE id = ?";
    $prepared_stmt = mysqli_prepare($conn, $sql_query);
    mysqli_stmt_bind_param($prepared_stmt, "i", $delete_id);
    if ($prepared_stmt) {
        if (mysqli_stmt_execute($prepared_stmt)) {
            if ($session_id == $delete_id) {
                endSession();
            }
            redirect("");
        }
    } else {
        echo mysqli_error($conn);
    }
}
echo $delete_id;
