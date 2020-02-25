<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'afficherfacture';
}
$action = $_REQUEST['action'];

switch($action){

    case 'choixFacture': {
        $idContrat = $_GET['idcontrat'];
        $lecontrat = $contrat->getcontrat($idContrat);
        print_r($lecontrat);
        $lesMois = $factureDao->getdatefacture($idContrat);
        //print_r($lesMois);
        // $lesContrats=$contrat->collectioncontrat(); //renvoie une collection de contrat
        //$lesMois= getdouzeMois(); //alimente la liste deroulante des mois
        include 'vues/v_choixfacture.php';
    break;
    }

    case 'afficherfacture':{
        $idContrat = $_GET['idcontrat']; 
        $leMois = $_POST['mois'];
        $m = substr($leMois, 0,2);
        $a = substr($leMois, 2, 4);

        if ($factureDao->factureexists($idContrat, $leMois) == 0){
            // $lesContrats=$contrat->collectioncontrat(); //renvoie une collection de contrat
            // $lesMois= getdouzeMois(); //alimente la liste deroulante des mois
            $lesMois = $factureDao->getdatefacture($idContrat);
            include 'vues/v_choixfacture.php'; //choix facture
            include 'vues/v_erreurs.php'; //sinon afficher une vue erreur
        }    
            
        else {
            $uncontrat = $contrat->getobjcontrat($idContrat);
            $unefacture = $factureDao->getfacture($leMois, $idContrat, $uncontrat);
            $periode = $unefacture->getclecra()->getPeriode();
            $mois = substr($periode, 0, 2);
            $annee = substr($periode, 2, 4);
            $idfacture = $factureDao->getidfacutrefromcontrat($idContrat);
            $JF = $craDAO->getJFfromidcontrat($idContrat, $leMois);
            require_once 'vues/v_lafacture.php';    
        }    
    break;        
    }
}