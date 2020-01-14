
<div class="form-style-5">
    <form method="POST" action="index.php?uc=contrat&action=validAjoutC">
        <fieldset>
            <legend>Ajouter un contrat</legend>
             Client : <select class="select" id='lesClients'name="lesClients">
            <?php
                foreach ($lesClients as $unClient) {
                    $idclient = $unClient['id'];
                    $raisonsocial = $unClient['raisonsocial'];
                  ?> <option selected value="<?php echo $idclient?>"><?php echo $raisonsocial?></option>
                    <?php  }?>
        </select>
        <br><br>
        
                <label>Type de contrat : *</label>
                <select class="select" name="typecontrat">    
                    <option value='Sous-traitant'>Sous traitant</option>
                    <option value='En portage'>En portage</option>
                    <option selected value='Salarie' >Salarié</option>
                </select><br<br><br><br>
                
                <?php
                if(isset($_POST['ajoutercontrat'])){
                    if(empty($_POST['datedebut'])){   
                    echo '<p class="commentaire">Le champs <span class="commentaire">D&eacute;but du contrat</span> est vide</p>';
                    }
                }
                ?>
                <label>D&eacute;but du contrat :*</label>
                <input type="date" pattern="(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d\d" value="<?php if (isset($_POST['datedebut'])){echo $_POST['datedebut'];} ?>" name="datedebut"><br><br>
                
                <?php 
                if(isset($_POST['ajoutercontrat'])){
                if (empty($_POST['datefin']))
                    {   
                        echo '<p class="commentaire">Le champs <span class="commentaire">Fin du contrat</span> est vide</p>';
                }}?>
                <label>Fin du Contrat : *</label>
                
                <input type="date" pattern="(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d\d" value="<?php if (isset($_POST['datefin'])){echo $_POST['datefin'];} ?>" name="datefin" ><br><br>
                
                <input type="number" value="<?php if (isset($_POST['salaire'])){echo $_POST['salaire'];} ?>" name="salaire" placeholder="Salaire" min="0"><br><br>
                <input type="number" value="<?php if (isset($_POST['tarif'])){echo $_POST['tarif'];} ?>" name="tarif" placeholder="Tarif" min="0"><br><br>
        </fieldset>
                 <p>* Champs obligatoire</p>
        
                 <input type='submit' name='ajoutercontrat' value='Ajouter'>
    </form>
</div>
