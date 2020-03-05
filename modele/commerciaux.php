<?php

class commerciaux extends utilisateur {
   
  

    public function __construct($unNom,$unPrenom,$uneAdresse,$uneVille,$unCp,$unTel,$unEmail)
    {
        parent::__construct($unNom,$unPrenom,$uneAdresse,$uneVille,$unCp,$unTel,$unEmail);
    }

        public function getNom(){return($this->nom);}
        public function getPrenom(){return($this->prenom);}
        public function getTel(){return($this->tel);}
        public function getEmail(){return($this->email);}
        public function getAdresse(){return($this->adresse);}
        public function getVille(){return($this->ville);}
        public function getCp(){return($this->cp);}



    public function afficherCommercial(){
        print($this->nom." ".$this->prenom." ".$this->tel." ".
        $this->email." ".$this->adresse." ".$this->ville." ".$this->cp);
    }

}