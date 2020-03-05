<?php
if (!isset($_REQUEST['action'])){
	$_REQUEST['action']="afficherConsultant";
}
$action = $_REQUEST['action'];

switch($action){
    case 'afficherConsultant':{
        $lesConsultants = $UconsultantDao->collectionconsultant();
        //var_dump($lesConsultants);
	    include ('vues/v_consultant.php');
	break;
    }

    case 'ajouterconsultant':{
        require_once 'vues/v_ajconsultant.php';
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
        if(isset($_POST['typecontrat'])){$typecontrat = $_POST['typecontrat']; } else {$typecontrat = "";}
        if(isset($_POST['salaire'])){$salaire  = $_POST['salaire']; } else {$salaire  = "";} 
        if(isset($_POST['tarif'])){$tarif  = $_POST['tarif']; } else {$tarif  = "";}  
        
        $objconsultant = new consultant ($nom, $prenom, $adr, $ville, $cp, $tel, $email, $typecontrat, $salaire, $tarif);
        $UconsultantDao->add($objconsultant);
        header('location:index.php?uc=consultant&action=afficherConsultant');
        break;
    }
    case 'modifconsultant':{
        // $idConsultant = $_GET['idconsultant'];
       // $consultant = $consultantDao->getConsultantfromId($idConsultant);

        $lesconsultants=$UconsultantDao->collectionconsultant();
		$_comm=explode(",",$_REQUEST["tableau"]);
		$nom=$_comm[0];
		$prenom=$_comm[1];
		$adresse=$_comm[2];
		$ville=$_comm[3];
		$cp=$_comm[4];
		$tel=$_comm[5];
        $email=$_comm[6];
        $typecontrat=$_comm[7];
        $salaire=$_comm[8];
        $tarif=$_comm[9];
        var_dump($_REQUEST["tableau"]);

        if(empty($cp)){ $cp='0';}
        if(empty($tel)){ $tel='Non renseigné';}
        if(empty($salaire)){$salaire=0;}
        if(empty($tarif)){$tarif=0;}
			$idconsultant=$_REQUEST["idConsultant"];
			$comm=$UconsultantDao->getConsultantfromId($idconsultant);

               // $consultant = new utilisateur( $nom, $prenom, $adresse, $ville, $cp, $tel, $email);
				$consultant = new consultant($nom,$prenom,$adresse,$ville,$cp ,$tel,$email, $typecontrat, $salaire, $tarif);
				$UconsultantDao->update($consultant, $idconsultant);
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
