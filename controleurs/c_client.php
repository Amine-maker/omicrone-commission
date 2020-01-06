<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'afficherclient';
}
$action = $_REQUEST['action'];

$tabcontrat = new tableauContrat();

switch($action){
	case 'afficherclient':{ 
            include("vues/v_client.php");
            include 'vues/v_ajclient.php';
            break;
	}
        
        case 'addclient':{
            //include 'vues/v_ajclient.php';
            break;
        }
        
        case 'modifclient':{
            $idclient = $_GET['idclient'];
            $lesinfosclient = $client->getinfoclient($idclient);
            var_dump($lesinfosclient);
            foreach ($lesinfosclient as $uneinfo) {
                $raisonsocial = $uneinfo['raisonsocial'];
                $siret = $uneinfo['siret'];
                $adr = $uneinfo['adr'];
                $ville = $uneinfo['ville'];
                $cp = $uneinfo['codepostale'];
                $email = $uneinfo['email1'];
                $email2 = $uneinfo['email2'];
                $email3 = $uneinfo['email3'];
                $bureau = $uneinfo['bureau'];
                $fax = $uneinfo['fax'];
                $tel3 = $uneinfo['tel3'];
            }
            include 'vues/v_modifclient.php';
            break;
        }
        
        case 'validmodifclient':{
            break;
        }
        
        case 'suppclient':{
            $idclient = $_GET['idclient'];
            $client->suppclient($idclient);
            break;
        }
        default :{
            include("vues/v_client.php");
            break;
	}
}