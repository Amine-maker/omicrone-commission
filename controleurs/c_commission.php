<?php 
if (!isset($_REQUEST['action'])){
	$_REQUEST['action']=NULL;
}
$action = $_REQUEST['action'];
$commissionDAO= new commissionDAO;
switch($action){

	case 'ajouterCommission':{
		print_r($_POST);
		$idContrat=$_POST["idContrat"];
		$commission=new commission($commerciauxDao->getCommercial($_POST["idCommercial"]));
		$commissionDAO->add($commission,$_POST);
		header('location:index.php?uc=commission&action=afficherCommission');
		break;
	}

	case 'afficherCommission':{
		$lesCommerciaux=$commerciauxDao->getCommerciaux();
		$lesCommissions=$commissionDAO->getCommissions();
		$lesContrats=$contrat->collectioncontrat();
		include("vues/v_tableauCommission.php");
		break;
	}
	
	case 'updateCommission': {
		
		$_REQUEST["heri"]=explode(",",$_REQUEST["tableau"]);
		if($_REQUEST["heri"][0]==''){$_REQUEST["heri"][0]="Null";}
		$commercial=$commerciauxDao->getCommercial($_REQUEST["idCommercial"])->getOCommercial();
		if(!stristr($_REQUEST["heri"][0],"Null")){
			$commission=new one_shot($_REQUEST["heri"][0],$commercial);
			$commissionDAO->update($commission,$_REQUEST["idCommission"]);
		}
		else{
			$commission=new pourcentage($_REQUEST["heri"][1],$commercial);
			$commissionDAO->update($commission,$_REQUEST["idCommission"]);
		}
		
		header('location:index.php?uc=commission&action=afficherCommission');
		break;
	}
	case 'deleteCommission': {
		$commissionDAO->delete($_REQUEST["idCommission"]);
		header('location:index.php?uc=commission&action=afficherCommission');
	}
}
