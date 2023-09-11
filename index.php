<?php require "includes/header.php" ?>
<div class="container py-4 my-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Student Management System</h1>
            <p class="col-md-8 fs-4">Manage student details seamlessly with this platform.</p>
            <?php if (!isset($_SESSION["name"])) : ?>
                <a href="login.php">
                    <button class="btn btn-primary btn-lg" type="button">Login</button>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require "includes/footer.php" ?>