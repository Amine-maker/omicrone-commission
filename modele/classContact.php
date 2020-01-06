<?php
 class contact{
    private $_idcontact;
    private $_email;
    private $_email2;
    private $_email3;
    private $_bureau;
    private $_fax;
    private $_tel;
     
    public function __construct($unid, $unEmail, $unEmail2, $unEmail3, $unNumB, $unNumFax, $unTel){
        $this->_idcontact = $unid;
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
 }
 