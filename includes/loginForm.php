<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- ---- Include the above in your HEAD tag -------- -->

<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
                <!-- <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div> -->
            </div>

            <div style="padding-top:30px" class="panel-body">
                <?php if ($new_student) : ?>
                    <div id="login-alert" class="alert alert-warning col-sm-12">
                        New Student
                        <a href="/S.M.S/signUp.php">
                            Sign Up Here
                        </a>
                    </div>
                <?php elseif ($entered_incorrect_password) : ?>
                    <div id="login-alert" class="alert alert-danger col-sm-12">
                        Incorrect password!
                    </div>
                <?php endif; ?>
                <form id="loginform" class="form-horizontal" role="form" method="post" action="/S.M.S/login.php">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="username or email" required value="<?php echo htmlspecialchars($email) ?>">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required>
                    </div>



                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                            </label>
                        </div>
                    </div>


                    <div style="margin-top:10px" class="form-group">

                        <div class="col-sm-12 controls">
                            <button type="submit" class="btn btn-success">Login</button>
                            <!-- <a id="btn-login" href="#" class="btn btn-success">Login </a> -->
                            <!-- <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a> -->
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                Don't have an account!
                                <a href="/S.M.S/signUp.php">
                                    Sign Up Here
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>