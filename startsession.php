<?php 
session_start();

// if the session vars aren't set, try to set them with a cookie
if(!isset($_SESSION['user'])) {
    if (isset($_COOKIE['user'])){
        $_SESSION['user']= $_COOKIE['user'];
    }
}

?>