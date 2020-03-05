<?php

class financeDAO{

public function __construct()
{
    $this->pdo = PdoCommission::getInstance();
} 

    public function add($finance,$comm){

        $req="INSERT INTO infob (id,idclient,id,codeagence,compte,iban,bic,codebanque,clerib)
        VALUES (nextval('finance_idfinance_seq'::regclass),NULL,'".$comm->getIdCommercial($finance->getOCommercial())."','".$finance->getCodeAgence()."',
        '".$finance->getCompte()."','".$finance->getIban()."','".$finance->getBic()."',
        '".$finance->getCodeBanque()."','".$finance->getCleRib()."')";
        $this->pdo->exec($req);
    }
    

    public function getFinances()/* retourne une collection de finance*/{
        $lesFinance=array();
        $lesLignes =r::getAll("select nom, prenom, tel, email, adresse, ville, cp, codeagence ,compte ,iban ,bic, codebanque,clerib from utilisateur join commercial on utilisateur.id=commercial.idutilisateur left join infob on commercial.idutilisateur=infob.idcommercial where commercial.cacher = false");
        
        for($i=0;$i<=count($lesLignes)-1;$i++){
            // a finir quand on créra la table client, ajouter l'objet client a la collection quand la classe sera créée
           $comm=new commercial($lesLignes[$i]["nom"],$lesLignes[$i]["prenom"],$lesLignes[$i]["adresse"],$lesLignes[$i]["ville"],$lesLignes[$i]["cp"],$lesLignes[$i]["tel"],
           $lesLignes[$i]["email"]);

            $fin=new information_bancaire(NULL,$comm,$lesLignes[$i]["codeagence"],$lesLignes[$i]["compte"],$lesLignes[$i]["iban"],
                            $lesLignes[$i]["bic"],$lesLignes[$i]["codebanque"],$lesLignes[$i]["clerib"]);
            $lesFinance[]=$fin;
                                             }
        return($lesFinance);
        }

        public function getIdFinanceByObject($finance){
            $req=("SELECT id from infob
            where codeagence='".$finance->getCodeAgence()."'
            and compte='".$finance->getCompte()."'
            and iban='".$finance->getIban()."'
            and bic='".$finance->getBic()."'
            and codebanque='".$finance->getCodeBanque()."'
            and clerib='".$finance->getCleRib()."'");
            $rs=$this->pdo->query($req);
            $laLigne = $rs->fetch(); 
            return($laLigne["id"]);
                     
            }

        public function getFinance($idF)/* retourne l'objet finance par rapport a l'id*/{
            $req ="select nom, prenom, tel, email, adresse, ville, cp, codeagence ,compte ,iban ,bic, codebanque,clerib from utilisateur join commercial on utilisateur.id=commercial.idutilisateur left join infob on commercial.idutilisateur=infob.idcommercial where commercial.cacher = false and infob.id='".$idF."'";
            $rs=$this->pdo->query($req);
            $lesLignes = $rs->fetch(PDO::FETCH_ASSOC);
            $comm=new commercial($lesLignes["nom"],$lesLignes["prenom"],$lesLignes["tel"],
            $lesLignes["email"],$lesLignes["adresse"],$lesLignes["ville"],$lesLignes["cp"]);
            $finance=new information_bancaire(NULL,$comm,$lesLignes["codeagence"],$lesLignes["compte"],$lesLignes["iban"],
            $lesLignes["bic"],$lesLignes["codebanque"],$lesLignes["clerib"]);
            return($finance);
            
        }

        public function getIdFinanceById($idCommercial)/* recupere l'id de la finance avec l'id du commercial*/{
            $req="select infob.id as id from infob, commercial, utilisateur where utilisateur.id=commercial.idutilisateur and commercial.idutilisateur=infob.idcommercial and commercial.idutilisateur=".$idCommercial."";
            $rs=$this->pdo->query($req);
            $laLigne = $rs->fetch(PDO::FETCH_ASSOC);
            return($laLigne["id"]);
        }

    public function update($finance,$idF,$idC){
        $req="UPDATE infob SET idclient=NULL, id='".$idC."', codeagence='".$finance->getCodeAgence()."', compte='".$finance->getCompte()."',
             iban='".$finance->getIban()."', bic='".$finance->getBic()."', codebanque='".$finance->getCodebanque()."', clerib='".$finance->getCleRib()."' WHERE id='".$idF."'";
        $this->pdo->exec($req);
    }
    public function delete($finance){
        $req="delete from infob where id='".$this->getIdFinanceByObject($finance)."'";
        $this->pdo->exec($req);
        }
    public function addfinance($finance, $clientDao){
        $idclient = $clientDao->getidclientfromchamps($finance->getOClient());
        $ca = $finance->getCodeAgence();
        $compte = $finance->getCompte(); 
        $iban = $finance->getIban();
        $bic = $finance->getBic();
        $cb = $finance->getCodeBanque(); 
        $clerib = $finance->getCleRib(); 

        $finance = r::dispense('infob');
        $finance->idclient = $idclient;
        $finance->codeagence = $ca;
        $finance->compte = $compte;
        $finance->iban = $iban;
        $finance->bic = $bic;
        $finance->codebanque = $cb;
        $finance->clerib = $clerib;

        r::store($finance);
    }
}