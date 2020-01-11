
<div class='container'><h3 class="intitule">Les consultants</h3>
    <a href="index.php?uc=consultant&action=ajouterconsultant">Ajouter</a><br><br>
<table>
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

 <?php foreach( $lesConsultants as $unConsultant){?>
 
<tr class="table-row">

<td data-label="Nom"><?php echo $unConsultant->getNom() ?></td>
<td data-label="Prenom"><?php echo $unConsultant->getPrenom() ?></td>
<td data-label="Adresse"><?php echo $unConsultant->getAdresse() ?></td>
<td data-label="Ville"><?php echo $unConsultant->getVille() ?></td>
<td data-label="Code Postale"><?php echo $unConsultant->getCp() ?></td>
<td data-label="Tel"><?php echo $unConsultant->getTel() ?></td>
<td data-label="Email"><?php echo $unConsultant->getEmail() ?></td>
<td class="col col-6" data-label="Id commercial"><a class="tableau" href="index.php?uc=consultant&action=modifconsultant&idconsultant=<?php echo $consultantDao->getIdConsultantFromobject($unConsultant) ?>">
  <i class="fas fa-edit"></i></a>
  <a class="delete" onclick="if (confirm('voulez vous supprimer ?'))
      {window.location.replace('index.php?uc=consultant&action=suppconsultant&idconsultant=<?php echo $consultantDao->getIdConsultantFromobject($unConsultant)?>');}">
  <i class="fas fa-times"></i></a></td>
</tr>
 <?php } ?>
</table> 
</div>