<?php

class payer {
    private $_facture;
    private $_contrat;
    private $_client;
    
    public function __construct($facture, $contrat,$client){
        $this->_facture = $facture;
        $this->_contrat = $contrat;
        $this->_client = $client;
    }
   
    public function getclefacture(){
        return $this->_facture;
    }
    public function getclecontrat(){
        return $this->_contrat;
    }
    public function getcleclient(){
        return $this->_client;
    }
}

class PayerDao{
    function __construct() {
        $this->pdo = PdoCommission::getInstance();
    }
    public function addpayer($paiement){
        $idfacture = $paiement->getclefacture();
        $idcontrat = $paiement->getclecontrat();
        $idclient = $paiement->getcleclient();
        r::exec("insert into payer values ($idfacture,$idcontrat,$idclient)");        
    }
   
}
