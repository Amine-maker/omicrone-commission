


<div class="container">
  <table class="responsive-table">

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
  <h4>selectionner le type de commission</h4>

<div style="display: flex;">
  <input onclick="afficher();" type="radio" id="montant" name="heri" value="montant"checked >
  <label for="montant">montant</label>

  <input onclick="afficher();" type="radio" id="pourcentage" name="heri" value="pourcentage">
  <label for="pourcentage">pourcentage</label>

</div>
<div><input type="number" name="montant" id="INmontant" min="0" placeholder="Montant *" required="required">
<input type="number" name="pourcentage" id="INpourcentage" min="0" max="100" placeholder="Pourcentage *" style="display: none">
 </div>


<script>
function afficher(){
  var montant = document.getElementById('montant');
  var pourcentage = document.getElementById('pourcentage');
    if (montant.checked)
        {
        document.getElementById('INmontant').style.display='block';
        document.getElementById('INpourcentage').style.display='none';
        document.getElementById('INmontant').setAttribute('required','required');
        }
    
       else {
        document.getElementById('INmontant').style.display='none';
        document.getElementById('INpourcentage').style.display='block';
        document.getElementById('INpourcentage').setAttribute('required','required');
                                  }
        
                    }
</script>



</fieldset>

<input type="submit" name="envoyer" value="AJOUTER" />
</form>
</div>
    <tr class="table-header">
      <td class="col col-2">Id Commission</td>
      <td class="col col-2">Nom du Commercial</td>
      <td class="col col-2">Prenom du Commercial</td>
      <td class="col col-4">Montant</td>
      <td class="col col-3">Pourcentage</td>
    </tr>

    

<?php
$noligne=0;

for ($i=0; $i<=count($lesCommissions)-3; $i=$i+4){// je recupere les attribut dans un for 
                                                 //car j'ai besoin de parcourir 3 objet d'un coup
                                                // ce qui n'est pas possible avec un forach
  $id=$lesCommissions[$i];
  $nom=$lesCommissions[$i+1]->getOCommercial()->getNom();
  $prenom=$lesCommissions[$i+1]->getOCommercial()->getPrenom();
  $montant=$lesCommissions[$i+2]->getMontant();
  $valeur=$lesCommissions[$i+3]->getValeur();


  $montant=($montant==null) ? "<i>Null</i>" : $montant." ".'€';
  $valeur=($valeur==null) ? "<i>Null</i>" :  $valeur.'%';

    ?>
    
    
    <tr class="table-row" <?php if($noligne%2==0){echo"style='background-color:lightgrey;'";} ?>>
      <td class="col col-2" data-label="Id commission"><?php echo $id; ?></td>
      <td class="col col-2" data-label="nom du Commercial"><?php echo $nom ;?></td>
      <td class="col col-2" data-label="prenom du commercial"><?php echo $prenom ;?></td>
      <td class="col col-3" data-label="Montant"><?php echo $montant;?> </td>
      <td class="col col-4" data-label="Pourcentage"><?php echo $valeur ;?></td>
      <td align="center" data-label="Action"><a class="tableau" href="index.php?uc=commission&action=updateCommission&idCommission=<?php echo $id?>">
        <i class="fas fa-edit"></i></a>
      <a class="delete" onclick=
      "if (confirm('voulez vous supprimer la commission ?'))
      {window.location.replace('index.php?uc=commission&action=deleteCommission&idCommission=<?php echo $id;?>');}">
        <i class="fas fa-times"></i></a></td>
</tr>
<?php
$noligne++;
}
?>
</table>
</div>

