<?php

class depenseDAO{


public function add($depense){

    $libelle=$depense->getLibelle();
    $montant=$depense->getMontant();
    $depense = R::dispense('depense'); // on crée une depense
    $depense->montant = $montant; // on lui donne les champs
    $depense->libelle = $libelle;
    R::store($depense); // on le sauvegarde en BDD
    
}

public function getDepenses($limit)/*retourne une collection de depense*/ 
   
        {
             $cacher=false;
            if($limit!=0){
                $limit=$limit*5;
            }
          
            $lesDep=array();
           // $les = R::find('depense','cacher = false','order by id DESC limit 5 offset '.$limit.'');
           $les = r::getAll('select id, montant,libelle from depense where cacher=false order by id desc');
            foreach ($les as $depe){
               
               $dep=new depense($depe["montant"],$depe["libelle"]);
                $lesDep[]=$dep;
        }
           return($lesDep);
            
          
        }

    public function getIdDepense($depense){
        
        $montant=$depense->getMontant();
        $libelle=$depense->getLibelle();
        
        $id = R::find("depense","libelle = ?
        and montant = ?", 
        array( $libelle, $montant));

        foreach($id as $unid){
            return($unid->id);
        }
            
            }

    public function getDepense($idD)/* retourne l'objet depense par rapport a l'id*/{
        
       $depense = r::load('depense',$idD);
       $dep=new depense($depense->montant,$depense->libelle);
       return($dep);

            }
    public function nbLigne(){
          $nb=  r::getAll('select count(*)from depense where cacher = false');
          return($nb[0]["count"]);
    }


    public function update($depense,$idD){

        $montant=$depense->getMontant();
        $libelle=$depense->getLibelle();
        $depense=r::load('depense',$idD);
        $depense->montant=$montant;
        $depense->libelle=$libelle;
        $depense->cacher=false;
        r::store($depense);
                }

    public function delete($depense){
        $id=$this->getIdDepense($depense);
        $depense=r::load('depense',$id);
        $depense->cacher=true;
        r::store($depense);
        
                }
}