<?php

class contrat{
   private $_idContrat;
   private $_idClient;
   private $_datedebut;
   private $_datefin;
   private $_salaire;
   private $_tarif;
   private $_typecontrat;
  
 //  private $_lescontrats;
   
   public function __construct($unIdContrat ,$unIdClient, $uneDateDebut, $uneDateFin, $unSalaire, $unTarif, $unTypeContrat){
       $this->_idContrat = $unIdContrat;
       $this->_idClient = $unIdClient;
       //$this->_idClient = client::getidclient();
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
   
   public function setdatedebut($datedebut){
       return $this->_datedebut = $datedebut;
   }
   
   public function getdatefin(){
       return $this->_datefin;
   }
   
   public function setdatefin($datefin){
       return $this->_datefin = $datefin;
   }
   
   public function gettypecontrat(){
       return $this->_typecontrat;
   }
   
    public function settypecontrat($typecontrat){
       return $this->_typecontrat = $typecontrat;
   }
   
   public function getsalaire(){
       return $this->_salaire; 
   }
   public function setsalaire($salaire){
       return $this->_salaire = $salaire; 
   }
   
   public function gettarif(){
       return $this->_tarif;
   }
    public function settarif($tarif){
        return $this->_tarif = $tarif;
   }
   
   public function getidClient(){
        return $this->_idClient;
   }
   public function setidclient($idclient){
       return $this->_idClient = $idclient;
   }
} 

class tableauContrat{
    private $_tabContrat;
    private $_nbcontrat;
    
    public function __construct(){
        $this->_tabContrat = array();
        $this->_nbcontrat =0;
    }
    public function gettabcontrat(){
        return $this->_tabContrat;
    }
    public function getnbcontrat(){
        return $this->_nbcontrat;
    }
    public function idcontrat($i){
        return $this->_tabContrat[$i];
    }
    public function addContrat($contrat){
        $this->_tabContrat[tableauContrat::getnbcontrat()] = $contrat;
    }
    public function supprimer($i){
        unset($this->_tabContrat[$i]); //detruit le contrat 
    $this->_tabContrat = array_values($this->_tabContrat);
    }
}

class daoContrat{
    
    public function __construct() {
        $this->pdo = PdoCommission::getInstance();
    }
    
    public function getlistecontrat(){ //liste de contrat
        $req="select idcontrat, typecontrat, datedebut, datefin, salaire, tarif, raisonsocial from contrat join client on contrat.idclient=client.idclient order by idcontrat ASC";
        //print_r($req);
        $rs= $this->pdo->query($req);
        $ligne= $rs->fetchAll(PDO::FETCH_ASSOC);
        return $ligne;
    }
    
    public function insertcontrat(&$uncontrat){ //ajouter un contrat
        $req="INSERT INTO contrat (idcontrat, idclient, datedebut, datefin, salaire, tarif, typecontrat) "
                . "VALUES ('".$uncontrat->getidContrat()."','".$uncontrat->getidClient()."','".$uncontrat->getdatedebut()."',"
                . "'".$uncontrat->getdatefin()."','".$uncontrat->getsalaire()."','".$uncontrat->gettarif()."','".$uncontrat->gettypecontrat()."')";
        //print_r($req);
        $this->pdo->exec($req);
    }
    public function selectClients(){
        $req="SELECT idclient, raisonsocial FROM public.client;";
        //print_r($req);
        $rs= $this->pdo->query($req);
        $ligne= $rs->fetchAll(PDO::FETCH_ASSOC);
        return $ligne;
    }
    
    //renvoie le dernier contrat 
    public function getdernierid(){ 
        $req="SELECT idcontrat FROM contrat WHERE idcontrat = (SELECT MAX(idcontrat) FROM contrat)";
        //print_r($req);
        $resultat = $this->pdo->query($req);
        $ligne = $resultat->fetch();
        $donnees = $ligne['idcontrat'];
        return intval($donnees);
    }
    
    //renvoie les infos d'un contrat à modifier
    public function getnfocontratModif($idContrat){
        $req="SELECT idcontrat, client.idclient, datedebut, datefin, salaire, tarif, typecontrat, raisonsocial FROM contrat INNER JOIN client on contrat.idclient=client.idclient where idcontrat='$idContrat';";
        //print_r($req);
        $resultat = $this->pdo->query($req);
        $ligne= $resultat->fetchAll(PDO::FETCH_ASSOC);
        return $ligne;
    }
    
    //maj des infos dans la bdd
    public function setcontrat($idcontrat, $idclient, $datedebut, $datefin, $salaire, $tarif, $typecontrat){
        $req="update contrat 
                set 
                idclient = '$idclient',
                datedebut = '$datedebut',
                datefin = '$datefin',
                salaire = '$salaire',
                tarif = '$tarif',
                typecontrat = '$typecontrat'
                where idcontrat = '$idcontrat'";
        $this->pdo->exec($req);
        print_r($req);
    }
    public function suppContrat($idContrat){
        $req="DELETE FROM contrat where idcontrat = '$idContrat';";
        print_r($req);
        $this->pdo->exec($req);
    }
    
}
?>
