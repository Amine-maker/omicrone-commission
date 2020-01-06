<?php

class client {
    private $_idclient;
    private $_raisonsocial;
    private $_siret;
    private $_adr;
    private $_ville;
    private $_cp;
    private $_lesClients = array();
    
    public function __construt($unIdClient, $uneRS, $unSiret, $uneAdr, $uneVille, $unCP){
        $this->_idclient = $unIdClient;
        $this->_raisonsocial =  $uneRS;
        $this->_siret = $unSiret;
        $this->_adr = $uneAdr;
        $this->_ville = $uneVille;
        $this->_cp = $unCP;
    }
    
    public function getidclient(){
        return $this->_idclient;
    }
    public function getlesClients(){
        return $this->_lesClients;
    }
     public function getraisonsocial(){
        return $this->_raisonsocial;
    }
     public function getsiret(){
        return $this->_siret;
    }
     public function getadr(){
        return $this->_adr;
    }
     public function getville(){
        return $this->_ville;
    }
     public function getcp(){
        return $this->_cp;
    }
}

class DaoClient {
	
     public function __construct() {
        $this->pdo = PdoCommission::getInstance();
    }
    public function listeclient(){
        $req="SELECT idclient, raisonsocial, siret, adr, ville, codepostale, email1, email2, email3, bureau, fax, tel3 FROM client join contact on client.idcontact=contact.idcontact";
        $rs = $this->pdo->query($req);
        print_r($req);
        $ligne = $rs->fetchall(PDO::FETCH_ASSOC);
        return $ligne;
    }
    public function ajouterclient($client){
        $raisonsocial = $client->getraisonsocial();
        $siret = $client->getsiret();
        $adr = $client->getadr();
        $ville = $client->getville();
        $cp = $client->getcp();
//        $email = $client->contact::getemail();
//        $email2 = $client->contact::getemail2();
//        $email3 = $client->contact::getemail3();
//        $bureau = $client->contact::getnumbureau();
//        $fax = $client->contact::getfax();
//        $tel = $client->contact::gettel();
    }
    public function suppclient($idclient){
        $req="DELETE FROM client where idclient = '$idclient';";
        $this->pdo->exec($req);
    }
    public function getinfoclient($idclient){
        $req="SELECT idclient, raisonsocial, siret, adr, ville, codepostale, email1, email2, email3, bureau, fax, tel3 FROM client join contact on client.idcontact=contact.idcontact where idclient='$idclient'";
        $rs = $this->pdo->query($req);
        $ligne = $rs->fetchall(PDO::FETCH_ASSOC);
        return $ligne;
    }
}

?>