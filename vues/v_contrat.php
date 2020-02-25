   <div class="container"> 
   <div class="interior">
    <div style = 'float : right'><label><strong>Recherche</strong></label>
    <input type="text" name="category" class='rechercher' id="categoryFilter"><br><br></div>
    
     <a class="btn" href="#open-modal">AJOUTER</a>
</div>
  </div><br>
   <div id="open-modal" class="modal-window">
    <div class="form-style-5">
        <table class="responsive-table">
            <form method="POST" action="index.php?uc=contrat&action=validAjoutC">
                <fieldset>
                     Client : <select class="select" id='lesClients'name="lesClients">
                    <?php
                        foreach ($lesClients as $unClient) {
                            $idclient = $unClient['id'];
                            $raisonsocial = $unClient['raisonsocial'];?>
                           <option  value="<?php echo $idclient?>"><?php echo $raisonsocial?></option>
                            <?php  }?>
                        </select>
                        Consultant : <select class="select" name="lesConsultants">
                            <?php foreach($lesConsultants as $unConsultant){
                                $idconsultant = $unConsultant['id'];
                                $nom = $unConsultant['nom'];
                                $prenom = $unConsultant['prenom']; ?>
                            <option value="<?php echo $idconsultant?>"><?php echo $nom.' '.$prenom?></option>
                         <?php } ?>

                        </select>
                        <?php
                        if(isset($_POST['ajoutercontrat'])){
                            if(empty($_POST['datedebut'])){   
                            echo '<p class="commentaire">Le champs <span class="commentaire">D&eacute;but du contrat</span> est vide</p>';
                            }
                            if(isset($_POST['datefin']) <= isset($_POST['datedebut'])){
                               '<p class="commentaire">Date de d&eacute;but ne doit pas exc&eacute;der la date de fin</p>';
                            }
                        }
                        ?>
                        <label>D&eacute;but du contrat :*</label>
                        <input type="date" value="<?php if (isset($_POST['datedebut'])){echo $_POST['datedebut'];} ?>" name='datedebut'>

                        <?php 
                        if(isset($_POST['ajoutercontrat'])){
                        if (empty($_POST['datefin']))
                            {   
                                echo '<p class="commentaire">Le champs <span class="commentaire">Fin du contrat</span> est vide</p>';
                        }}?>
                        <label>Fin du Contrat : *</label>

                        <input type="date"  value="<?php if (isset($_POST['datefin'])){echo $_POST['datefin'];} ?>" name="datefin" >
                        <input type="text" value="<?php if (isset($_POST['mission'])){echo $_POST['mission'];}?>" name="mission" placeholder='Description de la mission'>
                        
                          </script>  
                    <p>* Champs obligatoire</p>   
                </fieldset> 
                <a href="#" title="Close" id="close" class="modal-close">Fermer</a>
               <input type="submit" name='ajoutercontrat' value="Ajouter"/>             
            </form>
        </table>
    </div>
   </div>
   <style>input, select.select {margin-bottom: 15px;} </style>
   <!-- <a href="index.php?uc=contrat&action=ajoutC">Ajouter un contrat</a> -->
    <?php print(tableauContrat($lesContrats));?>  
   
   
   
   
   </div>
