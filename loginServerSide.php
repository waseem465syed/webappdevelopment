


<?php 
error_reporting(E_ALL);

    // previous form from where it should come 
define('URLFORM', 'http://localhost/login.html');

// current form address
define('URLLIST', 'http://localhost/loginServerSide.php');
$referer= $_SERVER['HTTP_REFERER'];

//if referer is not the form redirect the browser to the previous form
if($referer != URLFORM && $referer!=URLIST){
    header('Location: '.URLFORM);
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
         
        $host = 'localhost';
        $userr = 'waseem';
        $passwd= 'localhost';
        $dbname= 'waseem';
        $query='SHOW TABLES';
        extract($_POST);

error_reporting(0);
$studentId = $_POST['user'];
$userPasswd = $_POST['pass'];

if (!($link = mysqli_connect($host, $userr, $passwd, $dbname))){
        echo '<p>Error connecting to database</p>';
    } else {
        
        $query= 'SELECT * FROM student';
        if (!($result = mysqli_query($link, $query))){
            printError(sprintf("Error %s : %s", mysqli_errno($link), mysqli_error($link)));
        }else {
            echo "<table><thead><tr><th>Row</th>";
            $fields = mysqli_fetch_fields($result);
            for ($i = 0; $i<mysqli_num_fields($result); $i++){
                echo "<th>" . $fields[$i]->name . "</th>\n";
            }
            echo "</tr></thead>\n<tbody>";
            for ($i = 0; $i<mysqli_num_rows($result); $i++){
                echo "<tr><td>" . ($i + 1) . "</td>";
                $row = mysqli_fetch_row($result);
                for ($j = 0; $j<mysqli_num_fields($result); $j++){
                    echo "<td>&nbsp;".$row[$j] . "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody></table>";
        }
         $link->close();
    }


?>

<!DOCTYPE html>



</body>
</html>