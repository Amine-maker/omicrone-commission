<div class="container">
<div class="form-style-5">
        <form method="post" action="index.php?uc=cra&action=afficherCraChoisis&idconsultant=<?php echo $idconsultant?>">
                <fieldset>
                        <legend align="center">Cra</legend><br>
                                <?php 

                                 ?>
                                <br><br>
                        <select name="mois">
                                <?php 
                                for($i=0; $i<sizeof($lesMois);$i++){
                                        $mois = $lesMois[$i];
                                        $numMois = substr($mois, 0, 2);
                                        $numAnnee = substr($mois, 2, 4);
                                        if($mois == $moisASelectionner){
                                        ?>
                                        <option selected value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
                                        <?php  
                                        }
                                        else{ ?> 
                                        <option value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
                                        <?php }
                               
                                } ?>
                        </select>
                        <input type="submit" value="Valider" name="valider" style="width: 100%!important">
                        
                </fieldset>

        </form>
</div>
</div>