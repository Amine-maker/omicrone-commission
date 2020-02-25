<html lang="fr">
<?php
include("vues/v_entete.php");
 //fichier qui contient l'ensemble des classes 
require_once ("modele/include.php");
$contrat = new daoContrat();
$clientDao = new DaoClient();
$contactDao = new DaoContact();
$factureDao = new FactureDao();
$payerDao = new PayerDao();
$financeDAO = new financeDAO();
$UconsultantDao = new UconsultantDao();
$commerciauxDao=new UcommerciauxDao();
$craDAO = new craDAO();
// coonexion à la base de données avec l'ORM
R::setup('pgsql:host=localhost;dbname=commission','postgres','test'); 
R::freeze(true);

if (!isset($_REQUEST['uc'])) {
    $_REQUEST['uc'] = 'commercial';
}
$uc = $_REQUEST['uc'];
switch ($uc) {
    case 'commercial': {
        include("controleurs/c_commerciaux.php");
        break;
        }
    case 'depense' : {
        include("controleurs/c_depense.php");
        break;
        }
    case 'commission' : {
        include("controleurs/c_commission.php");
        break;
        }
    case 'contrat':{
        include("controleurs/c_contrat.php");
        break;}
    case 'client':{
        include 'controleurs/c_client.php';
        break;
        }
    case 'facture':{
        include 'controleurs/c_facture.php';
        break;}
    case 'consultant':{
        include 'controleurs/c_consultant.php';
        break;}
    case 'cra':{
        include 'controleurs/c_cra.php';}
}
?>

