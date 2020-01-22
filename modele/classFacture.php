<?php

class facture{
    private $_idfacture;
    private $_datef;
    private $_montant;
    
    public function __construct($unedatef, $unmontant) {
        $this->_datef = $unedatef;
        $this->_montant = $unmontant;
    }
    public function getidfacture(){
        return $this->_idfacture;
    }
    public function getdatef(){
        return $this->_datef;
    }
    public function getmontant() {
        return $this->_montant;
    }    
    public function MontantAvecTVA(){
        return $this->_montant * 1.2;
    }
}

class FactureDao{
    public function __construct() {
        $this->pdo = PdoCommission::getInstance();
    }
    
    public function getobjectfromid($idfacture){
        $facture = r::load('facture', $idfacture);
        $unefacture = new facture ($facture->datef, $facture->montant);
        return ($unefacture);
    }
    
    public function addfacture($facture){
        $date = $facture-> getdatef();
        $montant = $facture->getmontant();
        
        $lafacture = R::dispense('facture');
        $lafacture->datef = $date;
        $lafacture->montant = $montant;
        R::store($lafacture);
    }

    public function factureexists($idContrat){
       $req =  r::getAll("select EXISTS (select facture.id ,datef , montant from facture join payer on facture.id=payer.idfacture join contrat on contrat.id=payer.idcontrat where  contrat.id=".$idContrat.")");    
      // print_r($req);
       return $req[0]["exists"];
    }
    public function getobjetfacturefromcontrat($idContrat){
        $lafacture = r::getAll("select facture.id ,datef , montant from facture join payer on facture.id=payer.idfacture join contrat on contrat.id=payer.idcontrat where  contrat.id=".$idContrat."");
        for($i=0; $i<=sizeof($lafacture)-1;$i++){
            $facture = new facture ($lafacture[$i]['datef'], $lafacture[$i]['montant']); 
        }
        return $facture;
    }

    public function getidfacutrefromcontrat($idContrat){
       $idfacture =  r::getAll("select facture.id as idfacture from facture join payer on facture.id=payer.idfacture join contrat on contrat.id=payer.idcontrat where  contrat.id=".$idContrat."");
       for($i=0; $i<=sizeof($idfacture)-1;$i++){
        $IDFACTURE = $idfacture[$i]['idfacture'];}
        return  $IDFACTURE;
    }
    
    public function dernieridfacture(){
        $req="SELECT id FROM facture WHERE id = (SELECT MAX(id) FROM facture)";
        //print_r($req);
        $resultat = $this->pdo->query($req);
        $ligne = $resultat->fetch();
        $donnees = $ligne['id'];
        return intval($donnees);
        //return $donnees;
    }
}