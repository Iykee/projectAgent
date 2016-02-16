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
    <link href="css/timeline.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <?php $page="logs";?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
             <?php
                # Top Menu Items 
                include 'navigation/topNav.php';
                # Sidebar Menu Items - These collapse to the responsive navigation menu on small screens
                if($myPos=='Admin'){
                    include 'navigation/Asidebar.php';
                }else{
                    include 'navigation/sidebar.php';
                }
            ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Logs</h1>
                    </div>

                    <div class='panel-body'>
                    <table class="table table-striped table-hover table-condensed">
                        <?php
                            $sql="SELECT * FROM log";
                            $result = mysqli_query($connect,$sql) or die("Query could not be executed");
                            echo "<tr><th>#</th>";
                            echo "<th>User</th>";
                            echo "<th>Description</th>";
                            echo "<th>Timestamp</th>";
                            echo "</tr>";

                            $count = 1;
                            while($row=mysqli_fetch_array($result)){
                                /*$lsql = "SELECT lName, fName, mName FROM member WHERE memID = '$row[memID]'";
                                $name = mysqli_query($connect, $nsql) or die("Query could not be executed");
                                $nrow = mysqli_fetch_array($name) or die("Query could not be executed");*/
                            
                                echo "<tr>";
                                echo "<td>$row[logID]</td>";
                                echo "<td>$row[memID]</td>";
                                echo "<td>$row[logDesc]</td>";
                                echo "<td>$row[logStamp]</td>";
                                echo "</tr>";
                                $count++;
                            }
                        ?>
            </table>
                    </div>
                </div>

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