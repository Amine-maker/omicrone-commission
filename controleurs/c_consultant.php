<?php
if (!isset($_REQUEST['action'])){
	$_REQUEST['action']="afficherConsultant";
}
$action = $_REQUEST['action'];

switch($action){
    case 'afficherConsultant':{
        $lesConsultants = $consultantDao->getCollectionConsultant();
        //print_r($lesConsultants);
	include("vues/v_consultant.php");
	break;
    }
    case 'ajouterconsultant':{
            require_once  'vues/v_ajconsultant.php';
      break;  
    }
    case 'validajoutconsultant':{
        if(isset($_POST['nom'])){$nom = $_POST['nom'];} else {$nom="";}
        if(isset($_POST['prenom'])){$prenom = $_POST['prenom'];}else {$prenom="";}
        if(isset($_POST['adr'])){$adr = $_POST['adr'];}else {$adr="";}
        if(isset($_POST['ville'])){$ville = $_POST['ville'];}else {$ville="";}
        if(isset($_POST['cp'])){$cp = $_POST['cp'];}else {$cp="";}
        if(isset($_POST['tel'])){$tel = $_POST['tel'];}else {$tel="";}
        if(isset($_POST['email'])){$email = $_POST['email'];}else {$email="";}
        
        $objconsultant = new consultant ($nom, $prenom, $adr, $ville, $cp, $tel, $email);
        $consultantDao->add($objconsultant);
        header('location:index.php?uc=consultant&action=afficherConsultant');
        break;
    }
    case 'modifconsultant':{
       // $idConsultant = $_GET['idconsultant'];
       // $consultant = $consultantDao->getConsultantfromId($idConsultant);

       $lesconsultants=$consultantDao->getCollectionConsultant();
		$_comm=explode(",",$_REQUEST["tableau"]);
		$nom=$_comm[0];
		$prenom=$_comm[1];
		$adresse=$_comm[2];
		$ville=$_comm[3];
		$cp=$_comm[4];
		$tel=$_comm[5];
        $email=$_comm[6];
        // var_dump($_REQUEST["tableau"]);

        if(empty($cp)){ $cp='0';}
        if(empty($tel)){ $tel='Non renseigné';}
			$idconsultant=$_REQUEST["idConsultant"];
			$comm=$consultantDao->getConsultantfromId($idconsultant);

				$consultant = new consultant($nom,$prenom,$adresse,$ville,$cp ,$tel,$email);
				$consultantDao->update($consultant,$idconsultant);
                header('location:index.php?uc=consultant&action=afficherConsultant');
        break;
    }
    case 'suppconsultant':{
         $idconsultant = $_GET['idconsultant'];
         $consultantDao->delete($consultantDao->getConsultantfromId($idconsultant));
         header('location:index.php?uc=consultant&action=afficherConsultant');
        break;
    }
}
