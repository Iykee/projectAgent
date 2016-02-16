    
<table class="table table-hover" style="width : 100%" border="0">
    <tr>
        <td><h4>Project Name</h4></td>
        <td><h4>Description</h4></td>
        <td><h4>Amount</h4></td>
        <td><h4>Date</h4></td>
    </tr>

<?php

    $budsql="SELECT * FROM Budget";
    $budresult = mysqli_query($connect,$budsql) or die("ERROR CONNECTING TO DB");
    $budres=mysql_query($budsql) or die (mysql_error());
    $total=0;
    $annual=0;
    $good=100;
    while($bata = mysql_fetch_array($budres)){
            $date=$bata['dateReceived'];
            $myYear=$date[0].$date[1].$date[2].$date[3];
            if($myYear==$year && $bata['memID']==$myMemID && $bata['budDesc']!=NULL  && $bata['budDesc']=='Annual Budget' ){
                $annual=$bata['budAmount']+$annual;
   

            }
            if($myYear==$year && $bata['budAmount']!=NULL && $bata['memID']==$myMemID && $bata['budDesc']!=NULL  && $bata['budDesc']!='Annual Budget'){
                $namesql="SELECT * FROM project";
                $nameresult = mysqli_query($connect,$namesql) or die("ERROR CONNECTING TO DB");
                $nameres=mysql_query($namesql) or die (mysql_error());
                
                while($namedata = mysql_fetch_array($nameres)){
                        
                    if($namedata['projID']==$bata['projID']){
                        echo "<tr><td><h4>".$namedata['projName']."</h4></td>";
                    }
                }
                    echo"
                    <td><h4>".$bata['budDesc']."</h4></td>
                    <td><h4>".$bata['budAmount']."</h4></td>
                    <td><h4>".$bata['dateReceived']."</h4></td><tr>";
                    $total=$total+$bata['budAmount'];
            }
                        
    }

    echo "<h3>My Annual Budget : ".$annual."</h3>";
    echo "<h3>Total Budget Used : ".$total."</h3>";
       $total=$annual-$total;
    echo "<h3>Total Budget Left : ".$total."</h3>";
?>
</table>