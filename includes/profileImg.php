<?php
$max_file_size = 1000000 * 6;
function upload_profile_picture()
{
    global $max_file_size;
    $errors = [];

    if ($_FILES['file']['size'] > $max_file_size) {
        $errors[] = "File size exceeded";
    }

    $mime_types = ['image/gif', 'image/png', 'image/jpeg', 'image/jpg'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
    if (!in_array($mime_type, $mime_types)) {
        $errors[]  = "Invalid file format!";
    }

    $pathinfo = pathinfo($_FILES['file']['name']);
    $base = $pathinfo['filename'];
    $base = preg_replace('/[^a-bA-Z0-9_-]/', '_', $base);
    $filename = $base . "." . $pathinfo['extension'];
    $dir_path = "studentDB/uploads/";
    $destination = $dir_path . $filename;
    $file_number = 1;
    while (file_exists($destination)) {
        $filename = $base . "(" . $file_number++ . ")." . $pathinfo['extension'];
        $destination = $dir_path . $filename;
    }

    if (empty($errors)) {
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);
    }
    return [$destination, $errors];
}
