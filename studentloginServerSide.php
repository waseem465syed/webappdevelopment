


<?php 
error_reporting(E_ALL);
//require_once('startsession.php');



   // previous form from where it should come 
/*define('URLFORM', 'http://localhost/login.php');

// current form address
define('URLLIST', 'http://localhost/studentloginServerSide.php');
$referer= $_SERVER['HTTP_REFERER'];

//if referer is not the form redirect the browser to the previous form
if($referer!= URLLIST && $referer != URLFORM) {
    header('Location: '.URLFORM);


}*/


if (!isset($_SESSION['user'])){
    if(isset($_COOKIE['user']) && isset($_COOKIE['group'])){
        $_SESSION['user']=$_COOKIE['user'];
        $_SESSION['group']=$_COOKIE['group'];
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
        
        $query = "SELECT groups FROM students WHERE student_id= $studentId";
        

          $query= "SELECT student_id, email, groups FROM students WHERE groups IN (SELECT DISTINCT groups FROM students WHERE student_id = '$studentId')";
        $result = mysqli_query($link, $query);
            while($row=mysqli_fetch_array($result)){
                
                setcookie('group', $row['groups'], time() +(60*60*24*30));
            }
          $group = $_COOKIE['group'];
 
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

         if (isset($_POST['delete'])){
            $selected_id =$_POST['stuid'];
             $query= "DELETE from ratings WHERE rated_id = $selected_id";
             
     $result = mysqli_query($link, $query);
             
                echo '<p class="text-white text-center font-weight-bold bg-success" style="font-size: 25px"> Record Deleted ';
         

            }  
       
    
        if (isset($_POST['update'])){
             $selected_id =$_POST['stuid'];
         $rating = $_POST['rating'];
 
         $comment = mysqli_real_escape_string($link, trim($_POST['comment']));
        
     
            $query = "UPDATE ratings SET rating=$rating, comment = '$comment'  WHERE rated_id = $selected_id AND rater_id=$studentId";
             $result = mysqli_query($link, $query);
                echo '<p class="text-white text-center font-weight-bold bg-success" style="font-size: 25px"> record updated!!';
            
        }
         
         
     
     if (isset($_POST['ratestudent'])){
            $selected_id =$_POST['stuid'];
         $rating = $_POST['rating'];
         $comment = mysqli_real_escape_string($link, trim($_POST['comment']));
        
         $userfile =$_POST['userfile']; 
           // echo $selected_id;
         if (isset($_POST['frating'])){
            
           $query= "INSERT INTO ratings (rater_id, rating, comment, image, rated_id, final_rating, groups) VALUES 
             ('$studentId', $rating, '$comment', '$userfile', '$selected_id', $rating, $group)";
     $result = mysqli_query($link, $query);
             
             $query =  "SELECT grade FROM students WHERE student_id = $selected_id";
                         $data = mysqli_query($link, $query); 
                         if (mysqli_num_rows($data) ==1){
                             
             
          $query = "UPDATE students SET grade= ($rating+ $rating)/2 WHERE student_id = $selected_id";
             $result = mysqli_query($link, $query);
                echo '<p class="text-white text-center font-weight-bold bg-success" style="font-size: 25px"> Final grade udpated!!';
                             
    
        } else {
           
                             
                      $query= "INSERT INTO students (rater_id) VALUES 
             ('$rating') WHERE student_id= $selected_id";
     $result = mysqli_query($link, $query);       
             echo '<p class="text-white text-center font-weight-bold bg-success" style="font-size: 25px"> Student Rated!!';
        }
         

       
     } else {
             
             
           $query= "INSERT INTO ratings (rater_id, rating, comment, image, rated_id) VALUES 
             ('$studentId', $rating, '$comment', '$userfile', '$selected_id')";
     $result = mysqli_query($link, $query);
             echo '<p class="text-white text-center font-weight-bold bg-success" style="font-size: 25px"> Student Rated!!';
     }

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
					  <input type="checkbox" id="final_rating" name="final_rating" value="finalrating">Finalise<br>
				</div>
                

				<div class="form-group">
					<label class="font-weight-bold"> Comment </label>
					<textarea rows="4" cols= "50" name="comment" class="form-control" id="comment" value="<?php echo $commentt ?>" >
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
                         if (mysqli_num_rows($result) >=2){
                             echo '<input type="submit" id="ratestudent" disabled';
                          
                         }  else {
                             echo "";
                         }
            
                      
                
                


?>
              
   
	<input type="submit" id="ratestudent" name="ratestudent" value="Submit" class="btn btn-success">
             
                
                
                <?php 
                 $query = "SELECT final_rating FROM ratings WHERE rater_id = $studentId";
                         $result = mysqli_query($link, $query); 
                         if (mysqli_num_rows($result) >=2){
                             echo '<input type="submit" id="delete" disabled';
                          
                         }  else {
                             echo "";
                         }
                
                                
                    
                    $link->close();
              ?>
    <input type="submit" id="delete" name="delete" value="Delete" class="btn btn-success">
                
                
                 
               
                 
	<input type="submit" id="update" name="update" value="Change" class="btn btn-success">
                                
</form><br><br>


		</div>
	</div>


        


</body>
</html>