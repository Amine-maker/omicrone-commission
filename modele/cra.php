<?php

class cra {

    private $totalJfacturable;
    private $totalJmaladie;
    private $totalJconge;
    private $astreinte;
    private $contrat;
    private $periode;


    public function __construct($untotalJF,$untotalJM,$untotalJC,$uneastreinte,$unContrat,$unPeriode)
    {
        $this->totalJfacturable=$untotalJF;
        $this->totalJmaladie=$untotalJM;
        $this->totalJconge=$untotalJC;
        $this->astreinte=$uneastreinte;
        $this->contrat=$unContrat;
        $this->periode=$unPeriode;
    }

    public function getJF(){return $this->totalJfacturable;}
    public function getJM(){return $this->totalJmaladie;}
    public function getJC(){return $this->totalJconge;}
    public function getAstreinte(){return $this->astreinte;}
    public function getOContrat(){return $this->contrat;}
    public function getPeriode(){return $this->periode;}



    public function getTotal(){return $this->totalJfacturable+$this->totalJmaladie+$this->totalJconge;}


}

?>