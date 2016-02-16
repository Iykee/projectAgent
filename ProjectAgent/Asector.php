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
<?php $page="Asector";?>
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

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <button  data-toggle="collapse" data-target="#demo" style="background-color: transparent;border:0px"> Sectors
                            <small>(Click Here to Add a Sector)</small>
                            </button>
                        </h1>
                        
                    </div>
                </div>
                <table class="table-hover" style="width : 100%" border="0">
                    <thead class="page-header">
                        <td><h4>Type<h4></td>
                        <td><h4>Description<h4></td>                    
                    </thead>
                
                <?php
#creates new sector-----------------------------------------------------------------------------------
                    if(isset($_POST['submit'])){
                        $sectorType=$_POST['sectorType'];
                        $sectorDesc=$_POST['sectorDesc'];

                        $sql="INSERT INTO sector (secType,secDesc) VALUES ('$sectorType','$sectorDesc')";
                        if(!mysql_query($sql)){
                            die ('error'.mysql_error());
                        }
                    }

                    $sortname=array();
                    $i=0;
                    $sql="SELECT * FROM sector";                    
                    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
                    $res=mysql_query($sql) or die (mysql_error());
#sort by name (UNFINISHED)----------------------------------------------------------------------------                        
                    while($data = mysql_fetch_array($res)){
                        $i++;
                        $sortname[$i]=$data['secType'];
                    }
                    sort($sortname);
#displays all sectors and their description----------------------------------------------------------
                            $res=mysql_query($sql) or die (mysql_error());  
                            while($data = mysql_fetch_array($res)){
                                $sectorID=$data['sectorID'];    
                                echo "<td><h4>".$data['secType']."</h4></td>";
                                echo "<td><h4>".$data['secDesc']."</h4></td></tr>";
                            }
unset($_SESSION['memID']);
                ?>
                <ul id="demo" class="collapse">
                    <form method="POST" action="Asector.php">
                        <input required autofocus name="sectorType" placeholder="Sector Name"></input>
                        <input required name="sectorDesc" placeholder="Sector Description"></input>
                        <input name="submit" class="btn btn-warning" type="submit"></input>
                    </form>
                </ul>   
                </table>

                           
                        
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

<footer> 
    <?php
        include 'navigation/footer.php';
    ?>
</footer>

</html>
