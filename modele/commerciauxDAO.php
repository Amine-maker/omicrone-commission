<?php

class UcommerciauxDao {

    
    public function add($commercial){
        
        $nom= $commercial->getNom();
        $prenom= $commercial->getPrenom();
        $tel= $commercial->getTel();
        $email= $commercial->getEmail();
        $adresse=$commercial->getAdresse();
        $ville=$commercial->getVille();
        $cp=$commercial->getCp();

        $commercial = R::dispense('utilisateur'); // on crée un commercial
        $commercial->nom = $nom; // on lui donne les champs
        $commercial->prenom = $prenom;
        $commercial->tel=$tel;
        $commercial->email=$email;
        $commercial->adresse=$adresse;
        $commercial->ville=$ville;
        $commercial->cp=$cp;
        R::store($commercial); // on le sauvegarde en BDD
        
    }
    public function getCommerciaux()/*retourne une collection de commerciall*/ 
        {
             // $limit=0;
            $lesComm=array();
            $les = r::getAll('select nom, prenom, tel, email, adresse, ville, cp from utilisateur join commercial on utilisateur.id=commercial.idutilisateur where cacher = false order by id desc');
       // $les = R::find('commerciall'/*,'limit 5 offset 5'*/,"order by id desc");
            foreach ($les as $depe){
                $comm=new commercial($depe["nom"],$depe["prenom"],$depe["tel"], $depe["email"],$depe["adresse"],$depe["ville"],$depe["cp"]);
                $lesComm[]=$comm;
        }
            return($lesComm);
        }

       public function getIdCommercial($commercial){

        $nom= $commercial->getNom();
        $prenom= $commercial->getPrenom();
        $tel= $commercial->getTel();
        $email= $commercial->getEmail();
        $adresse=$commercial->getAdresse();
        $ville=$commercial->getVille();
        $cp=$commercial->getCp();

        $id=r::find("utilisateur", "nom = ? and prenom = ? and tel = ? and email = ? and adresse = ? and ville = ? and cp = ?",
        array($nom,$prenom,$tel,$email,$adresse,$ville,$cp));

        foreach($id as $unid){
            return($unid->id);
        }

        
        }
        
        public function getCommercial($idC){
           
           $res = R::getAll("select nom, prenom, tel, email, adresse, ville, cp, codeagence ,compte ,iban ,bic, codebanque,clerib
           from utilisateur join commercial on utilisateur.id=commercial.idutilisateur left join infob on commercial.idutilisateur=infob.idcommercial where commercial.idutilisateur=$idC");
           
            foreach($res as $resu){
            $comm=new commercial($resu["nom"],$resu["prenom"],$resu["tel"],
            $resu["email"],$resu["adresse"],$resu["ville"],$resu["cp"]);

            $fin=new information_bancaire(NULL,$comm,$resu["codeagence"],$resu["compte"],$resu["iban"],
                 $resu["bic"],$resu["codebanque"],$resu["clerib"]);
             return($fin);
            }
        }

        public function update($commercial,$idC){
        
            $nom = $commercial->getNom();
            $prenom = $commercial->getPrenom();
            $tel = $commercial->getTel();
            $email = $commercial->getEmail();
            $adresse =$commercial->getAdresse();
            $ville = $commercial->getVille();
            $cp = $commercial->getCp();

            $commercial=r::load('commercial',$idC);// on recupere le commercial
            $commercial->nom = $nom; // on lui donne les champs
            $commercial->prenom = $prenom;
            $commercial->tel=$tel;
            $commercial->email=$email;
            $commercial->adresse=$adresse;
            $commercial->ville=$ville;
            $commercial->cp=$cp;
            $commercial->cacher=false;
            R::store($commercial); // on le sauvegarde en BDD

            }
            public function nbLigne(){
                $nb=  r::getAll('select count(*)from commercial');
                return($nb[0]["count"]);
          }

        public function delete($commercial){
            $id=$this->getIdCommercial($commercial);
            $idcommission=r::find("commission", " idcommercial = ?", array($id));

            foreach($idcommission as $unid){
               
                // r::exec('delete from prendre where idcommission='.$unid->id.'');
                // $pourcentage=r::load('pourcentage',$unid);
                // r::trash($pourcentage);
                // $one_shot=r::load('one_shot',$unid); 
                // r::trash($one_shot);
                // $commission=r::load('commission',$unid);
                // r::trash($commission);
            }
            $commercial=r::load('commercial',$id);
            $commercial->cacher = true;
            r::store($commercial);
            

        }
}