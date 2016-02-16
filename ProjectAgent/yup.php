<form method="post" action="sql/Aupdate.php">
                                        <div class="col-lg-9">
                                            <input name="newBudget" placeholder="budget" type="number">
                                        </div>
                                        <div class="col-lg-3">
                                            <?php
                                                echo "<button  name='budget' value='$memID' style='border-color:green;'>Create</button>";
                                            ?>
                                        </div>
                                    </form>
                                    <table class="table table-hover" style="width : 100%" border="0">
                                        <tr style="background-color:gray;border-top:2px solid green;">
                                            <td><h3 style="color:darkgreen;">Source of Fund</h3></td>
                                            <td><h3 style="color:darkgreen;">Budget</h3></td>
                                            <td><h3 style="color:darkgreen;">Date Released</h3></td>
                                        </tr>
                                        <?php
                                            $budsql="SELECT * FROM Budget";
                                            $budresult = mysqli_query($connect,$budsql) or die("ERROR CONNECTING TO DB");
                                            $budres=mysql_query($budsql) or die (mysql_error());
                                            $total=0;
                                            while($bata = mysql_fetch_array($budres)){
                                                if($bata['memID']==$memID){
                                                    $color="black";
                                                    if($bata['source']!='Government'){ $color="green";}
                                                        echo"
                                                        <td><h4 style='color:$color'>".$bata['source']."</h4></td>
                                                        <td><h4 style='color:$color'>".$bata['budAmount']."</h4></td>
                                                        <td><h4 style='color:$color'>".$bata['dateReleased']."</h4></td><tr>";
                                                    }                          
                                            }
#END OF Bidget View--------------------------------------------------------------
#View Proposed Prjects-----------------------------------------------------------
                                        ?>
                                    </table>