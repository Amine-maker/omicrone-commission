<?php
if (!isset($_REQUEST['action'])){
	$_REQUEST['action']="afficherConsultant";
}
$action = $_REQUEST['action'];
$consultantDao = new consultantDao();
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
        $idConsultant = $_GET['idconsultant'];
        $consultant = $consultantDao->getConsultantfromId($idConsultant);
        include 'vues/v_modifconsultant.php';
        break;
    }
    case 'validmodif':{
        $idconsultant = $_GET['idconsultant'];
        $modifobjet = new consultant ($_POST['nom'], $_POST['prenom'], $_POST['adr'], $_POST['ville'], $_POST['cp'], $_POST['tel'], $_POST['email']);
        $consultantDao->update($modifobjet, $idconsultant);
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
