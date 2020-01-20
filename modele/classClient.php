<?php

class client {
    private $_idclient;
    private $_idcontact;
    private $_raisonsocial;
    private $_siret;
    private $_adr;
    private $_ville;
    private $_cp;
    
    public function __construct($uneRS, $unIdContact, $unSiret, $uneAdr, $uneVille, $unCP){
        //$this->_idclient =  $unIdClient;
        $this->_raisonsocial =  $uneRS;
        $this->_idcontact = $unIdContact;
        $this->_siret = $unSiret;
        $this->_adr = $uneAdr;
        $this->_ville = $uneVille;
        $this->_cp = $unCP;
    }
    
    public function getidclient(){
        return $this->_idclient;
    }
    
    public function getclecontact(){
        return $this->_idcontact;
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
        $req="SELECT client.id, raisonsocial, siret, adr, ville, codepostale, email1, email2, email3, bureau, fax, tel3 FROM client join contact on client.idcontact=contact.id order by client.id ASC";
        $rs = $this->pdo->query($req);
        //print_r($req);
        $ligne = $rs->fetchall(PDO::FETCH_ASSOC);
        return $ligne;
    }
    
    public function collectionclient(){
        $collectionclient = array();
        $req="SELECT client.id, raisonsocial, siret, adr, ville, codepostale, email1, email2, email3, bureau, fax, tel3 FROM client join contact on client.idcontact=contact.id order by client.id ASC";
        $rs = $this->pdo->query($req);
        //print_r($req);
        $lesclients = $rs->fetchall(PDO::FETCH_ASSOC);
        for($i; $i<=sizeof($lesclients)-1;$i++){
            $objcontact = new contact ($lesclients[$i]['email1'],$lesclients[$i]['email2'],$lesclients[$i]['email3'],$lesclients[$i]['bureau'],$lesclients[$i]['fax'],$lesclients[$i]['tel3']);
            $objclient = new client ($lesclients[$i]['raisonsocial'],$objcontact,$lesclients[$i]['siret'],$lesclients[$i]['adr'],$lesclients[$i]['ville'],$lesclients[$i]['codepostale']);
    
            $collectionclient[]=$objclient;
        }
        return $collectionclient;
    }
    
    
    
    public function getdernieridclient(){
        $req="SELECT id FROM client WHERE id = (SELECT MAX(id) FROM client)";
        //print_r($req);
        $resultat = $this->pdo->query($req);
        $ligne = $resultat->fetch();
        $donnees = $ligne['id'];
        //return intval($donnees);
        return $donnees;
    }
    
    public function ajouterclient($client,$contactDao){
        //var_dump($client);
        $email = $client->getclecontact()->getemail();
        $email2 = $client->getclecontact()->getemail2();
        $email3 = $client->getclecontact()->getemail3();
        $bureau = $client->getclecontact()->getnumbureau();
        $fax = $client->getclecontact()->getfax();
        $tel = $client->getclecontact()->gettel();
        $lecontact = R::dispense('contact'); //créer un objet contact
        
        $lecontact->email1 = $email;
        $lecontact->email2 = $email2;
        $lecontact->email3 = $email3;
        $lecontact->bureau = $bureau;
        $lecontact->fax = $fax;
        $lecontact->tel3 = $tel;   
        R::store($lecontact); //envoie dans la bdd
        $idcontact_fk = $contactDao->getIdContactFromChamps($client->getclecontact());
        $raisonsocial = $client->getraisonsocial();
        $siret = $client->getsiret();
        $adr = $client->getadr();
        $ville = $client->getville();
        $cp = $client->getcp();
        
        $leclient = R::dispense('client'); //créer un objet client
        $leclient->idcontact = $idcontact_fk;
        $leclient->raisonsocial = $raisonsocial;
        $leclient->siret = $siret;
        $leclient->adr = $adr;
        $leclient->ville = $ville;
        $leclient->codepostale = $cp;
        R::store($leclient);
        //print_r($client);
    }
    
    public function getinfoclient($idclient){
        $req="select client.id, raisonsocial, adr, siret, ville, codepostale, email1, email2, email3,tel3, bureau, fax FROM client join contact on client.idcontact=contact.id where client.id='$idclient'";
        print_r($req);
        $rs = $this->pdo->query($req);
        $ligne = $rs->fetchall(PDO::FETCH_ASSOC);
        return $ligne;
    }
    
    public function getclient($idduclient)/* recupère l'objet client par rapport à son l'id*/{
       $client = R::load('client',$idduclient);
       $unclient=new client($client->raisonsocial, $client->idcontact, $client->siret, $client->adr, $client->ville, $client->codepostale);
       return($unclient);
        }
    
    public function setclient($client,$idclient,$idcontact_fk){
        //$idclient = $client->getidclient();
        //$idcontact_fk = $contactDao->getIdContactFromChamps($client->getclecontact());
        $raisonsocial = $client->getraisonsocial();
        $siret = $client->getsiret();
        $adr = $client->getadr();
        $ville = $client->getville();
        $cp = $client->getcp();
        $leclient = R::load('client',$idclient); //créer un objet client
        $leclient->idcontact = $idcontact_fk;
        $leclient->raisonsocial = $raisonsocial;
        $leclient->siret = $siret;
        $leclient->adr = $adr;
        $leclient->ville = $ville;
        $leclient->codepostale = $cp;
        R::store($leclient);
    }
    public function getidclientfromchamps($client){
        $raisonsocial = $client->getraisonsocial();
        $siret = $client->getsiret();
        $adr = $client->getadr();
        $ville = $client->getville();
        $cp = $client->getcp();
        
        $idclient = R::find("client", "raisonsocial = ? and siret = ? and adr = ? and ville = ? and codepostale = ?",
        array($raisonsocial, $siret, $adr, $ville, $cp));
        foreach($idclient as $unidclient){
            return($unidclient->id);}   
    }
    
    public function suppclient($client){ 
            $idclient = $this->getidclientfromchamps($client); 
            $client = R::load('client', $idclient);
            R::trash($client);
        }
}

?>