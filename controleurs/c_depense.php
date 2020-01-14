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
            $depenseDao->add($depense);
            
			}
			header('location:index.php?uc=depense&action=afficherDepense');
		break;
	}

	case 'afficherDepense':{
        $lesDepenses = $depenseDao->getDepenses();
		
		include("vues/v_tableauDepenses.php");
		break;
	}
	
	case 'updateDepense': {
		$_REQUEST["tab"]=explode(",",$_REQUEST["tableau"]);
		$montant=$_REQUEST["tab"][0];
		$libelle=$_REQUEST["tab"][1];
		$lesDepenses = $depenseDao->getDepenses();
		$depense=$depenseDao->getDepense($_REQUEST["idDepense"]);
			
				$depense=new depense($montant,$libelle);
				$depenseDao->update($depense,$_REQUEST["idDepense"]);
				
				header('location:index.php?uc=depense&action=afficherDepense');
			
		break;
	}
	case 'deleteDepense': {

	$depenseDao->delete($depenseDao->getDepense($_REQUEST["idDepense"]));
	header('location: index.php?uc=depense&action=afficherDepense');

	}
}
