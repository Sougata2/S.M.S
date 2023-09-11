<?php
require "includes/url.php";
require "includes/sessionEnd.php";
function logout()
{
    endSession();
}
logout();
redirect("");
