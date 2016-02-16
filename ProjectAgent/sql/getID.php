<?php
            
    $sql="SELECT * FROM $tableName";
    $newID=0;
    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
    $res=mysql_query($sql) or die (mysql_error());
    while($data = mysql_fetch_array($res)){
    	if($data[$IDname]>$newID){
	        $newID=$data[$IDname];
    	}
    }
    $newID=$newID+1;
?>      