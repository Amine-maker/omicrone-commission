<?php

class craDAO{

    public function add($cra){
        $TJF=$cra->getJF();
        $TJC=$cra->getJC();
        $TJM=$cra->getJM();

        $cra=r::dispense('cra');
        $cra->totaljfacturable=$TJF;
        $cra->totaljmaladie=$TJM;
        $cra->totaljcongee=$TJC;
        r::store($cra);
    }

}


?>