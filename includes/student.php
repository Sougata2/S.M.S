<?php
function getStudent_result($conn, $columnName, $columnValue)
{
    $query = "SELECT * FROM students WHERE $columnName = ?";
    $input_type = is_numeric($columnValue) ? "i" : "s";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        echo mysqli_error($conn);
        exit;
    }
    mysqli_stmt_bind_param($stmt, $input_type, $columnValue);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }
    return false;
}

function getStudent_result_exclude_self($conn, $columnName, $columnValue, $id)
{
    $query = "SELECT * FROM students WHERE $columnName = ? AND id != ?";
    $input_type = is_numeric($columnValue) ? "ii" : "si";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        echo mysqli_error($conn);
        exit;
    }
    mysqli_stmt_bind_param($stmt, $input_type, $columnValue, $id);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }
    return false;
}


