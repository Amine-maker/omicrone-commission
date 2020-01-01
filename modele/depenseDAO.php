<?php

class depenseDAO{

public function __construct()
{
    $this->pdo = PdoCommission::getInstance();
} 

public function ajouterDepense($depense){

    $req="INSERT INTO depense (iddepense,montant,libelle)
    VALUES (nextval('finance_idfinance_seq'::regclass),'".$depense->getMontant()."',
    '".$depense->getLibelle()."')";
    $this->pdo->exec($req);
    
}

public function getDepenses()/*retourne une collection de depense*/ 
        {
            $lesDep=array();
            $req= "SELECT iddepense,montant,libelle from depense order by iddepense asc";
            $rs=$this->pdo->query($req);
            $lesLignes = $rs->fetchAll(PDO::FETCH_ASSOC);
            for($i=0;$i<=count($lesLignes)-1;$i++){
               $dep=new depense($lesLignes[$i]["montant"],$lesLignes[$i]["libelle"]);
                $lesDep[]=$dep;
            }
            return($lesDep);
            
        }

    public function getIdDepense($depense){
            $req= ("SELECT iddepense from depense where 
            montant='".$depense->getMontant()."'
            and libelle='".$depense->getLibelle()."'");
            $rs=$this->pdo->query($req);
            $laLigne = $rs->fetch();
            return($laLigne["iddepense"]);
            
            }

            public function getDepense($idD)/* retourne l'objet depense par rapport a l'id*/{
                $req ="select montant , libelle from depense where iddepense=".$idD."";
                $rs=$this->pdo->query($req);
                $laLigne = $rs->fetch(PDO::FETCH_ASSOC);
                $dep=new depense($laLigne["montant"],$laLigne["libelle"]);
                return($dep);
            }


            public function update($depense,$idD){
                $req="UPDATE depense SET montant='".$depense->getMontant()."', libelle='".$depense->getLibelle()."' WHERE iddepense='".$idD."'";
                $this->pdo->exec($req);
                }

            public function delete($depense){
                $req="delete from depense where iddepense='".$this->getIdDepense($depense)."'";
                $this->pdo->exec($req);
                }
}