<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'affichercontrat';
}
$action = $_REQUEST['action'];
switch($action){
	case 'affichercontrat':{ 
        $lesContrats = $contrat->getlistecontrat();
        $lesClients =$clientDao->selectClients();
        $lesConsultants = $UconsultantDao->getconsultant();
        include("vues/v_contrat.php");
        break;
	}
        
        case 'ajoutC':{
            $lesClients =$clientDao->selectClients();
            $lesConsultants = $UconsultantDao->getconsultant();
            include("vues/v_ajContrat.php");
            break;
        }
        
        case 'validAjoutC':{
            $lesClients =$clientDao->selectClients();
            $lesConsultants = $UconsultantDao->getconsultant();
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
            
            
            //verifier si les champs sont vide
            if(empty($datedebut) OR empty($datefin)){
                $lesClients =$clientDao->selectClients();
                $lesConsultants = $UconsultantDao->getconsultant();
                header('location:index.php?uc=contrat&action=affichercontrat#open-modal');
            }  
            $dernieridcontrat = $contrat->getdernierid();
            $dernieridcontrat++;
            //print_r($dernieridcontrat);
            for ($i=0;$i<=$dernieridcontrat;$i++){
                $objcontrat = new contrat($i, $idclient, $idconsultant, $datedebut, $datefin, $mission);
            }
            if($datefin <= $datedebut){ ?>
               <script>
                   alert ('Date de début ne doit pas excéder la date de fin');
                window.location.href="index.php?uc=contrat&action=affichercontrat#open-modal" </script><?php
            }
             else {
            $contrat->insertcontrat($objcontrat); 
            header('location:index.php?uc=contrat&action=affichercontrat');
         }
            break;
        }
        
        case 'modifcontrat':{
            $lecontrat = explode(",",$_GET["tableau"]);          
            $contrat->setcontrat($_GET["idcontrat"], $lecontrat[0] , $lecontrat[1], $lecontrat[2]);
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
