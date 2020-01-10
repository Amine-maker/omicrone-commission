


<div class="container">
  <table class="responsive-table">
  <div class="interior">
    <a class="btn" href="#open-modal">Ajouter</a>
  </div>
  <br>
<div id="open-modal" class="modal-window">
  <div>
   
    <div class="form-style-5">

<form method="post" action="index.php?uc=depense&action=ajouterDepense">

<input type="number" min="0" name="montant" placeholder="Montant *" required="required">
<input type="text" pattern="[A-Za-z]{1,20}" name="libelle" placeholder="Libelle *" required="required">
<a href="#" title="Close" id="close" class="modal-close">Fermer</a>
<input type="submit" name="envoyer" value="Ajouter"/>
</form>
</div>
  </div>
</div>


 
    <tr class="contrat">
      <td class="col col-2">Id depense</td>
      <td class="col col-3">Libelle</td>
      <td class="col col-4">Montant</td>
      <td class=""></td>
    </tr>

  
<?php
$noligne=0;
foreach ($lesDepenses as $uneDep){
    ?>
    
    <tr <?php if($noligne%2==0 ){echo"style='background-color:#dedede;'";}else{echo 'style="background-color:#F6F6F6"';} ?>>
    
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



