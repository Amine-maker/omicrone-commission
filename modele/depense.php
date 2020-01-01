<?php

class depense {
    
    private $montant;
    private $libelle;

    public function __construct($unMontant,$unLibelle)
    {
        
        $this->montant = $unMontant;
        $this->libelle=$unLibelle;
       
    }
        public function getMontant(){return($this->montant);}
        public function getLibelle(){return($this->libelle);}



    public function afficherDepense(){
        print($this->montant." ".$this->libelle);
    }

}