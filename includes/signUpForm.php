<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- ---- Include the above in your HEAD tag -------- -->
<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Sign Up</div>
            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="/S.M.S/login.php">Sign In</a></div>
        </div>
        <div class="panel-body">
            <form id="signupform" class="form-horizontal" role="form" method="post" action="/S.M.S/signUp.php">
                <?php if (!empty($errors)) : ?>
                    <div id="signupalert" class="alert alert-danger">
                        <?php if (isset($errors["email_taken"]) && $errors["email_taken"]) : ?>
                            Account already Exists! <a href="/S.M.S/login.php">Login</a>
                        <?php else : ?>
                            <ul>
                                <?php if (isset($errors["username_taken"]) && $errors["username_taken"]) : ?>
                                    <li>User name Already Taken!</li>
                                <?php endif; ?>
                                <?php if (isset($errors["roll_number_taken"]) && $errors["roll_number_taken"]) : ?>
                                    <li>Roll Number Already Taken!</li>
                                <?php endif; ?>
                                <?php if (isset($errors["phone_number_taken"]) && $errors["phone_number_taken"]) : ?>
                                    <li>Phone Number Already Taken!</li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>



                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="email" placeholder="Email Address" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">User name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="username" placeholder="User name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="roll-no" class="col-md-3 control-label">Roll Number</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="roll_no" placeholder="Roll Number" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact-number" class="col-md-3 control-label">Contact No</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="passwd" placeholder="Password" required>
                    </div>
                </div>

                <!-- <div class="form-group">
                        <label for="icode" class="col-md-3 control-label">Invitation Code</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="icode" placeholder="">
                        </div>
                    </div> -->

                <div class="form-group">
                    <!-- Button -->
                    <div class="col-md-offset-3 col-md-9">
                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Sign Up</button>
                        <!-- <span style="margin-left:8px;">or</span> -->
                    </div>
                </div>
            </form>
        </div>
    </div>




</div>