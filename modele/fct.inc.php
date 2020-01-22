<?php
function tableauContrat($contenu){
    $tableau_html ="<TR class='contrat'>"
        // ."<td>N°</td>"
        ."<td>Type de contrat</td>"
        ."<td>Date Début</td>"
        ."<td>Date fin</td>"
        ."<td>Mission</td>"
        ."<td>Salaire</td>"
        ."<td>Tarif</td>"
        ."<td>Raison Social</td>"
        ."<td>Consultant</td>"
        ."<td>Facture</td>"
        ."<td>Action</td>"
        ."</TR>";
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
       // print_r($idContrat);
    }
   
   if($i>0 && $i<9){
   $ligne_html .="<td class='filter_td'>$tabcontrat[$i]</td>";
   }
    if($i==8){
       $ligne_html .="<td><a href='index.php?uc=facture&action=afficherfacture&idcontrat=$idContrat'><i class='fas fa-file-invoice'></i></a></td>";
   }
   if($i==8){
        $ligne_html .= "<TD ><a class='tableau' href='index.php?uc=contrat&action=modifC&idcontrat=$idContrat'><i class='fas fa-edit'></i></a><a class='delete' href='#' onClick=\"if(confirm('Etes vous sur de vouloir supprimer?'))document.location.href='index.php?uc=contrat&action=suppcontrat&idcontrat=$idContrat'\">"
                 . "<i class='fas fa-times'></i></a></TD>";
   }
   
  
}
$id=$ligne['id'];
if($noligne%2==0){
$tableau_html .="<TR bgcolor=#e1ecfd>$ligne_html</TR>";
}
else {
  $tableau_html .="<TR  bgcolor=#ffffff>$ligne_html</TR>";
}
$noligne++;
}
return "<TABLE id='filter' class='responsive-table'>$tableau_html</TABLE>";
}

//tableau renvoyant la liste des clients
function tableauClient($contenu){

    $tableau_html ="<TR class='contrat'>"
        ."<td class='col col-5'>Raison Social</td>"
        ."<td class='col col-5'>Siret</td>"
        ."<td class='col col-5'>Adresse</td>"
        ."<td class='col col-5'>Ville</td>"
        ."<td class='col col-5'>Code Postale</td>"
        ."<td class='col col-5'>Email 1</td>"
        ."<td class='col col-5'>Email 2</td>"
        ."<td class='col col-5'>Email 3</td>"
        ."<td class='col col-5'>Bureau</td>"
        ."<td class='col col-5'>Fax</td>"
        ."<td class='col col-5'>Tel</td>"
        ."<td colspan='2' class='col col-5'>Action</td>"
        ."</TR>";
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
        // $ligne_html .="<td class='filter_td'>$tabclient[$i]</td>";
        //print_r($idclient);
    }
   
   elseif($i<12){
   $ligne_html .="<td class='col col-5 filter_td' name='modif".$noligne."'>$tabclient[$i]</td>";
   $ligne_html .="<td class='col col-5' style='display: none' name='tdmodif".$noligne."'>
   <input class='col col-4' name='demodif".$noligne."' type='text' value='$tabclient[$i]'>
 </td>";
   }
   if($i==11){
        //$ligne_html .= "<TD class='col col-5'><a class='tableau' href='index.php?uc=client&action=modifclient&idclient=$idclient'><i class='fas fa-edit'></i></a></td>";

        $ligne_html .= "<td><a class='tableau' id='submit".$noligne."' name='modif".$noligne."' onclick='modif(this.name,this.id);'><i class='fas fa-edit'></i></a>
        <a class='tableau' id='desubmit".$noligne."' style='display: none; padding:0px; margin-right:5px;'><button id='button' name='modif".$noligne."' onclick='submitClient(this.name,$idclient);'><i class='fas fa-check'></i></button></a>";

        $ligne_html .= "<a class='delete' href='#' onClick=\"if(confirm('Etes vous sur de vouloir supprimer?'))document.location.href='index.php?uc=client&action=suppclient&idclient=$idclient'\">"
        . "<i class='fas fa-times'></i></a></td>";
    }

}
$id=$ligne['id'];
if($noligne%2==0){
$tableau_html .="<TR bgcolor=#e1ecfd>$ligne_html</TR>";
}
else {
  $tableau_html .="<TR bgcolor=#ffffff>$ligne_html</TR>";
}
$noligne++;
}
return "<TABLE id='filter'  class='responsive-table'>$tableau_html</TABLE>";
}

$mois=1;



function getMoisFr($mois){

    $tab=array("Janvier","Fevrier", "Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");

        for($l=0;$l<=12;$l++)
        {
            switch($mois)
            {       
                case $l :{ 
                    $leMois=$tab[$l-1]; break;}
            }
        }
                    
    return $leMois;
}
?>