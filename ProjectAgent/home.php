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

<?php $page="home";
    if(isset($_SESSION['projectID'])){
        unset($_SESSION['projectID']);
        unset($_SESSION['update']);
    }
?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            
                <?php
                    #Top Menu Items
                    include 'navigation/topNav.php';
                    #Sidebar Menu Items - These collapse to the responsive navigation menu on small screens
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
                        <br></br>
                            <div class="col-lg-12" >
                                <img src="pics/about.jpg" style="width:100%"><br><br> 
                            </div>
                        
                        
                        <!--<h1 class="page-header" style="text-align:center;">
                            Our Mentor
                        </h1>
                            <div class="col-lg-12" style="text-align:center">
                                <img src="pics/glenn.jpg" style="width:30%; height:400px;"><br>
                                Sir Glenn Pepito<br><br><br>
                            </div> -->

                        <h1 class="page-header" style="text-align:center;">
                            <u>Our Goal</u>
                        </h1>
                            <p style="text-align: justify"><h3>
                            To store and organize information about the new, 
                            on-going and existing projects in the local government 
                            and allow some of the information to be viewed by 
                            the public thus through this it provides transparency 
                            and minimizes ambiguousness of data. </h3>
                          
                            </p>
                        <h1 class="page-header" style="text-align:center;">
                            <u>Our Mission</u>
                        </h1>
                            <p style="text-align:justify"><h3>
                             To provide transparency of the local government project’s 
                            information in order to minimize corruption within the local government. </h3></p>

                        </h1> 

                        <br>
                        <br>

                        <h4 class="page-header" style="text-align:center;">
                            ProjectAgent © 2016 
                        </h4>

                        <!--
                            <div class="col-lg-3" style="text-align:center">
                                <img src="pics/charl.jpg" style="width:100%; height:300px;">
                                Charl Amaba
                            </div>
                            <div class="col-lg-3" style="text-align:center">
                                <img src="pics/aha.jpg" style="width:100%; height:300px;">
                                Angela Hannah Aguirre
                            </div>
                            <div class="col-lg-3" style="text-align:center">
                                <img src="pics/carl.jpg" style="width:100%; height:300px;">
                                Carl Patrick Agbisit
                            </div>
                            <div class="col-lg-3" style="text-align:center">
                                <img src="pics/dahlia.jpg" style="width:100%; height:300px;">
                                Dahlia Tudtud<br><br><br>
                            </div>   

                            -->
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

</body>

<footer> 
    <?php
        include 'navigation/footer.php';
    ?>
</footer>

</html>
