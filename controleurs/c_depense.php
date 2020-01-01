<?php 
if (!isset($_REQUEST['action'])){
	$_REQUEST['action']=NULL;
}
$action = $_REQUEST['action'];
$depenseDao=new depenseDAO();

switch($action){

	case 'ajouterDepense':{

        if(isset($_POST["envoyer"])){
            $depense= new depense($_POST["montant"],$_POST["libelle"]);
            $depenseDao->ajouterDepense($depense);
            
            }
		include ("vues/v_ajouterDepense.php");
		break;
	}

	case 'afficherDepense':{
        $lesDepenses = $depenseDao->getDepenses();
		
		include("vues/v_tableauDepenses.php");
		break;
	}
	
	case 'modifierDepense': {
		$lesDepenses = $depenseDao->getDepenses();
		$depense=$depenseDao->getDepense($_REQUEST["idDepense"]);
			if (isset($_POST["modifier"])) {
				$depense=new depense($_POST["montant"],$_POST["libelle"]);
				$depenseDao->update($depense,$_POST["idDepense"]);
				include("vues/v_confirmation.php");
			}
		include('vues/v_modifDepense.php');
		break;
	}
	case 'deleteDepense': {

	$depenseDao->delete($depenseDao->getDepense($_REQUEST["idDepense"]));
	header('location: index.php?uc=depense&action=afficherDepense');

	}
}
