


<div class="container">
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-2">Id Commission</div>
      <div class="col col-3">Valeur</div>
      <div class="col col-4">Montant</div>
    </li>

    
<div class="form-style-5">

<form method="post" action="index.php?uc=commission&action=ajouterCommission">
<fieldset>
  <select name="idCommercial">

    <?php

  foreach ($lesCommerciaux as $unCommercial)
  {
      ?>

      <option <?php if(isset($_POST['idCommercial']) && $commerciauxDao->getIdCommercial($unCommercial) == $_POST["idCommercial"]){echo 'selected';} ?>
      value=" <?php echo $commerciauxDAO->getIdCommercial($unCommercial) ?>"> <?php echo $unCommercial->getNom()." ".$unCommercial->getPrenom() ?></option>';

  <?php
  }
  ?> 
  </select>
<input type="number" min="0" name="valeur" placeholder="Pourcentage *">
<input type="number" min="0" name="montant" placeholder="Montant *">


</fieldset>

<?php /* if(isset($_POST['idCommercial']) && $commerciauxDao->getIdCommercial($unCommercial) == $_POST["idCommercial"]){echo 'selected';} */ ?>
<input type="submit" name="envoyer" value="ajouter" />
</form>
</div>
<?php

foreach ($lesDepenses as $uneDep){
    ?>
    
    <li class="table-row">
      <div class="col col-2" data-label="Id depense"><a class="tableau" href="index.php?uc=depense&action=modifierDepense&idDepense=<?php echo $depenseDao->getIdDepense($uneDep)?>">
        <i class="fas fa-edit"></i></a>
      <a class="delete" onclick=
      "if (confirm('voulez vous supprimer la depense ?'))
      {window.location.replace('index.php?uc=depense&action=deleteDepense&idDepense=<?php echo $depenseDao->getIdDepense($uneDep)?>');}">
        <i class="fas fa-times"></i></a><?php echo $depenseDao->getIdDepense($uneDep)?></div>
      <div class="col col-3" data-label="Libelle"><?php echo $uneDep->getLibelle() ?> </div>
      <div class="col col-4" data-label="Montant"><?php echo $uneDep->getMontant() ?> €</div>
    </li>
<?php

}
?>
</ul>
</div>


