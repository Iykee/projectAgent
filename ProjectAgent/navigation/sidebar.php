<?php 
    if($myPos=='Admin'){echo header('location:Admin.php');}
    
    


    $accept=0;
    $sql="SELECT * FROM Budget";
    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
    $res=mysql_query($sql) or die (mysql_error());
    while($data = mysql_fetch_array($res)){
        if($data['budDesc']=='Annual Budget' && $data['dateReleased']!=NULL && $data['dateReceived']==NULL && $data['memID']==$login){
            $relBudget=$data['budAmount'];
            $relDate=$data['dateReleased'];
            $relBudID=$data['budgetID'];
            $accept=1;
        }
    }


?>
<div class='collapse navbar-collapse navbar-ex1-collapse'>
    <ul class='nav navbar-nav side-nav'>
         <?php
            if($page=="project"){ echo "<li class='active'";}else{echo "<li";}
            echo "><a  href='project.php'data-toggle='collapse' data-target='#demo'><img src='pics/projects.png' width='100px'/></a></li>";
            if($page=="budget"){ echo "<li class='active'";}else{echo "<li";}
            echo "><a href='budget.php'><img src='pics/budgetlist1.png' width='140px'/></a></li>";
            
        ?>
    </ul>
</div>
<!--class='active'-->