<?php
session_start();
error_reporting(E_ERROR);


    // previous form from where it should come 
define('URLFORM', 'http://localhost/login.php');

// current form address
define('URLLIST', 'http://localhost/registration.php');
$referer= $_SERVER['HTTP_REFERER'];

//if referer is not the form redirect the browser to the previous form
if($referer != URLFORM && $referer!=URLIST){
    header('Location: '.URLFORM);
}



if (isset($_SESSION['user'])){
$user=$_SESSION['user'];
$email=$_SESSION['email'];
    
}


/*setcookie('user', $_POST['user'], time()+3600);
setcookie('email', $_POST['user'], time()+3600);*/



      /*  $host = 'localhost';
        $userr = 'waseem';
        $passwd= 'localhost';
        $dbname= 'waseem';*/

require_once('connection.php');
        $query='SHOW TABLES';


        extract($_POST);
       $link = mysqli_connect($host, $userr, $passwd, $dbname);
//SQL Injections protection
$studentId = mysqli_real_escape_string($link, trim($_POST['user']));
$userPasswd =mysqli_real_escape_string($link, trim($_POST['pass']));
$eMail= mysqli_real_escape_string($link, trim($_POST['email']));
$groupId=$_POST['groupno'];
$user_pass_phrase =mysqli_real_escape_string($link, trim($_POST['verify']));



   
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
<h1 class="text-white text-center font-weight-bold bg-success" style="font-size: 55px;"> Peer Assessment System </h1>

	<div class="container"><br>
		
		<div class="col-lg-6 m-auto d-block">
			
			<form method="post" id="myForm" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validation()" class="bg-light">
				
				<div class="form-group">
					<label for="user" class="font-weight-bold"> Student ID: </label>
					<input type="text"  value="<?php echo $studentId;?>" name="user" class="form-control" id="user"  placeholder="Insert 9 digits student ID" pattern="[0-9]*">
					<span id="username" class="text-danger font-weight-bold"> </span>
				</div>

				<div class="form-group">
					<label class="font-weight-bold"> Password: </label>
					<input type="password" name="pass" class="form-control" id="pass" autocomplete="off">
					<span id="passwords" class="text-danger font-weight-bold"> </span>
				</div>

				<div class="form-group">
					<label class="font-weight-bold"> Confirm Password: </label>
					<input type="password" name="conpass" class="form-control" id="conpass" autocomplete="off">
					<span id="confrmpass" class="text-danger font-weight-bold"> </span>
				</div>

			

				<div class="form-group">
					<label class="font-weight-bold"> Email: </label>
					<input type="text" value="<?php echo $eMail;?>" name="email" class="form-control" id="email" >
					<span id="emailids" class="text-danger font-weight-bold"> </span>
				</div>
            
                                         
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
       <label for="verify">Verification</label>
                <input type="text" id="verify" name="verify" placeholder="Enter the pass-phrase"/>
                <img src="captcha3.php" alt="Verification pass-phrase"/>
        </div>
                
				<input type="submit" name="submit" value="submit" class="btn btn-success" 	autocomplete="off">

<?php
                 if (isset($_POST['submit'])){
                     
                     //check the CAPTCHA pass-phrase for verification
                     
                     if($_SESSION['pass_phrase'] == $user_pass_phrase){
                    $query = "SELECT*FROM students WHERE student_id = $studentId";
                     $result = mysqli_query($link, $query);
                      if (mysqli_num_rows($result)==0){
                          //the studentId is unique, so inser the data into the database
                          
        $query="INSERT INTO students (student_id, password, grade, email, groups) VALUES ('$studentId', SHA('$userPasswd'), '', '$eMail', $groupId)";
        mysqli_query($link, $query);
        echo '<p class="text-white text-center font-weight-bold bg-success" style="font-size: 25px"> Account created successfully!!';
          
                    
                         
           
            } else {
        echo '<p class="text-white text-center font-weight-bold bg-success" style="font-size: 25px"> Account already exist for this Student ID!!';
              
            
        }
        
                         
                     }else {
                         echo '<p class"text-white text-center font-weight-bold bg-success" style="font-size: 25px"> Please enter the correct pass-phrase.</p>';
                     }
                     

         $link->close();
        
                      }
         
    
   
                

    ?>         
                         
			</form><br><br>
                    Already Registered? Login here <a href="login.php" class="form-group"> Login</a>


    </div>
    </div>



	<script type="text/javascript">
		

		function validation(){

			var user = document.getElementById('user').value;
			var pass = document.getElementById('pass').value;
			var confirmpass = document.getElementById('conpass').value;
			
			var emails = document.getElementById('email').value;





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
			}







			if(pass == ""){
				document.getElementById('passwords').innerHTML =" ** Please fill the password field";
				return false;
			}
			if((pass.length <= 5) || (pass.length > 20)) {
				document.getElementById('passwords').innerHTML =" ** Passwords lenght must be between  5 and 20";
				return false;	
			}


			if(pass!=confirmpass){
				document.getElementById('confrmpass').innerHTML =" ** Password does not match the confirm password";
				return false;
			}



			if(confirmpass == ""){
				document.getElementById('confrmpass').innerHTML =" ** Please fill the confirmpassword field";
				return false;
			}



			if(emails == ""){
				document.getElementById('emailids').innerHTML =" ** Please fill the email idx` field";
				return false;
			}
			if(emails.indexOf('@') <= 0 ){
				document.getElementById('emailids').innerHTML =" ** @ Invalid Position";
				return false;
			}

			if((emails.charAt(emails.length-4)!='.') && (emails.charAt(emails.length-3)!='.')){
				document.getElementById('emailids').innerHTML =" ** . Invalid Position";
				return false;
			}
            myFunction();


		}
        /*function myFunction() {
  alert("Student Registered");
}*/
     


	</script>

 
    
  
</body>
</html>