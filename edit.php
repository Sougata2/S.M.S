<?php require "includes/header.php" ?>
<?php
require "includes/database.php";
require "includes/url.php";
require "includes/student.php";
require "includes/validate.php";
require "includes/profileImg.php";
require "includes/getProfilePic.php";
$errors = [];
$upload_errrors = [];
$file_upload_success = false;
$no_change_warning = false;
$conn = getDB();

function add_img_db($filePath, $id, $conn)
{
    $query = "UPDATE students SET img = ? WHERE id = ?";
    $prepared_stmt = mysqli_prepare($conn, $query);
    if (!$prepared_stmt) {
        echo mysqli_error($conn);
        return false;
    }
    mysqli_stmt_bind_param($prepared_stmt, "si", $filePath, $id);
    if (!mysqli_stmt_execute($prepared_stmt)) {
        return false;
    }
    return true;
}
if (isset($_GET) && $_GET['id']) {
    $id = $_GET['id'];
    $student = mysqli_fetch_assoc(getStudent_result($conn, "id", $id));
    if (!$student) {
        echo "Invalid Id";
        exit;
    }
    $id = $student["id"];
    $name = $student["name"];
    $username = $student["username"];
    $roll_no = $student["roll_no"];
    $email = $student["email"];
    $phone_number = $student["phone_number"];
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST)) {
        $column_string = '';
        if ($_POST["roll_no"] != $roll_no) {
            $column_string .= "roll_no = '{$_POST["roll_no"]}', ";
        }
        if ($_POST["phone_number"] != $phone_number) {
            $column_string .= "phone_number = '{$_POST["phone_number"]}', ";
        }
        if ($_POST["email"] != $email) {
            $column_string .= "email = '{$_POST["email"]}', ";
        }
        if ($_POST["username"] != $username) {
            $column_string .= "username = '{$_POST["username"]}', ";
        }
        if ($column_string) {
            $errors = validate('', $_POST["roll_no"], $_POST["phone_number"], $_POST["email"], $_POST["username"], $conn, $id);
            if (empty($all_errrors)) {
                $column_string = rtrim($column_string, ", ");
                $query = "UPDATE students SET $column_string WHERE id = {$_POST["id"]}";
                $prepared_stmt = mysqli_prepare($conn, $query);
                if ($prepared_stmt) {
                    if (mysqli_stmt_execute($prepared_stmt)) {
                        redirect("profile.php?id={$_POST['id']}");
                    }
                } else {
                    echo mysqli_error($conn);
                    exit();
                }
            }
        } elseif (isset($_SESSION['img_changed']) && $_SESSION['img_changed']) {
            $no_change_warning = false;
            $_SESSION['img_changed'] = false;
            redirect("profile.php?id={$_POST['id']}");
        } else {
            $no_change_warning = true;
        }
    }
    if (!empty($_FILES)) {
        if ($_FILES['file']["name"] == '') {
            $upload_errrors[] = "No file selected";
        } else {

            $upload_result  = upload_profile_picture();
            $filePath = $upload_result[0];
            $upload_errrors = $upload_result[1];
        }
        // var_dump($upload_errrors);

        if (empty($upload_errrors)) {
            $file_upload_success = true;
            add_img_db($filePath, $id, $conn);
            $_SESSION['img_changed'] = true;
        }
    }

    $all_errrors = array_merge($errors, $upload_errrors);
}
?>
<?php if ($no_change_warning) : ?>
    <div class="container">
        <div class="alert alert-warning alert-dismissible fade show mx-auto" role="alert" style="width: 50%;">
            <i class="fa-solid fa-triangle-exclamation"> </i><strong>OOps!</strong> You forgot to update the profile.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>
<?php if ($file_upload_success) : ?>
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show mx-auto" role="alert" style="width: 50%;">
            File Uploaded Successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>
<?php if (!empty($all_errrors)) : ?>
    <div class="container">
        <div class="alert alert-warning alert-dismissible fade show mx-auto" role="alert" style="width: 50%;">
            <?php foreach ($all_errrors as $error) : ?>
                <strong><i class="fa-solid fa-triangle-exclamation ms"></i> </strong><?php echo $error ?>!<br>
            <?php endforeach; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<div class="card mx-auto mt-4" style="width: 20rem; height:fit-content">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group">
            <label for="file"></label>
            <input type="file" name="file" id="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Upload</button>
        </div>
    </form>
    <div class="profile-pic-con">
        <img src="<?php echo get_pic($_GET["id"], $conn) ?>" class="card-img-top mx-auto mt-2 profile-pic" alt="..." style="width: 16rem;">
    </div>
    <div class="card-body position-relative">
        <h5 class="card-title"><?php echo $name ?></h5>
        <p class="card-text">
        <form method="post" class="update-form">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="form-group">
                <strong>User name:</strong><input type="text" name="username" value="<?php echo $username ?>" class="edit-input">
            </div>
            <div class="form-group">
                <strong>Roll No:</strong><input type="text" name="roll_no" value="<?php echo $roll_no ?>" class="edit-input">
            </div>
            <div class="form-group">
                <strong>Email Id:</strong><input type="text" name="email" value="<?php echo $email ?>" class="edit-input">
            </div>
            <div class="form-group">
                <strong>Contact No:</strong><input type="text" name="phone_number" value="<?php echo $phone_number ?>" class="edit-input">
            </div>
            <button type="submit" class="btn btn-primary update-btn">Save</button>
        </form>
        </p>
    </div>
</div>
<?php require "includes/footer.php" ?>