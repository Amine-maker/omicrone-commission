<?php

class contrat{
   private $_idContrat;
   private $_client;
   private $_datedebut;
   private $_datefin;
   private $_salaire;
   private $_tarif;
   private $_typecontrat;
   private $_consultant;
   private $_cra;
     
   public function __construct($unIdContrat ,$unClient, $unConsultant, $uneDateDebut, $uneDateFin, $unSalaire, $unTarif, $unTypeContrat){
       $this->_idContrat = $unIdContrat;
       $this->_client = $unClient;
       $this->_consultant = $unConsultant;
    //    $this->_cra = $uncra;
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
        $req="select contrat.id, typecontrat, datedebut, datefin, salaire, tarif, raisonsocial, nom from consultant join contrat on consultant.id=contrat.idconsultant join client on contrat.idclient=client.id order by id ASC";
        //print_r($req);
        $rs= $this->pdo->query($req);
        $ligne= $rs->fetchAll(PDO::FETCH_ASSOC);
        return $ligne;
    }
    
    public function collectioncontrat(){
        $collectionC= array();
        $lescontrats = R::find('contrat');
        foreach ($lescontrats as $uncontrat) {
             $objcontrat = new contrat($uncontrat->id, $uncontrat->idclient, $uncontrat->idconsultant, $uncontrat->idcra ,$uncontrat->datedebut,$uncontrat->datefin, $uncontrat->salaire, $uncontrat->tarif, $uncontrat->typecontrat);
        $collectionC[] = $objcontrat;
        }
    return $collectionC;
    }
    
    public function getobjcontrat($idcontrat){ //retourne un objet contrat en fonction de son id 
        $uncontrat = R::load('contrat', $idcontrat);
        $idclient = $uncontrat->idclient;
        $client = R::load('client', $idclient);
        $unclient =  new client($client->raisonsocial, $uncontact, $client->siret, $client->adr, $client->ville, $client->codepostale);
        $idcontact = $client->idcontact;
        $contact = r::load('contact', $idcontact);
        $uncontact = new contact ($contact->email1, $contact->email2, $contact->email3, $contact->bureau, $contact->fax, $contact->tel3);
        $idconsultant = $uncontrat->idconsultant;
        $consultant = R::load('consultant', $idconsultant);
        $unconsultant = new consultant ($consultant->nom ,$consultant->prenom ,$consultant->adr ,$consultant->ville, $consultant->cp, $consultant->tel, $consultant->email);
        $contrat = new contrat($uncontrat->id, $unclient, $unconsultant, $uncontrat->datedebut,$uncontrat->datefin, $uncontrat->salaire, $uncontrat->tarif, $uncontrat->typecontrat);
        //var_dump($contrat);
        return $contrat;
    }
    
    
    
    public function insertcontrat(&$uncontrat){ //ajouter un contrat
        $req="INSERT INTO contrat (id, idclient, idconsultant, datedebut, datefin, salaire, tarif, typecontrat) "
                . "VALUES ('".$uncontrat->getidContrat()."','".$uncontrat->getcleclient()."','".$uncontrat->getcleconsultant()."','".$uncontrat->getdatedebut()."',"
                . "'".$uncontrat->getdatefin()."','".$uncontrat->getsalaire()."','".$uncontrat->gettarif()."','".$uncontrat->gettypecontrat()."')";
        //print_r($req);
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
        $req="SELECT contrat.id, idclient, idconsultant, datedebut, datefin, salaire, tarif, typecontrat, raisonsocial, nom, prenom from consultant join contrat on consultant.id=contrat.idconsultant join client on contrat.idclient=client.id where contrat.id='$idContrat';";
        print_r($req);
        $resultat = $this->pdo->query($req);
        $ligne= $resultat->fetchAll(PDO::FETCH_ASSOC);
        return $ligne;
    }
    
    //maj des infos dans la bdd
    public function setcontrat($idcontrat, $idclient, $idconsultant, $datedebut, $datefin, $salaire, $tarif, $typecontrat){
        $req="update contrat 
                set 
                idclient = '$idclient',
                idconsultant = '$idconsultant',
                datedebut = '$datedebut',
                datefin = '$datefin',
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
    
    public function getidcontratfromchamps(){
        
    }
    
}
?>
