<?php
require "includes/database.php";
require "includes/student.php";
$conn = getDB();
$students = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $students = mysqli_fetch_all(getStudent_result($conn, "name", $name), MYSQLI_ASSOC);
}
?>
<?php require "includes/header.php" ?>
<div>
    <h1 class="student-table-txt">Students</h1>
</div>

<div class="container">

    <?php if (empty($students)) : ?>
        <h1>No records found!</h1>
    <?php else : ?>
        <table class="table table-striped">
            <tr>
                <th>Student Name</th>
                <th>Student Roll Number</th>
                <th>Student Email</th>
                <th>Student Phone Number</th>
            </tr>
            <?php foreach ($students as $student) : ?>
                <tr>
                    <td><a href="profile.php?id=<?php echo $student["id"] ?>"><?php echo $student["name"] ?></a></td>
                    <td><?php echo $student["roll_no"] ?></td>
                    <td><?php echo $student["email"] ?></td>
                    <td><?php echo $student["phone_number"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
<?php require "includes/footer.php" ?>