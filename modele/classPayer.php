<?php

class payer {
    private $_idfinance;
    private $_idcontrat;
    private $_idclient;
    
   public function __construct($unIdF, $unIdClient, $unIdContrat){
       $this->_idfinance = $unIdF;
       $this->_idclient = $unIdClient;  
       $this->_idcontrat = $unIdContrat;
   }
   
   public function getidfinance(){
       return $this->_idfinance;
   }
   public function getidclient(){
       return $this->_idclient;
   }
   public function getidcontrat(){
       return $this->_idcontrat;
   }
}

class PayerDao{
    function __construct() {
        $this->pdo = PdoCommission::getInstance();
    }
   
}
