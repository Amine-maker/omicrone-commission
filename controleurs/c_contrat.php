<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'affichercontrat';
}
$action = $_REQUEST['action'];
switch($action){
	case 'affichercontrat':{ 
        $lesContrats = $contrat->getlistecontrat();
        $lesClients = $contrat->selectClients();
        $lesConsultants = $contrat->selectConsultants();
        include("vues/v_contrat.php");
           
            break;
	}
        
        case 'ajoutC':{
            $lesClients = $contrat->selectClients();
            $lesConsultants = $contrat->selectConsultants();
            include("vues/v_ajContrat.php");
            break;
        }
        
        case 'validAjoutC':{
            $lesClients = $contrat->selectClients();
            $lesConsultants = $contrat->selectConsultants();
            if(isset($_POST['lesClients'])){$_SESSION['id'] = $_POST['lesClients'];}
            if (isset($_SESSION['id'])) {$idclient = $_SESSION['id'];}
            else {$idclient = "" ;}
            
            if(isset($_POST['lesConsultants'])){$_SESSION['id'] = $_POST['lesConsultants'];}
             if (isset($_SESSION['id'])) {$idconsultant = $_SESSION['id'];}
            else {$idconsultant = "" ;}
            
            if(isset($_POST['datedebut'])){$datedebut = $_POST['datedebut'];}
            else {$datedebut = "";}
            if(isset($_POST['datefin'])){$datefin = $_POST['datefin'];}
            else {$datefin="";}
            if(isset($_POST['mission'])){$mission = $_POST['mission'];}
            else {$mission="";}
            if (isset($_POST['salaire'])){$salaire= $_POST['salaire'];}
            else {$salaire="";}
            if(isset($_POST['tarif'])){$tarif = $_POST['tarif'];}
            else {$tarif="";}
            if(isset($_POST['typecontrat'])){$typecontrat=$_POST['typecontrat'];}
            else {$typecontrat="";}
            
            
            //verifier si les champs sont vide
            if(empty($datedebut) OR empty($datefin)){
                $lesClients = $contrat->selectClients();
                $lesConsultants = $contrat->selectConsultants();
                include("vues/v_ajContrat.php");
            }
            if(empty($salaire)){$salaire=0;}
            if(empty($tarif)){$tarif=0;}
            
            $dernieridcontrat = $contrat->getdernierid();
            $dernieridcontrat++;
            //print_r($dernieridcontrat);
            for ($i=0;$i<=$dernieridcontrat;$i++){
                $objcontrat = new contrat($i, $idclient, $idconsultant, $datedebut, $datefin, $mission, $salaire,  $tarif, $typecontrat);
            }
            if($datefin <= $datedebut){
                header('location:index.php?uc=contrat&action=affichercontrat#open-modal');
            }
            else {
            $ajouter = $contrat->insertcontrat($objcontrat); 
            header('location:index.php?uc=contrat&action=affichercontrat');}
            
            
            break;
        }
        
        case 'modifcontrat' : {
            $lecontrat=explode(",",$_REQUEST["tableau"]);
            $idContrat = $_GET['idcontrat'];
            var_dump($lecontrat);
            $typecontrat = $lecontrat[0];
            $datedebut = $lecontrat[1];
            $datefin = $lecontrat[2];
            $mission = $lecontrat[3];
            $salaire = $lecontrat[4];
            $tarif = $lecontrat[5];

            //if (isset($typecontrat) == 'Salarié'){ echo 'readonly' ; }

            if(empty($salaire)){$salaire='0';}
            if(empty($tarif)){$tarif='0';}                  
            
            $contrat->setcontrat($idContrat, $datedebut, $datefin, $mission, $salaire, $tarif);
            header('location:index.php?uc=contrat&action=affichercontrat');
           break;
        }

        case 'suppcontrat':{
            $lesClients = $contrat->selectClients();
            $idContrat = $_GET['idcontrat'];
            $contrat->suppContrat($idContrat);
            header('location:index.php?uc=contrat&action=affichercontrat');
            break;
        }
	default :{
            include("vues/v_contrat.php");
            break;
	}
}
?>
