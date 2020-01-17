<div class="container">
<label><strong>Recherche</strong></label>
<input type="text" name="category" class='rechercher' id="categoryFilter"><br><br>
    
  <table id='filter' class="responsive-table">
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
    $id=$commerciauxDao->getIdCommercial($uneFinance->getOCommercial());
    $nom=$uneFinance->getOCommercial()->getNom();
    $prenom=$uneFinance->getOCommercial()->getPrenom();
    $tel=$uneFinance->getOCommercial()->getTel();
    $email=$uneFinance->getOCommercial()->getEmail();
    $adresse=$uneFinance->getOCommercial()->getAdresse();
    $ville=$uneFinance->getOCommercial()->getVille();
    $cp=$uneFinance->getOCommercial()->getCp();
    ?>


<tr <?php if($noligne%2==0 ){echo"style='background-color:#dedede;'";}else{echo 'style="background-color:#F6F6F6"';} ?>>


<form>

<td class="col col-5" name="modif<?php echo $noligne ?>" class="filter_td" data-label="Nom"><?php echo $nom ;?></td>
    <td class="col col-5" style="display: none" name="tdmodif<?php echo $noligne ?>">
      <input class="col col-4" name="demodif<?php echo $noligne ?>" type="text" pattern="[0-9]{10}" min="0" placeholder="Nom *" value="<?php echo $nom;?>">
    </td>


    <td class="col col-5" name="modif<?php echo $noligne ?>" class="filter_td" data-label="Prenom"><?php echo $prenom ;?></td>
    <td class="col col-5" style="display: none" name="tdmodif<?php echo $noligne ?>">
      <input class="col col-4" name="demodif<?php echo $noligne ?>" type="text" pattern="[0-9]{10}" min="0" placeholder="Prenom *" value="<?php echo $prenom;?>">
    </td>


    <td class="col col-5" name="modif<?php echo $noligne ?>" data-label="Telephone"><?php echo $tel ;?></td>
    <td class="col col-5" style="display: none" name="tdmodif<?php echo $noligne ?>">
      <input  class="col col-4" name="demodif<?php echo $noligne ?>" type="text" pattern="[0-9]{10}" min="0" placeholder="Telephone *" value="<?php echo $tel;?>">
    </td>

    <td class="col col-5" name="modif<?php echo $noligne ?>" data-label="Email"><?php echo $email ;?></td>
    <td class="col col-5" style="display: none" name="tdmodif<?php echo $noligne ?>">
      <input class="col col-4" name="demodif<?php echo $noligne ?>" type="email" pattern="[0-9]{10}" min="0" placeholder="Email *" value="<?php echo $email;?>">
    </td>

    <td class="col col-5" name="modif<?php echo $noligne ?>" data-label="Adresse"><?php echo $adresse ;?></td>
    <td class="col col-5" style="display: none" name="tdmodif<?php echo $noligne ?>">
      <input class="col col-4" name="demodif<?php echo $noligne ?>" type="text" pattern="[0-9]{10}" min="0" placeholder="Adresse *" value="<?php echo $adresse;?>">
    </td>

    <td class="col col-5" name="modif<?php echo $noligne ?>" data-label="Ville"><?php echo $ville ;?></td>
    <td class="col col-5" style="display: none" name="tdmodif<?php echo $noligne ?>">
      <input class="col col-4" name="demodif<?php echo $noligne ?>" type="text" placeholder="Ville *" value="<?php echo $ville;?>">
    </td>

    <td class="col col-5" name="modif<?php echo $noligne ?>" class="filter_td" data-label="Code Postal"><?php echo $cp ;?></td>
    <td class="col col-5" style="display: none" name="tdmodif<?php echo $noligne ?>">
      <input style="width: 100px;" class="col col-4" name="demodif<?php echo $noligne ?>" type="number" pattern="[0-9]{10}" min="0" placeholder="Code >Postale *" value="<?php echo $cp;?>">
    </td>



<td align="center" data-label="Action">
      <a class="tableau" id="submit<?php echo $noligne ?>" name="modif<?php echo $noligne ?>" onclick="modif(this.name,this.id);"><i class="fas fa-edit"></i></a>
      <a class="tableau" id="desubmit<?php echo $noligne ?>" style="display: none; padding:0px; margin-right:5px;"><button id="button" name="modif<?php echo $noligne ?>" onclick="submitCommercial(this.name,<?php echo $id;?>);"><i class="fas fa-check"></i></button></a>

      <a class="delete" onclick=
      "if (confirm('voulez vous supprimer le commercial ?'))
      {window.location.replace('index.php?uc=commercial&action=deleteCommercial&idCommercial=<?php echo $id;?>');}">
        <i class="fas fa-times"></i></a>
  
      </td>
</tr>

<?php
$noligne++;
}
?>
</table>
</div>

</form>
