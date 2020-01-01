<?php

class commerciaux {
   
    private $nom;
    private $prenom;
    private $tel;
    private $email;
    private $adresse;
    private $ville;
    private $cp;

    public function __construct($unNom,$unPrenom,$unTel,$unEmail,$uneAdresse,$uneVille,$unCp)
    {
        
        $this->nom = $unNom;
        $this->prenom=$unPrenom;
        $this->tel=$unTel;
        $this->email=$unEmail;
        $this->adresse=$uneAdresse;
        $this->ville=$uneVille;
        $this->cp=$unCp;
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