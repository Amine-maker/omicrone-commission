<?php

class cra {

    private $totalJfacturable;
    private $totalJmaladie;
    private $totalJconge;
    private $astreinte;


    public function __construct($untotalJF,$untotalJM,$untotalJC,$uneastreinte)
    {
        $this->totalJfacturable=$untotalJF;
        $this->totalJmaladie=$untotalJM;
        $this->totalJconge=$untotalJC;
        $this->astreinte=$uneastreinte;
    }

    public function getJF(){return $this->totalJfacturable;}
    public function getJM(){return $this->totalJmaladie;}
    public function getJC(){return $this->totalJcongee;}
    public function getAstreinte(){return $this->astreinte;}



    public function getTotal(){return $this->totalJfacturable+$this->totalJmaladie+$this->totalJcongee;}


}

?>