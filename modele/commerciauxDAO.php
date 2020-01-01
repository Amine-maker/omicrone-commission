<?php


class commerciauxDAO{


    public function __construct()
    {
        $this->pdo = PdoCommission::getInstance();
    }
    
    public function add($commercial){

        $req="INSERT INTO commerciaux (idcommerciaux,nom,prenom,tel,email,adresse,ville,cp)
        VALUES (nextval('commerciaux_idcommerciaux_seq'::regclass),'".$commercial->getNom()."','".$commercial->getPrenom()."','".$commercial->getTel()."','".$commercial->getEmail()."','".
        $commercial->getAdresse()."','".$commercial->getVille()."','".$commercial->getCp()."')";
        $this->pdo->exec($req);
       // print_r($req);
        
        
    }
    public function getCommerciaux()/*retourne une collection de commercial*/ 
        {
            $lesComm=array();
            $req= "SELECT idcommerciaux,nom,prenom,tel,email,adresse,ville,cp from commerciaux";
            $rs=$this->pdo->query($req);
            $lesLignes = $rs->fetchAll(PDO::FETCH_ASSOC);
            for($i=0;$i<=count($lesLignes)-1;$i++){
               $comm=new commerciaux($lesLignes[$i]["nom"],$lesLignes[$i]["prenom"],$lesLignes[$i]["tel"],
                $lesLignes[$i]["email"],$lesLignes[$i]["adresse"],$lesLignes[$i]["ville"],$lesLignes[$i]["cp"]);
                $lesComm[]=$comm;
            }
            return($lesComm);
            
        }

       public function getIdCommercial($commercial){
        $req=("SELECT idcommerciaux from commerciaux where nom='".$commercial->getNom()."'
        and prenom='".$commercial->getPrenom()."'
        and tel='".$commercial->getTel()."'
        and email='".$commercial->getEmail()."'
        and adresse='".$commercial->getAdresse()."'
        and ville='".$commercial->getVille()."'
        and cp='".$commercial->getCp()."'");
        $rs=$this->pdo->query($req);
        $laLigne = $rs->fetch();
        return($laLigne["idcommerciaux"]);
        
        }
        
        public function getCommercial($idC){
            $req ="select nom, prenom, tel, email, adresse, ville, cp, codeagence ,compte ,iban ,bic, codebanque,clerib
            from commerciaux left join finance on commerciaux.idcommerciaux=finance.idcommerciaux where commerciaux.idcommerciaux=".$idC."";
            $rs=$this->pdo->query($req);
            $laLigne = $rs->fetch(PDO::FETCH_ASSOC);
            $comm=new commerciaux($laLigne["nom"],$laLigne["prenom"],$laLigne["tel"],
            $laLigne["email"],$laLigne["adresse"],$laLigne["ville"],$laLigne["cp"]);

            $fin=new finance(NULL,$comm,$laLigne["codeagence"],$laLigne["compte"],$laLigne["iban"],
                $laLigne["bic"],$laLigne["codebanque"],$laLigne["clerib"]);
            return($fin);
        }

        public function update($commercial,$idC){
            $req="UPDATE commerciaux SET nom='".$commercial->getNom()."', prenom='".$commercial->getPrenom()."', tel='".$commercial->getTel()."', email='".$commercial->getEmail()."', adresse='".$commercial->getAdresse()."', ville='".$commercial->getVille()."', cp='".$commercial->getCp()."' WHERE idcommerciaux='".$idC."'";
            $this->pdo->exec($req);
            }
        public function delete($commercial){
            $req="delete from commerciaux where idcommerciaux='".$this->getIdCommercial($commercial)."'";
            $this->pdo->exec($req);
            print_r($req);
        }
}

        