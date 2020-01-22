<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'afficherfacture';
}
$action = $_REQUEST['action'];

switch($action){
    case 'creerfacture':{
        $idContrat = $_GET['idcontrat'];
        $UnContrat = $contrat->getobjcontrat($idContrat);
        $objclient = new client ($UnContrat->getcleclient()->getraisonsocial(),$UnContrat->getcleclient()->getclecontact() , $UnContrat->getcleclient()->getsiret(),$UnContrat->getcleclient()->getadr(),$UnContrat->getcleclient()->getville(),$UnContrat->getcleclient()->getcp());
        $idclient =  $clientDao->getidclientfromchamps($objclient); 

        if ($factureDao->factureexists($idContrat) == 1){
            $lafacture = $factureDao->getobjetfacturefromcontrat($idContrat);
            $dateX = $lafacture->getdatef();
            $montantX = $lafacture->getmontant();
            $montantTvaX = $lafacture->MontantAvecTVA();
            $idexistant = $factureDao->getidfacutrefromcontrat($idContrat);
            $Unefacture = $factureDao->getobjectfromid($idexistant);

            $nbmois = $contrat->timecontrat($idContrat);
                if ($nbmois == 0 ){
                    $nbmois = 1;
                }
    
                $JF = $craDAO->getJFfromidcontrat($idContrat);
    
                if($UnContrat->getsalaire() == 0){
                    $montant = $UnContrat->gettarif() * $JF;
                }
                
                else {
                    $montant = $UnContrat->getsalaire() * $nbmois;
                        if($UnContrat->getsalaire() > 0 && $UnContrat->gettarif() > 0){
                        $tarif = $UnContrat->gettarif() * $JF;
                        $salaire = $UnContrat->getsalaire() * $nbmois;
                        $montant = $tarif + $salaire;
                        }
                }
        }
        else {

            $nbmois = $contrat->timecontrat($idContrat);
            if ($nbmois == 0 ){
                $nbmois = 1;
            }

            $JF = $craDAO->getJFfromidcontrat($idContrat);
            
            if($UnContrat->getsalaire() == 0){
                $montant = $UnContrat->gettarif() * $JF;
            }
            
            else {
                $montant = $UnContrat->getsalaire() * $nbmois;
                if($UnContrat->getsalaire() > 0 && $UnContrat->gettarif() > 0){
                $tarif = $UnContrat->gettarif() * $JF;
                $salaire = $UnContrat->getsalaire() * $nbmois;
                $montant = $tarif + $salaire;
                }
             }
            $date = date('Y-m-d');
            $objfacture = new facture($date,$montant); //créer un objet
            $factureDao->addfacture($objfacture); //ajouter l'objet facture dans la bdd
            $idfacture = $factureDao->dernieridfacture(); //recupère l'id de l'objet créer précédemment
            $unpaiement = new payer ($idfacture, $idContrat, $idclient); //créer un nouvel objet facture
            $payerDao->addpayer($unpaiement);  //ajoute cette objet dans la bdd
            $Unefacture = $factureDao->getobjectfromid($idfacture); //retourne l'objet facture en fonctiond de son id
        }
        require_once 'vues/v_facture.php';
        break;
    }
}