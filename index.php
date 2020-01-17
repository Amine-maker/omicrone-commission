
<html lang="fr">
<?php
include("vues/v_entete.php");
require_once ("modele/include.php");
$contrat = new daoContrat();
$clientDao = new DaoClient();
$contactDao = new DaoContact();
R::setup('pgsql:host=localhost;dbname=comm','postgres','test');
R::freeze(true);
session_start();


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
        break;
	}
    case 'client':{
        include 'controleurs/c_client.php';
        break;
        }
    case 'paiement':{
        include 'controleurs/c_paiement.php';
        break;
    }
    case 'facture':{
        include 'controleurs/c_facture.php';
        break;
    }
    case 'consultant':{
        include 'controleurs/c_consultant.php';
        break;
    }
    case 'cra':{
        include 'controleurs/c_cra.php';
    }
}
?>

