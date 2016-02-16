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
    <?php $page="Admin";?>
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
                            <button  data-toggle="collapse" data-target="#demo" style="background-color: transparent;border:0px">List of Members
                            <small>(Click Here to Add a New Member Account)</small>
                            </button>
                        </h1>
                        
                    </div>
                </div>
                <table width='100%' class="table table-hover">
                    <thead class="page-header">
                       <!-- <td width="5%"><h3>ID</h3></td> -->
                        <td width="20%"><h3><u>Barangay</u></h3></td>
                        <td width="30%"><h3><u>Name</u></h3></td>
                        <td width="50%"><h3><u>Position</u></h3></td>
                    </thead>

                
                <?php
                    $date = date("Y-m-d");
                    $tableName="member";
                    $IDname="memID";
                    include 'sql/getID.php';
                    $memID=$newID;
#creates new member---------------------------------------------------------------------------
                    if(isset($_POST['submit'])){
                        $datereg = date("Y-m-d");
                        $fName=$_POST['firstName'];
                        $mName=$_POST['middleName'];
                        $lName=$_POST['lastName'];
                        //$gender=$_POST['gender'];
                        $birthday=$_POST['birthday'];
                        $email=$_POST['email'];
                        $contact=$_POST['contact'];
                        $password=$memID;
                        $md5=md5($password);
                        $sha1=sha1($md5);
                        $cryptpass=crypt($sha1,'CA');
                        $password=$cryptpass;
                        $position=$_POST['position'];
                        $address=$_POST['address'];
                        $barangay=$_POST['barangay'];
                        $city=$_POST['city'];
                        $zip=$_POST['zip'];
                        $tableName="location";$IDname="locID";include 'sql/getID.php';
                        $locID=$newID;
                        $imageLink='pics/profpic.jpg';
#Creates new Member----------------------------------------------------------------------------
#CODE for Insert Location---------------------------------------------------------
                        $sql="INSERT INTO location (locID,street,barangay,city,zipcode) VALUES ('$locID','$address','$barangay','$city','$zip')";
                        if(!mysql_query($sql)){
                            die('ERROR' . mysql_error());                    
                        }
#END OF CODE for Insert Location---------------------------------------------------
#CODE for Insert Gallery---------------------------------------------------------
                        $sql="INSERT INTO gallery (locID,imageLink) VALUES ('$locID','$imageLink')";
                        if(!mysql_query($sql)){
                            die('ERROR' . mysql_error());                    
                        }
#END OF CODE for Insert Gallery---------------------------------------------------
#CODE for Insert Member------------------------------------------------------------
                        $sql="INSERT INTO member (memID,fName,mName,lName,position,dateOfBirth,email,contactNo,memPword,dateReg,locID) VALUES ('$memID','$fName','$mName','$lName','$position','$birthday','$email','$contact','$password','$datereg','$locID')";
                        if(!mysql_query($sql)){
                            die('ERROR' . mysql_error());                    
                        }
#END OF CODE for Insert Member-----------------------------------------------------
#Send Email to User----------------------------------------------------------------
                    $subject="Project Agent";
                    $message="ProjectAgent";
                    mail($email, $subject, $message);
#END of Sending Mail---------------------------------------------------------------
                }
#END OF creating New Member-------------------------------------------------------------------
                    $sql="SELECT * FROM member";                    
                    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
                    $res=mysql_query($sql) or die (mysql_error());
#displays all sectors and their description--------------------------------------------------                        
                    while($data = mysql_fetch_array($res)){
                        $memberID=$data['memID'];    
                        if($data['position']=="Committee Chairman" || $data['position']=="Councilor" ){
#gets the barangay location----------------------------------------------------------
                            $fullName=$data['mName'];
                            $fullName=$data['fName']." ".$fullName[0].". ".$data['lName']." ";
                            $brgy=$data['locID'];
                            $locsql="SELECT * FROM location";                    
                            $locresult = mysqli_query($connect,$locsql) or die("ERROR CONNECTING TO DB");
                            $locres=mysql_query($locsql) or die (mysql_error());
                            while($locdata = mysql_fetch_array($locres)){
                                if($locdata['locID']==$data['locID']){
                                    $brgy=$locdata['barangay'];
                                }
                            }
#end of geting the barangay location-------------------------------------------------
                            echo "<tr>";
                            echo "<td ><h4>".$brgy."</h4></td>";
                            echo "<td><h4>".$fullName."</h4></td>";
                            echo "<td><h4>".$data['position']."</h4></td>";
                            echo "<td><form method='POST' action='Aprofile.php'>
                                       <button name=memID value=$memberID class='btn btn-primary'>VIEW</button>
                                       </form></td>";
                            echo "</tr>";
                        }
                    }
                    unset($_SESSION['memID']);
                ?>
           
                <ul id="demo" class="collapse">
                    <form method="POST" action="Admin.php">
                        <div class="col-md-6 portfolio-item" >
                            <h2>Personal Information</h2>
                            <input required name="firstName"  placeholder="Firstname" autofocus/>
                            <input required name="middleName" placeholder="Middlename"/>
                            <input required name="lastName"   placeholder="Lastname"/>
                            <input required type="date" name="birthday">
                            <h2> Contact Details</h2>
                            <input required placeholder="Email Address" name="email" style="border:1px solid red">
                            <input required placeholder="Contact No." name="contact"style="border:1px solid red" >
                        </div>
                        <div class="col-md-6 portfolio-item" >
                            <h2><?php echo "Member ID: ".$memID;?></h2>

                            <div id="option-sector" >
                            <select name="position" required style="width:100%;border-radius:5px; color:#9b9b9b; font-size: 20pt; height:40px" > 

                            <option disabled selected value="" style="display:none;">Position</option>
                            <option value="Committee Chairman" >Committee Chairman</option>
                            <option value="Councilor" >Councilor</option>
                            </select>
                            </div>

                            <h2>Location</h2>
                            <input required placeholder="Home Address" name="address">
                            <input required placeholder="Barangay" name="barangay">
                            <input required placeholder="City" name="city">
                            <input required placeholder="Zip Code" name="zip">
                            <input name="submit" type="submit" class="btn btn-warning"></input>
                        </div>
                    </form>
                </ul>   
                </table>

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

</body>

</html>
