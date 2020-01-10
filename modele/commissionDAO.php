<?php

class commissionDAO {

    public function __construct()
    {
        $this->pdo = PdoCommission::getInstance();
    } 

    public function add($uneCommission,$commDAO,$valeur){
        $commercial=$uneCommission->getOCommercial()->getOCommercial();
        $idcommercial=$commDAO->getIdCommercial($commercial);

        $ocommercial=r::dispense("commission");
        $ocommercial->idcommerciaux=$idcommercial;
        r::store($ocommercial);

       $id = r::find("commission","idcommerciaux = ?", array($idcommercial)); 
        foreach($id as $unid){
            $idC=$unid->id;
            
        }
            if($valeur["heri"]=="pourcentage"){
                r::exec("insert into pourcentage(id,valeur) values (".$idC.",".$valeur["pourcentage"].")");
                                                }
           else{
                r::exec("insert into one_shot(id,montant) values (".$idC.",".$valeur["montant"].")");
                }
    }
    
    public function getCommissions(){
            $dao=new commerciauxDAO;

            $lesComm=array();
            $lesCommissions=r::getAll("select commission.id,idcommerciaux, montant, valeur from
            commission left join one_shot on commission.id=one_shot.id
            left join pourcentage on commission.id=pourcentage.id");
        
            foreach($lesCommissions as $uneCommission){
               $commission=new commission($dao->getCommercial($uneCommission['idcommerciaux'])->getOCommercial());
               $one_shot=new one_shot($uneCommission['montant'],$commission->getOCommercial());
               $pourcentage=new pourcentage($uneCommission['valeur'],$commission->getOCommercial());

                $lesComm[]=$uneCommission["id"];
                $lesComm[]=$commission;
                $lesComm[]=$one_shot;
                $lesComm[]=$pourcentage;
                
            }
        
            return($lesComm);
           
   }
    public function getLaCommission($id){
        $dao=new commerciauxDAO;

            $lesComm=array();
            $lesCommissions=r::getAll("select commission.id,idcommerciaux, montant, valeur from
            commission full join one_shot on commission.id=one_shot.id
            full join pourcentage on commission.id=pourcentage.id where commission.id=$id");
        
            foreach($lesCommissions as $uneCommission){
               $commission=new commission($dao->getCommercial($uneCommission['idcommerciaux'])->getOCommercial());
               $one_shot=new one_shot($uneCommission['montant'],$commission->getOCommercial());
               $pourcentage=new pourcentage($uneCommission['valeur'],$commission->getOCommercial());

                $lesComm[]=$uneCommission["id"];
                $lesComm[]=$commission;
                $lesComm[]=$one_shot;
                $lesComm[]=$pourcentage;
                var_dump($lesComm);
                return $lesComm;
                }
    }

   public function update($commission,$idC){
         $dao=new commerciauxDAO;
      //  $idcommercial=$commission->getOCommercial()->
    }

    public function delete($id){
        $pourcentage=r::load('pourcentage',$id);
        r::trash($pourcentage);
        $one_shot=r::load('one_shot',$id); 
        r::trash($one_shot);
        $commission=r::load('commission',$id);
        r::trash($commission);
        }
}