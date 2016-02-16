<?php
	
	for ($stat=0; $stat <2 ; $stat++) { 
		if ($stat==1) {
			$status='existing';
		}else
		{
			$status='on-going';
		}
	
		$sql="SELECT * FROM project";
		$result = mysqli_query($connect,$sql) or die("ERROR CONNECTING TO DB");
		$res=mysql_query($sql) or die (mysql_error());
		while($data = mysql_fetch_array($res)){
		    $projName=$data['projName'];
		    if($projName[0]==$sort[$idx] && $data['projStat']==$status){
		    	
		    	$target='target'.$num;
		    	$datatarget='#'.$target;
		    	$projID=$data['projID'];
		    	$memID=$data['memID'];

		    	


			
				$galsql="SELECT * FROM gallery";
				$galresult = mysqli_query($connect,$galsql) or die("ERROR CONNECTING TO DB");
				$galres=mysql_query($galsql) or die (mysql_error());
				while($galdata = mysql_fetch_array($galres)){
					if($galdata['projectID']==$projID){
						$image=$galdata['imageLink'];
					}
				}
				$secsql="SELECT * FROM sector";
				$secresult = mysqli_query($connect,$secsql) or die("ERROR CONNECTING TO DB");
				$secres=mysql_query($secsql) or die (mysql_error());
				while($secdata = mysql_fetch_array($secres)){
					if($secdata['sectorID']==$data['sectorID']){
						$sector=$secdata['secType'];
					}
				}
				$comsql="SELECT * FROM committee";
				$comresult = mysqli_query($connect,$comsql) or die("ERROR CONNECTING TO DB");
				$comres=mysql_query($comsql) or die (mysql_error());
				while($comdata = mysql_fetch_array($comres)){
					if($comdata['comID']==$data['comID']){
						$committee=$comdata['comName'];
					}
				}

				echo "<div class='col-md-4 portfolio-item' >";
					echo "<ul data-toggle='collapse' data-target='$datatarget' >";
				
					echo "<img class='img-responsive'src='$image' width='250px' height='500px'/>";
					echo "<h3 style='color:white;width:250px'>".$projName."</h3>";
					echo "</ul>";

					echo "<ul id='$target' class='collapse' style='background:#CCCCFF; width:250px; border: 3px solid orange; margin-left:40px;border-radius: 0 0 5px 5px;text-align:left '>";
						echo "<br><h5>Project Status: ".$data['projStat']."</h5>";
						echo "<h5>Sector: ".$sector."</h5>";
						echo "<h5>Committee: ".	$committee."</h5><br>";
					echo "</ul>";
				echo "</div>";
				$num++;	

			}
			

		}
		
	}


?>
