<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'afficherfacture';
}
$action = $_REQUEST['action'];

switch($action){
    case 'afficherfacture':{
        $idContrat = $_GET['idcontrat'];
        $UnContrat = $contrat->getobjcontrat($idContrat);
        //print_r($UnContrat);
        require_once 'vues/v_facture.php';
        break;
    }
    
    case'genererfacture':{
        break;
    }
}