


<?php 
error_reporting(E_ALL);
//require_once('startsession.php');



   // previous form from where it should come 
define('URLFORM', 'http://localhost/login.php');

// current form address
define('URLLIST', 'http://localhost/studentloginServerSide.php');
$referer= $_SERVER['HTTP_REFERER'];

//if referer is not the form redirect the browser to the previous form
if($referer!= URLLIST && $referer != URLFORM) {
    header('Location: '.URLFORM);
    
    
    
    //if (isset($_COOKIE['user']))
}


if (!isset($_SESSION['user'])){
    if(isset($_COOKIE['user'])){
        $_SESSION['user']=$_COOKIE['user'];
    }
}

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
        
<h1 class="text-white text-center font-weight-bold bg-success" style="font-size: 55px;"> Student Record Table</h1>


<?php
   echo '&#10084; <a href="logout.php">Log Out ('.$_COOKIE['user']. ')</a>';       
         
       require_once('connection.php');
        $query='SHOW TABLES';
        extract($_POST);
        $studentId = $_COOKIE['user'];
        $link = mysqli_connect($host, $userr, $passwd, $dbname);
        


          $query= "SELECT student_id, email, groups FROM students WHERE groups IN (SELECT DISTINCT groups FROM students WHERE student_id = '$studentId')";
    
  
       // $query= "SELECT groups FROM student WHERE student_id = $studentId";
        if (!($result = mysqli_query($link, $query))){
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
            
            echo "This ".$studentId. " not found, please insert correct StudentID";
        }else {
          
            echo "<table align='center'><thead align='center'><tr><th>Row</th>";
 
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            
            }
            echo "</tr></thead>\n<tbody>";
            for ($i = 0; $i<mysqli_num_rows($result); $i++){
                echo "<tr><td align='center'>" . ($i + 1) . "</td>";
                $row = mysqli_fetch_row($result);
                for ($j = 0; $j<mysqli_num_fields($result); $j++){
                  
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                        
           
                    
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
            
               
        }
    
    $query= "SELECT student_id FROM students WHERE groups IN (SELECT DISTINCT groups FROM students WHERE student_id = $studentId)";
     if (!($result = mysqli_query($link, $query)))
     {
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }
    else  {
         
        
         
           $opt = "<select name='stuid'>";

                
                for ($j = 0; $j<mysqli_num_rows($result); $j++){
                    $row = mysqli_fetch_assoc($result);
                    
                    if($row['student_id']!=$studentId){
                  
                   $opt .="<option value='{$row['student_id']}'>{$row['student_id']}</option>\n";

                  } else {
                      $newstu = $row['student_id'];
                  }
                }

         $opt .="</select>";
       
        }

         
     
     if (isset($_POST['ratestudent'])){
            $selected_id =$_POST['stuid'];
         $rating = $_POST['rating'];
         $comment = mysqli_real_escape_string($link, trim($_POST['comment']));

         $userfile =$_POST['userfile']; 
           // echo $selected_id;
         
            
             $query= "INSERT INTO ratings (rater_id, rating, comment, image, rated_id) VALUES 
             ('$studentId', $rating, '$comment', '$userfile', '$selected_id')";
     $result = mysqli_query($link, $query);
          
                echo '<p class="text-white text-center font-weight-bold bg-success" style="font-size: 25px"> Student Rated!!';
         
            
            $comment="";
            $userfile="";
    
        }
         

       



?>
        <div class="container"><br>
		
		<div class="col-lg-6 m-auto d-block">
			
			<form action="<?php echo $_SERVER['PHP_SELF'];?>"  class="bg-light"
                method="post" >
				
				<div class="form-group">
			 <label class="font-weight-bold">Select Numeric Rating</label>
            <select name="rating" id="rating">
                
                 <option value="1">0</option>
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5">5</option>
                 <option value="6">6</option>
                 <option value="7">7</option>
                 <option value="8">8</option>
                 <option value="9">9</option>
                 <option value="10">10</option>    
            </select>
                
				</div>
                
				<div class="form-group">
					  <input type="checkbox" name="finalrating" value="finalrating">Finalise Rating<br>
				</div>
                

				<div class="form-group">
					<label class="font-weight-bold"> Comment </label>
					<textarea rows="4" cols= "50" name="comment" class="form-control" id="comment">
                    </textarea>
					
				</div>

				<div class="form-group">
					<label class="font-weight-bold"></label>
					<input type="file" name="userfile" id="userfile" accept="image/*">
				</div>
                <div class="form-group">
					<?php    echo '&#10084;Logged-in Student ID:  ('.$_COOKIE['user']. ')';  ?>
				
				</div>
                   

		

 <?php
echo $opt;
                
                
                 $query = "SELECT rating FROM ratings WHERE rater_id = $studentId";
                         $result = mysqli_query($link, $query); 
                         if (mysqli_num_rows($result) >=3){
                             echo '<input type="submit" id="ratestudent" disabled';
                         }  else {
                             echo "";
                         }
                
                
                    
$link->close();

?>
              
   
	<input type="submit" id="ratestudent" name="ratestudent" value="Submit" class="btn btn-success">
             
                <input type="submit" id="delete" name="delete" value="Delete" class="btn btn-success">
                
                                
</form><br><br>


		</div>
	</div>


        


</body>
</html>