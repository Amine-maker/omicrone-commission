<div class="container">
  <h3 class='intitule'>Les commissions</h3>

  <table id='filter' class="responsive-table"> 

  <table class="responsive-table" id="filter">
  <div class="interior">
    <div style = 'float : right'><label><strong>Recherche</strong></label>
    <input type="text" name="category" class='rechercher' id="categoryFilter"><br><br></div>
    
     <a class="btn" href="#open-modal">AJOUTER</a>
</div>
  <br>
<div id="open-modal" class="modal-window">
  <div>
   
  <div class="form-style-5">

<form method="post" action="index.php?uc=commission&action=ajouterCommission">

<fieldset>
  <h4>Choisir le commercial</h4>
  <select name="idCommercial" required="required" >
  
    <?php

  foreach ($lesCommerciaux as $unCommercial)
  {
      ?>

      <option  value=" <?php echo $commerciauxDAO->getIdCommercial($unCommercial) ?>"> <?php echo $unCommercial->getNom()." ".$unCommercial->getPrenom() ?></option>';

  <?php
  }
  ?> 
  </select>
  <h4>Choisir le contrat</h4>
    <select name="idContrat">
    
    <?php

  foreach ($lesContrats as $unContrat)
  {
      ?>

      <option value="<?php echo $unContrat->getidContrat() ?>"> <?php echo 'Consultant : '.$unContrat->getcleconsultant()->getNom().' - D&eacute;but : '. $unContrat->getdatedebut()." - Fin : ".$unContrat->getdatefin() ?></option>';

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

</fieldset>

<input type="submit" name="envoyer" value="AJOUTER" />
<a href="#" title="Close" id="close" class="modal-close">FERMER</a>
</form>
</div>



  </div>
</div> 

    <tr class="contrat">
      <td class="col col-2">Nom du Commercial</td>
      <td class="col col-2">Prenom du Commercial</td>
      <td class="col col-4">Montant</td>
      <td class="col col-3">Pourcentage</td>
      <td class="col col-3"></td>
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
  $idCommercial=$commerciauxDAO->getIdCommercial($lesCommissions[$i+1]->getOCommercial());
  


  $montant=($montant==null) ? "<i>Null</i>" : $montant." ".'€';
  $valeur=($valeur==null) ? "<i>Null</i>" :  $valeur.'%';

    ?>
    
    <tr <?php if($noligne%2==0 ){echo"style='background-color:#e1ecfd;'";}else{echo 'style="background-color:#FFFFFF"';} ?>>
      
    
    <td class="col col-2 filter_td" name="modif" data-label="nom du Commercial"> <?php echo $nom ;?></td>
    
    <td class="col col-2 filter_td" name="modif"  data-label="prenom du commercial"> <?php echo $prenom ;?></td>
    
    
    <td class="col col-3 filter_td" name="modif<?php echo $noligne ?>" data-label="Montant"><?php echo $montant ;?></td>
    <td class="col col-3 filter_td" style="display: none" name="tdmodif<?php echo $noligne ?>">
      <input style="display: none" class="col col-2" name="demodif<?php echo $noligne ?>" type="number" pattern="[0-9]{10}" min="0" max="100" placeholder="Montant *" value="<?php echo substr($montant,0,-4);?>" <?php if($montant=="<i>Null</i>"){echo 'readonly';} ?>>
    </td>
     
    
    <td class="col col-4 filter_td" name="modif<?php echo $noligne ?>" data-label="Pourcentage"><?php echo $valeur ;?></td>
    <td class="col col-4" style="display: none" name="tdmodif<?php echo $noligne ?>">
      <input style="display: none" class="col col-2" name="demodif<?php echo $noligne ?>" type="number" pattern="[0-9]{10}" value="<?php echo substr($valeur,0,-1) ;?>" min="0" max="100" placeholder="Pourcentage *" <?php if($valeur=="<i>Null</i>"){echo 'readonly';} ?>>
    </td>
     

    <td align="center" data-label="Action">
      <a class="tableau" id="submit<?php echo $noligne ?>" name="modif<?php echo $noligne ?>" onclick="modif(this.name,this.id);"><i class="fas fa-edit"></i></a>
      <a class="tableau" id="desubmit<?php echo $noligne ?>" style="display: none; padding:0px; margin-right:5px;"><button id="button" name="modif<?php echo $noligne ?>" onclick="submit(this.name,<?php echo $id;?>,<?php echo $idCommercial;?>);"><i class="fas fa-check"></i></button></a>

      <a class="delete" onclick=
      "if (confirm('voulez vous supprimer la commission ?'))
      {window.location.replace('index.php?uc=commission&action=deleteCommission&idCommission=<?php echo $id;?>');}">
        <i class="fas fa-times"></i></a>
      </td>
</tr>
<?php
$noligne++;
}
?>
</form>
</table>


</div>







