
<div class='container'><h3 class='intitule'>Les consultants</h3>
<label><strong>Recherche</strong></label>
<input type="text" name="category" class='rechercher' id="categoryFilter"><br><br>
    <a href='index.php?uc=consultant&action=ajouterconsultant'>Ajouter</a><br><br>
<table id="filter">
<tr class='contrat'>
      <td >Nom</td>
      <td >Prenom</td>
      <td >Adresse</td>
      <td >Ville</td>
      <td >Code Postale</td>
      <td >Tel</td>
      <td >Email</td>
      <td >Action</td>
 </tr>

 <?php  $noligne=0;
 foreach( $lesConsultants as $unConsultant){?>
 
<tr class='table-row' <?php
    if($noligne%2==0 ){
       echo"style='background-color:#dedede;'";}
    else{
     echo 'style="background-color:#F6F6F6"';
     } ?>
>

<td  class="col col-5 filter_td" data-label='Nom' name="modif<?php echo $noligne ?>"><?php echo $unConsultant->getNom() ?></td>
<td  class="col col-5 filter_td" data-label='Prenom' name="modif<?php echo $noligne ?>"><?php echo $unConsultant->getPrenom() ?></td>
<td  class="col col-5 filter_td" data-label='Adresse' name="modif<?php echo $noligne ?>"><?php echo $unConsultant->getAdresse() ?></td>
<td class="col col-5 filter_td" data-label='Ville' name="modif<?php echo $noligne ?>"><?php echo $unConsultant->getVille() ?></td>
<td class="col col-5 filter_td" data-label='Code Postale' name="modif<?php echo $noligne ?>"><?php echo $unConsultant->getCp() ?></td>
<td  class="col col-5 filter_td" data-label='Tel' name="modif<?php echo $noligne ?>"><?php echo $unConsultant->getTel() ?></td>
<td  class="col col-5 filter_td" data-label='Email' name="modif<?php echo $noligne ?>"><?php echo $unConsultant->getEmail() ?></td>
<td class='col col-6' data-label='Id commercial' name="modif<?php echo $noligne ?>"><a class='tableau' href='index.php?uc=consultant&action=modifconsultant&idconsultant=<?php echo $consultantDao->getIdConsultantFromobject($unConsultant) ?>'>
  <i class='fas fa-edit'></i></a>
  <a class='delete' onclick="if (confirm('voulez vous supprimer ?'))
      {window.location.replace('index.php?uc=consultant&action=suppconsultant&idconsultant=<?php echo $consultantDao->getIdConsultantFromobject($unConsultant)?>');}">
        <i class='fas fa-times'></i></a></td>
</tr>
 <?php
$noligne++;
 } ?>
</table> 
</div>