<?php 
if (!isset($_REQUEST['action'])){
	$_REQUEST['action']=NULL;
}
$action = $_REQUEST['action'];
$commerciauxDAO=new commerciauxDAO;
$commissionDAO= new commissionDAO;
switch($action){

	case 'ajouterCommission':{

		$commission=new commission($commerciauxDAO->getCommercial($_POST["idCommercial"]));
		$commissionDAO->add($commission,$commerciauxDAO,$_POST);
		header('location:index.php?uc=commission&action=afficherCommission');
		break;
	}

	case 'afficherCommission':{
		$lesCommerciaux=$commerciauxDAO->getCommerciaux();
		$lesCommissions=$commissionDAO->getCommissions();
		include("vues/v_tableauCommission.php");
		break;
	}
	
	case 'updateCommission': {
		header('location:index.php?uc=commission&action=afficherCommission');
		break;
	}
	case 'deleteCommission': {
		$commissionDAO->delete($_REQUEST["idCommission"]);
		header('location:index.php?uc=commission&action=afficherCommission');
	}
}
