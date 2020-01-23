<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'afficherclient';
}
$action = $_REQUEST['action'];
switch($action){
	case 'afficherclient':{ 
        $lesclients = $clientDao->listeclient();
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
            if(isset($_POST["regarder"])=="on"){
				$finance=new information_bancaire($objclient,NULL,$_POST["codeAgence"],$_POST["compte"],$_POST["iban"],$_POST["bic"],$_POST["codeBanque"],$_POST["cleRib"]);
				$financeDAO->addfinance($finance, $clientDao);
			}
            header('location:index.php?uc=client&action=afficherclient');
            break;
        }
        
        
        case 'modifclient':{
            //print_r($_REQUEST);
            $_client=explode(",",$_REQUEST["tableau"]);
            $idclient = $_GET['idClient'];
            //var_dump($_client);
            $raisonsocial=$_client[0];
            $siret=$_client[1];
            $adresse=$_client[2];
            $ville=$_client[3];
            $cp=$_client[4];
            $email1=$_client[5];
            $email2=$_client[6];
            $email3=$_client[7];
            $bureau=$_client[8];
            $fax=$_client[9];
            $tel=$_client[10];
            
            $idcontact = $contactDao->getidcontactfromidclient($idclient);
            if(empty($siret)){$siret='12345678910123';}
            if(empty($cp)){$cp='0';}
            if(empty($tel)){$tel='0';}
            if(empty($email2)){$email2='xxx@xxx.xx';}
            if(empty($email3)){$email3='xxx@xxx.xx';}
            if(empty($bureau)){$bureau='0';}
            if(empty($fax)){$fax='0';}  
            $objcontact = new contact ($email1,$email2, $email3, $bureau, $fax, $tel);
            $objclient = new client ($raisonsocial, $objcontact, $siret, $adresse, $ville, $cp);
                    
            
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