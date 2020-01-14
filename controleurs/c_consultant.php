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
      break;  
    }
}
