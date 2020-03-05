<?php

class craDAO{

    public function add($cra){
        $TJF=$cra->getJF();
        $TJC=$cra->getJC();
        $TJM=$cra->getJM();
        $astreinte=$cra->getAstreinte();
        $id=$cra->getOContrat()->getidContrat();
        $periode=$cra->getPeriode();
        $interv = $cra->getInterv();

        $cra=r::dispense('cra');
        $cra->totaljfacturable=$TJF;
        $cra->totaljmaladie=$TJM;
        $cra->totaljconge=$TJC;
        $cra->astreinte=$astreinte;
        $cra->idcontrat=$id;
        $cra->periode = $periode;
        $cra->intervention = $interv;
        r::store($cra);
    }

    public function collectionCRA(){
        $collection = array();
        $lesCras= r::getAll('select consultant.idutilisateur as idconsultant, utilisateur.nom as nom, utilisateur.prenom as prenom, utilisateur.adresse as adrcons, utilisateur.ville as villecons, utilisateur.cp as cp, utilisateur.tel as tel, utilisateur.email as email, consultant.typecontrat as typecontrat, consultant.salaire as salaire, consultant.tarif as tarif,
        contrat.id as idcontrat, datedebut, datefin, mission,
        client.id as idclient, idcontact, raisonsocial, siret, client.adr as clientadr, client.ville as clientville, codepostal,
        cra.id as idcra, totaljfacturable, totaljmaladie, totaljconge, astreinte, periode, intervention,
        contact.id as idcontact, email1, email2, email3, bureau, fax, tel3
               from utilisateur, consultant, contrat, client, cra, contact where
               utilisateur.id=consultant.idutilisateur and
               contact.id=client.idcontact and
               client.id=contrat.idclient and
               consultant.idutilisateur=contrat.idutilisateur and
               cra.idcontrat=contrat.id');
        for ($i=0; $i<=count($lesCras)-1; $i++) {
                $objcontact = new contact ($lesCras[$i]['email1'],$lesCras[$i]['email2'],$lesCras[$i]['email3'],$lesCras[$i]['bureau'],$lesCras[$i]['fax'],$lesCras[$i]['tel']);
                $objclient = new client ($lesCras[$i]['raisonsocial'], $objcontact, $lesCras[$i]['siret'], $lesCras[$i]['clientadr'], $lesCras[$i]['clientville'], $lesCras[$i]['codepostal']);
                $objconsultant = new consultant ($lesCras[$i]['nom'], $lesCras[$i]['prenom'], $lesCras[$i]['adresse'], $lesCras[$i]['ville'], $lesCras[$i]['cp'], $lesCras[$i]['tel'], $lesCras[$i]['email'], $lesCras[$i]['typecontrat'], $lesCras[$i]['salaire'], $lesCras[$i]['tarif']);
                $objcontrat = new contrat($lesCras[$i]['idcontrat'], $objclient, $objconsultant, $lesCras[$i]['datedebut'],$lesCras[$i]['datefin'], $lesCras[$i]['mission'],$lesCras[$i]['salaire'], $lesCras[$i]['tarif'], $lesCras[$i]['typecontrat']);
                $objcra = new cra ($lesCras[$i]['totaljfacturable'], $lesCras[$i]['totaljmaladie'],$lesCras[$i]['totaljconge'], $objcontrat, $lesCras[$i]['astreinte'], $lesCras[$i]['periode'], $lesCras[$i]['intervention']);
                $collection[]=$objcra;
            } 
            return $collection;
    }
    public function idcrafromobject($cra){ //recupere l'id du cra en fonction de l'objet
        $consultantDao = new consultantDao();

        $TJF= $cra->getJF();
        $TJM= $cra->getJM();
        $TJC= $cra->getJC();
        $astreinte = $cra->getAstreinte();
        $idcontrat = $cra->getOContrat()->getidContrat();
        $periode = $cra->getPeriode();
        $interv = $cra->getInterv();
            
        $idcra=r::find("cra", "totaljfacturable = ? and totaljmaladie = ? and totaljconge = ? and astreinte = ? and idcontrat = ? and periode = ? and intervention = ?",
        array($TJF, $TJM, $TJC, $astreinte, $idcontrat,  $periode, $interv));

        foreach($idcra as $unidcra){
            return($unidcra->id);
        }
    }

    public function getcraformid($idcra){ //retourne un objet cra en fonction de son id 
        $uncra = R::load('cra',$idcra);
        $idcontrat = $uncra->idcontrat;
        $uncontrat = R::load('contrat', $idcontrat); 
        $idclient = $uncontrat->idclient;
        $client = R::load('client', $idclient);
        $idcontact = $client->idcontact;
        $contact = r::load('contact', $idcontact);
        $uncontact = new contact ($contact->email1, $contact->email2, $contact->email3, $contact->bureau, $contact->fax, $contact->tel3);
        $idconsultant = $uncontrat->idconsultant;
        $unclient =  new client($client->raisonsocial, $uncontact, $client->siret, $client->adr, $client->ville, $client->codepostal);
        // $consultant = R::load('consultant', $idconsultant);
        // $unconsultant = new consultant ($consultant->nom ,$consultant->prenom ,$consultant->adr ,$consultant->ville, $consultant->cp, $consultant->tel, $consultant->email);
        $consultant = r::getAll('select * from utilisateur join consultant on utilisateur.id=consultant.idutilisateur where idutilisateur='.$idconsultant.'');
        for ($i=0; $i<count($consultant);$i++){
            $unconsultant = new consultant ($consultant[$i]['nom'], $consultant[$i]['prenom'], $consultant[$i]['adresse'], $consultant[$i]['ville'], $consultant[$i]['cp'], $consultant[$i]['tel'], $consultant[$i]['email'], $consultant[$i]['typecontrat'], $consultant[$i]['salaire'], $consultant[$i]['tarif']);
        }
        $contrat = new contrat($uncontrat->id, $unclient, $unconsultant, $uncontrat->datedebut,$uncontrat->datefin, $uncontrat->mission, $uncontrat->salaire, $uncontrat->tarif, $uncontrat->typecontrat);
        
        $cra = new cra ($uncra->totaljfacturable, $uncra->totaljmaladie, $uncra->totaljconge, $uncra->astreinte, $contrat, $uncra->periode, $uncra->intervention);
         return $cra;
    }

    public function getJFfromidcontrat($idcontrat, $mois){ 
        $lesJF = r::getAll("select totaljfacturable as jf from cra where idcontrat='$idcontrat' and periode='$mois'");
        print_r($lesJF);
        return $lesJF[0]['jf'];
    }

    public function crasConsultants($idconsultant){
        $tabcras = array();
        $lescras = r::getAll("select distinct periode from cra join contrat on cra.idcontrat=contrat.id join utilisateur on contrat.idutilisateur=utilisateur.id join consultant on utilisateur.id=consultant.idutilisateur where consultant.idutilisateur=$idconsultant");
        for($i=0; $i<sizeof($lescras);$i++){
           $unedate= $lescras[$i]['periode'];
           $tabcras[] = $unedate;
        }
        return $tabcras;
    }

    public function insererCra($cra,$filePath){
        $id = $this->idcrafromobject($cra);
        $cra = r::load('cra',$id);
        $cra->chemin = $filePath;
        r::store($cra);
    }

    public function cheminCra($periode, $idconsultant){
       $chemin =  r::getAll("select distinct chemin from cra join contrat on cra.idcontrat = contrat.id join utilisateur on contrat.idutilisateur = utilisateur.id join consultant on utilisateur.id = consultant.idutilisateur where periode = '$periode' and consultant.idutilisateur = $idconsultant ");
        return $chemin[0]["chemin"];
    }
}


?>