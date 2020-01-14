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
				$finance=new information_bancaire(NULL,$commercial,$_POST["codeAgence"],$_POST["compte"],$_POST["iban"],$_POST["bic"],$_POST["codeBanque"],$_POST["cleRib"]);
				$financeDAO->add($finance,$commerciauxDao);
			}
		}
	header('location:index.php?uc=commercial&action=afficherTableau');
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
		$_comm=explode(",",$_REQUEST["tableau"]);
		$nom=$_comm[0];
		$prenom=$_comm[1];
		$tel=$_comm[2];
		$email=$_comm[3];
		$adresse=$_comm[4];
		$ville=$_comm[5];
		$cp=$_comm[6];

			$idCommercial=$_REQUEST["idCommercial"];
			$idFinance=$financeDAO->getIdFinanceById($idCommercial);
			$comm=$commerciauxDao->getCommercial($idCommercial);

				$idFinance=$financeDAO->getIdFinanceById($_REQUEST["idCommercial"]);

				$commercial = new commerciaux($nom,$prenom,$tel, $email,$adresse,$ville,$cp);
				//$finance= new information_bancaire(NULL,$commercial,$_POST["codeAgence"],$_POST["compte"],$_POST["iban"],$_POST["bic"],$_POST["codeBanque"],$_POST["cleRib"]);
				$commerciauxDao->update($commercial,$_REQUEST["idCommercial"]);
				//$financeDAO->update($finance,$idFinance,$_REQUEST["idCommercial"]);
				header('location:index.php?uc=commercial&action=afficherTableau');
			

		//include("vues/v_modifCommercial.php");
		break;
	}
	case 'deleteCommercial': {
		$idFinance=$financeDAO->getIdFinanceById($_REQUEST["idCommercial"]);
			if(gettype($idFinance) == 'integer' || $idFinance == '1'){
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