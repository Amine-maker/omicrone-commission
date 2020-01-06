<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'affichercontrat';
}
$action = $_REQUEST['action'];

if(isset($_POST['lesClients'])){
$_SESSION['idclient'] = $_POST['lesClients'];}

$tabcontrat = new tableauContrat();

switch($action){
	case 'affichercontrat':{ 
        $lesClients = $contrat->selectClients();
        //include('vues/v_ajContrat.php');
        include("vues/v_contrat.php");
           
            break;
	}
        
        case 'ajoutC':{
            $lesClients = $contrat->selectClients();
            include("vues/v_ajContrat.php");
            break;
        }
        
        case 'validAjoutC':{
            if(isset($_POST['lesClients'])){$_SESSION['idclient'] = $_POST['lesClients'];}
            if (isset($_SESSION['idclient'])) {$idclient = $_SESSION['idclient'];}
            else {$idclient = "" ;}
            if(isset($_REQUEST['datedebut'])){$datedebut = $_REQUEST['datedebut'];}
            else {$datedebut = "";}
            if(isset($_REQUEST['datefin'])){$datefin = $_REQUEST['datefin'];}
            else {$datefin="";}
            if (isset($_REQUEST['salaire'])){$salaire= $_REQUEST['salaire'];}
            else {$salaire="";}
            if(isset($_REQUEST['tarif'])){$tarif = $_REQUEST['tarif'];}
            else {$tarif="";}
            if(isset($_REQUEST['typecontrat'])){$typecontrat=$_REQUEST['typecontrat'];}
            else {$typecontrat="";}
            
            //verifier si les champs sont vide
            if(empty($datedebut) OR empty($datefin)){
                $lesClients = $contrat->selectClients();
                include("vues/v_ajContrat.php");
            }
            if(empty($salaire)){$salaire=0;}
            if(empty($tarif)){$tarif=0;}
            
            //$tabcontrat = new tableauContrat();
            $dernieridcontrat = $contrat->getdernierid();
            $dernieridcontrat++;
            //var_dump($dernieridcontrat);
            for ($i=0;$i<=$dernieridcontrat;$i++){
                //var_dump($i);
                $objcontrat = new contrat($i, $idclient, $datedebut, $datefin, $salaire,  $tarif, $typecontrat);
                //$tabcontrat->addContrat($objcontrat);
                //var_dump($tabcontrat);
            }
            $ajouter = $contrat->insertcontrat($objcontrat);

                include 'vues/v_contrat.php';
            
            //var_dump($objcontrat);
            break;
        }
        
        case 'modifC':{
            $idContrat = $_GET['idcontrat'];
            $lesClients = $contrat->selectClients();
            $lesmodifcontrats = $contrat->getnfocontratModif($idContrat);
            //var_dump($lesmodifcontrats);
            foreach($lesmodifcontrats as $modifContrat){
            $idduclient = $modifContrat['idclient'];
            $datedebut = $modifContrat['datedebut'];
            $datefin = $modifContrat['datefin'];
            $salaire = $modifContrat['salaire'];
            $tarif = $modifContrat['tarif'];
            $laraisonsocial = $modifContrat['raisonsocial'];
            $typecontrat = $modifContrat['typecontrat'];
            }
            include("vues/v_modifcontrat.php");
            break;            
        }
        
        case 'validmodifcontrat':{
            $idContrat = $_GET['idcontrat'];
            if(isset($_POST['ModiflesClients'])){
                $_SESSION['idclient'] = $_POST['ModiflesClients'];
            }
            if (isset($_SESSION['idclient'])) {$idclient = $_SESSION['idclient'];}
            else {$idclient = "" ;}
            if(isset($_REQUEST['datedebut'])){$datedebut = $_REQUEST['datedebut'];}
            else {$datedebut = "";}
            if(isset($_REQUEST['datefin'])){$datefin = $_REQUEST['datefin'];}
            else {$datefin="";}
            if (isset($_REQUEST['salaire'])){$salaire= $_REQUEST['salaire'];}
            else {$salaire="";}
            if(isset($_REQUEST['tarif'])){$tarif = $_REQUEST['tarif'];}
            else {$tarif="";}
            if(isset($_REQUEST['typecontrat'])){$typecontrat=$_REQUEST['typecontrat'];}
            else {$typecontrat="";}
            
            if(empty($datedebut) OR empty($datefin)){
                $lesClients = $contrat->selectClients();
                include("vues/v_modifcontrat.php");
            }
            if(empty($salaire)){$salaire=0;}
            if(empty($tarif)){$tarif=0;}
            
            $modif = $contrat->setcontrat($idContrat, $idclient, $datedebut, $datefin, $salaire, $tarif, $typecontrat);
            if(!$modif == TRUE){
                include 'vues/v_contrat.php';
            }
            break;
        }
        case 'suppcontrat':{
            $lesClients = $contrat->selectClients();
            $idContrat = $_GET['idcontrat'];
            $contrat->suppContrat($idContrat);
             include 'vues/v_contrat.php';
            break;
        }
	default :{
            include("vues/v_contrat.php");
            break;
	}
}
?>
