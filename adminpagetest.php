<?php 
error_reporting(E_ALL);
//require_once('startsession.php');

    // previous form from where it should come 
/*efine('URLFORM', 'http://localhost/login.php');

// current form address
define('URLLIST', 'http://localhost/adminpage.php');
$referer= $_SERVER['HTTP_REFERER'];

//if referer is not the form redirect the browser to the previous form
if($referer != URLFORM && $referer!=URLLIST){
    header('Location: '.URLFORM);
}*/





if (!isset($_SESSION['user'])){
    if(isset($_COOKIE['user'])){
        $_SESSION['user']=$_COOKIE['user'];
    }
}

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

  $studentId = $_COOKIE['user'];
  $elg = $_POST['av'];
        $order = $_POST['order'];
      $selected_group =$_POST['group'];
          
        
        echo '&#10084; <a href="logout.php">Log Out ('.$_COOKIE['user']. ')</a>';   
        
$link = mysqli_connect($host, $userr, $passwd, $dbname);

    
    
     
     if (isset($_POST['seegroup'])){
         $selected_group =$_POST['group'];
          
           // echo $selected_id;
            
             $query= "SELECT student_id, email, groups FROM students WHERE groups = $selected_group";
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
            
            
             $query= "SELECT student_id FROM students WHERE groups = '$selected_group'";
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
    //  $selectedoption = $_POST['stuid'];
       
        }
    /*   function build_query($elg, $order, $grade){
             $host = 'localhost';
        $userr = 'waseem';
        $passwd= 'localhost';
        $dbname= 'waseem';
           $link = mysqli_connect($host, $userr, $passwd, $dbname);
               $query = "SELECT student_id, email, groups, grade FROM students WHERE grade $elg $grade ORDER BY grade $order";
         $real_query = sprintf($query);
             $result = mysqli_query($link, $real_query); 
            
                 
                 
                 return $result; 
             }
        */
        
        
        function build_query($selected_grades,$elg, $sort){
            
            $search_query = "SELECT student_id, grade, email, groups FROM students ";
            $search_query.= " WHERE grade $elg";
            $search_query.=" $selected_grades";
            switch ($sort) {
                case 1:
                    $search_query.=" ORDER BY grade DESC";
                    break;
                    
                case 2: 
                    $search_query.= " ORDER BY grade ASC";
                    break;
                default:
                    
            }
            return $search_query;
            
        }
        
            if (isset($_POST['search'])){
            $selected_grades =$_POST['grades'];
             $elg = $_POST['av'];
        $order = $_POST['order'];
      
           $query=  build_query($selected_grades,$elg, $order);
            $result = mysqli_query($link, $query);
         echo "<table align='center'><thead align='center'><tr><th>Row</th>";
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            }
            echo "</tr></thead>\n<tbody>";
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
                              
           
            
            
            
    
    
    
     if (isset($_POST['seeprofile'])){
            $seeprofile= $_POST['seeprofile'];
            $selected_id =$_POST['stuid'];
           // echo $selected_id;
            
             $query= "SELECT students.student_id, students.grade, students.email, students.groups, ratings.rating, ratings.comment, ratings.image, ratings.rater_id FROM students INNER JOIN ratings ON (ratings.rated_id = students.student_id) WHERE students.student_id= $selected_id"; 
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
    


?>
          <div class="container"><br>
		
		<div class="col-lg-6 m-auto d-block">
	<form  name="myForm" method="post" id="myForm" action="<?php echo $_SERVER['PHP_SELF'];?>" class="bg-light">
          
        <div style="padding: 25px; background-color: #98AFC7;">
        <label class="font-weight-bold">Select Group</label>
            <select name="group" id="group">
                
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
                             
 <input type="submit" class="btn btn-success" formaction="" name=seegroup value="See Group">   
        </div>
        
        <div style="padding: 25px; background-color: #E5E4E2;">
      <label for="students" class="font-weight-bold"> Students List: </label>  <?php echo $opt;?>               
 <input type="submit" class="btn btn-success" formaction="" name=seeprofile value="See Profile ">   
        </div>
        
        		<div style="padding: 25px; background-color: #BCC6CC;">
			 <label class="font-weight-bold">Search by grades</label>
            <select name="grades" id="grades">
                
                 <option value="0">0</option>
                 <option value="1" selected>1</option>
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
                <input type="radio" name="av" value="<"> Less than
<input type="radio" name="av" value=">"> Greater than
                    <input type="radio" name="av" value="=" checked="checked"> Equal to
                     <input type="submit" class="btn btn-success" formaction="" name=search value="Search">  
                     <input type="radio" name="order" value="2" checked="checked"> Ascending
                     <input type="radio" name="order" value="1"> Desending
				</div>
        
        
        
        <div style="padding: 25px; background-color: #98AFC7;">
 <input type="submit" name=sendemail class="btn btn-success" formaction="/emailformphp.php" value="Send Email To Groups ">
        </div>
</form>
  </div>
                </div>

</body>
</html>