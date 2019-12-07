


<?php 
error_reporting(E_ALL);

    // previous form from where it should come 
/*efine('URLFORM', 'http://localhost/login.html');

// current form address
define('URLLIST', 'http://localhost/loginServerSide.php');
$referer= $_SERVER['HTTP_REFERER'];

//if referer is not the form redirect the browser to the previous form
if($referer != URLFORM && $referer!=URLIST){
    header('Location: '.URLFORM);
}*/
?>
<html>
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
         
        require_once('connection.php');
        $query='SHOW TABLES';
        extract($_POST);

error_reporting(0);
  $studentId = $_COOKIE['user'];

        $seeprofile= $_POST['seeprofile'];
        
        echo '&#10084; <a href="logout.php">Log Out ('.$_COOKIE['user']. ')</a>';   
        

if (!($link = mysqli_connect($host, $userr, $passwd, $dbname))){
        echo '<p>Error connecting to database</p>';
    } else {
        
          $query= "SELECT student_id, email, groups FROM students ORDER BY groups";
        if (!($result = mysqli_query($link, $query))){
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }else {
        
            echo "<table align='center'><thead align='center'><tr><th>Row</th>";
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            }
            echo "</tr></thead>\n<tbody>";
            for ($i = 0; $i<mysqli_num_rows($result); $i++){
                echo "<tr align='center'><td align='center'>" . ($i + 1) . "</td>";
             
                $row = mysqli_fetch_row($result);
                for ($j = 0; $j<mysqli_num_fields($result); $j++){
                    echo "<td align='center' >&nbsp;".$row[$j] . "</td>";
                    
                    
                }
               // echo "<td>"."<input type=submit name=update value=Profile method=post"." </td>";
                echo "</tr>\n";
            }
            echo "</tbody></table>";
            
            
            
             $query= "SELECT * FROM students";
     if (!($result = mysqli_query($link, $query)))
     {
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }
    else  {
         
            $opt = "<select name='stuid' >";
        
        
         /*while($row = mysqli_fetch_assoc($result))
         {
             
             $opt .="<option value='{$row['student_id']}'>{$row['student_id']}</option>\n";
         }*/
        
        
               
                
                for ($j = 0; $j<mysqli_num_rows($result); $j++){
                    $row = mysqli_fetch_assoc($result);
                    
                    if($row['student_id']!=$studentId){
                  
                   $opt .="<option value='{$row['student_id']}'>{$row['student_id']}</option>\n";

                  } else {
                      $newstu = $row['student_id'];
                  }
                }

         $opt .="</select>";
      $selectedoption = $_POST['stuid'];
       
        }
    
            
           
            
            
        }
    
    
    
     if (isset($_POST['seeprofile'])){
            $selected_id =$_POST['stuid'];
           // echo $selected_id;
            
             $query= "SELECT student_id, email, groups FROM students WHERE student_id = $selected_id";
        if (!($result = mysqli_query($link, $query))){
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }else {
        
            echo "<table align='center'><thead align='center'><tr><th>Row</th>";
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            }
            echo "</tr></thead>\n<tbody>";
            for ($i = 0; $i<mysqli_num_rows($result); $i++){
                echo "<tr align='center'><td align='center'>" . ($i + 1) . "</td>";
             
                $row = mysqli_fetch_row($result);
                for ($j = 0; $j<mysqli_num_fields($result); $j++){
                    echo "<td align='center' >&nbsp;".$row[$j] . "</td>";
                    
                    
                }
               // echo "<td>"."<input type=submit name=update value=Profile method=post"." </td>";
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
        
        
        
        }
    
         $link->close();
    }


?>
          <div class="container"><br>
		
		<div class="col-lg-6 m-auto d-block">
	<form  name="myForm" method="post" id="myForm" action="<?php echo $_SERVER['PHP_SELF'];?>" class="bg-light">
        
        <div class="form-group">
      <label for="students" class="font-weight-bold"> Students List: </label>  <?php echo $opt;?>               
 <input type="submit" class="btn btn-success" formaction="" name=seeprofile value="See Profile ">   
        </div>
        
        <div class="form-group">
               
 <input type="submit" name=sendemail class="btn btn-success" formaction="/emailformphp.php" value="Send Email To Groups ">
        </div>
</form>
  </div>
                </div>

</body>
</html>