<?php
error_reporting(E_ERROR);




/*
setcookie('user', $_POST['user'], time()+3600);
setcookie('ebody', $_POST['user'], time()+3600);
*/
       
       

error_reporting(0);   

       $to = 'waseem.syed465@gmail.com';
        $msg = 'this is sent using php mail';
        $subject = 'testing php mail';
        $from= 'waseem465@gmail.com';
        $groupId = $_POST['groupno'];

     mail($to, $subject, $msg, $from);
echo "mail sent ";
     
      $link->close();