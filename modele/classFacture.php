<?php

class facture{
    private $_idfacture;
    private $_datef;
    private $_montant;
    
    public function __construct($unedatef, $unmontant /*, $unprixht, $unetva*/) {
        $this->_datef = $unedatef;
        $this->_montant = $unmontant;
        // $this->_prixht = $unprixht;
        // $this->_tva = $unetva;
    }
    public function getidfacture(){
        return $this->_idfacture;
    }
    public function getdatef(){
        return $this->_datef;
    }
    public function getmontant() {
        return $this->_montant;
    }    
    public function MontantAvecTVA(){
        return $this->_montant * 1.2;
    }
}

class FactureDao{
    public function __construct() {
        $this->pdo = PdoCommission::getInstance();
    }
    
    public function getobjectfromid($idfacture){
        $facture = r::load('facture', $idfacture);
        $unefacture = new facture ($facture->datef, $facture->montant);
        return ($unefacture);
    }
    
    public function addfacture($facture){
        $date = $facture-> getdatef();
        $montant = $facture->getmontant();
        
        $lafacture = R::dispense('facture');
        $lafacture->datef = $date;
        $lafacture->montant = $montant;
        R::store($lafacture);
    }
    
    public function dernieridfacture(){
        $req="SELECT id FROM facture WHERE id = (SELECT MAX(id) FROM facture)";
        //print_r($req);
        $resultat = $this->pdo->query($req);
        $ligne = $resultat->fetch();
        $donnees = $ligne['id'];
        return intval($donnees);
        //return $donnees;
    }
}