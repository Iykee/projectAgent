<?php

$login=0;
if(isset($_SESSION['login'])){
#Gets User Information------------------------------------------
    $login=$_SESSION['login'];
    $sql="SELECT * FROM member";
    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
    $res=mysql_query($sql) or die (mysql_error());
    while($data = mysql_fetch_array($res)){
        if ($data['memID']==$login) {
            $myMemID=$data['memID'];
            $myName=$data['mName'];
            $myName=$data['lName'].", ".$data['fName']." ".$myName[0].".";
            $myLoc=$data['locID'];
            $myPos=$data['position'];
            $myPass=$data['memPword'];
            $myTerm=$data['term'];
#Gets User Location--------------------------------------------
            $lsql="SELECT * FROM location";
		    $lresult = mysqli_query($connect,$lsql) or die("ERROR CONNECTING TO DB");
		    $lres=mysql_query($lsql) or die (mysql_error());
		    while($ldata = mysql_fetch_array($lres)){
		        if ($ldata['locID']==$myLoc) {
	                $myBrgy=$ldata['barangay'];
	                $myCity=$ldata['city'];
	                $myZip=$ldata['zipcode'];
                    $myAdd=$ldata['street'].", ".$ldata['barangay'].", ".$ldata['city']." ";
			    }        
		    }    
#END OF Getiing User Location-----------------------------------
        }        
    }
    $myPic='pics/profpic.jpg';
    $sql="SELECT * FROM gallery";
    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
    $res=mysql_query($sql) or die (mysql_error());
    while($data = mysql_fetch_array($res)){
        if($data['locID']==$myLoc){
            $myPic=$data['imageLink'];
        }
    }
    //if(is_null($myPic)){
      //  $myPic='pics/profpic.jpg';//DEFAULT PICTURE OF THE USER ------------------------------PLS CHANGE...yeah
    //}
#END OF Getiing User Information--------------------------------
    
}
if($login==0){
    echo header('location:index.php');
}
?>