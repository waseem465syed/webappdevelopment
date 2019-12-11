<?php 
//if the user is logged in, delete session vars to log them out


if (isset($_SESSION['user'])){
    
    //delete session vars by clearing session array
    
    $_SESSION=array();
    
    if (isset($_COOKIE[session_name()])){
        setcookie(session_name(), '', time() - 3600);
    }
    
    session_destroy();
}
    setcookie('user', '', time() -3600);
    $home_url ='http://' .$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login.php';
    header('Location: '.$home_url);


?>