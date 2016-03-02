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
    <?php $page="budget";?> <!-- changed from logs to budget -angela -->
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
                        <h3 class="page-header" style="color:white">Budget List</h3>
                    </div>

                    <div class='panel-body' style="color:#547c65">
                    <table class="table table-hover table-condensed">
                        <?php
                            $sql="SELECT * FROM Project";
                            $result = mysqli_query($connect,$sql) or die("Query could not be executed");
                            echo "<tr><th>Project Name</th>";
                            echo "<th>Project Description</th>";
                            echo "<th>Allocated Budget</th>"; //the link to budAlloc from createProject must be fixed. It's the reason why its empty. -angela
                            echo "<th>Date Finsihed</th>"; //therefore only projects in finished state will be displayed. -angela
                            echo "</tr>";

                            $count = 1;
                            while($row=mysqli_fetch_array($result)){
                                /*$lsql = "SELECT lName, fName, mName FROM member WHERE memID = '$row[memID]'";
                                $name = mysqli_query($connect, $nsql) or die("Query could not be executed");
                                $nrow = mysqli_fetch_array($name) or die("Query could not be executed");*/
                            
                                echo "<tr>";
                                echo "<td>$row[projName]</td>";
                                echo "<td>$row[projDesc]</td>";
                                echo "<td>$row[budAlloc]</td>";
                                //echo "<td>$row[projID]</td>";
                                echo "<td>MM-DD-YYYY</td>";

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

<!-- No footer -->

</html>
