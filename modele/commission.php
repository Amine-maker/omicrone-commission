<?php
class commission {

    protected $idCommission; 
    protected $commercial; // objet de la classe commercial
    private static $nextidCommission=0;

    public function __construct($unCommercial)
    {
        $this->commercial=$unCommercial;
        commission::$nextidCommission+=1;
        $this->idCommission=commission::$nextidCommission;
    }
    public function getIdCommission(){return $this->idCommission;}
    public function getOCommercial(){return $this->commercial;}

    
}

class one_shot extends commission {

    private $montant;

    public function __construct($unMontant)
    {
        $this->montant=$unMontant;
    }
    public function getMontant(){return($this->montant);}
}

class pourcentage extends commission {

    private $valeur;

    public function __construct($uneValeur)
    {
        $this->valeur=$uneValeur;
    }
    public function getValeur(){return($this->valeur);}
}