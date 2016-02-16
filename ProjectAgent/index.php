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
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/wow.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--Metro UI-->

    <link rel="stylesheet" href="css/metro-bootstrap.css">
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/jquery/jquery.widget.min.js"></script>
    <script src="js/metro/metro.min.js"></script>
    
    <!--Metro UI-->
    <style>
    #footer {
       position:absolute;
       bottom:0;
       width:100%;
       height:25px;   /* Height of the footer */
       background:#33CC99;
    }
    </style>

</head>

<body class="metro" background="pics/skyline.jpg" >
<?php
include 'connect/db.php';

if(isset($_POST['submit'])){    
    $memberID=$_POST['memberID'];
    $password=$_POST['password'];
    $md5=md5($password);
    $sha1=sha1($md5);
    $cryptpass=crypt($sha1,'CA');
    $password=$cryptpass;
    $sql="SELECT * FROM member";
    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
    $res=mysql_query($sql) or die (mysql_error());
    while($data = mysql_fetch_array($res)){
        if($data['memID']==$memberID && $data['memPword']==$password){
            $_SESSION['login']=$memberID;
            if($data['position']=='Admin'){
                echo header('location:Admin.php');
            }elseif ($data['position']=='Committee Chairman' || $data['position']=='Councilor'){
                echo header('location:home.php');
            }
            
        }
    }
}
else if(isset($_POST['logout'])){
    unset($_SESSION['login']);
    unset($_SESSION['memID']);
}else{
    
}

?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
<div class='navbar-form navbar-left'>
                <a href='home.php'><img SRC='pics/pa_new.png' width='250px'/></a>

                <!-- Aguirre - I removed the Search Bar because it looks stupid...
                    <div class='form-group'>
                        <form action='pubSearch.php' method='POST' width='100px'>
                        <input type='text' name='searchq' class='form-control' placeholder='Search Project'>
                        </div>
                            <button class='btn btn-warning' style='margin-bottom:-10px;'>Search</button>
                    </form> 
                -->

            </div>
<!--Brand and toggle get grouped for better mobile display-->
            
            <ul class="nav navbar-right top-nav">
                <form method='post' action='index.php' id='login'>
                    <input type='text'      name='memberID' placeholder='Member ID'/>
                    <input type='password'  name='password' placeholder='Password'/>
                    <button name="submit">Log in</button>
                </form>
            </ul>
            
                        <!-- /.navbar-collapse -->
        </nav>



        <div id="page-wrapper">       
        <!-- Projects Row -->

<!-- Aguirre - I removed this to remove the Project Status Gallery 

            <div class="tab-panels">
                <ul class="tabs" style="text-align:center">
                <?php
                    $pan="panel";
                    $i=1;
                    $sql="SELECT * FROM Project";
                    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
                    $res=mysql_query($sql) or die (mysql_error());
                    while($data = mysql_fetch_array($res)){
                        if($data['projStat']=='existing' || $data['projStat']=='on-going'){
                    
                            $name=$data['projName'];
                            $initial=$name[0];
                            $alphabet[0]=0000;
                            $alphabet[$i]=$initial;
                            $panel=$pan.$i;
                            $dupYear="0";
#code for check Duplicate------------------------------------------------------
#working but can still be modified
                            for ($j=1; $j<$i ; $j++) { 
                                if ($alphabet[$j]==$initial) {
                                    $dupYear="1";
                                }
                            }
#END OF check Duplicate--------------------------------------------------------
                            if($dupYear=='0'){
                                
                                $sort[$i]=$initial;
                                $i++;
                            }
                            
                        }
                    }

                    sort($sort);
                    for($j=0;$j<$i-1;$j++){
                        $pan="panel";
                        $panel=$pan.$j;
                        if($sort[$j]==$sort[0]){
                            echo "<li data-panel='$panel' class='active'><h1>".$sort[$j]."</h1></li>";
                        }else{
                            echo "<li data-panel='$panel'><h1>".$sort[$j]."</h1></li>";
                        }
                    }
                ?>
                </ul>
            </div>
            <div class="tab-panels">
                <?php
                    $num=0;
                    $i--;
                    $pan="panel";
                    $idx=0;
                    $panel=$pan.$idx;
                    $dupYear="0";
                    
                    echo "<div id='$panel' class='project active'>";
                    include 'sql/indexProject.php';
                    echo "</div>";
                    
                    for ($idx=1; $idx <$i ; $idx++) { 
                            $panel=$pan.$idx;

                            echo "<div id='$panel' class='project'>";
                            include 'sql/indexProject.php';   
                            echo "</div>";
                               
                    }

                ?>
            </div> 

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
 
    <!--My Script-->

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

<!-- Add Footer Here -->
<footer
     <div id="footer">
         <p style="color:white;font-size:11px;padding:5px" class="text-muted"  >
      <span style="float: right">P. del Rosario Street, Cebu City, Philippines 6000 | Phone: +63 (32) 253 1000 | Fax: +63 (32) 256 4341</span>
      <span style="float: left">Project Agent 2016 | USC-DCIS</span>
    </p> 
     </div>
</footer>

</html>
