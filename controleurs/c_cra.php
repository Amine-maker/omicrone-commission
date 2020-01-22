<?php 
require_once __DIR__ . '/../vendor/autoload.php';

if (!isset($_REQUEST['action'])){
	$_REQUEST['action']=NULL;
}
$action = $_REQUEST['action'];

switch($action){

	case 'choisirCra':{
		$dateMin = date('Y-m', strtotime('-5 month'));
		$dateMax = date('Y-m', strtotime('+1 month'));
		$lesContrats=$contrat->collectioncontrat();
		//print_r($lesContrats);
		include ("vues/v_choixCra.php");

		break;
	}

	case 'afficherCra':{

		$consultant=$contrat->getobjcontrat($_POST["idContrat"])->getcleconsultant();
		$annee=substr($_POST["annee"],0,4);
		$mois=substr($_POST["annee"],5,6);
		$number = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);
		include("vues/v_cra.php");
		break;
	}
	
	case 'update': {
		
		$idConsultant=$_POST["idConsultant"];
		$contrat=$contrat->getobjcontrat($_POST["idContrat"]);
		$consultant=$consultantDao->getConsultantfromId($idConsultant);
		$nomClient=$contrat->getcleclient()->getraisonsocial();
		
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

		 $periode = strtolower(getMoisFr($_POST["mois"]).$_POST["annee"]);
		 echo $periode;
		
		$cra=new cra($TJF,$TJM,$TJC,$_POST["astreinte"],$contrat,$periode);
		
		$craDAO->add($cra);
		
	
		include ("vues/v_PDFcra.php");
		break;
	}
	case 'delete': {
	
	}
}
