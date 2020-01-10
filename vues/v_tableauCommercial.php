
<div class="container">
  <table class="responsive-table">



  <div class="interior">
    <a class="btn" href="#open-modal">AJOUTER</a>
  </div>
  <br>
<div id="open-modal" name="demo" class="modal-window">
  <div>
 
    <div class="form-style-5">
        <form method="post" name="formC" action="index.php?uc=commercial&action=ajouterCommercial">
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
                <input onclick="afficherRib();" type="checkbox" id="voir" name="regarder">
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


<input type="submit" name="envoyer" style="float: left;" value="AJOUTER" />
<a href="#" title="Close" id="close" class="modal-close">FERMER</a>
</form>
</div>

  </div>
</div>





  

<tr class="contrat">
      <td class="col col-5">Nom</td>
      <td class="col col-5">Prenom</td>
      <td class="col col-5">Tel</td>
      <td class="col col-5">Email</td>
      <td class="col col-5">Adresse</td>
      <td class="col col-5">Ville</td>
      <td class="col col-5">Code Postale</td>
      <td class="col col-5"></td>

</tr>


<?php


//var_dump($lesFinance);
$noligne=0;
foreach ($lesFinance as $uneFinance){
    
    ?>

<tr <?php if($noligne%2==0 ){echo"style='background-color:#dedede;'";}else{echo 'style="background-color:#F6F6F6"';} ?>>

<td class="col col-5" data-label="Nom"><?php echo $uneFinance->getOCommercial()->getNom() ?></td>
<td class="col col-5" data-label="Prenom"><?php echo $uneFinance->getOCommercial()->getPrenom() ?></td>
<td class="col col-5" data-label="Tel"><?php echo $uneFinance->getOCommercial()->getTel() ?></td>
<td class="col col-5" data-label="Email"><?php echo $uneFinance->getOCommercial()->getEmail() ?></td>
<td class="col col-5" data-label="Adresse"><?php echo $uneFinance->getOCommercial()->getAdresse() ?></td>
<td class="col col-5" data-label="Ville"><?php echo $uneFinance->getOCommercial()->getVille() ?></td>
<td class="col col-5" data-label="Code Postale"><?php echo $uneFinance->getOCommercial()->getCp() ?></td>
<td class="col col-5" style="width: 0px!important;"><a class="tableau" href="index.php?uc=commercial&action=modifCommercial&idCommercial=<?php echo $commerciauxDao->getIdCommercial($uneFinance->getOCommercial()) ?>">
  <i class="fas fa-edit"></i></a>
  <a class="delete" onclick=
      "if (confirm('voulez vous supprimer ?'))
      {window.location.replace('index.php?uc=commercial&action=deleteCommercial&idCommercial=<?php echo $commerciauxDao->getIdCommercial($uneFinance->getOCommercial())?>');}">
  <i class="fas fa-times"></i></a></td>
</tr>

<?php
$noligne++;
}
?>
</table>
</div>


