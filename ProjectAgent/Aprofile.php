<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project Agent</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/mycss.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php $page="Admin";?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            
                <?php
                    #Top Menu Items
                    include 'navigation/topNav.php';
                    #Sidebar Menu Items - These collapse to the responsive navigation menu on small screens
                    include 'navigation/Asidebar.php';
                ?>
            
            
                        <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
                <?php

#Gets User Information------------------------------------------
    if (isset($_SESSION['memID'])) {
        $memID=$_SESSION['memID'];    
    }else{
        $memID=$_POST['memID'];
    }
    $_SESSION['memID']=$memID;
    $usql="SELECT * FROM member";
    $uresult = mysqli_query($connect,$usql) or die("ERROR CONNECTING TO DB");
    $ures=mysql_query($usql) or die (mysql_error());
    while($udata = mysql_fetch_array($ures)){
        if ($udata['memID']==$memID) {
            $uName=$udata['mName'];
            $ulName=$udata['lName'];
            $uName=$udata['lName'].", ".$udata['fName']." ".$uName[0].".";
            $uLoc=$udata['locID'];
            $uPos=$udata['position'];
            $uTerm=$udata['term'];
            $uPass=$udata['memPword'];
            $uNum=$udata['contactNo'];
            $uEmail=$udata['email'];
            $uDateReg=$udata['dateReg'];
            $ubday=$udata['dateOfBirth'];

#Gets User Location--------------------------------------------
            $lsql="SELECT * FROM location";
            $lresult = mysqli_query($connect,$lsql) or die("ERROR CONNECTING TO DB");
            $lres=mysql_query($lsql) or die (mysql_error());
            while($ldata = mysql_fetch_array($lres)){
                if ($ldata['locID']==$uLoc) {
                    $uloc=$ldata['street'];
                    $uBrgy=$ldata['barangay'];
                    $uCity=$ldata['city'];
                    $uZip=$ldata['zipcode'];
                }        
            }    
            $gsql="SELECT * FROM gallery";
            $gresult = mysqli_query($connect,$gsql) or die("ERROR CONNECTING TO DB");
            $gres=mysql_query($gsql) or die (mysql_error());
            $profilePic="pics/profpic.jpg";
            while($gdata = mysql_fetch_array($gres)){
                if ($gdata['locID']==$uLoc) {
                    $profilePic=$gdata['imageLink'];
                }        
            }    
#END OF Getiing User Location-----------------------------------
        }        
    }
#END OF Getiing User Information--------------------------------

?>
                <!-- Page Heading -->
                <div class="row">

<?php
#Member View---------------------------------------------------------------------
#Image not Working
#updated Image working
?>                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <!-- <?php echo "".$uBrgy.", ".$uCity.", ".$uZip."";?> -->
                        </h1>
                        <div class="col-lg-6">
                            <?php echo "<img class='img-responsive' style='width:500px; height:400px; ' src='$profilePic'>"?>
                        </div>
                        <?php
                            echo "<div class='col-lg-6'>";
                                echo "<h4>Name: ".$uName."</h4>";
                                echo "<h4>Email: ".$uEmail."</h4>";
                                echo "<h4>Contact No: ".$uNum."</h4>";
                                echo "<h4>Address: ".$uloc."</h4>";
                                echo "<h4>Birthdate: ".$ubday."</h4>";

                                echo "<br><br>";

                                echo "<h4>Barangay: ".$uBrgy."</h4>";
                                echo "<h4>Position: ".$uPos."</h4>";
                                echo "<h4>Term: ".$uTerm."</h4>";

                                echo "<br><br><br><br>";

                                echo "<h4>Date Registered: ".$uDateReg."</h4>";

#END OF Member View--------------------------------------------------------------
#Member Uodate-------------------------------------------------------------------                                
                              
                                echo "</div>";

                        ?>
<?php
#END OF Member Update------------------------------------------------------------
#Budget View---------------------------------------------------------------------
?>
                          <?php  
                          if($uPos=='Committee Chairman'){
                            echo "<div class='col-lg-12'>                          
                                    <br><br><button  data-toggle='collapse' data-target='#annualBudget' class='btn btn-success'
                                        style='font-size:20pt;border:0;text-align:center;width:100%'>Annual Budget</button>
                            
                                <ul id='annualBudget' class='collapse'>
                                    
                                    <table class='table table-hover' style='width : 100%' border='0'>
                                        <tr style='background-color:white;border-top:1px solid black;'>
                                            <td><h3 style='color:darkgreen;'><u>Source of Fund</u></h3></td>
                                            <td><h3 style='color:darkgreen;'><u>Budget</u></h3></td>
                                            <td><h3 style='color:darkgreen;'><u>Date Released</u></h3></td>
                                        </tr>";
                                        
                                            $budsql="SELECT * FROM Budget";
                                            $budresult = mysqli_query($connect,$budsql) or die("ERROR CONNECTING TO DB");
                                            $budres=mysql_query($budsql) or die (mysql_error());
                                            $total=0;
                                            while($bata = mysql_fetch_array($budres)){
                                                if($bata['memID']==$memID){
                                                    $color="black";
                                                    if($bata['source']!='Government'){ $color="green";}
                                                        echo"
                                                        <td><h4 style='color:$color'>".$bata['source']."</h4></td>
                                                        <td><h4 style='color:$color'>".$bata['budAmount']."</h4></td>
                                                        <td><h4 style='color:$color'>".$bata['dateReleased']."</h4></td><tr>";
                                                    }                          
                                            }


                                    
                                            
                                                echo "<form method='post' action='sql/Aupdate.php'>
                                                    <div class='col-lg-9'>
                                                        <input name='newBudget' placeholder='Budget Amount' type='number'>
                                                    </div>
                                                    <div class='col-lg-3'>
                                                        
                                                            <button  name='budget' value='$memID' class='btn btn-success'>Add Budget</button>
                                                        
                                                    </div>
                                                </form>";
                                            }
#END OF Bidget View--------------------------------------------------------------                                            
#View Proposed Prjects-----------------------------------------------------------
                                        ?>
                                    </table>

                                </ul>
                                       
                            
                                <div class="colblue">                          
                                    <h1 style="text-align:center;color:yellow;">
                                        <button  data-toggle="collapse" data-target="#demo" class="btn btn-info" 
                                                    style="font-size:20pt;border:0;width:100%">View Projects</button>
                                    </h1>
                                </div>
                                <ul id="demo" class="collapse">
                                    <table class="table table-hover" style="width : 100%" border="0">
                                            <tr style="background-color:white;border-top:1px solid black;">
                                                <td><h3 style="color:blue;">ID</h3></td>
                                                <td><h3 style="color:blue;">Name</h3></td>
                                                <td><h3 style="color:blue;">Status</h3></td>
                                            </tr>
                                            <?php
                                                $sql="SELECT * FROM project";
                                                $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
                                                $res=mysql_query($sql) or die (mysql_error());
                                                while($data = mysql_fetch_array($res)){
                                                    if($data['memID']==$memID){
                                                        echo"
                                                        <td><h4>".$data['projID']."</h4></td>
                                                        <td><h4>".$data['projName']."</h4></td>
                                                        <td><h4>".$data['projStat']."</h4></td><tr>";
                                                    }
                                                }

#END OF Viewing Proposed Projects------------------------------------------------
                                            ?>
                                    </table>
                                </ul>

                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <br>
                <br>
                <br>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
