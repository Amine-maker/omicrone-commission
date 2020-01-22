<?php

class information_bancaire {

    private $idFinance;
    private $client;
    private $commercial;
    private $codeAgence;
    private $compte;
    private $iban;
    private $bic;
    private $codeBanque;
    private $cleRib;

    public function __construct($UnClient,$UnCommercial,$unCodeAgence,$unCompte,$unIban,$unBic,$unCodeBanque,$uneCleRib)
    {
    $this->client=$UnClient;
    $this->commercial=$UnCommercial;
    $this->codeAgence= $unCodeAgence;
    $this->compte=$unCompte;
    $this->iban=$unIban;
    $this->bic=$unBic;
    $this->codeBanque=$unCodeBanque;
    $this->cleRib=$uneCleRib;
    }

    
    public function getOClient(){return $this->client;}
    public function getOCommercial(){return $this->commercial;}
    public function getIdFinance(){return $this->idFinance;}
    public function getCodeAgence(){return($this->codeAgence);}
    public function getCompte(){return($this->compte);}
    public function getIban(){return($this->iban);}
    public function getBic(){return($this->bic);}
    public function getCodeBanque(){return($this->codeBanque);}
    public function getCleRib(){return($this->cleRib);}

}