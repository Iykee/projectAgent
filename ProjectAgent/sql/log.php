<?php

	$sql="INSERT INTO log (logDesc, memID) VALUES ('$log', '$myMemID')";
	if(!mysql_query($sql)){
	    die ("Error ".mysql_error());
	}

?>