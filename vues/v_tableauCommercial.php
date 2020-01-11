
<div class="container">
  <ul class="responsive-table">
  <div class="form-style-5">
        <form method="post" action="index.php?uc=commercial&action=ajouterCommercial">
        <fieldset>
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


<input type="submit" name="envoyer" value="AJOUTER" />
</form>
</div>

    <li class="table-header">
      <div class="col col-6">Id Commercial</div>
      <div class="col col-5">Nom</div>
      <div class="col col-5">Prenom</div>
      <div class="col col-5">Tel</div>
      <div class="col col-5">Email</div>
      <div class="col col-5">Adresse</div>
      <div class="col col-5">Ville</div>
      <div class="col col-5">Code Postale</div>
    </li>

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

<?php


//var_dump($lesFinance);

foreach ($lesFinance as $uneFinance){
    
    ?>

<li class="table-row">
<div class="col col-6" data-label="Id commercial"><a class="tableau" href="index.php?uc=commercial&action=modifCommercial&idCommercial=<?php echo $commerciauxDao->getIdCommercial($uneFinance->getOCommercial()) ?>">
  <i class="fas fa-edit"></i></a>
  <a class="delete" onclick=
      "if (confirm('voulez vous supprimer ?'))
      {window.location.replace('index.php?uc=commercial&action=deleteCommercial&idCommercial=<?php echo $commerciauxDao->getIdCommercial($uneFinance->getOCommercial())?>');}">
  <i class="fas fa-times"></i></a><?php echo $commerciauxDao->getIdCommercial($uneFinance->getOCommercial())?></div>
<div class="col col-5" data-label="Nom"><?php echo $uneFinance->getOCommercial()->getNom() ?></div>
<div class="col col-5" data-label="Prenom"><?php echo $uneFinance->getOCommercial()->getPrenom() ?></div>
<div class="col col-5" data-label="Tel"><?php echo $uneFinance->getOCommercial()->getTel() ?></div>
<div class="col col-5" data-label="Email"><?php echo $uneFinance->getOCommercial()->getEmail() ?></div>
<div class="col col-5" data-label="Adresse"><?php echo $uneFinance->getOCommercial()->getAdresse() ?></div>
<div class="col col-5" data-label="Ville"><?php echo $uneFinance->getOCommercial()->getVille() ?></div>
<div class="col col-5" data-label="Code Postale"><?php echo $uneFinance->getOCommercial()->getCp() ?></div>
</li>
<?php

}
?>
</ul>
</div>


