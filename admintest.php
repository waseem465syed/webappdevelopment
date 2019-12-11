<?php 
error_reporting(E_ALL);

    // previous form from where it should come 
d/*efine('URLFORM', 'http://localhost/login.html');

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
         
        $host = 'localhost';
        $userr = 'waseem';
        $passwd= 'localhost';
        $dbname= 'waseem';
        $query='SHOW TABLES';
        extract($_POST);

error_reporting(0);
$studentId = $_POST['user'];
$userPasswd = $_POST['pass'];
$group1='1';
$group2='2';
$group3='3';
$group4='4';
$group5='5';
$group6='6';
$group7='7';
$group8='8';
$group9='9';
$group10='10';


if (!($link = mysqli_connect($host, $userr, $passwd, $dbname))){
        echo '<p>Error connecting to database</p>';
    } else {
        
          $query= "SELECT student_id, email, groups FROM student WHERE groups = $group1";
        if (!($result = mysqli_query($link, $query))){
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }else {
            echo "<table align='left'><thead align='center'><tr><th>Row</th>";
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            }
            echo "</tr></thead>\n<tbody>";
            for ($i = 0; $i<mysqli_num_rows($result); $i++){
                echo "<tr align='center'><td align='center'>" . ($i + 1) . "</td>";
                $row = mysqli_fetch_row($result);
                for ($j = 0; $j<mysqli_num_fields($result); $j++){
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
            
            $query= "SELECT student_id, email, groups FROM student WHERE groups = $group2";
        if (!($result = mysqli_query($link, $query))){
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }else {
            echo "<br><br><br><br><br><table align='left'><thead align='center'><tr><th>Row</th>";
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            }
            echo "</tr></thead>\n<tbody>";
            for ($i = 0; $i<mysqli_num_rows($result); $i++){
                echo "<tr align='center'><td align='center'>" . ($i + 1) . "</td>";
                $row = mysqli_fetch_row($result);
                for ($j = 0; $j<mysqli_num_fields($result); $j++){
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
              
            $query= "SELECT student_id, email, groups FROM student WHERE groups = $group3";
        if (!($result = mysqli_query($link, $query))){
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }else {
            echo "<br><br><br><br><br><table align='left'><thead align='center'><tr><th>Row</th>";
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            }
            echo "</tr></thead>\n<tbody>";
            for ($i = 0; $i<mysqli_num_rows($result); $i++){
                echo "<tr align='center'><td align='center'>" . ($i + 1) . "</td>";
                $row = mysqli_fetch_row($result);
                for ($j = 0; $j<mysqli_num_fields($result); $j++){
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
              
            $query= "SELECT student_id, email, groups FROM student WHERE groups = $group4";
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
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
              
            $query= "SELECT student_id, email, groups FROM student WHERE groups = $group5";
        if (!($result = mysqli_query($link, $query))){
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }else {
            echo "<br><br><br><br><table align='center'><thead align='center'><tr><th>Row</th>";
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            }
            echo "</tr></thead>\n<tbody>";
            for ($i = 0; $i<mysqli_num_rows($result); $i++){
                echo "<tr align='center'><td align='center'>" . ($i + 1) . "</td>";
                $row = mysqli_fetch_row($result);
                for ($j = 0; $j<mysqli_num_fields($result); $j++){
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
              
            $query= "SELECT student_id, email, groups FROM student WHERE groups = $group6";
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
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
              
            $query= "SELECT student_id, email, groups FROM student WHERE groups = $group7";
        if (!($result = mysqli_query($link, $query))){
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }else {
            echo "<table align='right'><thead align='center'><tr><th>Row</th>";
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            }
            echo "</tr></thead>\n<tbody>";
            for ($i = 0; $i<mysqli_num_rows($result); $i++){
                echo "<tr align='center'><td align='center'>" . ($i + 1) . "</td>";
                $row = mysqli_fetch_row($result);
                for ($j = 0; $j<mysqli_num_fields($result); $j++){
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
              
            $query= "SELECT student_id, email, groups FROM student WHERE groups = $group8";
        if (!($result = mysqli_query($link, $query))){
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }else {
            echo "<table align='right'><thead align='center'><tr><th>Row</th>";
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            }
            echo "</tr></thead>\n<tbody>";
            for ($i = 0; $i<mysqli_num_rows($result); $i++){
                echo "<tr align='center'><td align='center'>" . ($i + 1) . "</td>";
                $row = mysqli_fetch_row($result);
                for ($j = 0; $j<mysqli_num_fields($result); $j++){
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
              
            $query= "SELECT student_id, email, groups FROM student WHERE groups = $group9";
        if (!($result = mysqli_query($link, $query))){
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }else {
            echo "<table align='right'><thead align='center'><tr><th>Row</th>";
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            }
            echo "</tr></thead>\n<tbody>";
            for ($i = 0; $i<mysqli_num_rows($result); $i++){
                echo "<tr align='center'><td align='center'>" . ($i + 1) . "</td>";
                $row = mysqli_fetch_row($result);
                for ($j = 0; $j<mysqli_num_fields($result); $j++){
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
              
            $query= "SELECT student_id, email, groups FROM student WHERE groups = $group10";
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
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
              
            $query= "SELECT student_id, email, groups FROM student WHERE groups = $group6";
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
                    echo "<td align='center'>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
            
            
             $query= "SELECT * FROM student";
     if (!($result = mysqli_query($link, $query)))
     {
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }
    else  {
         
        
         
           $opt = "<select name='stuid'>";
        
        
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
       
        }
    
            
            
            
            
        }
         $link->close();
    }


?>
	<form  name="myForm" method="post" id="myForm"  class="bg-light">
        <div class="form-group">
      <label for="students" class="font-weight-bold"> Students List: </label>  <?php echo $opt;?>   
        </div>
        
        <div class="form-group">
               
 <input type="submit" formaction="/emailformphp.php" value="Send Email To Groups ">
        </div>
</form>


</body>
</html>