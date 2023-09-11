<?php
function get_pic($id, $conn)
{
    $default_pic = "images/profile_picture.png";
    $query = "SELECT img FROM students WHERE id = ?";
    $prepared_stmt = mysqli_prepare($conn, $query);
    if (!$prepared_stmt) {
        echo mysqli_error($conn);
        return $default_pic;
    }
    mysqli_stmt_bind_param($prepared_stmt, "i", $id);
    if (!mysqli_stmt_execute($prepared_stmt)) {
        echo mysqli_error($conn);
        return $default_pic;
    }
    $pic = mysqli_fetch_assoc(mysqli_stmt_get_result($prepared_stmt))['img'];
    if ($pic == "" || !file_exists($pic)) {
        return $default_pic;
    }
    return $pic;
}
