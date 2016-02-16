<?php
	include '../connect/db.php';
    include 'checkLogin.php';

    if(isset($_POST['updateprof'])){
//UPDATE PROFILE PICTURE-----------------------------------------------    	
        if($_POST['imageLink']!=NULL){
            $imageLink=$_POST['imageLink'];
            mysqli_query($connect,"UPDATE gallery SET imageLink='$imageLink' WHERE locID='$myLoc'");
            $log="Image Updated to ".$imageLink;
            include 'log.php';
           
        }    
//UPDATE PASSWORD-----------------------------------------------------     
    	if($_POST['newpass']!=NULL && $_POST['oldpass']!=NULL ){
			$newpass=$_POST['newpass'];
			$oldpass=$_POST['oldpass'];

			$md5=md5($oldpass);
	    	$sha1=sha1($md5);
	    	$cryptpass=crypt($sha1,'CA');
	    	$oldpass=$cryptpass;
	    	
	    	if($oldpass==$myPass){	    		
		    	$md5=md5($newpass);
		    	$sha1=sha1($md5);
		    	$cryptpass=crypt($sha1,'CA');
		    	$newpass=$cryptpass;			
				mysqli_query($connect,"UPDATE member SET memPword='$newpass' WHERE memID='$myMemID'");
				$log="Password Updated";
            	include 'log.php';
				
			}
		}

		
	}
    echo header('location:../myProfile.php');
?>