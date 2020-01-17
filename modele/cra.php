<?php

class cra {

    private $totalJfacturable;
    private $totalJmaladie;
    private $totalJcongee;


    public function __construct($untotalJF,$untotalJM,$untotalJC)
    {
        $this->totalJfacturable=$untotalJF;
        $this->totalJmaladie=$untotalJM;
        $this->totalJcongee=$untotalJC;
    }

    public function getJF(){return $this->totalJfacturable;}
    public function getJM(){return $this->totalJmaladie;}
    public function getJC(){return $this->totalJcongee;}

    public function getTotal(){return $this->totalJfacturable+$this->totalJmaladie+$this->totalJcongee;}


}

?>