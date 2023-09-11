<?php
$error_log = [];
/**
 * Validate if the attributes are already taken
 * @param string $name name of student.
 * @param string $roll_no roll number of student.
 * @param string $phone_number phone number of student.
 * @param string $email email of the student.
 * @param mysqli_connection $mysqli_conn  MySql connection object.
 * @param string $id  if the id is to excluded from search operation | 0
 * @return array $error_log
 */
function validate($name, $roll_no, $phone_number, $email, $username, $conn, $id = 0)
{
    global $error_log;
    if ($id) {
        $valid_roll_number = mysqli_num_rows(getStudent_result_exclude_self($conn, "roll_no", $roll_no, $id));
        $valid_phone_number = mysqli_num_rows(getStudent_result_exclude_self($conn, "phone_number", $phone_number, $id));
        $valid_email = mysqli_num_rows(getStudent_result_exclude_self($conn, "email", $email, $id));
        $valid_username = mysqli_num_rows(getStudent_result_exclude_self($conn, "username", $username, $id));
    } else {
        $valid_roll_number = mysqli_num_rows(getStudent_result($conn, "roll_no", $roll_no));
        $valid_phone_number = mysqli_num_rows(getStudent_result($conn, "phone_number", $phone_number));
        $valid_email = mysqli_num_rows(getStudent_result($conn, "email", $email));
        $valid_username = mysqli_num_rows(getStudent_result($conn, "username", $username));
    }
    if ($valid_roll_number) {
        $error_log[] = "roll_number_taken";
    }
    if ($valid_phone_number) {
        $error_log[] = "phone_number_taken";
    }
    if ($valid_email) {
        $error_log[] = "email_taken";
    }
    if ($valid_username) {
        $error_log[] = "username_taken";
    }
    return $error_log;
}
