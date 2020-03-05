<?php

class facture{
    private $_idfacture;
    private $_libelle;
    private $_cra;
    private $_montant;
    private $_datef;
    
    public function __construct($unlibelle, $uncra, $unmontant, $datef) {
        $this->_libelle = $unlibelle;
        $this->_cra = $uncra;
        $this->_montant = $unmontant;
        $this->_datef = $datef;
    }
    public function getidfacture(){
        return $this->_idfacture;
    }
    public function getclecra(){
        return $this->_cra;
    }
    public function getlibelle(){
        return $this->_libelle;
    }
    public function getdatef(){
        return $this->_datef;
    }
    public function getmontant() {
        return $this->_montant;
    }    
    public function MontantAvecTVA(){
        return $this->getmontant() * 1.2;
    }
}

class FactureDao{
    public function __construct() {
        $this->pdo = PdoCommission::getInstance();
    }
    
    public function getobjectfromid($idfacture){
        $facture = r::load('facture', $idfacture);
        $unefacture = new facture ($facture->libelle, $facture->idcra, $facture->montant, $facture->datef);
        return ($unefacture);
    }

    public function collectionfacture(){
        $collection = array();
        $lafacture = r::getAll('select consultant.idutilisateur as idconsultant, utilisateur.nom as nom, utilisateur.prenom as prenom, utilisateur.adresse as adrcons, utilisateur.ville as villecons, utilisateur.cp as cp, utilisateur.tel as tel, utilisateur.email as email, consultant.typecontrat as typecontrat, consultant.salaire as salaire, consultant.tarif as tarif, contrat.id as idcontrat, datedebut, datefin, mission, client.id as idclient, idcontact, raisonsocial, siret, client.adr as clientadr, client.ville as clientville, codepostal, cra.id as idcra, totaljfacturable, totaljmaladie, totaljconge, astreinte, periode, intervention, contact.id as idcontact, email1, email2, email3, bureau, fax, tel3, facture.id as idfacture ,idcra, libelle, montant, datef from utilisateur, consultant, contrat, client, cra, contact, facture where utilisateur.id=consultant.idutilisateur and contact.id=client.idcontact and client.id=contrat.idclient and consultant.idutilisateur=contrat.idutilisateur and cra.idcontrat=contrat.id and cra.id=facture.idcra');
        for ($i=0; $i<=count($lafacture)-1; $i++) {
            $objcontact = new contact ($lafacture[$i]['email1'],$lafacture[$i]['email2'],$lafacture[$i]['email3'],$lafacture[$i]['bureau'],$lafacture[$i]['fax'],$lafacture[$i]['tel']);
            $objclient = new client ($lafacture[$i]['raisonsocial'], $objcontact, $lafacture[$i]['siret'], $lafacture[$i]['clientadr'], $lafacture[$i]['clientville'], $lafacture[$i]['codepostal']);
            $objconsultant = new consultant ($lafacture[$i]['nom'], $lafacture[$i]['prenom'], $lafacture[$i]['adrcons'], $lafacture[$i]['villecons'], $lafacture[$i]['cp'], $lafacture[$i]['tel'], $lafacture[$i]['email'], $lafacture[$i]['typecontrat'], $lafacture[$i]['salaire'], $lafacture[$i]['tarif']);
            $objcontrat = new contrat($lafacture[$i]['idcontrat'], $objclient, $objconsultant, $lafacture[$i]['datedebut'],$lafacture[$i]['datefin'], $lafacture[$i]['mission'],$lafacture[$i]['salaire'], $lafacture[$i]['tarif'], $lafacture[$i]['typecontrat']);
            $objcra = new cra ($lafacture[$i]['totaljfacturable'], $lafacture[$i]['totaljmaladie'],$lafacture[$i]['totaljconge'], $objcontrat, $lafacture[$i]['astreinte'], $lafacture[$i]['periode'], $lafacture[$i]['intervention']);
            $objetfacture = new facture ($lafacture[$i]['libelle'], $objcra, $lafacture[$i]['montant'], $lafacture[$i]['datef']);
            $collection[]=$objetfacture;
        } 
        return $collection;
    }

    public function getfacture($mois, $idcontrat, $contrat){
        $lafacture = r::getAll("select cra.id as idcra, totaljfacturable, totaljmaladie, totaljconge, astreinte, periode, intervention, facture.id as idfacture, libelle, montant, datef from cra join facture on cra.id=facture.idcra where cra.periode='".$mois."' and cra.idcontrat =".$idcontrat."");
        //$lafacture = r::getAll("select utilisateur.nom as nom, utilisateur.prenom as prenom, utilisateur.adresse as adrcons, utilisateur.ville as villecons, utilisateur.cp as cp, utilisateur.tel as tel, utilisateur.email as email, consultant.typecontrat as typecontrat, consultant.salaire as salaire, consultant.tarif as tarif, contrat.id as idcontrat, datedebut, datefin, mission, client.id as idclient, raisonsocial, siret, client.adr as clientadr, client.ville as clientville, codepostal, cra.id as idcra, totaljfacturable, totaljmaladie, totaljconge, astreinte, periode, contact.id as idcontact, email1, email2, email3, bureau, fax, tel3, facture.id as idfacture ,idcra, libelle, montant, datef from utilisateur, consultant, contrat, client, cra, contact, facture where utilisateur.id=consultant.idutilisateur and contact.id=client.idcontact and client.id=contrat.idclient and consultant.idutilisateur=contrat.idutilisateur and cra.idcontrat=contrat.id and cra.id=facture.idcra and cra.periode='".$mois."' and cra.idcontrat =".$idcontrat."");
        for ($i=0; $i<=count($lafacture)-1; $i++) {
            // $objcontact = new contact ($lafacture[$i]["email1"],$lafacture[$i]["email2"],$lafacture[$i]["email3"],$lafacture[$i]["bureau"],$lafacture[$i]["fax"],$lafacture[$i]["tel"]);
            // $objclient = new client ($lafacture[$i]["raisonsocial"], $objcontact, $lafacture[$i]["siret"], $lafacture[$i]["clientadr"], $lafacture[$i]["clientville"], $lafacture[$i]["codepostal"]);
            // $objconsultant = new consultant ($lafacture[$i]["nom"], $lafacture[$i]["prenom"], $lafacture[$i]["adrcons"], $lafacture[$i]["villecons"], $lafacture[$i]["cp"], $lafacture[$i]["tel"], $lafacture[$i]["email"], $lafacture[$i]["typecontrat"], $lafacture[$i]["salaire"], $lafacture[$i]["tarif"]);
            // $objcontrat = new contrat($lafacture[$i]["idcontrat"], $objclient, $objconsultant, $lafacture[$i]["datedebut"],$lafacture[$i]["datefin"], $lafacture[$i]["mission"],$lafacture[$i]["salaire"], $lafacture[$i]["tarif"], $lafacture[$i]["typecontrat"]);
            $objcra = new cra ($lafacture[$i]["totaljfacturable"], $lafacture[$i]["totaljmaladie"],$lafacture[$i]["totaljconge"], $contrat, $lafacture[$i]["astreinte"], $lafacture[$i]["periode"], $lafacture[$i]["intervention"]);
            $facture = new facture ($lafacture[$i]["libelle"], $objcra, $lafacture[$i]["montant"], $lafacture[$i]["datef"]);
        }
        print_r($lafacture);
        return $facture;
    }
    
    public function addfacture($facture){
        $libelle = $facture->getlibelle();
        $cra = $facture->getclecra();
        $date = $facture-> getdatef();
        $montant = $facture->getmontant();
        
        $lafacture = R::dispense('facture');
        $lafacture->libelle = $libelle;
        $lafacture->idcra = $cra;
        $lafacture->datef = $date;
        $lafacture->montant = $montant;
        R::store($lafacture);
    }

    public function factureexists($idContrat, $mois){
       $req =  r::getAll("select EXISTS (select facture.id ,idcra, libelle, montant, datef from facture join cra on cra.id=facture.idcra where cra.idcontrat=".$idContrat." and cra.periode='".$mois."')");    
      //print_r($req);
       return $req[0]["exists"];
    }

    public function getdatefacture($idcontrat){ //retourne les dates de chaque facture pour un contrat
        $collection=array();
        $lesdates= r::getAll("select distinct periode from cra where idcontrat='$idcontrat' order by periode");
        for ($i=0; $i<count($lesdates);$i++){
            $unedate = $lesdates[$i]['periode'];
            $collection[]=$unedate;
        }      
        return $collection;
    }

    public function getidfacutrefromcontrat($idContrat){
       $idfacture =  r::getAll("select facture.id as idfacture from facture join cra on cra.id=facture.idcra where cra.idcontrat=".$idContrat."");
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