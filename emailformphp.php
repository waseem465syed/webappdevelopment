<?php
error_reporting(E_ERROR);


if (!isset($_SESSION['user'])){
    if(isset($_COOKIE['user'])){
        $_SESSION['user']=$_COOKIE['user'];
    }
}


       
   require_once('connection.php');
        $query='SHOW TABLES';
        extract($_POST);
$link = mysqli_connect($host, $userr, $passwd, $dbname);
error_reporting(0);   

        $from= 'ws9766e@greenwich.ac.uk';
        $mailbody =mysqli_real_escape_string($link, trim($_POST['ebody']));
        $subject =mysqli_real_escape_string($link, trim($_POST['subject']));
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
		
		 <div style="padding: 25px; background-color: #E5E4E2;">
			
			<form method="post" id="myForm" action="<?php echo $_SERVER['PHP_SELF'];?>"  class="bg-light">
                <div style="padding: 25px; background-color: #98AFC7;">                                  
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
                </div>
				
				
            

		
				

				<input type="submit" name="reminder" value="Send Reminder" id="reminder" class="btn btn-success" 	autocomplete="off">
				
        

				<input type="submit" name="submit" value="Send Final Grades" id="submit" class="btn btn-success" 	autocomplete="off">
<?php
                if (isset($_POST['submit'])){
                   
            
          $query= "SELECT student_id, email, grade FROM students WHERE groups = $groupId";
    
       $result = mysqli_query($link, $query) or die('Error querying database');
            
         while($row=mysqli_fetch_array($result)){
                $student= $row['student_id'];
                $to =$row['email'];
             $grade= $row['grade'];
             $msg = "Dear Student, \n $student"; 
             $msg.= " Your Final Grades are: $grade";
            $msg.=  " $mailbody";
                mail($to,  $msg, 'From:'.$from);
             
             echo '<p class="text-white text-center font-weight-bold bg-success" style="font-size: 15px">'.$msg.'<br/>';
             echo '<p class="text-yellow text-center font-weight-bold bg-success" style="font-size: 15px">Email sent to: '.$to;
           
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