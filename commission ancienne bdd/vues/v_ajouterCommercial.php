
    
     
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
        <form method="post" action="index.php?uc=commercial&action=ajouterCommercial">
        <fieldset>
        <legend align="center">Information du Commercial</legend><br>
        <input type="text" pattern="[A-Za-z]{1,20}" name="nom" placeholder="Nom *" required="required">
        <input type="text" pattern="[A-Za-z]{1,20}" name="prenom" placeholder="Prenom *" required="required">
        <input type="text" pattern="[0-9]{10}" name="tel" placeholder="Numero de telephone *" required="required">
        <input type="email" name="email" placeholder="Email *" required="required">
        <input type="text" name="adresse" placeholder="Adresse *" required="required">
        <input type="text" pattern="[A-Za-z]{1,20}" name="ville" placeholder="Ville *" required="required">
        <input type="number" min="0" name="cp" placeholder="Code Postal *" required="required">
        

        <div class="control-group">
            <label class="control control-checkbox">
                Ajouter un RIB
                <input onclick="afficher()" type="checkbox" id="voir" name="regarder">
                <div class="control_indicator"></div>
            </label>
        </div>
        <div style="display: none" id="affichage" class="cacher">
        <input type="text" pattern="[0-9]{5}" name="codeAgence" placeholder="Code de l'agence *">
        <input type="number" min="0" name="compte" placeholder="N° compte *">
        <input type="text" pattern="[a-zA-Z0-9]{27}" name="iban" placeholder="IBAN *">
        <input type="text" pattern="{8|11}" name="bic" placeholder="BIC *">
        <input type="text" pattern="[0-9]{5}" name="codeBanque" placeholder="Code de la banque *">
        <input type="text" pattern="[0-9]{2}" name="cleRib" placeholder="cle RIB *">
        </div>

</fieldset>


<input type="submit" name="envoyer" value="Envoyer" />
</form>
</div>