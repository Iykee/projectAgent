<?php
    include '../connect/db.php';
    include 'checkLogin.php';
$annual=0;
    $budsql="SELECT * FROM Budget";
    $budresult = mysqli_query($connect,$budsql) or die("ERROR CONNECTING TO DB");
    $budres=mysql_query($budsql) or die (mysql_error());
    $total=0;
    while($bata = mysql_fetch_array($budres)){
           $year=date('Y');
            $date=$bata['dateReceived'];
            $myYear=$date[0].$date[1].$date[2].$date[3];

            /**if($myYear==$year && $bata['memID']==$myMemID && $bata['budDesc']=='Annual Budget' ){
                $annual=$bata['budAmount'];
                echo $annual."annual<br><br>";
            }
            if($myYear==$year && $bata['budAmount']!=NULL && $bata['memID']==$myMemID && $bata['budDesc']!=NULL  && $bata['budDesc']!='Annual Budget'){
                    $total=$total+$bata['budAmount'];
            }**/ /**removed by raymond**/

            if(/* $myYear==$year && $bata['memID']==$myMemID &&*/  $bata['budDesc']=='Annual Budget' ){
                $annual=$bata['budAmount'];
                echo $annual."annual<br><br>";
            }
            if(/* $myYear==$year && */ $bata['budAmount']!=NULL && /* $bata['memID']==$myMemID && */ $bata['budDesc']!=NULL  && $bata['budDesc']!='Annual Budget'){
                    $total=$total+$bata['budAmount'];
            }


                        
    }
    $total=$annual-$total;
//Project STATUS Update----------------------------------------------------------
    if(isset($_POST['uProject'])){
        $projectID=$_POST['uProject'];
        $sql="SELECT * FROM project";
        $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
        $res=mysql_query($sql) or die (mysql_error());

        while($data = mysql_fetch_array($res)){
            if($data['projID']==$projectID){
            	if($data['projStat']=="pending"){
            		$status="on-going";
                    $update=0;
                    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
                    if($result->num_rows>0){
                        mysqli_query($connect,"UPDATE project SET approvedBy='$myMemID' WHERE projID='$projectID'");

                    }
            	}else{
            		$status="existing";
                    $update=1;
            	}
            }
        }
        $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
        if($result->num_rows>0){
       		mysqli_query($connect,"UPDATE project SET projStat='$status' WHERE projID='$projectID'");

       	}
        $log="Project Status Update for Project ".$projectID." to ".$status;
        include 'log.php';
        $_SESSION['update']=$update;
//End Of Project Update--------------------------------------------------------------
//Budget Update----------------------------------------------------------------------
    }
    
    echo $total."total<br>";
    echo $_POST['expenses'];
    if (isset($_POST['expenses']) && $_POST['expenses'] > 0 && $_POST['expenses'] <= $total) {
          
           echo "good";
        $projectID=$_POST['bProject'];
        $expenses=$_POST['expenses'];
        $description=$_POST['description'];
        $dateReceived=date('Y-m-d');
        $sql="INSERT INTO budget (projID,budAmount,buddesc,dateReceived) VALUES ('$projectID','$expenses','$description','$dateReceived')";
        if(!mysql_query($sql)){
            die('ERROR' . mysql_error());                    
        }
        $log="Budget Updated for Project ".$projectID." of amount ".$expenses;
        include 'log.php';
    
//INSERT A Gallery and a Location----------------------------------------------------
    }else if(isset($_POST['bProject'])){
        echo "bad";
        $projectID=$_POST['bProject'];

    }
    if(isset($_POST['addimage'])){
        $projectID=$_POST['addimage'];
        $imageLink=$_POST['imageLink'];
        $street=$_POST['location'];
        $tableName='location';$IDname='locID';include 'getID.php';
        $locID=$newID;
        $sql="INSERT INTO location (locID,street,barangay,city,zipcode) VALUES ('$locID','$street','$myBrgy','$myCity','$myZip')";
        if(!mysql_query($sql)){
            die('ERROR' . mysql_error());                    
        }
        $sql="INSERT INTO Gallery (projectID,imageLink,locID) VALUES ('$projectID','$imageLink',$locID)";
        if(!mysql_query($sql)){
            die('ERROR' . mysql_error());                    
        }
        $log="Gallery and Location Inserted for Project ".$projectID." at Location ".$locID." with Image of ".$imageLink;
        include 'log.php';
        
    }



//END OF INSERTION-------------------------------------------------------------------
    $_SESSION['projectID']=$projectID;
    echo header('location:../myProject.php');
#   	if($status=="on-going"){
#   	echo header('location:../ongoing.php');
#	}else{
#		echo header('location:../existing.php');
#	}

?>