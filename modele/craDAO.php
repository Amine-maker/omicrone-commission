<?php

class craDAO{

    public function add($cra){
        $TJF=$cra->getJF();
        $TJC=$cra->getJC();
        $TJM=$cra->getJM();
        $astreinte=$cra->getAstreinte();

        $cra=r::dispense('cra');
        $cra->totaljfacturable=$TJF;
        $cra->totaljmaladie=$TJM;
        $cra->totaljcongee=$TJC;
        $cra->astreinte=$astreinte;
        r::store($cra);
    }

}


?>