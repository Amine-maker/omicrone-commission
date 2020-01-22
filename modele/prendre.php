<?php 
class prendre {


    private $commission; 
    private $contrat;


    public function __construct($uneCommission,$unContrat)
    {
        $this->commission=$uneCommission;
        $this->contrat=$unContrat;
    }

    public function getOCommission(){return($this->commission);}
    public function getOContrat(){return($this->contrat);}

}

