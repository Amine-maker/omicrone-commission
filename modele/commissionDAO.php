<?php

class commissionDAO {

    public function __construct()
    {
        $this->pdo = PdoCommission::getInstance();
    } 

    public function add($uneCommission,$comm){
        $commercial=$uneCommission->getOCommercial()->getOCommercial();
        $req="INSERT INTO commission (idcommission,idcommerciaux)
        VALUES (nextval('commission_idcommission_seq'::regclass),'".$comm->getIdCommercial($commercial)."');";

        $idcommission="select idcommission from commission where idcommerciaux = '1'";
        $rs=$this->pdo->query($idcommission);
            $lesLignes = $rs->fetchAll(PDO::FETCH_ASSOC);
            for($i=0;$i<=count($lesLignes)-1;$i++){
               
                     $id=($lesLignes[$i]["idcommission"]);
            }
    }
    
    public function getCommissions(){

            $lesComm=array();
            $req="select commission.idcommission,idcommerciaux, montant, valeur from
        commission left join one_shot on commission.idcommission=one_shot.idcommission
         left join pourcentage on commission.idcommission=pourcentage.idcommission";
            $rs=$this->pdo->query($req);
            $lesLignes = $rs->fetchAll(PDO::FETCH_ASSOC);
            for($i=0;$i<=count($lesLignes)-1;$i++){
               $comm=new commission($lesLignes[$i]["nom"],$lesLignes[$i]["prenom"],$lesLignes[$i]["tel"],
                $lesLignes[$i]["email"],$lesLignes[$i]["adresse"],$lesLignes[$i]["ville"],$lesLignes[$i]["cp"]);
                $lesComm[]=$comm;
            }
            return($lesComm);
   }
}



  