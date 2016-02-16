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
<?php $page="Acommittee";?>
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
                            <button  data-toggle="collapse" data-target="#demo"  style="background-color: transparent;border:0px"> Committee
                            <small>(Click Here to Add a Committee)</small>
                            </button>
                        </h1>
                        
                    </div>
                </div>
                <table class="table-hover" style="width : 100%" border="0">
                    <thead class="page-header">
                        <td><h4>Name<h4></td>
                        <td><h4>Description<h4></td>
                        <td><h4>Status<h4></td>                    
                    </thead>
                
                <?php

#creates new Committee---------------------------------------------------------------------------
                    if(isset($_POST['submit'])){
                        $year=date("Y");
                        $committeeName=$_POST['committeeName'];
                        $committeeDesc=$_POST['committeeDesc'];
                        $committeeStatus="active";
                        $sql="INSERT INTO committee (comName,comDesc,comStatus,yrFounded) VALUES ('$committeeName','$committeeDesc','$committeeStatus','$year')";
                        if(!mysql_query($sql)){
                            die ('error'.mysql_error());
                        header('location:Asector.php');
                        }
                    }
#END OF Creating new Committee-------------------------------------------------------------------
                    $color="red";
                    $committeeID=0;
                    $sql="SELECT * FROM committee";                    
                    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
                    $res=mysql_query($sql) or die (mysql_error());
#displays all sectors and their description-----------------------------------------                      
                    while($data = mysql_fetch_array($res)){
                        $committeeID=$data['comID'];    
                        echo "<td><h4>".$data['comName']."</h4></td>";
                        echo "<td><h4>".$data['comDesc']."</h4></td>";
                        if($data['comStatus']=="active"){
                            $color="green";
                        }
                        echo "<td style='color:$color'><h4>".$data['comStatus']."</h4></td></tr>";
                        $color="red";
                    }
                    $committeeID=$committeeID+1;
unset($_SESSION['memID']);

                ?>
                    <ul id="demo" class="collapse">
                        <form method="POST" action="Acommittee.php">
                            <input autofocus required name="committeeName" placeholder="Committee Name"></input>
                            <input name="committeeDesc" placeholder="Description"></input>
                            <input name="submit" type="submit" class="btn btn-warning"></input>
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
