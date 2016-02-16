<?php

#bd ot tcennoc-------------------------------------------------------------------------
    include 'connect/db.php';

#Checks if user is logged in-----------------------------------------------------------
    include 'sql/checkLogin.php';

?>


<div class='navbar-form navbar-left'>
    <a href='home.php'><img SRC='pics/pa_new.png' width='250px'/></a>
    <div class='form-group'>
        <form action='search.php' method='POST' width='100px'>
        <input type='text' name='searchq' class='form-control' placeholder='Search Project'>
    </div>
    <button class='btn btn-warning' style='margin-bottom:10px;'>Search</button>
    </form>
</div>
<!--Brand and toggle get grouped for better mobile display-->

</ul>
<ul class="nav navbar-right top-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size:15pt;"><?php echo "<img src='$myPic' height='35px' style='margin-right:20px'/>";echo $myName;?><b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>
                <a href="myProfile.php">Profile</a>
            </li>
            <li class="divider"></li>
            <li>
                <form method="post" action="index.php">
                    <button name="logout" style="background-color:transparent; font-size:10pt" >Log Out</button>
                </form>
            </li>
            
        </ul>
    </li>
</ul>