
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="style/style.css"/>
    <script src="https://kit.fontawesome.com/8b3260e825.js" crossorigin="anonymous"></script>

</head>
<body class="content">
<?php
include("vues/v_sommaire.php");
require_once ("modele/include.php");
$contrat = new daoContrat();
$client = new DaoClient();
$contact = new DaoContact();
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

}
?>

