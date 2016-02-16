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
<?php $page="project";?>
<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php
                include 'navigation/topNav.php';
                include 'navigation/sidebar.php';
            ?>
                        <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                
                

            
                <?php
                    $checkUpdate=3;
                    if(isset($_SESSION['projectID'])){
                        $projectID=$_SESSION['projectID'];
                        if(isset($_SESSION['update'])){
                            $checkUpdate=$_SESSION['update'];
                        }

                    }else{
                        $projectID=$_POST['project']; //error here
                    }
                    $status="existing";
                    $image="pics/cat.jpg";
                    $sql="SELECT * FROM project";
                    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
                    $res=mysql_query($sql) or die (mysql_error());
                    while($data = mysql_fetch_array($res)){
                        if($data['projID']==$projectID){
#header---------------------------------------------------------------------------------------------------------
#checks Status-------------------------------------------------------------------
                            if($data['projStat']=="pending"){
                                $status="Approve Project";
                            }elseif($data['projStat']=="on-going"){
                                $status="Finished";
                            }
#END OF Check Status-------------------------------------------------------------
#dispalay project Name and ID----------------------------------------------------
                            echo   "<h1 class='page-header'>".$data['projName']."<big style='color: gray'>|</big><small>".$projectID."</small>";
#approve button------------------------------------------------------------------
                            if($status!="existing"){
                                echo "<form method='post' action='sql/update.php'><div id='firstbutton'><button  name='uProject' class='btn btn-success' 
                                        style='font-size:18px;' value='$projectID' >".$status."</button></div></form>";             
                            }      
                            echo "</h1>";
#END OF header--------------------------------------------------------------------------------------------------
                            echo "<h1 style='text-align:center'>";

                            if($checkUpdate==0){
                                echo "Approved";
                            }else if($checkUpdate==1){
                                echo "Finished";
                            }else if($checkUpdate==2){
                                echo "Successsfully Created the Project!";
                            }
                            echo "<h1>";
#content--------------------------------------------------------------------------------------------------------
                            $sectorType="Unknown";
                            $sectorID=$data['sectorID'];
                            $sec="SELECT * FROM sector";
                            $secresult = mysqli_query($connect,$sec) or die("ERROR CONNECTING TO DB");
                            $secres=mysql_query($sec) or die (mysql_error());
                            while($secdata = mysql_fetch_array($secres)){
                                if($sectorID==$secdata['sectorID']){
                                    $sectorType=$secdata['secType'];
                                }
                            }


#committee_content--------------------------------------------------------------------------------------------------------
                            $comName="Unknown";
                            $comID=$data['comID'];
                            $com="SELECT * FROM committee";
                            $comresult = mysqli_query($connect,$com) or die("ERROR CONNECTING TO DB");
                            $comres=mysql_query($com) or die (mysql_error());
                            while($comdata = mysql_fetch_array($comres)){
                                if($comID==$comdata['comID']){
                                    $comName=$comdata['comName'];
                                }
                            }




#dispaly project contents------------------------------------------------------   
                            echo "<h4><b>Sector: </b>".$sectorType."</h4>";
                            echo "<h4><b>Committee: </b>".$comName."</h4>";
                            echo "<h4><b>Description: </b>".$data['projDesc']."<h4>";
                            ?>

                            <!--
                            <div >  
                                <h2 class="page-header" style="text-align:center;">
                                    <button  data-toggle="collapse" data-target="#expenses" class="btn btn-primary" 
                                                style="font-size:18px; width:90%">Add New Expense</button>
                               </h2>

                                

                                    
                                    <ul id="expenses" class="collapse">   
                                    <table class="table-hover" style="width :80%; margin-top:70px; margin-left:20px;" border="0"; >
                                        <thead class="page-header" style="background-color:white; margin-right:-50px;">
                                            <td ><h4 style="color:darkgreen; margin-left:25px;"><u>Amount Description</u></h4></td>
                                            <td ><h4 style="color:darkgreen;"><u>Amount Expense</u></h4></td>
                                            <td ><h4 style="color:darkgreen;"><u>Date</u></h4></td>
                                        </thead>

                            -->           
                                        <?php
                                            $budsql="SELECT * FROM Budget";
                                            $budresult = mysqli_query($connect,$budsql) or die("ERROR CONNECTING TO DB");
                                            $budres=mysql_query($budsql) or die (mysql_error());
                                            $total=0;
                                            while($bata = mysql_fetch_array($budres)){
                                                if($bata['projID']==$data['projID']){
                                                    $color="black";
                                                    if($bata['source']!='Government'){ $color="green";}
                                                        echo"
                                                        <tr>
                                                        <td><h4 style='color:$color'>".$bata['budDesc']."</h4></td>
                                                        <td><h4 style='color:$color'>".$bata['budAmount']."</h4></td>
                                                        <td><h4 style='color:$color'>".$bata['dateReceived']."</h4></td><tr>";
                                                    }                          
                                            }



                                        ?>

                                <!--

                                    <form method="post" action="sql/update.php">
                                        <div class="col-lg-8">
                                            <input name="expenses" placeholder="Amount Expense" type="number" required>
                                            <input name="description" placeholder="Description (Ex: 4 Pieces Barrel..)" type="text" required>
                                        </div>
                                            <?php
                                                echo "<button type='submit' name='bProject' class='btn btn-success' value=$projectID >Add Project Expense</button>";
                                            ?>
                                        </div>
                                    </form>

                                -->    

                            <!--
                                    <br>
                                    <br>    
                                    </table> 
                                    <br><br> 
                                </ul>
                            </div> 

                            -->



                            <!--
                            <h2 class='page-header' style='text-align:center;'>
                                <button  data-toggle="collapse" data-target="#demo" class="btn btn-success" style="font-size:18px; width:90%">View Project Gallery</button>
                            </h2>
                            -->

                            <h2 class='page-header' style='text-align:left;'>
                                <button  data-toggle="collapse" data-target="#demo1" class="btn btn-success" style="font-size:18px; width:20%">View Project Gallery</button>
                                <button  data-toggle="collapse" data-target="#demo" class="btn btn-default" style="font-size:18px; width:2%%">+</button>
                            </h2>

                            

                            <ul id="demo" class="collapse">
                                <form action='sql/update.php' method='post' style="width:60%;">

                                    <input  name='imageLink' placeholder='Image Link' required>
                                    <input  name='location' placeholder='Location' required>
                                   <?php echo "<button name='addimage' class='btn btn-warning' style='width:95%; margin-left:5px;' value='$projectID'>Add Project Photo</button>"; ?>
                                </form>
                            </ul>

                            <ul id="demo1" class="collapse">

                                <?php
    #SQL for Image with Location-----------------------------------------------------
                                echo "<div id='image-wrapper'>";

                                $i=0;
                                $gallerySQL="SELECT * FROM gallery";
                                $galleryresult = mysqli_query($connect,$gallerySQL) or die("ERROR CONNECTING TO DB");
                                $galleryres=mysql_query($gallerySQL) or die (mysql_error());
                                while($gallerydata = mysql_fetch_array($galleryres)){
                                    if($gallerydata['projectID'] == $projectID && $gallerydata['imageLink']!="" ){
                                        $image=$gallerydata['imageLink'];
                                
                                #--------------------------------------------------------          
                                        if($i==0){
                                            echo "<div class='row'>";
                                        }   
                                #--------------------------------------------------------

                                        echo "<div class='col-md-4 portfolio-item' >";
                                        echo "<img class='img-responsive' src=$image style='width:300px;height:230px;'>";

                                        $locID=$gallerydata['locID'];
                                        $locSQL="SELECT * FROM location";
                                        $locresult = mysqli_query($connect,$locSQL) or die("ERROR CONNECTING TO DB");
                                        $locres=mysql_query($locSQL) or die (mysql_error());
                                        while($locdata = mysql_fetch_array($locres)){
                                            if($locdata['locID']==$locID){
                                                echo $locdata['street'];
                                            }
                                        }                                    
                                        echo "</div>";
                                #-------------------------------------------------------
                                        $i++;
                                        if($i==3){
                                            echo "</div><br><br><br>";
                                            $i=0;
                                        }
                                #-------------------------------------------------------
                                    }
                                }
                                echo "</div>";
    #END OF SQL for Image with Location----------------------------------------------
    #END OF content-------------------------------------------------------------------------------------------------
                            }
                        }
                        if(isset($_SESSION['projectID'])){
                            unset($_SESSION['projectID']);
                        }
                        if(isset($_SESSION['update'])){
                            unset($_SESSION['update']);
                        }
                        
                    ?>

                </ul>

                <br>
                <br>
                <br>
                <br>
                <br>
                </div>
            </div>
            <!-- /.row -->
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
