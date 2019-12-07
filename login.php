<?php

require_once('connection.php');
error_reporting(E_ERROR);


session_start();


if (!isset($_COOKIE['user'])){
if(isset($_POST['submit'])) {
    
    
    
        $link = mysqli_connect($host, $userr, $passwd, $dbname);


$studentId = mysqli_real_escape_string($link, trim($_POST['user']));
$userPasswd =mysqli_real_escape_string($link, trim($_POST['pass']));
    
    if (!empty($studentId) && !empty($userPasswd)) {
        if ($studentId == '000000000' && $userPasswd == '000'){
             setcookie('user', $studentId);
            $home_url='http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). '/adminpage.php';
            header('Location: '. $home_url);
            
        } else {
        $query= "SELECT student_id FROM students WHERE student_id= $studentId and password = SHA('$userPasswd')";
        // $query= "SELECT groups FROM student WHERE student_id = $studentId";
       $result = mysqli_query($link, $query); 
          if (mysqli_num_rows($result)==1){
          
                $row = mysqli_fetch_array($result);
          //$username = $row['student_id'];
            setcookie('user', $row['student_id']);
            $home_url='http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). '/studentloginServerSide.php';
            header('Location: '. $home_url);
        }else {
                $error_msg = 'Sorry, you must enter a valid StudentID and password';
         
        }
        //
    }
    
    
    }
    
    
    
    
    
    
    
    
    
}
    
//setcookie('username', $_POST['user'], time()+3600);




?>


<!DOCTYPE html>


<html lang="en">
<head>
    <script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>
    
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    
    

</head>
<body>
<h1 class="text-white text-center font-weight-bold bg-success" style="font-size: 55px;"> Login Form </h1>
    
    <?php 
    //if the coockie is empty show any error message
    if (empty($_COOKIE['user'])){
        echo '<p class="error">' . $error_msg . '</p>';
    }
    ?>

	<div class="container"><br>
		
		<div class="col-lg-6 m-auto d-block">
			
			<form  name="myForm" method="post" id="myForm" onsubmit="return validation()" class="bg-light">
                
        <fieldset>
				
				<div class="form-group">
					<label for="user" class="font-weight-bold"> StudentID: </label>
					<input type="text"   name="user" id="user" value="<?php if (!empty($user_user)) echo $user_user;?>" class="form-control input_user" required>
					<span id="username" class="text-danger font-weight-bold"> </span>
				</div>

				<div class="form-group">
					<label class="font-weight-bold"> Password: </label>
					<input type="password" name="pass" id="pass" class="form-control input_pass" required>
					<span id="passwords" class="text-danger font-weight-bold"> </span>
				</div>
</fieldset>
				
                <input type="submit" name="submit" value="Login" class="btn btn-success" 	autocomplete="off">
                
                   <div
                     class="form-group">
                     Don't have an account? <a href="registration.php" class="form-group"> Sign Up</a></div>
                 
                    <div
                     class="form-group">
                     Forgot the password? <a href="reset.html" class="form-group"> Reset Password</a></div>
				
                </form>
             
        </div>
    
				


			<br><br>


		
	</div>
    
    
    

   <script>
       
       
		function validation(){

			var user = document.getElementById('user').value;
			var pass = document.getElementById('pass').value;
			


			if(user == ""){
				document.getElementById('username').innerHTML =" ** Please fill the Student ID field";
				return false;
			}
			if(user.length!=9){
				document.getElementById('username').innerHTML =" ** Student ID must be 9 digits only";
				return false;	
			}
			if(isNaN(user)){
				document.getElementById('username').innerHTML =" ** only numbers are allowed";
				return false;
			}else{
			 
                 
			}


        }
        
      /* function mysubmit(){
         var user = document.getElementById('user').value;
         var pass = document.getElementById('pass').value;
           var tutoruser = "000000000";
           var tutorpass = "000";
         var userresult = tutoruser.localeCompare(user);
           var passresult= tutorpass.localeCompare(pass);
           if (userresult ==0 && passresult==0){
               document.getElementById('myForm').action="adminpagetest.php";
           }else 
               {
                   document.getElementById('myForm').action="studentloginServerSide.php";
                   
                  
               }
       }*/

	
	</script>
		
    <?php 
    }
    else {
         echo('<p class="text-white text-center font-weight-bold bg-success" style="font-size: 25px"> Your are logged in as ' . $_COOKIE['user']. '.</p>');
    }
?>

</body>
</html>