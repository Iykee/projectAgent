 <?php
    $sql="SELECT * FROM project";
    $result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
    $res=mysql_query($sql) or die (mysql_error());
    $check=0;
    while($data = mysql_fetch_array($res)){
        if( $data['projStat']==$prostat){
            $projectID=$data['projID'];
#SQL for Image----------------------------------------------------------------------------------------
            $image="pics/cat.jpg";

            $check++;
            $gallerySQL="SELECT * FROM gallery";
            $galleryresult = mysqli_query($connect,$gallerySQL) or die("ERROR CONNECTING TO DB");
            $galleryres=mysql_query($gallerySQL) or die (mysql_error());
            while($gallerydata = mysql_fetch_array($galleryres)){
                if($gallerydata['projectID'] == $projectID && $gallerydata['imageLink']!="" ){
                       $image=$gallerydata['imageLink'];
                }
            }   
#END OF SQL Image--------------------------------------------------------------------------------------
#SQL for Sector----------------------------------------------------------------------------------------
            $sectorType='Unknown';
            $sectorID=$data['sectorID'];
            $sectorSQL="SELECT * FROM sector";
            $sectorresult = mysqli_query($connect,$sectorSQL) or die("ERROR CONNECTING TO DB");
            $sectorres=mysql_query($sectorSQL) or die (mysql_error());
            while($sectordata = mysql_fetch_array($sectorres)){
                if($sectorID==$sectordata['sectorID']){
                    $sectorType=$sectordata['secType'];
                }
            }
#END OF SQL Sector------------------------------------------------------------------------------------
#SQL for Committee----------------------------------------------------------------------------------------
            $comName='Unknown';
            $comID=$data['comID'];
            $comSQL="SELECT * FROM committee";
            $comresult = mysqli_query($connect,$comSQL) or die("ERROR CONNECTING TO DB");
            $comres=mysql_query($comSQL) or die (mysql_error());
            while($comdata = mysql_fetch_array($comres)){
                if($comID==$comdata['comID']){
                    $comName=$comdata['comName'];
                }
            }

#END OF SQL Committee------------------------------------------------------------------------------------
#SQL for Name of Creator----------------------------------------------------------------------------------------
            $byName='Unknown';
            $byID=$data['memID'];
            $bySQL="SELECT * FROM member";
            $byresult = mysqli_query($connect,$bySQL) or die("ERROR CONNECTING TO DB");
            $byres=mysql_query($bySQL) or die (mysql_error());
            while($bydata = mysql_fetch_array($byres)){
                if($byID==$bydata['memID']){
                    $byName=$bydata['fName'];
                    $byName=$bydata['lName'].", ".$byName[0].".";
                }
            }
            
#END OF SQL Name of Creator------------------------------------------------------------------------------------
        echo "<div class='row'>";
#display Image---------------------------------------------------------------------
        echo "<div class='col-md-8'>";
        echo "<a><img src='$image' style='width:550px ; height: 315px;margin: 10px'></a>";
        echo "</div>";
        echo "<div class='col-md-3'>";
#display Project Name and Project ID-----------------------------------------------
        echo "<h3>".$data['projName']."<big>  |</big><small style='color:#8f8f8f'>".$projectID."</small></h3>";

#display sector type----------------------------------------------------------------
        echo "Sector: ".$sectorType."<br>";
#display committee type----------------------------------------------------------------
        echo "Committee: ".$comName."<br>";
#display ProJect Description--------------------------------------------------------
        echo "Description: ".$data['projDesc']."<br><br>";
#display ProJect Creator--------------------------------------------------------        
        echo "Proposed By: ".$byName."<br>";
        echo "<br>";
#view project button using | $projectID | as its value------------------------------
        echo "<button name='project' value='$projectID' class='btn btn-success' href='view.php' style='width:60%;margin-left:1px;'>View Project</button>";
        echo "</div>";  
        echo "</div>";
        echo "<hr>";    
        }
    }
    if ($check==0) {
        echo "<h1>NO PROJECTS FOUND</h1>";
    }
 ?>