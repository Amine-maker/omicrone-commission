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

        if($UnContrat->getsalaire() == 0){
             $montant = $UnContrat->gettarif();
        }
        else {
            $montant = $UnContrat->getsalaire();
        }
        $date =  date('d/m/Y');
        $objfacture = new facture($date,$montant); //créer un objet
        $factureDao->addfacture($objfacture); //ajouter l'objet facture dans la bdd
        $idfacture = $factureDao->dernieridfacture(); //recupère l'id de l'objet créer précédemment
        //print_r($idfacture);
        $unpaiement = new payer ($idfacture, $idContrat, $idclient);
        $payerDao->addpayer($unpaiement); 
        $Unefacture = $factureDao->getobjectfromid($idfacture);
        //var_dump($Unefacture);
        require_once 'vues/v_facture.php';
        
        //header('location:index.php?uc=facture&action=creerfacture');
        break;
    }
    
    case 'creerfacture':{
         require_once  __DIR__  .  ' /../vendor/autoload.php ' ;
       
        $mpdf = new \Mpdf\Mpdf();
        
        $pdf = '';
        $pdf .='<h1 style= "color:red">Facture du client</h1>';
        $pdf .='<p>Montant '.$montant ; 

        $mpdf->WriteHTML($pdf);
        $mpdf->Output('lafacture.pdf', 'D');
        // header('location:index.php?uc=facture&action=pdffacture');
        break;
    }
    
    
    
    // case 'pdffacture':{
       
    //     require_once 'vues/v_genererpdf.php';
    // }
}