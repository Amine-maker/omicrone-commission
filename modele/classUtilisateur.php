<?php
class utilisateur {
    private $id;
    private $nom;
    private $prenom;
    private $tel;
    private $email;
    private $adr;
    private $ville;
    private $cp;

    public function __construct($unNom,$unPrenom,$uneAdresse,$uneVille,$unCp,$unTel,$unEmail)
    {
        $this->nom = $unNom;
        $this->prenom=$unPrenom;
        $this->adr=$uneAdresse;
        $this->ville=$uneVille;
        $this->cp=$unCp;
        $this->tel=$unTel;
        $this->email=$unEmail;   
    }

    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return($this->nom);
    }
    public function getPrenom(){
        return($this->prenom);
    }
    public function getAdresse(){
        return($this->adr);
    }
    public function getVille(){
        return($this->ville);
    }
    public function getCp(){
        return($this->cp);
    }
    public function getTel(){
        return($this->tel);
    }
    public function getEmail(){
        return($this->email);
    }
}

class consultant extends utilisateur {
     private $typecontrat;
     private $salaire; 
     private $tarif; 

     public function __construct($unNom,$unPrenom,$uneAdresse,$uneVille,$unCp,$unTel, $unEmail, $untypecontrat, $unSalaire, $unTarif){
        parent::__construct($unNom,$unPrenom,$uneAdresse,$uneVille,$unCp,$unTel, $unEmail);
        $this->typecontrat = $untypecontrat;
        $this->salaire = $unSalaire;
        $this->tarif = $unTarif;
     }

     public function gettypecontrat(){
         return $this->typecontrat;
     }

     public function getsalaire(){
         return $this->salaire;
     }

     public function gettarif(){
         return $this->tarif;
     }
}

class commercial extends utilisateur {
    public function __construct($unNom,$unPrenom,$uneAdresse,$uneVille,$unCp,$unTel, $unEmail){
        parent::__construct($unNom,$unPrenom,$uneAdresse,$uneVille,$unCp,$unTel, $unEmail);
    }
    
}


class utilisateurDao {
    public function getiduser($utilisateur){
        $nom= $utilisateur->getNom();
        $prenom= $utilisateur->getPrenom();
        $adr=$utilisateur->getAdresse();
        $ville=$utilisateur->getVille();
        $cp=$utilisateur->getCp();
        $tel= $utilisateur->getTel();
        $email= $utilisateur->getEmail();

        $id = r::find('utilisateur', 'nom = ? and prenom = ? and adresse = ? and ville = ? and cp = ? and tel = ? and email = ? ',
        array($nom,$prenom,$adr,$ville,$cp,$tel,$email));
         foreach($id as $unid){
            return($unid->id);
        }
    }
}
class UconsultantDao  {


    public function add($consultant){
        $nom= $consultant->getNom();
        $prenom= $consultant->getPrenom();
        $tel= $consultant->getTel();
        $email= $consultant->getEmail();
        $adresse=$consultant->getAdresse();
        $ville=$consultant->getVille();
        $cp=$consultant->getCp();
        $salaire = $consultant->getsalaire();
        $tarif = $consultant->gettarif();
        $typecontrat = $consultant->gettypecontrat();

        $consultant = R::dispense('utilisateur'); // on crée un commercial

        $consultant->nom = $nom; // on lui donne les champs
        $consultant->prenom = $prenom;
        $consultant->tel=$tel;
        $consultant->email=$email;
        $consultant->adresse=$adresse;
        $consultant->ville=$ville;
        $consultant->cp=$cp;
        R::store($consultant); // on le sauvegarde en BDD
        $idC = r::getAll("SELECT id FROM utilisateur WHERE id = (SELECT MAX(id) FROM utilisateur)");
        $id = $idC[0]["id"];
        r::getAll("insert into consultant values ($id,$typecontrat,$salaire,$tarif, 'FALSE')");
    }
    public function collectionconsultant(){ //collection de consultant
        $collection = array();
        $lesconsultants = r::getAll('select nom, prenom, adresse, ville, cp, tel, email, typecontrat, salaire, tarif
         from utilisateur join consultant on utilisateur.id=consultant.idutilisateur where cacher=false order by id desc');
        //print_r($lesconsultants);
        foreach($lesconsultants as $unconsultant){
            $unconsultant = new consultant ($unconsultant['nom'], $unconsultant['prenom'], $unconsultant['adresse'], $unconsultant['ville'],
            $unconsultant['cp'], $unconsultant['tel'], $unconsultant['email'], $unconsultant['typecontrat'], $unconsultant['salaire'],
             $unconsultant['tarif']);
            $collection[] = $unconsultant;
        }
        return $collection;
    }

    public function getconsultant(){ //retour la liste des noms et prenom des consultants
        $consultant = r::getAll('select id, nom, prenom from utilisateur join consultant on utilisateur.id=consultant.idutilisateur');
        return $consultant;
    }

    public function getIdConsultantFromobject($consultant){ //recupere l'id du consultant

        $nom= $consultant->getNom();
        $prenom= $consultant->getPrenom();
        $adr=$consultant->getAdresse();
        $ville=$consultant->getVille();
        $cp=$consultant->getCp();
        $tel= $consultant->getTel();
        $email= $consultant->getEmail();
        $typecontrat = $consultant->gettypecontrat();
        $salaire = $consultant->getsalaire();
        $tarif = $consultant->gettarif();

        $id = r::getAll("select consultant.idutilisateur as idu from utilisateur join consultant on utilisateur.id=consultant.idutilisateur where nom='$nom' and prenom='$prenom' and adresse='$adr'
         and ville='$ville' and cp='$cp' and tel='$tel' and email='$email' and typecontrat='$typecontrat' and salaire='$salaire' and tarif='$tarif'");
    
        return $id[0]['idu'];
    }

    public function getConsultantfromId($idC){ //retourne l'objet en fonction de son id
        $req = R::getAll('select nom, prenom, adresse, ville, cp, tel, email, typecontrat, salaire, tarif from utilisateur join consultant on utilisateur.id=consultant.idutilisateur where consultant.idutilisateur='.$idC.'');
        foreach($req as $laligne){
        $consultant=new consultant($laligne['nom'],$laligne['prenom'],$laligne['adresse'],$laligne['ville'],$laligne['cp'],$laligne['tel'],$laligne['email'], $laligne['typecontrat'], $laligne['salaire'], $laligne['tarif']);
        return($consultant);
        }
    }

    public function update($consultant,$idC){
        $nom= $consultant->getNom();
        $prenom= $consultant->getPrenom();
        $adr=$consultant->getAdresse();
        $ville=$consultant->getVille();
        $cp=$consultant->getCp();
        $tel= $consultant->getTel();
        $email= $consultant->getEmail();

        $consultant=r::load('utilisateur',$idC);// on recupere le consultant
        $consultant->nom = $nom; // on lui donne les champs
        $consultant->prenom = $prenom;
        $consultant->adresse=$adr;
        $consultant->ville=$ville;
        $consultant->cp=$cp;
        $consultant->tel=$tel;
        $consultant->email=$email;
        // $consultant->cacher = FALSE;
        $consultant = R::store($consultant); // sauvegarde du user dans le BDD

        $idconsultant = $idC;
        $typecontrat = $consultant->gettypecontrat();
        $salaire = $consultant->getsalaire();
        $tarif = $consultant->gettarif();

        $consultant = r::dispense('consultant', $idconsultant);
        $consultant->idutilisateur= $idconsultant;
        $consultant->typecontrat = $typecontrat;
        $consultant->salaire = $salaire;
        $consultant->tarif= $tarif;
        $consultant->cacher = FALSE;
        R::store($consultant); // sauvegarde du consultant en BDD
        //print_r($consultant);
        }


}
?>