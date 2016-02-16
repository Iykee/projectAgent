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

         <div id="page-wrapper">

          <div class="container-fluid">
            <div class="row">
            <table class="table table-striped table-hover table-condensed">
              <?php
              $var = $_POST['searchq'];
              $s = trim($var);

              echo "<br><br>";
              if($s!="" || !empty($s) || !isset($var)){
                echo "<h4>You searched for \"{$_POST['searchq']}\"</h4>";
                echo "<br><br>";
              }

              if(!isset($_POST['searchq'])){
                die("Search Query not found");
              }

              if($s==""){
                echo "No Projects Available";
                echo "<p><h3>Please enter a search query!</h3></p>";
                exit;
              }
              if(!isset($var)){
                echo "<p>We don't seem to have a search parameter!</p>";
                exit;
              }

              if(empty($s)){
                $s=0;
              }
              $sql="SELECT * FROM project WHERE projName LIKE '%$s%' ORDER BY projName";


  //$sql="SELECT * FROM project";
              $result = mysqli_query($connect,$sql) or die("Query could not be executed");

              echo "<tr><th>#</th>";
              echo "<th>Project Name</th>";
              echo "<th>Project Description</th>";
              echo "<th>Proposed By</th>";
              echo "<th>Status</th>";
              echo "<th></th>";
              echo "</tr>";

              $count = 1;
              while($row=mysqli_fetch_array($result)){
                $nsql = "SELECT lName, fName, mName FROM member WHERE memID = '$row[memID]'";
                $name = mysqli_query($connect, $nsql) or die("Query could not be executed");
                $nrow = mysqli_fetch_array($name) or die("Query could not be executed");
                
                echo "<tr>";
                echo "<td>$count</td>";
                echo "<td>$row[projName]</td>";
                echo "<td>$row[projDesc]</td>";
                echo "<td>$nrow[lName], $nrow[fName]</td>";
                echo "<td>$row[projStat]</td>";
                echo "<td><form method='POST' action='myProject.php'>";
                echo "<button type='submit' value='$row[projID]' class='btn btn-info' name='project'>VIEW</button>";
                echo "</form></td></tr>";
                $count++;
              }
              ?>
            </table>
              <!-- /.row -->
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
