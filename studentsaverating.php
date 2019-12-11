<?php 
error_reporting(E_ALL);
require_once('startsession.php');

/*    // previous form from where it should come 
define('URLFORM', 'http://localhost/login.html');

// current form address
define('URLLIST', 'http://localhost/loginServerSide.php');
$referer= $_SERVER['HTTP_REFERER'];

//if referer is not the form redirect the browser to the previous form
if($referer != URLFORM && $referer!=URLIST){
    header('Location: '.URLFORM);
}*/








?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <style>
thead {color:green;}
tbody {color:blue;}
tfoot {color:red;}

table, th, td {
  border: 1px solid black;
}
</style>
    
</head>
    <body>
<h1 class="text-white text-center font-weight-bold bg-success" style="font-size: 55px;"> Student Rating Save</h1>


<?php
         
    require_once('connection.php');
        $query='SHOW TABLES';
        extract($_POST);

error_reporting(0);
      
        
       
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
        $userfile = $_POST['userfile'];
        $loggedstu = $_POST['logeedstu'];
       
                $link = mysqli_connect($host, $userr, $passwd, $dbname) or die('Error connecting to mysql server');
    
    
    
         
          $query= "SELECT email FROM students WHERE groups = $groupId";
    
  
       // $query= "SELECT groups FROM student WHERE student_id = $studentId";
       $result = mysqli_query($link, $query) or die('Error querying database');
            
            
            echo $loggedstu;
                    
                
            }
            
      
    
    
    $link->close();
          

           
        

?>


</body>
</html>