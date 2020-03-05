<?php
class utilisateur {

private $_id;
private $_nom;
private $_prenom;
private $_tel;
private $_email;
private $_adr;
private $_ville;
private $_cp;

public function __construct($unNom,$unPrenom,$uneAdresse,$uneVille,$unCp,$unTel, $unEmail)

{

    $this->_nom = $unNom;
    $this->_prenom=$unPrenom;
    $this->_adr=$uneAdresse;
    $this->_ville=$uneVille;
    $this->_cp=$unCp;
    $this->_tel=$unTel;
    $this->_email=$unEmail;   

}

public function getId(){
    return $this->_id;
}

public function getNom(){
    return($this->_nom);
}

    

public function getPrenom(){
    return($this->_prenom);
}

public function getAdresse(){
    return($this->_adr);
}

public function getVille(){
    return($this->_ville);
}

public function getCp(){
    return($this->_cp);
}

public function getTel(){
    return($this->_tel);
}

public function getEmail(){
    return($this->_email);
}
}