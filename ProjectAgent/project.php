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
<?php $page="project";
    
?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
             <?php
                # Top Menu Items 
                include 'navigation/topNav.php';
                # Sidebar Menu Items - These collapse to the responsive navigation menu on small screens
                include 'navigation/sidebar.php';
            ?>
            <!-- /.navbar-collapse -->
        </nav>

<?php
    if(isset($_POST['submit'])){   

        $date = date("Y-m-d");
        $status="pending";
        $name=$_POST['name'];
        $sector=$_POST['secID'];
        $street=$_POST['street'];
        $budget=$_POST['budget'];  //changed from budAlloc to budget -angela (testing)
        $imageLink=$_POST['imageLink'];
        $description=$_POST['description'];
        
        //--
        $sector-1;

        //---
        $propose=$_POST['propose'];
        $expect=$_POST['expect'];
        $support=$_POST['support'];
        $committee=$_POST['comID'];

        $tableName="project";$IDname="projID";include 'sql/getID.php';  
        $projID=$newID;

        $tableName="budget";$IDname="budgetID";include 'sql/getID.php';
        $budgetID=$newID;

        $tableName="location";$IDname="locID";include 'sql/getID.php';  
        $locID=$newID;
     
#INSERT IN Location------------------------------------------------------------------------        
#pls update ----INSERT zipCode, city, brangay using personal info-------------------------- 
        $sql="INSERT INTO location (street,barangay,city,zipcode) VALUES ('$street','$myBrgy','$myCity','$myZip')";
        if(!mysql_query($sql)){
            die('ERROR' . mysql_error());
        }
#INSERT IN Gallery------------------------------------------------------------------------
        
        $sql="INSERT INTO gallery (projectID,locID,imageLink) VALUES ('$projID',$locID,'$imageLink')";
        if(!mysql_query($sql)){
            die('ERROR' . mysql_error());
        }

#INSERT IN BUDGET------------------------------------------------------------------------        
        
        $sql="INSERT INTO budget (budAmount,projID) VALUES ('$budget','$projID')";
        if(!mysql_query($sql)){
            die('ERROR' . mysql_error());
        }

#INSERT IN Project------------------------------------------------------------------------
        $sql="INSERT INTO project (projID,projName,projDesc,projStat,sectorID,locID,budgetID,comID,memID,supportName,output,proposedBud,budAlloc)
        VALUES ('$projID','$name','$description','$status','$sector','$locID','$budgetID','$committee','$myMemID','$support','$expect','$propose','$budget')";
        if(!mysql_query($sql)){
            die('ERROR' . mysql_error());
        }

        $log="Created new Project ".$projID;
        include 'sql/log.php';
        $_SESSION['projectID']=$projID;
        $_SESSION['update']=2;
        echo header('location:myProject.php');
    
    }

?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                             <div class="tab-panels">
                                    <ul class="tabs">
                                        <li data-panel="panel1" class="active"><h4>Finished</h4></li>
                                        <li data-panel="panel2"><h4 >On-Going</h4></li>
                                        <li data-panel="panel3"><h4 >Pending</h4></li>
                                        <li data-panel="panel4"><h4 >Create</h4></li>
                                    </ul>
                            </div>

                        </h1>
                         
                            <div class="tab-panels">
                                <div id="panel1" class="project active">
                                    <form method="post" action="myProject.php">
                                    <?php
                                        $prostat="existing";
                                        include 'sql/projectviewer.php';
                                    ?>
                                    </form>
                                </div>
                                <div id="panel2" class="project">
                                     <form method="post" action="myProject.php">
                                     <?php
                                        $prostat="on-going";
                                        include 'sql/projectviewer.php';
                                    ?>
                                    </form>
                                </div>  
                                <div id="panel3" class="project">
                                    <form method="post" action="myProject.php">
                                    <?php
                                        $prostat="pending";
                                        include 'sql/projectviewer.php';
                                    ?>
                                    </form>
                                </div> 
                                <div id="panel4" class="project">
                                <br><br><br><br>    
                                    <form name="create" method="post" action="project.php">
                                        <?php
#gets a new id---------------------------------------------------------------
                                        $tableName="project";$IDname="projID";
                                        include 'sql/getID.php';
                                        $projID=$newID;
                                            
                                            echo "<h3 style='margin-left:82%; margin-top:-110px; color:black;'>  Project No: ".$projID."</h3>";
                                            //margin-left was changed to 82 from 80; margin-top was changed from -100 to -110 ---angela
                                        ?>
                                        <div class="row">
                                        <div class="col-md-6">  

                                        <!-- temporary pa ang naming sa forms by category kay confusing ang pag title - angela -->          
                                    
                                        <div id="required">
                                        <h4 style="color:white;margin-left:5px">Primary Information :</h4>
                                        <input name="name"  placeholder="Project Name" required autofocus /><br>
                                        <input name="description"  placeholder="Description" required /><br>
                                        <br>
                                        <h4 style="color:white;margin-left:5px">Project Support :</h4>
                                        <input name="support"  placeholder="Supported By" required /><br>
                                        <input name="expect"  placeholder="Expected Output" required /><br> 
                                        <div id="option-sector" ><select name="secID" required style="width:100%;border-radius:5px; color:#9b9b9b; 
                                                margin-top:5px;font-size: 14pt; height:40px; padding: 5px 7px;" > 
                                            <option disabled selected value="" style="display:none;">Sector</option>

                                            <?php
#RETRIEVE Sector Type-----------------------------------------------------
                                                $sql="SELECT * FROM sector";
                                                $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
                                                $res=mysql_query($sql) or die (mysql_error());
                                                $id=0;
                                                while($data = mysql_fetch_array($res)){
                                                    $id++;
                                                    echo "<option  value='$id' style='color:black'>".$data['secType']."</option><br>";        
                                                }
#END OF RETRIEVE sector Type--------------------------------------------- 
                                            ?>
                                        </select></div> 

                                        <br>
                                        <input name="reset" type="reset"  class="btn btn-danger" style="width:95%; margin-top:20px;"/>


                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div id="notRequired" >
                                            <h4 style="color:white;margin-left:5px">About Project :</h4>
                                            <input name="imageLink" placeholder="Image Link"  />
                                            <input name="street" placeholder="Location(street/specific place)"/><br> 
                                            <br>
                                            <h4 style="color:white;margin-left:5px">Budget :</h4>
                                            <input name="propose"placeholder="Proposed Budget"/><br>
                                            <input name="budget" placeholder="Budget Allocated"/><br>
                                            <div id="option-sector" ><select name="comID" required style="width:100%;border-radius:5px; color:#9b9b9b;
                                                margin-top:5px;font-size: 14pt; height:40px; padding: 5px 7px;" > 
                                            <option disabled selected value="" style="display:none;">Committee</option>

                                            <?php
#RETRIEVE Sector Type-----------------------------------------------------
                                                $sql="SELECT * FROM committee";
                                                $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
                                                $res=mysql_query($sql) or die (mysql_error());
                                                $comID=0;
                                                while($data = mysql_fetch_array($res)){
                                                    $comID=$data['comID'];
                                                    echo "<option  value='$comID' style='color:black'>".$data['comName']."</option><br>";        
                                                }
#END OF RETRIEVE sector Type--------------------------------------------- 
                                            ?>
                                        </select></div> 

                                        <br>
                                        <input name="submit" type="submit"   class="btn btn-primary" style="width:95%; margin-top:20px;"/>
                                            
                                        </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>                        
                    </div>
                </div>
                <!-- /.row -->
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
    
    <script>
        $(function(){
            $('.tab-panels .tabs li').on('click',function(){
            $('.tab-panels .tabs li.active').removeClass('active');
            $(this).addClass('active');
            
            var panelToShow=$(this).attr('data-panel');
            
                $('.tab-panels .project.active').slideUp(300,function(){
                    $(this).removeClass('active');

                    $('#'+panelToShow).slideDown(300,function(){
                        $(this).addClass('active');
                    });     
                });
            });
        });
      
    </script>

</body>

<footer> 
    <?php
        include 'navigation/footer.php';
    ?>
</footer>

</html>
