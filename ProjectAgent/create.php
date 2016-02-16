<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Budget Monitoring</title>

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
    <script type="text/javascript">
    </script>

</head>

<body>
<?php $page="create";?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php
#smetI uneM poT----------------------------------------------------------------------- 
                include 'navigation/topNav.php';
#smetI uneM rabediS-------------------------------------------------------------------
                include 'navigation/sidebar.php';
            ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Create <small>New Project</small>
                        </h1>
                        <br><br>
                  
                        <form name="create" method="post" action="create.php">
                        <?php
#gets a new id---------------------------------------------------------------
                        $tableName="project";$IDname="projID";include 'sql/getID.php';
                        $projID=$newID;
                            
                            echo "<h3 style='margin-left:80%; margin-top:-100px; background-color:#ff9595'>  Poject No: ".$projID."</h3>";
                        ?>
                        <div class="row">
                        <div class="col-md-6">            
                    
                        <div id="required">
                        <input name="name"  placeholder="Project Name" required autofocus /><br>
                  
                        <input name="description"  placeholder="Description" required /><br>

                        <input name="support"  placeholder="Supported By" required /><br>
                        <input name="expect"  placeholder="Expected Output" required /><br>
                        <div id="option-sector" ><select name="sector" required style="width:100%;border-radius:5px; color:#9b9b9b; font-size: 20pt; height:40px" > 
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
                        <input type="reset"  style="background-color: #FF0028;"/> 
                        
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div id="notRequired" >
                            <input name="imageLink" placeholder="Image Link"  />
                            <input name="street" placeholder="Location(street/specific place)"/><br> 
                            <input name="budget" placeholder="Budget"/><br>
                            <input name="submit"  type="submit" style="background-color: #006AFF; "/>    
                            
                        </div>
                        </div>
                    </div>
                    </form>
                      <?php
                        if(isset($_POST['submit'])){   

                            $date = date("Y-m-d");
                            $status="pending";
                            $name=$_POST['name'];
                            $sector=$_POST['sector'];
                            $street=$_POST['street'];
                            $budget=$_POST['budget'];
                            $imageLink=$_POST['imageLink'];
                            $description=$_POST['description'];


                            $support
                            $expect
                            $propose=

#INSERT IN Location------------------------------------------------------------------------ 
                            $tableName="location";$IDname="locID";include 'sql/getID.php';  
                            $locID=$newID;
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
                            $tableName="budget";$IDname="budgetID";include 'sql/getID.php';
                            $budgetID=$newID;
#INSERT IN BUDGET------------------------------------------------------------------------
                            $sql="INSERT INTO budget (budAmount,projID) VALUES ('$budget','$projID')";
                            if(!mysql_query($sql)){
                                die('ERROR' . mysql_error());                    
                            }
#INSERT IN Project------------------------------------------------------------------------
                            $sql="INSERT INTO project (projName,projDesc,projStat,sectorID,locID,budgetID) VALUES ('$name','$description','$status','$sector','$locID','$budgetID')";
                            if(!mysql_query($sql)){
                                die('ERROR' . mysql_error());
                            }
                        }
                    ?>
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

</body>

</html>
