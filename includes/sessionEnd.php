<?php 
function endSession(){
    session_start();
    session_unset();
    session_destroy();
}

