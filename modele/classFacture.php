<?php

class facture{
    private $_idfinance;
    private $_datef;
    private $_montant;
    
    public function __construct($unedatef, $unmontant /*, $unprixht, $unetva*/) {
        $this->_datef = $unedatef;
        $this->_montant = $unmontant;
        $this->_prixht = $unprixht;
        $this->_tva = $unetva;
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
        $montant = $montant / $cra->nbjtravailler(); // diviser par le nb jour travailler 
        return $montant;
    }
    
}

class FactureDao{
    public function __construct() {
        $this->pdo = PdoCommission::getInstance();
    }
    
    public function collectionfacture(){
        $collectionF = array();
        $lesfactures = R::load('facture');
        foreach ($lesfactures as $unefacture) {
            $objfacture = new facture($unefacture->datef, $unefacture->montant, $unefacture->prixht, $unefacture);
            $collectionF[] = $objfacture;
        }
        return $collectionF;
    }
    
    public function getidffromchamps($facture){
        $datef = $facture->getdatef();
        $montant = $facture->getmontant();
        $prixht = $facture->getprixht();
        $tva = $facture->gettva();
        
        $idfacture = R::find('facture',"datef = ? and montant = ? and prixht = ? and tva = ?", 
        array( $datef, $montant, $prixht, $tva));

        foreach($idfacture as $unidf){
            return($unidf->id);
        }
    }
}