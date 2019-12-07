<?php
error_reporting(E_ERROR);

session_start();
session_destroy();
if (isset($_SESSION['user'])){
$user=$_SESSION['user'];
$email=$_SESSION['email'];
}


/*
setcookie('user', $_POST['user'], time()+3600);
setcookie('ebody', $_POST['user'], time()+3600);
*/
       
   require_once('connection.php');
        $query='SHOW TABLES';
        extract($_POST);

error_reporting(0);   

        $from= 'waseem465@gmail.com';
        $mailbody = $_POST['ebody'];
        $subject = $_POST['subject'];
        $groupId = $_POST['groupno'];
  $studentId = $_COOKIE['user'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<h1 class="text-white text-center font-weight-bold bg-success" style="font-size: 55px;"> EMail Form </h1>
<?php  echo '&#10084; <a href="logout.php">Log Out ('.$_COOKIE['user']. ')</a>'; ?>
	<div class="container"><br>
		
		<div class="col-lg-6 m-auto d-block">
			
			<form method="post" id="myForm" action="<?php echo $_SERVER['PHP_SELF'];?>"  class="bg-light">
                                                 
               <label class="font-weight-bold">Select Group</label>
            <select name="groupno" id="groupno">
                
                 <option value="1">Group 1</option>
                 <option value="2">Group 2</option>
                 <option value="3">Group 3</option>
                 <option value="4">Group 4</option>
                 <option value="5">Group 5</option>
                 <option value="6">Group 6</option>
                 <option value="7">Group 7</option>
                 <option value="8">Group 8</option>
                 <option value="9">Group 9</option>
                 <option value="10">Group 10</option>    
            </select>
				
				<div class="form-group">
					<label for="user" class="font-weight-bold"> Subject: </label>
					<input type="text" value="<?php echo $subject;?>" name="subject" class="form-control" id="subject" >
					
				</div>

		
				<div class="form-group">
					<label class="font-weight-bold"> Body</label>
					<textarea rows="4" cols= "50" name="ebody" class="form-control" id="ebody"><?php echo $mailbody;?></textarea>
					
				</div>


				
        

				<input type="submit" name="submit" value="Send" id="submit" class="btn btn-success" 	autocomplete="off">
<?php
                if (isset($_POST['submit'])){
                    if(!empty($subject) && (!empty($mailbody))){
        $link = mysqli_connect($host, $userr, $passwd, $dbname) or die('Error connecting to mysql server');    
          $query= "SELECT email FROM students WHERE groups = $groupId";
    
       $result = mysqli_query($link, $query) or die('Error querying database');
            
         while($row=mysqli_fetch_array($result)){
                $msg = "Dear Student, \n $mailbody";
                $to =$row['email'];
                mail($to, $subject, $msg, 'From:'.$from);
                echo 'Email sent to: '.$to.'<br/>';
           
            }  
 
        } 
     
    else {
                echo 'You forgot the email subject and/or body text.<br />';
            }
       
 }
                ?>
			</form><br><br>


		</div>
	</div>

<?php 
    

   
    
    
    
      $link->close();
?>

</body>
</html>