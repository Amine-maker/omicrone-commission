<?php

class contrat{
   private $_idContrat;
   private $_client;
   private $_datedebut;
   private $_datefin;
   private $_mission;
   private $_salaire;
   private $_tarif;
   private $_typecontrat;
   private $_consultant;
     
   public function __construct($unIdContrat ,$unClient, $unConsultant, $uneDateDebut, $uneDateFin, $unemission, $unSalaire, $unTarif, $unTypeContrat){
       $this->_idContrat = $unIdContrat;
       $this->_client = $unClient;
       $this->_consultant = $unConsultant;
       $this->_mission = $unemission;
       $this->_datedebut = $uneDateDebut;
       $this->_datefin = $uneDateFin;
       $this->_salaire = $unSalaire;
       $this->_tarif = $unTarif;
       $this->_typecontrat = $unTypeContrat;
       
   }
   
   public function getidContrat(){
       return $this->_idContrat;
   }
    
   public function getdatedebut(){
       return $this->_datedebut;
   }
     
   public function getdatefin(){
       return $this->_datefin;
   }

   public function getmission(){
       return $this->_mission;
   }
    
   public function gettypecontrat(){
       return $this->_typecontrat;
   }
  
   public function getsalaire(){
       return $this->_salaire; 
   }

   public function gettarif(){
       return $this->_tarif;
   }
   public function getcleclient(){
        return $this->_client;
   }
   public function getcleconsultant(){
       return $this->_consultant;
   }

} 

class daoContrat{
    
    public function __construct() {
        $this->pdo = PdoCommission::getInstance();
    }
    
    public function getlistecontrat(){ //liste de contrat
        $req="select contrat.id, typecontrat, datedebut, datefin,  mission, salaire, tarif, raisonsocial, nom from consultant join contrat on consultant.id=contrat.idconsultant join client on contrat.idclient=client.id order by id ASC";
        //print_r($req);
        $rs= $this->pdo->query($req);
        $ligne= $rs->fetchAll(PDO::FETCH_ASSOC);
        return $ligne;
    }
    
    public function collectioncontrat(){
        $collectionC= array();
        $lesContrats= r::getAll('select consultant.id as idconsultant, nom, prenom, consultant.adr as adrcons, consultant.ville as villecons, cp, tel, email, contrat.id as idcontrat, datedebut, datefin, salaire, tarif, typecontrat, mission, client.id as idclient, idcontact, raisonsocial, siret, client.adr as clientadr, client.ville as clientville, codepostale from consultant join contrat on consultant.id=contrat.idconsultant join client on client.id=contrat.idclient');
        for ($i=0; $i<=count($lesContrats)-1; $i++) {
                $objclient = new client ($lesContrats[$i]['raisonsocial'],$lesContrats[$i]['idcontact'],$lesContrats[$i]['siret'], $lesContrats[$i]['clientadr'], $lesContrats[$i]['clientville'], $lesContrats[$i]['codepostale']);
                $objconsultant = new consultant ($lesContrats[$i]['nom'], $lesContrats[$i]['prenom'], $lesContrats[$i]['adrcons'], $lesContrats[$i]['villecons'], $lesContrats[$i]['cp'], $lesContrats[$i]['tel'], $lesContrats[$i]['email']);
            
                $objcontrat = new contrat($lesContrats[$i]['idcontrat'], $objclient, $objconsultant, $lesContrats[$i]['datedebut'],$lesContrats[$i]['datefin'], $lesContrats[$i]['mission'],$lesContrats[$i]['salaire'], $lesContrats[$i]['tarif'], $lesContrats[$i]['typecontrat']);
                $collectionC[] = $objcontrat;
        }
    return $collectionC;
    //var_dump($collectionC);
    }
    
    public function getobjcontrat($idcontrat){ //retourne un objet contrat en fonction de son id 
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
        //var_dump($contrat);
        return $contrat;
    }
    
    
    
    public function insertcontrat(&$uncontrat){ //ajouter un contrat
        $req="INSERT INTO contrat (id, idclient, idconsultant, datedebut, datefin, mission, salaire, tarif, typecontrat) "
                . "VALUES ('".$uncontrat->getidContrat()."',
                '".$uncontrat->getcleclient()."',
                '".$uncontrat->getcleconsultant()."',
                '".$uncontrat->getdatedebut()."',
                '".$uncontrat->getdatefin()."',
                '".$uncontrat->getmission()."',
                '".$uncontrat->getsalaire()."',
                '".$uncontrat->gettarif()."',
                '".$uncontrat->gettypecontrat()."')";
        $this->pdo->exec($req);
    }

    public function selectClients(){
        $req="SELECT id, raisonsocial FROM public.client;";
        //print_r($req);
        $rs= $this->pdo->query($req);
        $ligne= $rs->fetchAll(PDO::FETCH_ASSOC);
        return $ligne;
    }
    
    public function selectConsultants(){
        $req="select id, nom, prenom from consultant";
        //print_r($req);
        $rs= $this->pdo->query($req);
        $ligne= $rs->fetchAll(PDO::FETCH_ASSOC);
        return $ligne;
    }
    
    //renvoie le dernier contrat 
    public function getdernierid(){ 
        $req="SELECT id FROM contrat WHERE id = (SELECT MAX(id) FROM contrat)";
        //print_r($req);
        $resultat = $this->pdo->query($req);
        $ligne = $resultat->fetch();
        $donnees = $ligne['id'];
        return intval($donnees);
    }
    
    //renvoie les infos d'un contrat à modifier
    public function getnfocontratModif($idContrat){
        $req="SELECT contrat.id, idclient, idconsultant, datedebut, datefin, mission, salaire, tarif, typecontrat, raisonsocial, nom, prenom from consultant join contrat on consultant.id=contrat.idconsultant join client on contrat.idclient=client.id where contrat.id='$idContrat';";
        print_r($req);
        $resultat = $this->pdo->query($req);
        $ligne= $resultat->fetchAll(PDO::FETCH_ASSOC);
        return $ligne;
    }
    
    //maj des infos dans la bdd
    public function setcontrat($idcontrat, $idclient, $idconsultant, $datedebut, $datefin, $mission, $salaire, $tarif, $typecontrat){
        $req="update contrat 
                set 
                idclient = '$idclient',
                idconsultant = '$idconsultant',
                datedebut = '$datedebut',
                datefin = '$datefin',
                mission = '$mission',
                salaire = '$salaire',
                tarif = '$tarif',
                typecontrat = '$typecontrat'
                where id = '$idcontrat'";
        $this->pdo->exec($req);
       // print_r($req);
    }
    public function suppContrat($idContrat){
        $req="DELETE FROM contrat where id = '$idContrat';";
        print_r($req);
        $this->pdo->exec($req);
    }
    
    public function getIdContratFromObject($contrat){ //récupère l'id du contrat en fonction de l'objet
            $consultantDao = new consultantDao();
            $clientDao = new DaoClient();

            $idclient = $clientDao-> getidclientfromchamps($contrat->getcleclient());
            $datedebut= $contrat->getdatedebut();
            $datefin= $contrat->getdatefin();
            $salaire= $contrat->getsalaire();
            $tarif=$contrat->gettarif();
            $typecontrat= $contrat->gettypecontrat();
            $idconsultant = $consultantDao->getIdConsultantFromobject($contrat->getcleconsultant());
            $mission = $contrat->getmission();
                
            $id=r::find("contrat", "idclient = ? and datedebut = ? and datefin = ? and salaire = ? and tarif = ? and typecontrat = ? and idconsultant = ? and mission = ?",
            array($idclient, $datedebut, $datefin, $salaire, $tarif, $typecontrat, $idconsultant, $mission));
    
            foreach($id as $unid){
                return($unid->id);
            }
    }

    public function timecontrat($idcontrat){ //retourne le nb de mois où le consultant à travailler sur la période du contrat
        $req = "SELECT EXTRACT(YEAR FROM datefin) - EXTRACT(YEAR FROM datedebut) as nbannee, EXTRACT(MONTH FROM datefin) - EXTRACT(MONTH FROM datedebut) as nbmois from contrat where id='$idcontrat'";
        print_r($req);
        $resultat = $this->pdo->query($req);
        $laperiode = $resultat->fetch();
        $nbmois = intval($laperiode['nbmois']) ;
       for ($i=0; $i<=$laperiode['nbannee']-1;$i++){; 
            $nbmois = $nbmois + (12*$i);       
        }
        return $nbmois;
    }
    
}
?>
