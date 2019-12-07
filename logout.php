<?php 

if (isset($_COOKIE['user'])){
    setcookie('user','', time()-3600);
}
    
    $home_url ='http://' .$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login.php';
    header('Location: '.$home_url);
    

?>