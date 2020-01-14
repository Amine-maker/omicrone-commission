


<div class="container">
  <table class="responsive-table">


  <div class="form-style-5">

<form method="post" action="index.php?uc=depense&action=ajouterDepense">
<fieldset>
<input type="number" min="0" name="montant" placeholder="Montant *" required="required">
<input type="text" pattern="[A-Za-z]{1,20}" name="libelle" placeholder="Libelle *" required="required">


</fieldset>


<input type="submit" name="envoyer" value="AJOUTER" />
</form>
</div>
    <tr class="table-header">
      <td class="col col-2">Id depense</td>
      <td class="col col-3">Libelle</td>
      <td class="col col-4">Montant</td>
      <td class=""></td>
    </tr>

  
<?php
$noligne=0;
foreach ($lesDepenses as $uneDep){
    ?>
    
    <tr class="table-row" <?php if($noligne%2==0 ){echo"style='background-color:lightgrey;'";} ?>>
      <td class="col col-2" data-label="Id depense"><?php echo $depenseDao->getIdDepense($uneDep)?></td>
      <td class="col col-3" data-label="Libelle"><?php echo $uneDep->getLibelle() ?> </td>
      <td class="col col-4" data-label="Montant"><?php echo $uneDep->getMontant() ?> €</td>
      <td align="center" data-label="Action"><a class="tableau" href="index.php?uc=depense&action=modifierDepense&idDepense=<?php echo $depenseDao->getIdDepense($uneDep)?>">
        <i class="fas fa-edit"></i></a>
      <a class="delete" onclick=
      "if (confirm('voulez vous supprimer la depense ?'))
      {window.location.replace('index.php?uc=depense&action=deleteDepense&idDepense=<?php echo $depenseDao->getIdDepense($uneDep)?>');}">
        <i class="fas fa-times"></i></a></td>
</tr>
<?php
$noligne++;
}
?>
</table>
</div>



