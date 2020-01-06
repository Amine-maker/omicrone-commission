<hr>
<div class="form-style-5">
    <form method="POST" action="index.php?uc=contrat&action=validmodifcontrat&idcontrat=<?php echo $idContrat?>">
        <fieldset>
            <legend><span class="number"></span>Modifier le contrat</legend>
             Client : <select class="select" name="ModiflesClients">
            <option selected value="<?php echo $idduclient?>"><?php echo $laraisonsocial;?></option>
            <?php
                foreach ($lesClients as $unClient) {
                    $idclient = $unClient['idclient'];
                    $raisonsocial = $unClient['raisonsocial'];
                   ?>
                 
                 <option value="<?php echo $idclient?>"><?php echo $raisonsocial?></option>
                    <?php  }?>
        </select>
        <br><br>
                <label>Type de contrat : *</label>
                <select class="select" name="typecontrat">    
                    <option selected value=<?php echo $typecontrat?>><?php echo $typecontrat?></option>
                    <option value='Sous-traitant'>Sous traitant</option>
                    <option value='En portage'>En portage</option>
                    <option value='Salarié'>Salarié</option>
                </select><br<br><br>
                
                <?php
                if(isset($_POST['validmodifcontrat'])){
                    if(empty($_POST['datedebut'])){   
                    echo '<p class="commentaire">Le champs <span class="commentaire">D&eacute;but du contrat</span> est vide</p>';
                    }
                }
                ?>
                <label>D&eacute;but du contrat</label>
                <input type="date" value="<?php echo $datedebut ?>" name="datedebut"><br><br>
                
                <?php 
                if(isset($_POST['validmodifcontrat'])){
                if (empty($_POST['datefin']))
                    {   
                        echo '<p class="commentaire">Le champs <span class="commentaire">Fin du contrat</span> est vide</p>';
                }}?>
                <label>Fin du Contrat : *</label>
                <input type="date"  value="<?php echo $datefin?>" name="datefin" ><br><br>
                <label>Salaire : </label>
                <input type="number" value="<?php echo $salaire; ?>" name="salaire" placeholder="Salaire" min="0"><br><br>
                <label>Tarif : </label>
                <input type="number" value="<?php echo $tarif ?>" name="tarif" placeholder="Tarif" min="0"><br><br>
        </fieldset>
                 <p>* Champs obligatoire</p>
        
                 <input type='submit' name='validmodifcontrat' value='Modifier'>
    </form>
</div>
</div>
