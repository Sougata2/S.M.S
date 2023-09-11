<?php
require "includes/database.php";
require "includes/student.php";
require "includes/getProfilePic.php";
$conn = getDB();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    $student = mysqli_fetch_assoc(getStudent_result($conn, "id", $id));
    if (!$student) {
        echo "Invalid Id";
        exit;
    }
    $name = ucfirst($student["name"]);
    $username = $student["username"];
    $roll_no = $student["roll_no"];
    $phone_number = $student["phone_number"];
    $email = $student["email"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
}
?>
<?php require "includes/header.php" ?>
<div class="card mx-auto mt-4" style="width: 18rem; padding-bottom: 2rem">
    <div class="profile-pic-con">
        <img src="<?php echo get_pic($_GET["id"], $conn) ?>" class="card-img-top mx-auto mt-2 profile-pic" alt="..." style="width: 16rem;">
    </div>
    <div class="card-body position-relative">
        <h5 class="card-title"><?php echo $name ?></h5>
        <p class="card-text">
        <ul>
            <?php if (isset($_GET["dashboard"]) && $_GET["dashboard"] == 1) : ?>
                <li><strong>User name: </strong><?php echo $username ?></li>
            <?php endif; ?>
            <li><strong>Roll No: </strong><?php echo $roll_no ?></li>
            <li><strong>Email Id: </strong><?php echo $email ?></li>
            <li><strong>Contact No: </strong><?php echo $phone_number ?></li>
        </ul>
        </p>
        <!-- Show after new Student Added to database -->
        <?php if (isset($_GET["new_student"])) : ?>
            <div id="login-alert" class="alert alert-success col-sm-12">
                SignUp success! <a href="login.php">Login</a>
            </div>
        <?php else : ?>
            <!-- Show when logged in. -->
            <?php if ($_GET['id'] == $_SESSION['id'] || $_SESSION['id'] == 1) : ?>
                <form action="edit.php" method="get" class="edit-form">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button type="submit" class="btn btn-primary edit-btn"><i class="fa-solid fa-pen-to-square"></i></button>
                </form>

                <?php require "includes/modelHeader.php" ?>
                <form action="delete.php" method="post" class="">
                    <input type="hidden" name="delete_id" value="<?php echo $id ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
                <?php require "includes/modalFooter.php" ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php require "includes/footer.php" ?>