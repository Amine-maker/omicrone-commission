<?php

class craDAO{

    public function add($cra){
        $TJF=$cra->getJF();
        $TJC=$cra->getJC();
        $TJM=$cra->getJM();
        $astreinte=$cra->getAstreinte();
        $id=$cra->getOContrat()->getidContrat();
        $periode=$cra->getPeriode();

        $cra=r::dispense('cra');
        $cra->totaljfacturable=$TJF;
        $cra->totaljmaladie=$TJM;
        $cra->totaljconge=$TJC;
        $cra->astreinte=$astreinte;
        $cra->idcontrat=$id;
        $cra->periode = $periode;
        r::store($cra);
    }

    public function collectionCRA(){
        $collection = array();
        $lesCras= r::getAll('select consultant.id as idconsultant, nom, prenom, consultant.adr as adrcons, consultant.ville as villecons, cp, tel, email, contrat.id as idcontrat, datedebut, datefin, salaire, tarif, typecontrat, mission, client.id as idclient, idcontact, raisonsocial, siret, client.adr as clientadr, client.ville as clientville, codepostale, cra.id as idcra, totaljfacturable, totaljmaladie, totaljconge, astreinte, periode, contact.id as idcontact, email1, email2, email3, bureau, fax, tel
        from consultant, contrat, client, cra, contact where
        contact.id=client.idcontact and
        client.id=contrat.idclient and
        consultant.id=contrat.idconsultant and
        cra.idcontrat=contrat.id');
        for ($i=0; $i<=count($lesCras)-1; $i++) {
                $objcontact = new contact ($lesCras[$i]['email1'],$lesCras[$i]['email2'],$lesCras[$i]['email3'],$lesCras[$i]['bureau'],$lesCras[$i]['fax'],$lesCras[$i]['tel']);
                $objclient = new client ($lesCras[$i]['raisonsocial'], $objcontact, $lesCras[$i]['siret'], $lesCras[$i]['clientadr'], $lesCras[$i]['clientville'], $lesCras[$i]['codepostale']);
                $objconsultant = new consultant ($lesCras[$i]['nom'], $lesCras[$i]['prenom'], $lesCras[$i]['adrcons'], $lesCras[$i]['villecons'], $lesCras[$i]['cp'], $lesCras[$i]['tel'], $lesCras[$i]['email']);
                $objcontrat = new contrat($lesCras[$i]['idcontrat'], $objclient, $objconsultant, $lesCras[$i]['datedebut'],$lesCras[$i]['datefin'], $lesCras[$i]['mission'],$lesCras[$i]['salaire'], $lesCras[$i]['tarif'], $lesCras[$i]['typecontrat']);
                $objcra = new cra ($lesCras[$i]['totaljfacturable'], $lesCras[$i]['totaljmaladie'],$lesCras[$i]['totaljconge'], $objcontrat, $lesCras[$i]['astreinte'], $lesCras[$i]['periode']);
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
            
        $idcra=r::find("cra", "totaljfacturable = ? and totaljmaladie = ? and totaljconge = ? and astreinte = ? and idcontrat = ? and periode = ?",
        array($TJF, $TJM, $TJC, $astreinte, $idcontrat,  $periode));

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
        $unclient =  new client($client->raisonsocial, $uncontact, $client->siret, $client->adr, $client->ville, $client->codepostale);
        $consultant = R::load('consultant', $idconsultant);
        $unconsultant = new consultant ($consultant->nom ,$consultant->prenom ,$consultant->adr ,$consultant->ville, $consultant->cp, $consultant->tel, $consultant->email);
        $contrat = new contrat($uncontrat->id, $unclient, $unconsultant, $uncontrat->datedebut,$uncontrat->datefin, $uncontrat->mission, $uncontrat->salaire, $uncontrat->tarif, $uncontrat->typecontrat);
        
        $cra = new cra ($uncra->totaljfacturable, $uncra->totaljmaladie, $uncra->totaljconge, $uncra->astreinte, $uncra->idcontrat, $uncra->periode);
         return $cra;
    }

    public function getJFfromidcontrat($idcontrat){
        $lesjFacturable = 0;
        $lesJF = r::getAll("select totaljfacturable from cra where idcontrat='$idcontrat'");
        for ($i=0; $i<=sizeof($lesJF)-1;$i++){
            $lesjFacturable = $lesjFacturable + $lesJF[$i]['totaljfacturable'];
        }
        return $lesjFacturable;
    }

}


?>