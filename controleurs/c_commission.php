<?php 
if (!isset($_REQUEST['action'])){
	$_REQUEST['action']=NULL;
}
$action = $_REQUEST['action'];
$commerciauxDAO=new commerciauxDAO;
$commissionDAO= new commissionDAO;
switch($action){

	case 'ajouterCommission':{
print_r($_POST);
		if(isset($_POST["montant"]) || isset($_POST["valeur"]))
			{
				
			$commission=new commission($commerciauxDAO->getCommercial($_POST["idCommercial"]));
			$commissionDAO->add($commission,$commerciauxDAO);
			}
		break;
	}

	case 'afficherCommission':{
		$lesCommerciaux=$commerciauxDAO->getCommerciaux();
		include("vues/v_tableauCommission.php");
		break;
	}
	
	case 'updateCommission': {
		
		break;
	}
	case 'deleteCommission': {
	
	}
}
