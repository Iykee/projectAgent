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
<?php $page="budget";
    if(isset($_SESSION['projectID'])){
        unset($_SESSION['projectID']);
        unset($_SESSION['update']);
    }
?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php
#Top Menu Items------------------------------------------------------------------------ 
                include 'navigation/topNav.php';
#Sidebar Menu Items - These collapse to the responsive navigation menu on small screens
                include 'navigation/sidebar.php';
            ?>
            <!-- /.navbar-collapse -->
        </nav>
<?php

    if(isset($_POST['accept'])){
        $budID=$_POST['accept'];
        $recDate=date("Y-m-d");
        $password=$_POST['recPassword'];

        $md5=md5($password);
        $sha1=sha1($md5);
        $cryptpass=crypt($sha1,'CA');
        $password=$cryptpass;
        echo $password;
            echo "<br>";
            echo $myPass;
        if($password == $myPass){
            echo $password;
            echo "<br>";
            echo $myPass;
            mysqli_query($connect,"UPDATE budget SET dateReceived='$recDate' WHERE budgetID='$budID'");
            $accept=0;
            $log="Budget was accepted";
            include 'sql/log.php';
        }
    }
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
        
                        <!--<h1 class="page-header">Budget</h1>-->
                        <br></br>
                        <img src="pics/budget.png" alt="Budget List" style="width:1000px;height:500px;">

                        <br>

                        <!-- 

                            <table border="1" style="width:100%;">
                              <tr>
                                <td>Project Name</td>
                                <td>Proposed Budget</td> 
                                <td>Date to Finish</td>
                              </tr>
                              <tr>
                                <td>Eve</td>
                                <td>Jackson</td> 
                                <td>94</td>
                              </tr>
                              <tr>
                                <td>Jill</td>
                                <td>Smith</td> 
                                <td>50</td>
                              </tr>
                              <tr>
                                <td>Eve</td>
                                <td>Jackson</td> 
                                <td>94</td>
                              </tr>
                            </table>

                        -->


                    <!--                           
                        <div class="tab-panels">
                           <ul class="tabs">

                                <?php
                                
                                if($accept==1){
                                    echo "<form method='post' action='budget.php'>";
                                    echo "<h3><div class='col-md-4'>New Budget</div><div class='col-md-4'>Released Date</div><div class='col-md-4'>
                                            <button class='btn btn-danger' style='width:270px;' name='accept' value=$relBudID>Accept</button></div></h3>";
                                    echo "<h3><div class='col-md-4'>".$relBudget."</div><div class='col-md-4'>".$relDate."</div><div class='col-md-4'><input type='password' name='recPassword' placeholder='Password'></input></div></h3>";
                                    echo "</form>";

                                }
                                    $thisYear=date("Y");
                                    $pan="panel";
                                    $i=1;
                                    $sql="SELECT * FROM Budget";
                                    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
                                    $res=mysql_query($sql) or die (mysql_error());
                                    while($data = mysql_fetch_array($res)){
                                        if($data['memID']==$myMemID && $data['budDesc']!='Annual Budget' && $data['budDesc']!=NULL){
                                            $date=$data['dateReceived'];
                                            $year=$date[0].$date[1].$date[2].$date[3];
                                            $allYear[0]=0000;
                                            $allYear[$i]=$year;
                                            $panel=$pan.$i;
                                            $dupYear="0";
#code for check Duplicate------------------------------------------------------
#working but can still be modified
                                            for ($j=1; $j<$i ; $j++) { 
                                                if ($allYear[$j]==$year) {
                                                    $dupYear="1";
                                                }
                                            }
#END OF check Duplicate--------------------------------------------------------
                                            if($dupYear=='0'){
                                                if($year==$thisYear){
                                                    echo "<li data-panel='$panel' class='active'><h1>".$year."</h1></li>";
                                                }else{
                                                    echo "<li data-panel='$panel'><h1>".$year."</h1></li>";
                                                }
                                                $i++;
                                            }
                                            
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="tab-panels">
                        <?php
                            $thisYear=date("Y");
                            $pan="panel";
                            $i=1;
                            $sql="SELECT * FROM Budget";
                            $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
                            $res=mysql_query($sql) or die (mysql_error());
                            while($data = mysql_fetch_array($res)){
                                $date=$data['dateReleased'];
                                $year=$date[0].$date[1].$date[2].$date[3];
                                $allYear[$i]=$year;
                                $panel=$pan.$i;
                                $dupYear="0";
#code for check Duplicate------------------------------------------------------
#working but can still be modified
                                for ($j=1; $j<$i ; $j++) { 
                                    if ($allYear[$j]==$year) {
                                        $dupYear="1";
                                    }
                                }
#END OF check Duplicate--------------------------------------------------------
                                if($dupYear=='0'){
                                  if($year==$thisYear){
                                        echo "<div id='$panel' class='project active'>";
                                        include 'sql/budget.php';
                                        echo "</div>";
                                    }else{
                                        echo "<div id='$panel' class='project'>";
                                        include 'sql/budget.php';
                                        echo "</div>";
                                    }
                                    $i++;
                                }
                            }
                        ?>
                   
                        </div>
                    </div> 
                </div>
                <!-- /.row -->
                
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

</html>
