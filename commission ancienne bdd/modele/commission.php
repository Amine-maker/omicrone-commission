<?php
class commission {

    protected $idCommission; 
    protected $commercial; // objet de la classe commercial

    public function __construct($unCommercial)
    {
        $this->commercial=$unCommercial;
    }
    public function getIdCommission(){return $this->idCommission;}
    public function getOCommercial(){return $this->commercial;}

    
}

class one_shot extends commission {

    private $montant;

    public function __construct($unMontant,$unCommercial)
    {
        parent:: __construct($unCommercial);
        $this->montant=$unMontant;
    }
    public function getMontant(){return($this->montant);}
}

class pourcentage extends commission {

    private $valeur;
   

    public function __construct($uneValeur,$unCommercial)
    {
        parent:: __construct($unCommercial);
        $this->valeur=$uneValeur;

    }
    public function getValeur(){return($this->valeur);}
}