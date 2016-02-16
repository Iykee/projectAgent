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
<?php $page="profile";?>
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
                        <h1 class="page-header">Profile</h1>
                        <div class='col-lg-7' >
                            <?php echo "<img class='img-responsive' style='width:500px; height:400px; ' src='$myPic'/>"; ?>
                            <br><br>
                        </div>
                        <div class="col-lg-4">

                            <?php
                                echo "<h4>Name: ".$myName."</h4>";
                                echo "<h4>Address: ".$myAdd."</h4>";
                                echo "<h4>Position: ".$myPos."</h4>";

                            ?>


                      <h2 class='page-header' style='text-align:center;'>
                        <button  data-toggle="collapse" data-target="#profile" class="btn btn-info" style="font-size:15px; width:90%">Update My Profile</button>
                    </h2>
                            <ul id="profile" class="collapse">

                            <form method="post" action='sql/profile.php'>
                            <h4> <u>Change Profile Picture </u></h4>
                            
                                
                                <input name='imageLink' placeholder='Image Link' ></input>
                                <br>
                                <h4> <u>Change Password </u></h4>
                                <input name='oldpass' type='password' placeholder='Old Password' ></input>
                                <input name='newpass' type='password' placeholder='New Password' ></input>

                                <button name='updateprof' class="btn btn-warning">Update Profile</button>
                            </form>
                        </div>
                       
                        
                    </div>

                         <div class='panel-body'>
                            <ul class='timeline'>
                                
                                <?php
                                echo "<li>
                                    <div class='timeline-badge blue'></div>
                                    <div class='timeline-panel'>
                                        <div class='timeline-heading'>
                                            <h4 class='timeline-title'>March 12, 2015</h4>
                                        </div>
                                        <div class='timeline-body'>
                                            <p>Reported an issue.</p>
                                        </div>
                                    </div>
                                </li>";
                                echo "<li class='timeline-inverted'>
                                    <div class='timeline-badge purple'></div>
                                    <div class='timeline-panel'>
                                        <div class='timeline-heading'>
                                            <h4 class='timeline-title'>Welcome to Project Agent</h4>
                                        </div>
                                        <div class='timeline-body'>
                                            <p>How Are You?</p>
                                        </div>
                                    </div>
                                </li>";
                                ?>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
    
 

</body>

</html>
