<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'afficherfacture';
}
$action = $_REQUEST['action'];

switch($action){
    case 'afficherfacture':{
        $idContrat = $_GET['idcontrat'];
        $UnContrat = $contrat->getobjcontrat($idContrat); //print_r($UnContrat);
        $objclient = new client ($UnContrat->getcleclient()->getraisonsocial(),$UnContrat->getcleclient()->getclecontact() , $UnContrat->getcleclient()->getsiret(),$UnContrat->getcleclient()->getadr(),$UnContrat->getcleclient()->getville(),$UnContrat->getcleclient()->getcp());
        $idclient =  $clientDao->getidclientfromchamps($objclient); 
        //$lescras = $craDAO->collectionCRA();
       
        $nbmois = $contrat->timecontrat($idContrat);
        if ($nbmois == 0 ){
            $nbmois = 1;
        }
        $tauxjm = $craDAO->getJFfromidcontrat($idContrat);
        //print_r($tauxjm);
        if($UnContrat->getsalaire() == 0 && $UnContrat->gettarif() <> 0){
             $montant = $UnContrat->gettarif() * $tauxjm;
        }
        
       // else {
            if($UnContrat->getsalaire() > 0 && $UnContrat->gettarif() > 0){
            $tarif = $UnContrat->gettarif() * $tauxjm;
            $salaire = $UnContrat->getsalaire() * $nbmois;
            $montant = $tarif + $salaire;
            }
            else {
                $montant = $UnContrat->getsalaire() * $nbmois;
                }
        //    }
    
        $date =  date('d/m/Y');
        $objfacture = new facture($date,$montant); //créer un objet
        $factureDao->addfacture($objfacture); //ajouter l'objet facture dans la bdd
        $idfacture = $factureDao->dernieridfacture(); //recupère l'id de l'objet créer précédemment
        //print_r($idfacture);
        $unpaiement = new payer ($idfacture, $idContrat, $idclient); //créer un nouvel objet facture
        $payerDao->addpayer($unpaiement);  //ajoute cette objet dans la bdd
        $Unefacture = $factureDao->getobjectfromid($idfacture); //retourne l'objet facture en fonctiond de son id
        var_dump($Unefacture);
        require_once 'vues/v_facture.php';
        break;
    }
    
    case'genererfacture':{
        break;
    }
}