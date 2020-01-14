<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'afficherclient';
}
$action = $_REQUEST['action'];
switch($action){
	case 'afficherclient':{ 
//            echo $contactDao->getidcontactfromidclient(21);
//            print_r($objcontact = $contactDao->getobjetcontact($contactDao->getidcontactfromidclient(21)));
//            $contactDao->suppcontact($objcontact);
            //$lesClients = $clientDao->collectionclient();
            include("vues/v_client.php");
            break;
	}
        
        case 'ajclient':{
            include 'vues/v_ajclient.php';
            break;
        }
        
        case 'addclient':{
            if(isset($_POST['email'])){$email = $_POST['email'];}else {$email="";}
            if(isset($_POST['email2'])){$email2 = $_POST['email2'];}else {$email2="";}
            if(isset($_POST['email3'])){$email3 = $_POST['email3'];}else {$email3="";}
            if(isset($_POST['bureau'])){$bureau = $_POST['bureau'];}else {$bureau="";}
            if(isset($_POST['fax'])){$fax = $_POST['fax'];} else {$fax="";}
            if(isset($_POST['tel3'])){$tel3 = $_POST['tel3'];}else {$tel3="";}
            if(isset($_POST['rsl'])){$raisonsocial = $_POST['rsl'];}else {$raisonsocial="";}
            if(isset($_POST['siret'])){$siret = $_POST['siret'];}else {$siret="";}
            if(isset($_POST['adr'])){$adr = $_POST['adr'];}else {$adr="";}
            if(isset($_POST['ville'])){$ville = $_POST['ville'];}else {$ville="";}
            if(isset($_POST['cp'])){$cp = $_POST['cp'];}else {$cp="";}
            
            if( empty($email2) OR empty($email3) OR empty($bureau) OR empty($fax)){
                $email2='xxx@xxx.xx';
                $email3='xxx@xxx.xx';
                $bureau='0000000000';
                $fax='0000000000';
            }
            
            $objcontact = new contact($email, $email2, $email3, $bureau, $fax, $tel3);
            $objclient = new client($raisonsocial, $objcontact, $siret, $adr, $ville, $cp);
            $clientDao->ajouterclient($objclient,$contactDao);
            header('location:index.php?uc=client&action=afficherclient');
            break;
        }
        
        case 'modifclient':{
            $idclient = $_GET['idclient'];
            $lesinfosclient = $clientDao->getinfoclient($idclient);
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
            $idclient = $_GET['idclient'];
            $idcontact = $contactDao->getidcontactfromidclient($idclient);
            if( empty($_POST['email2'])){echo $_POST['email2']='xxx@xxx.xx';}
             if(empty($_POST['email3'])){echo $_POST['email3']='xxx@xxx.xx';}
             if(empty($_POST['bureau'])){echo $_POST['bureau']='0000000000';}
             if(empty($_POST['fax'])){ echo $_POST['fax']='0000000000';}  
            $objcontact = new contact ($_POST['email'],$_POST['email2'], $_POST['email3'], $_POST['bureau'], $_POST['fax'], $_POST['tel3']);
            $objclient = new client($_POST['rsl'], $objcontact, $_POST['siret'], $_POST['adr'], $_POST['ville'], $_POST['cp']);
                          
            $contactDao->setcontact($objcontact, $idcontact);
            $clientDao->setclient($objclient, $idclient, $idcontact);
            header('location:index.php?uc=client&action=afficherclient');
            break;
        }
        
        case 'suppclient':{            
            $objclient = $clientDao->getclient($_GET['idclient']);
            $idcontact = $contactDao->getidcontactfromidclient($_GET['idclient']);
            $clientDao->suppclient($objclient);
            $objcontact = $contactDao->getobjetcontact($idcontact);
             $contactDao->suppcontact($objcontact);
            header('location:index.php?uc=client&action=afficherclient');
            break;
        }
        default :{
            include("vues/v_client.php");
            break;
	}
}