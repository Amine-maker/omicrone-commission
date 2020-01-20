<?php
 class contact{
    private $_idcontact;
    private $_email;
    private $_email2;
    private $_email3;
    private $_bureau;
    private $_fax;
    private $_tel;
     
    public function __construct($unEmail, $unEmail2, $unEmail3, $unNumB, $unNumFax, $unTel){
       // $this->_idcontact = $unid;
        $this->_email = $unEmail;
        $this->_email2 = $unEmail2;
        $this->_email3 = $unEmail3; 
        $this->_bureau = $unNumB;
        $this->_fax = $unNumFax;
        $this->_tel = $unTel;
    }
    
    public function getidcontact(){
        return $this->_idcontact;
    }
    public function getemail(){
        return $this->_email;
    }
    public function getemail2(){
        return $this->_email2;
    }            
    public function getemail3(){
        return $this->_email3;
    }
    public function getnumbureau(){
        return $this->_bureau;
    }
    public function getfax(){
        return $this->_fax;
    }
    public function gettel(){
        return $this->_tel;
    }
 }
 
 class DaoContact {
    public function __construct(){
       $this->pdo = PdoCommission::getInstance();
    }
    public function getIdContactFromChamps($contact){
        $email = $contact->getemail();
        $email2 = $contact->getemail2();
        $email3 = $contact->getemail3();
        $bureau = $contact->getnumbureau();
        $fax = $contact->getfax();
        $tel = $contact->gettel();
        
        $idcontact = R::find("contact", "email1 = ? and email2 = ? and email3 = ? and bureau = ? and fax = ? and tel3 = ?",
        array($email, $email2, $email3, $bureau, $fax, $tel));
        foreach($idcontact as $unidcontact){
            return($unidcontact->id);}     
    }
       
//    public function getdernieridcontact(){ //recupere l'id du contact le plus grand
//        $req="SELECT id FROM contact WHERE id = (SELECT MAX(id) FROM contact)";
//        //print_r($req);
//        $resultat = $this->pdo->query($req);
//        $ligne = $resultat->fetch();
//        $donnees = $ligne['id'];
//        //return intval($donnees);
//        return $donnees;
//    }
    
    public function getobjetcontact($idcontact){ //retourne un objet contact en fonction de l'id
       $contact = r::load('contact',$idcontact);
       $uncontact=new contact($contact->email1, $contact->email2,$contact->email3, $contact->bureau, $contact->fax, $contact->tel3);
       return($uncontact);
    }
    
    public function getidcontactfromidclient($idclient){ //recupère l'id du contact en fonction du client
        $req = "select contact.id from contact join client on contact.id=client.idcontact where client.id ='$idclient'";
        $rs = $this->pdo->query($req);
        $ligne = $rs->fetch();
        $donnees = $ligne['id'];
        return $donnees;
    }
    
    public function setcontact($contact, $idcontact){ //modifier les informations de la table contact d'un client
        $email = $contact->getemail();
        $email2 = $contact->getemail2();
        $email3 = $contact->getemail3();
        $bureau = $contact->getnumbureau();
        $fax = $contact->getfax();
        $tel = $contact->gettel();
        $lecontact = R::load('contact',$idcontact); 
        $lecontact->email1 = $email;
        $lecontact->email2 = $email2;
        $lecontact->email3 = $email3;
        $lecontact->bureau = $bureau;
        $lecontact->fax = $fax;
        $lecontact->tel3 = $tel;   
        R::store($lecontact); //envoie dans la bdd
    }
    
    public function suppcontact($contact){
        $idcontact = $this->getIdContactFromChamps($contact);
        $contact = R::load('contact', $idcontact);
        R::trash($contact);
    }
 }
 