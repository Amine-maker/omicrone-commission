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
	
	case 'createCRA': {
		
		$idConsultant=$_POST["idConsultant"];
		$lecontrat=$contrat->getobjcontrat($_POST["idContrat"]);
		$consultant=$UconsultantDao->getConsultantfromId($idConsultant);
		$nomClient=$lecontrat->getcleclient()->getraisonsocial();
		
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


		echo "tjf : ".$TJF." tjm : ".$TJM." tjc : ".$TJC." ";

		 $periode = strtolower($_POST["mois"].$_POST["annee"]);
		 echo $periode;
		 $interv = $_POST['interv'];
		
		$cra=new cra($TJF,$TJM,$TJC,$_POST["astreinte"],$lecontrat,$periode,$interv);
		$chemin = ('CRA/CRA_'.getMoisFr($_POST["mois"]).'_'.$_POST["annee"].'.pdf');// chemin ou stocker le fichier du CRA
		$craDAO->add($cra);
		$craDAO->insererCra($cra,$chemin);
				
		//création de la facture pour le mois donné

		if ($factureDao->factureexists($_POST["idContrat"],$periode) == 0){
			$idcra = $craDAO->idcrafromobject($cra);
			$objclient = new client ($lecontrat->getcleclient()->getraisonsocial(),$lecontrat->getcleclient()->getclecontact() , $lecontrat->getcleclient()->getsiret(),$lecontrat->getcleclient()->getadr(),$lecontrat->getcleclient()->getville(),$lecontrat->getcleclient()->getcp());
			$idclient =  $clientDao->getidclientfromchamps($objclient);
			
			//retoune le nb jour facturable
			$JF = $craDAO->getJFfromidcontrat($_POST["idContrat"], $periode);

			//définir la valeur du montant
			if($lecontrat->getcleconsultant()->getsalaire() == 0){
				$montant = $lecontrat->getcleconsultant()->gettarif() * $JF;}
			else {
				$montant = $lecontrat->getcleconsultant()->getsalaire();
					if($lecontrat->getcleconsultant()->getsalaire() > 0 && $lecontrat->getcleconsultant()->gettarif() > 0){
						$tarif = $lecontrat->getcleconsultant()->gettarif() * $JF;
						$salaire = $lecontrat->getcleconsultant()->getsalaire();
						$montant = $tarif + $salaire;
					}
				}
			$libelle = $lecontrat->getmission();
			$datef = date('Y-m-d');
			$objfacture = new facture($libelle, $idcra,$montant, $datef); //créer un objet
			$factureDao->addfacture($objfacture); //ajouter l'objet facture dans la bdd
			$idfacture = $factureDao->dernieridfacture(); //recupère l'id de l'objet créer précédemment
			$unpaiement = new payer ($idfacture, $_POST["idContrat"], $idclient); //créer un nouvel objet facture
			$payerDao->addpayer($unpaiement);  //ajoute cette objet dans la bdd
			$Unefacture = $factureDao->getobjectfromid($idfacture); //retourne l'objet facture en fonctiond de son id	
		}	
		include ("vues/v_PDFcra.php");
		break;
	}


	case 'crasConsultant':{
		$idconsultant  = $_GET['idconsultant'];
		$lesMois = $craDAO->crasConsultants($idconsultant);
		//print_r($lesMois);
		include 'vues/v_lescras.php';
	break;
	}

	case 'afficherCraChoisis': {

		$chemin = $craDAO->cheminCra($_POST["mois"], $_GET['idconsultant']);
		include ('vues/v_chemin.php');
	}
}
