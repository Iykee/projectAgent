<?php
	include '../connect/db.php';
	$memID=$_SESSION['memID'];
	if (isset($_POST['update']) || isset($_POST['budget'])){


		if($_POST['newlName']!=NULL){
			$lName=$_POST['newlName'];
			mysqli_query($connect,"UPDATE member SET lName='$lName' WHERE memID='$memID'");
			$log="Last Name Updated to ".$lName;
			include 'log.php';
		}if($_POST['newpassword']!=NULL){
			$password=$_POST['newpassword'];
			mysqli_query($connect,"UPDATE member SET memPword='$password' WHERE memID='$memID'");
			$log="Password Updated";
			include 'log.php';
		}if($_POST['newaddress']!=NULL){
		    $locID=$_POST['update'];
		    $address=$_POST['newaddress'];
		 	mysqli_query($connect,"UPDATE location SET street='$address' WHERE locID='$locID'");   
		 	$log="Address of ".$locID." updated to ".$address;
		 	include 'log.php';
		}if($_POST['newBudget']!=NULL){
			$budget=$_POST['newBudget'];
			$budDesc='Annual Budget';
			$date=date("Y-m-d");
			$sql="INSERT INTO budget (budDesc,budAmount,source,dateReleased,memID) VALUES ('$budDesc','$budget','Government','$date','$memID')";
			if(!mysql_query($sql)){
                die ('error'.mysql_error());
            }
            $log="Given ".$budget." to member ".$memID;
            include 'log.php';
		}
	}
		

	
	echo header('location:../Aprofile.php');
?>