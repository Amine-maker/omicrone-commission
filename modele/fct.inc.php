<?php
function tableauContrat($contenu){
    $tableau_html ="<li class='table-header'>"
        ."<div class='col col-2'>N°</div>"
        ."<div class='col col-2'>Type de contrat</div>"
        ."<div class='col col-2'>Date Début</div>"
        ."<div class='col col-2'>Date fin</div>"
        ."<div class='col col-2'>Salaire</div>"
        ."<div class='col col-2'>Tarif</div>"
        ."<div class='col col-2'>Raison Social</div>"
        ."</li>";
$noligne=0;
foreach ($contenu as $ligne){
    $tabcontrat=array(); //creer un tableau
$ligne_html ="";
foreach($ligne as $cellule){
    array_push($tabcontrat,$cellule);
}
for($i=0;$i<sizeof($tabcontrat);$i++) //parcours du tableau
{
    if($i==0){
        $idContrat = $tabcontrat[$i];
        $ligne_html .= "<div class='col col-2'><a class='tableau' href='index.php?uc=contrat&action=modifC&idcontrat=$idContrat'><i class='fas fa-edit'></i></a><a class='delete' href='#' onClick=\"if(confirm('Etes vous sur de vouloir supprimer?'))document.location.href='index.php?uc=contrat&action=suppcontrat&idcontrat=$idContrat'\">"
                 . "<i class='fas fa-times'></i></a>$tabcontrat[$i]</div>";
        //print_r($idContrat);
    }
   
   elseif($i<7){
   $ligne_html .="<div class='col col-2'>$tabcontrat[$i]</div>";
   }
   
}
$id=$ligne['idcontrat'];
if($noligne%2==0){
$tableau_html .="<li class='table-row'>$ligne_html</li>";
}
else {
  $tableau_html .="<li class='table-row'>$ligne_html</li>";
}
$noligne++;
}
return "$tableau_html</ul>";
}

//tableau renvoyant la liste des clients
function tableauClient($contenu){
    $tableau_html ="<li class='table-header'>"
        ."<div class='col col-2'>N°</div>"
        ."<div class='col col-2'>Raison Social</div>"
        ."<div class='col col-2'>Siret</div>"
        ."<div class='col col-2'>Adresse</div>"
        ."<div class='col col-2'>Ville</div>"
        ."<div class='col col-2'>Code Postale</div>"
        ."<div class='col col-2'>Email 1</div>"
        ."<div class='col col-2'>Email 2</div>"
        ."<div class='col col-2'>Email 3</div>"
        ."<div class='col col-2'>Bureau</div>"
        ."<div class='col col-2'>Fax</div>"
        ."<div class='col col-2'>Tel</div>"
        ."<div class='col col-2'>Modifier</div>"
        ."<div class='col col-2'>Supprimer</div>"
        ."</li>";
$noligne=0;
foreach ($contenu as $ligne){
    $tabclient=array(); //creer un tableau
    $ligne_html ="";
foreach($ligne as $cellule){
    array_push($tabclient,$cellule);
}
for($i=0;$i<sizeof($tabclient);$i++) //parcours du tableau
{
    if($i==0){
        $idclient = $tabclient[$i];
         $ligne_html .="<div class='col col-2 filter_td'>$tabclient[$i]</div>";
        //print_r($idclient);
    }
   
   elseif($i<12){
   $ligne_html .="<div class='col col-2 filter_td'>$tabclient[$i]</div>";
   }
   if($i==11){
        $ligne_html .= "<div class='col col-2'><a href='index.php?uc=client&action=modifclient&idclient=$idclient'><i>Modifier</a></div>";
   }
   if($i==11){ 
        $ligne_html .= "<div class='col col-2'><a href='#' onClick=\"if(confirm('Etes vous sur de vouloir supprimer?'))document.location.href='index.php?uc=client&action=suppclient&idclient=$idclient'\">"
                 . "<i>Supprimer</a></div>";
   }
}
$id=$ligne['idclient'];
if($noligne%2==0){
$tableau_html .="<li class='table-row'>$ligne_html</li>";
}
else {
  $tableau_html .="<li class='table-row'>$ligne_html</li>";
}
$noligne++;
}
return "<ul class='responsive-table' id='filter'>$tableau_html</ul>";
}
?>