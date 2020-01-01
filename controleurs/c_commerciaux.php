<?php 
if (!isset($_REQUEST['action'])){
	$_REQUEST['action']="ajouterCommercial";
}
$action = $_REQUEST['action'];
$commerciauxDao=new commerciauxDAO();
$financeDAO = new financeDAO();
switch($action){

	case 'ajouterCommercial':{

        if(isset($_POST["envoyer"])){

            $commercial = new commerciaux($_POST["nom"],$_POST["prenom"],$_POST["tel"], $_POST["email"],$_POST["adresse"],$_POST["ville"],$_POST["cp"]);
			$commerciauxDao->add($commercial);

			if(isset($_POST["regarder"])=="on"){
				$finance=new finance(NULL,$commercial,$_POST["codeAgence"],$_POST["compte"],$_POST["iban"],$_POST["bic"],$_POST["codeBanque"],$_POST["cleRib"]);
				$financeDAO->add($finance,$commerciauxDao);
			}
		}
		include ("vues/v_ajouterCommercial.php");
		break;
	}

	case 'afficherTableau':{
		$lesFinance=$financeDAO->getFinances();
		$lesCommerciaux=$commerciauxDao->getCommerciaux();
		include("vues/v_tableauCommercial.php");
		break;
	}

	case 'modifCommercial':{
		$lesCommerciaux=$commerciauxDao->getCommerciaux();

			$idCommercial=$_REQUEST["idCommercial"];
			$idFinance=$financeDAO->getIdFinanceById($idCommercial);
			$comm=$commerciauxDao->getCommercial($idCommercial);

			if(isset($_POST["modifier"])){
				$idFinance=$financeDAO->getIdFinanceById($_REQUEST["idCommercial"]);
		
				$commercial = new commerciaux($_POST["nom"],$_POST["prenom"],$_POST["tel"], $_POST["email"],$_POST["adresse"],$_POST["ville"],$_POST["cp"]);
				$finance= new finance(NULL,$commercial,$_POST["codeAgence"],$_POST["compte"],$_POST["iban"],$_POST["bic"],$_POST["codeBanque"],$_POST["cleRib"]);
				$commerciauxDao->update($commercial,$_REQUEST["idCommercial"]);
				$financeDAO->update($finance,$idFinance,$_REQUEST["idCommercial"]);
				include("vues/v_confirmation.php");
			}

		include("vues/v_modifCommercial.php");
		break;
	}
	case 'deleteCommercial': {
		$idFinance=$financeDAO->getIdFinanceById($_REQUEST["idCommercial"]);
			if(gettype($idFinance) == 'integer'){
				$financeDAO->delete($financeDAO->getFinance($idFinance));
			}
		$lesCommerciaux=$commerciauxDao->getCommerciaux();

		foreach($lesCommerciaux as $unCommercial)
		{
			if($commerciauxDao->getIdCommercial($unCommercial)==$_REQUEST["idCommercial"])
				{
					$commerciauxDao->delete($unCommercial);
				}
		}

		header('location:index.php?uc=commercial&action=afficherTableau');
	}
}
?>