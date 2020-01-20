<?php 
require_once __DIR__ . '/../vendor/autoload.php';

if (!isset($_REQUEST['action'])){
	$_REQUEST['action']=NULL;
}
$action = $_REQUEST['action'];
$craDAO=new craDAO();
$contratdao=new daoContrat;
switch($action){

	case 'choisirCra':{
		$dateMin = date('Y-m', strtotime('-5 month'));
		$dateMax = date('Y-m', strtotime('+1 month'));
		$lesContrats=$contratdao->collectioncontrat();
		include ("vues/v_choixCra.php");

		break;
	}

	case 'afficherCra':{

		$consultant=$consultantDAO->getConsultantfromId($_POST["idConsultant"]);
		$annee=substr($_POST["annee"],0,4);
		$mois=substr($_POST["annee"],5,6);
		$number = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);
		include("vues/v_cra.php");
		break;
	}
	
	case 'update': {
		$idConsultant=$_POST["idConsultant"];
		$consultant=$consultantDAO->getConsultantfromId($idConsultant);
		
		$TJF=0;
		$TJM=0;
		$TJC=0;

		
		foreach($_POST["facturable"] as $nb){
			$TJF=$TJF+$nb;
		}
	
		foreach($_POST["maladie"] as $nb){
			$TJM=$TJM+$nb;
		}
		
		foreach($_POST["conger"] as $nb){
			$TJC=$TJC+$nb;
		}


		echo "tjf : ".$TJF." tjm : ".$TJM." tjc : ".$TJC;


		
		$cra=new cra($TJF,$TJM,$TJC,$_POST["astreinte"]);
		$craDAO->add($cra);
		
	
		include ("vues/v_PDFcra.php");
		break;
	}
	case 'delete': {
	
	}
}
