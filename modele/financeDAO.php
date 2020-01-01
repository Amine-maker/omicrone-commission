<?php

class financeDAO{

public function __construct()
{
    $this->pdo = PdoCommission::getInstance();
} 

    public function add($finance,$comm){

        $req="INSERT INTO finance (idfinance,idclient,idcommerciaux,codeagence,compte,iban,bic,codebanque,clerib)
        VALUES (nextval('finance_idfinance_seq'::regclass),NULL,'".$comm->getIdCommercial($finance->getOCommercial())."','".$finance->getCodeAgence()."',
        '".$finance->getCompte()."','".$finance->getIban()."','".$finance->getBic()."',
        '".$finance->getCodeBanque()."','".$finance->getCleRib()."')";
        $this->pdo->exec($req);
    }

    public function getFinances()/* retourne une collection de finance*/{
        $lesFinance=array();
        $req = "select nom, prenom, tel, email, adresse, ville, cp, codeagence ,compte ,iban ,bic, codebanque,clerib
         from commerciaux left join finance on commerciaux.idcommerciaux=finance.idcommerciaux
        ";
        $rs=$this->pdo->query($req);
        $lesLignes = $rs->fetchAll(PDO::FETCH_ASSOC);
        for($i=0;$i<=count($lesLignes)-1;$i++){
            // a finir quand on créra la table client, ajouter l'objet client a la collection quand la classe sera créée
           $comm=new commerciaux($lesLignes[$i]["nom"],$lesLignes[$i]["prenom"],$lesLignes[$i]["tel"],
                        $lesLignes[$i]["email"],$lesLignes[$i]["adresse"],$lesLignes[$i]["ville"],$lesLignes[$i]["cp"]);

            $fin=new finance(NULL,$comm,$lesLignes[$i]["codeagence"],$lesLignes[$i]["compte"],$lesLignes[$i]["iban"],
                            $lesLignes[$i]["bic"],$lesLignes[$i]["codebanque"],$lesLignes[$i]["clerib"]);
            $lesFinance[]=$fin;
                                             }
        return($lesFinance);
        }

        public function getIdFinanceByObject($finance){
            $req=("SELECT idfinance from finance
            where codeagence='".$finance->getCodeAgence()."'
            and compte='".$finance->getCompte()."'
            and iban='".$finance->getIban()."'
            and bic='".$finance->getBic()."'
            and codebanque='".$finance->getCodeBanque()."'
            and clerib='".$finance->getCleRib()."'");
            $rs=$this->pdo->query($req);
            $laLigne = $rs->fetch();
            print_r($req);   
            return($laLigne["idfinance"]);
                     
            }

        public function getFinance($idF)/* retourne l'objet finance par rapport a l'id*/{
            $req ="select nom, prenom, tel, email, adresse, ville, cp, codeagence ,compte ,iban ,bic, codebanque,clerib
            from commerciaux left join finance on commerciaux.idcommerciaux=finance.idcommerciaux where idfinance='".$idF."'";
            $rs=$this->pdo->query($req);
            $lesLignes = $rs->fetch(PDO::FETCH_ASSOC);
            $comm=new commerciaux($lesLignes["nom"],$lesLignes["prenom"],$lesLignes["tel"],
            $lesLignes["email"],$lesLignes["adresse"],$lesLignes["ville"],$lesLignes["cp"]);
            $finance=new finance(NULL,$comm,$lesLignes["codeagence"],$lesLignes["compte"],$lesLignes["iban"],
            $lesLignes["bic"],$lesLignes["codebanque"],$lesLignes["clerib"]);
            print_r($req);
            return($finance);
            
        }

        public function getIdFinanceById($idCommercial)/* recupere l'id de la finance avec l'id du commercial*/{
            $req="select idfinance from finance, commerciaux where commerciaux.idcommerciaux=finance.idcommerciaux and commerciaux.idcommerciaux=".$idCommercial."";
            $rs=$this->pdo->query($req);
            $laLigne = $rs->fetch(PDO::FETCH_ASSOC);
            print_r($req);
            return($laLigne["idfinance"]);
        }

    public function update($finance,$idF,$idC){
        $req="UPDATE finance SET idclient=NULL, idcommerciaux='".$idC."', codeagence='".$finance->getCodeAgence()."', compte='".$finance->getCompte()."',
             iban='".$finance->getIban()."', bic='".$finance->getBic()."', codebanque='".$finance->getCodebanque()."', clerib='".$finance->getCleRib()."' WHERE idfinance='".$idF."'";
        $this->pdo->exec($req);
    }
    public function delete($finance){
        $req="delete from finance where idfinance='".$this->getIdFinanceByObject($finance)."'";
        $this->pdo->exec($req);
        print_r($req);
        }
}