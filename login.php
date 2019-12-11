<?php



require_once('connection.php');

error_reporting(E_ERROR);









//if the user isnt logged in , try to log them in, check the user cookie to see if 
//the user is logged in.
if (!isset($_COOKIE['user'])){

    
    //if the user isnt logged in, see if they have submitted login data
if(isset($_POST['submit'])) {

    

    

    

        $link = mysqli_connect($host, $userr, $passwd, $dbname);



/// sql injection

$studentId = mysqli_real_escape_string($link, trim($_POST['user']));

$userPasswd =mysqli_real_escape_string($link, trim($_POST['pass']));

    

    if (!empty($studentId) && !empty($userPasswd)) {

        if ($studentId == '000000000' && $userPasswd == '000'){

             setcookie('user', $studentId);

            $home_url='http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). '/adminpage.php';

            header('Location: '. $home_url);

            

        } else  {

        $query= "SELECT student_id FROM students WHERE student_id= $studentId and password = SHA('$userPasswd')";

        // $query= "SELECT groups FROM student WHERE student_id = $studentId";

       $result = mysqli_query($link, $query); 

          if (mysqli_num_rows($result)==1){

          

                $row = mysqli_fetch_array($result);

          //$username = $row['student_id'];
              
            $_SESSION['user']=$row['student_id'];
              setcookie('user', $row['student_id'], time() +(60*60*24*30));

            $home_url='http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). '/studentloginServerSide.php';

            header('Location: '. $home_url);

        }else {

                $error_msg = 'Sorry, you must enter a valid StudentID and password';

          }

        }

        //

    }
        else {
            $error_msg='Sorry, you must enter StudentId and password to login';
        }


    }


}



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

    

    ?>



	<div class="container"><br>

		

		 <div style="padding: 25px; background-color: #98AFC7;">

			

			<form  name="myForm" method="post" id="myForm" onsubmit="return validation()" class="bg-light">

                

        <fieldset>

				

				<div style="padding: 25px; background-color: #E5E4E2;">

					<label for="user" class="font-weight-bold"> StudentID: </label>

					<input type="text"   name="user" id="user" value="<?php if (!empty($user_user)) echo $user_user;?>" class="form-control input_user" required>

					<span id="username" class="text-danger font-weight-bold"> </span>

				</div>



				<div style="padding: 25px; background-color: #E5E4E2;">

					<label class="font-weight-bold"> Password: </label>

					<input type="password" name="pass" id="pass" class="form-control input_pass" required>

					<span id="passwords" class="text-danger font-weight-bold"> </span>

				</div>

</fieldset>

				

                <input type="submit" name="submit" value="Login" class="btn btn-success" 	autocomplete="off">

                

                   <div style="padding: 25px; background-color: #E5E4E2;">

                     Don't have an account? <a href="registration.php" class="form-group"> Sign Up</a></div>

                 

                    <div style="padding: 25px; background-color: #E5E4E2;">

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

        

   


	

	</script>

		

    <?php 

    }

    else {

         echo('<p class="text-white text-center font-weight-bold bg-success" style="font-size: 25px"> Your are logged in as ' . $_COOKIE['user']. '.</p>');

    }

?>



</body>

</html>