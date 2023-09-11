<?php
require "includes/database.php";
$conn = getDB();
$sql_query = "SELECT * FROM students";
$result = mysqli_query($conn, $sql_query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<?php require "includes/header.php" ?>
<div>
    <h1 class="student-table-txt">Students Table</h1>
</div>

<div class="container">

    <?php if (empty($rows)) : ?>
        <h1>Add Some Students</h1>
    <?php else : ?>
        <table class="table table-striped">
            <tr>
                <th>Student Name</th>
                <th>Student Roll Number</th>
                <th>Student Email</th>
                <th>Student Phone Number</th>
            </tr>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><a href="profile.php?id=<?php echo $row["id"] ?>"><?php echo $row["name"] ?></a></td>
                    <td><?php echo $row["roll_no"] ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><?php echo $row["phone_number"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
<?php require "includes/footer.php" ?>