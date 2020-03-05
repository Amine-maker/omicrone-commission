<?php

class commissionDAO {


    public function add($uneCommission,$valeur){
        $commDAO=new commerciauxDao;
        $commercial=$uneCommission->getOCommercial()->getOCommercial();
        $idcommercial=$commDAO->getIdCommercial($commercial);

        $ocommercial=r::dispense("commission");
        $ocommercial->idcommercial=$idcommercial;
        r::store($ocommercial);

    //    $id = r::find("commission","idcommercial = ?", array($idcommercial)); 
    //     foreach($id as $unid){
    //         $idC=$unid->id;  }

    $id = r::getAll("select id from commission where id = (select max(id) from commission) and cacher = false");
    $idC = $id[0]['id'];

var_dump($id);
            if($valeur["heri"]=="pourcentage"){
               $v = $valeur['pourcentage'];
                r::exec("insert into pourcentage(idcommission,valeur) values ($idC,$v)");
                                                }
           else{
               $m = $valeur["montant"];
                r::exec("insert into oneshot(idcommission,montant) values ($idC,$m)");
                }
                $idContrat=$valeur["idContrat"];
                r::exec("insert into prendre (idcontrat,idcommission) values (".$idContrat.",".$idC.")");
    
    }
    
    public function getCommissions(){
            $dao=new commerciauxDao;

            $lesComm=array();
            $lesCommissions=r::getAll("select commission.id,idcommercial, montant, valeur from
            commission left join oneshot on commission.id=oneshot.idcommission
            left join pourcentage on commission.id=pourcentage.idcommission where commission.cacher = false order by id desc");
        
            foreach($lesCommissions as $uneCommission){
               $commission=new commission($dao->getCommercial($uneCommission['idcommercial'])->getOCommercial());
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
        $dao=new commerciauxDao;

            $lesComm=array();
            $lesCommissions=r::getAll("select commission.id,idcommercial, montant, valeur from
            commission full join oneshot on commission.id=oneshot.idcommission
            full join pourcentage on commission.id=pourcentage.idcommission where commission.id=$id");
        
            foreach($lesCommissions as $uneCommission){
               $commission=new commission($dao->getCommercial($uneCommission['idcommercial'])->getOCommercial());
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

   public function update($commission,$idCommission){
      
        if(method_exists($commission ,"getValeur")){
             $valeur=$commission->getValeur();
            // $pourcentage=r::load("pourcentage",$idCommission);

            r::getAll("update pourcentage set valeur = $valeur where idcommission = $idCommission");
        }
        else {
            $montant=$commission->getMontant();
            // $one_shot=r::load("oneshot",$idCommission);
            // $one_shot->montant=$montant;
            // r::store($one_shot);
            r::getAll("update oneshot set montant = $montant where idcommission = $idCommission");
        }

    }

    public function delete($id){
        // $pourcentage=r::load('pourcentage',$id);
        // r::trash($pourcentage);
        // $one_shot=r::load('one_shot',$id); 
        // r::trash($one_shot);
        $commission=r::load('commission',$id);
        $commission->cacher=true;
        r::store($commission);
        // $prendre = r::find("prendre","idcommission = ?", array($id));
        // r::trash($prendre);
        }
}