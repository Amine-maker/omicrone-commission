<?php

class craDAO{

    public function add($cra){
        $TJF=$cra->getJF();
        $TJC=$cra->getJC();
        $TJM=$cra->getJM();
        $astreinte=$cra->getAstreinte();
        $id=$cra->getOContrat()->getidContrat();
        $periode=$cra->getPeriode();

        $cra=r::dispense('cra');
        $cra->totaljfacturable=$TJF;
        $cra->totaljmaladie=$TJM;
        $cra->totaljconge=$TJC;
        $cra->astreinte=$astreinte;
        $cra->idcontrat=$id;
        $cra->periode = $periode;
        r::store($cra);
    }

}


?>