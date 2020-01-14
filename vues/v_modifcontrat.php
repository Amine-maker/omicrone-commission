<div class='container'>
<div class='form-style-5'>
    <form method='POST' action='index.php?uc=contrat&action=validmodifcontrat&idcontrat=<?php echo $idContrat?>'>
        <fieldset>
            <legend>Modifier le contrat</legend>
             Client : <select class='select' name='ModiflesClients'>
            <option selected value='<?php echo $idduclient?>'><?php echo $laraisonsocial;?></option>
            <?php
                foreach ($lesClients as $unClient) {
                    $idclient = $unClient['id'];
                    $raisonsocial = $unClient['raisonsocial'];
                   ?>
                 
                 <option value='<?php echo $idclient?>'><?php echo $raisonsocial?></option>
                    <?php  }?>
             </select>
              Consultant : <select class="select" name="ModiflesConsultants">
                <option selected value='<?php echo $idduconsultant?>'><?php echo $lenom.' '.$leprenom;?></option>
                            <?php foreach($lesConsultants as $unConsultant){
                                $idconsultant = $unConsultant['id'];
                                $nom = $unConsultant['nom'];
                                $prenom = $unConsultant['prenom']; ?>
                            <option value="<?php echo $idconsultant?>"><?php echo $nom.' '.$prenom?></option>
                         <?php } ?>

                        </select>               
                <?php
                if(isset($_POST['validmodifcontrat'])){
                    if(empty($_POST['datedebut'])){   
                    echo "<p class='commentaire'>Le champs <span class='commentaire'>D&eacute;but du contrat</span> est vide</p>";
                    }
                }
                ?>
                <label>D&eacute;but du contrat</label>
                <input type='date' value='<?php echo $datedebut ?>' name='datedebut'><br><br>
                
                <?php 
                if(isset($_POST['validmodifcontrat'])){
                if (empty($_POST['datefin']))
                    {   
                        echo "<p class='commentaire'>Le champs <span class='commentaire'>Fin du contrat</span> est vide</p>";
                }}?>
                <label>Fin du Contrat : *</label>
                <input type='date'  value='<?php echo $datefin?>' name='datefin' ><br><br>
                
                <label>Type de contrat : *</label>
                    <div style='display: flex;'>
                        <?php if($typecontrat == 'Salarie'){?>
                            <input onclick='afficher();' type='radio' id='sa' name='typecontrat' checked value='<?php echo $typecontrat?>'><label>Salarié</label>
                             <input onclick='afficher();' type='radio' id='st' name='typecontrat' value='Sous-traitant'>
                                <label>Sous-Traitant</label>
                            <input onclick='afficher();' type='radio' id='ep' name='typecontrat' value='En portage'>
                                <label>En portage</label>
                      <?php  } 
                      else {?>
                        
                        <?php if ($typecontrat == 'Sous-traitant'){?>
                         <input onclick='afficher();' type='radio' id='sa' name='typecontrat' value='Salarie' >
                            <label>Salarié</label>    
                        <input onclick='afficher();' type='radio' id='st' name='typecontrat' checked value='<?php echo $typecontrat?>'>
                            <label>Sous-Traitant</label>
                        <input onclick='afficher();' type='radio' id='ep' name='typecontrat' value='En portage'>
                            <label>En portage</label>
                        <?php } 
                        else {?>
                        <input onclick='afficher();' type='radio' id='sa' name='typecontrat' value='Salarie' >
                            <label>Salarié</label>   
                        <input onclick='afficher();' type='radio' id='st' name='typecontrat' value='Sous-traitant'>
                                <label>Sous-Traitant</label>     
                        <input onclick='afficher();' type='radio' id='ep' name='typecontrat' checked value='<?php echo $typecontrat?>'>
                            <label>En portage</label>
                      <?php }}?>
                    </div>
                    <div>
                        <label>Salaire : </label>
                        <input type='number' id='salaire' value='<?php echo $salaire; ?>' name='salaire' placeholder='Salaire' min='0'><br><br>
                        <label>Tarif : </label>
                        <input type='number' id='tarif' value='<?php echo $tarif ?>' name='tarif' placeholder='Tarif' min='0' style='display: none'><br><br>
                    </div>            
                    <script>
                    function afficher(){
                      var soustraitant = document.getElementById('st');
                      var enportage = document.getElementById('ep');
                      var salarie = document.getElementById('sa');  

                        if (salarie.checked)
                            {
                            document.getElementById('salaire').style.display='block';
                            document.getElementById('tarif').style.display='none';
                            document.getElementById('salaire').setAttribute('required','required');
                            }

                        if (soustraitant.checked){
                            document.getElementById('salaire').style.display='none';
                            document.getElementById('tarif').style.display='block';
                            document.getElementById('tarif').setAttribute('required','required');
                            }

                        if (enportage.checked) {
                            document.getElementById('salaire').style.display='block';
                            document.getElementById('tarif').style.display='block';
                            document.getElementById('salaire').setAttribute('required','required');
                            document.getElementById('tarif').setAttribute('required','required');
                            }

                    }
                    </script>
        </fieldset>
                 <p>* Champs obligatoire</p>
        
                 <input type='submit' name='validmodifcontrat' value='Modifier'>
    </form>
</div>
</div>
