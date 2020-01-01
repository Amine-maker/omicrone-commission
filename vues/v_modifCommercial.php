<script>
function afficher(){
    if (document.getElementById('voir').checked)
        {
        document.getElementById('affichage').style.display='block';
        }
    else {
        document.getElementById('affichage').style.display='none';
        }
                    }
</script>

<div class="form-style-5">
        <form method="post" action="index.php?uc=commercial&action=modifCommercial">
        <fieldset>
        <legend align="center">Information(s) à modifier</legend><br>
        <input type="text" pattern="[A-Za-z]{1,20}" name="nom" placeholder="Nom *" required="required" value="<?php echo $comm->getOCommercial()->getNom()?>">
        <input type="text" pattern="[A-Za-z]{1,20}" name="prenom" placeholder="Prenom *" required="required" value="<?php echo  $comm->getOCommercial()->getPrenom()?>">
        <input type="text" pattern="[0-9]{10}" name="tel" placeholder="Numero de telephone *" required="required" value="<?php echo $comm->getOCommercial()->getTel()?>">
        <input type="email" name="email" placeholder="Email *" required="required" value="<?php echo $comm->getOCommercial()->getEmail()?>">
        <input type="text" name="adresse" placeholder="Adresse *" required="required" value="<?php echo $comm->getOCommercial()->getAdresse()?>">
        <input type="text" pattern="[A-Za-z]{1,20}" name="ville" placeholder="Ville *" required="required" value="<?php echo $comm->getOCommercial()->getVille()?>">
        <input type="number" min="0" name="cp" placeholder="Code Postal *" required="required" value="<?php echo $comm->getOCommercial()->getCp()?>">
        <input type="hidden" value="<?php echo $_REQUEST["idCommercial"] ?>" name="idCommercial">
        <div class="control-group" <?php if($idFinance==NULL){ ?>style="display: none" <?php } ?>>
            <label class="control control-checkbox" style="width: 180px">
                 Modifier le RIB <br>
                <input onclick="afficher()" type="checkbox" id="voir" name="regarder">
                <div class="control_indicator"></div>
            </label>
        </div> <br>
        <div style="display: none" id="affichage" class="cacher">
        <input type="text" pattern="[0-9]{5}" name="codeAgence" placeholder="Code de l'agence *" value="<?php echo $comm->getCodeAgence()?>">
        <input type="number" min="0" name="compte" placeholder="N° compte *" value="<?php echo $comm->getCompte()?>">
        <input type="text" pattern="[a-zA-Z0-9]{27}" name="iban" placeholder="IBAN *" value="<?php echo $comm->getIban()?>">
        <input type="text" pattern="[a-zA-Z0-9]{8,11}" name="bic" placeholder="BIC *" value="<?php echo $comm->getBic()?>">
        <input type="text" pattern="[0-9]{5}" name="codeBanque" placeholder="Code de la banque *" value="<?php echo $comm->getCodeBanque()?>">
        <input type="text" pattern="[0-9]{2}" name="cleRib" placeholder="cle RIB *" value="<?php echo $comm->getCleRib()?>">
    </div>

</fieldset>


<input type="submit" name="modifier" value="Modifier" />
</form>
</div>