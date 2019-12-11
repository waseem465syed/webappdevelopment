<?php 

function tablefunction(){
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

?>