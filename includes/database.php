<?php
$db_host = "localhost";
$db_name = "studentDB";
$db_user = "root";
$db_password = "sougata";

function getDB()
{
    global $db_host, $db_name, $db_password, $db_user;
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit();
    }
    return $conn;
}
