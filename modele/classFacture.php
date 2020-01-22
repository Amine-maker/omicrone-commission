<?php

class facture{
    private $_idfinance;
    private $_datef;
    private $_montant;
    
    public function __construct($unedatef, $unmontant /*, $unprixht, $unetva*/) {
        $this->_datef = $unedatef;
        $this->_montant = $unmontant;
        // $this->_prixht = $unprixht;
        // $this->_tva = $unetva;
    }
    public function getidfinance(){
        return $this->_idfinance;
    }
    public function getdatef(){
        return $this->_datef;
    }
    public function getmontant() {
        return $this->_montant;
    }

    
    public function calculprixHT($contrat, $depenseDao, $cra){
        $montant = $contrat->getsalaire() * 2; //salaire multiplié par 2 pour prendre en compte les charges sociales et fiscales
        $montant = $montant * 1.1; //ajouter 10% pour prendre en compte les congés payés
        $montant = $montant + $depenseDao->getDepenses(); //ajouter les charges de fonctionnement mensuelles (frais de location de bureau, communications, documentation, électricité, etc.).
        $montant = $montant / getTotal(); // diviser par le nb jour travailler 
        return $montant;
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