<div class="container">
    <table class="responsive-table">
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
                </select><br><br>               
                <?php
                if(isset($_POST['ajoutercontrat'])){
                    if(empty($_POST['datedebut'])){   
                    echo '<p class="commentaire">Le champs <span class="commentaire">D&eacute;but du contrat</span> est vide</p>';
                    }
                }
                ?>
                <label>D&eacute;but du contrat :*</label>
                <input type="date"value="<?php if (isset($_POST['datedebut'])){echo $_POST['datedebut'];} ?>" name="datedebut"><br><br>
                
                <?php 
                if(isset($_POST['ajoutercontrat'])){
                if (empty($_POST['datefin']))
                    {   
                        echo '<p class="commentaire">Le champs <span class="commentaire">Fin du contrat</span> est vide</p>';
                }}?>
                <label>Fin du Contrat : *</label>
                
                <input type="date"  value="<?php if (isset($_POST['datefin'])){echo $_POST['datefin'];} ?>" name="datefin" ><br><br>
               
                <label>Type de contrat : *</label>
                    <div style="display: flex;">
                        <input onclick="afficher();" type="radio" id="sa" name="typecontrat" value="Salarié" checked>
                        <label>Salarié</label>
                        
                        <input onclick="afficher();" type="radio" id="st" name="typecontrat" value="Sous-traitant">
                        <label>Sous-Traitant</label>
                        
                        <input onclick="afficher();" type="radio" id="ep" name="typecontrat" value="En portage">
                        <label>En portage</label>
                    </div>
                    <div>
                        <input type='number' id='salaire' value="<?php if (isset($_POST['salaire'])){echo $_POST['salaire'];} ?>" name="salaire" placeholder="Salaire" min="0"><br><br>
                        <input type='number' id='tarif' value="<?php if (isset($_POST['tarif'])){echo $_POST['tarif'];} ?>" name="tarif" placeholder="Tarif" min="0" style="display: none"><br><br>
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
        
        <input type='submit' name='ajoutercontrat' value='Ajouter'>
    </form>
</div>
        </table>
</div>