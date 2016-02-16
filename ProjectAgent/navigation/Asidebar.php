
<?php if($myPos=='chairman'){echo header('location:project.php');}?>
<div class='collapse navbar-collapse navbar-ex1-collapse'>
    <ul class='nav navbar-nav side-nav'>
        <?php 
            
            if($page=="Admin"){ echo "<li class='active'";}else{echo "<li";}
            echo "><a href='Admin.php'><img src='pics/admin2.png' width='200px'/></a></li>";
            if($page=="Acommittee"){ echo "<li class='active'";}else{echo "<li";}
            echo "><a href='Acommittee.php'><img src='pics/committees1.png' width='150px height='30px'/></a></li>";    
            if($page=="Asector"){ echo "<li class='active'";}else{echo "<li";}
            echo "><a href='Asector.php'><img src='pics/sectors1.png' width='150px' height='35px'/></a></li>";
            if($page=="logs"){ echo "<li class='active'";}else{echo "<li";}
            echo "><a href='logs.php'><img src='pics/logs1.png' width='150px' height='35px'/></a></li>";
        ?>
    </ul>
</div>

