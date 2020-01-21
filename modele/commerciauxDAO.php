<?php


class commerciauxDAO{

    
    public function add($commercial){

        
        $nom= $commercial->getNom();
        $prenom= $commercial->getPrenom();
        $tel= $commercial->getTel();
        $email= $commercial->getEmail();
        $adresse=$commercial->getAdresse();
        $ville=$commercial->getVille();
        $cp=$commercial->getCp();

        $commercial = R::dispense('commerciaux'); // on crée un commercial
        $commercial->nom = $nom; // on lui donne les champs
        $commercial->prenom = $prenom;
        $commercial->tel=$tel;
        $commercial->email=$email;
        $commercial->adresse=$adresse;
        $commercial->ville=$ville;
        $commercial->cp=$cp;
        R::store($commercial); // on le sauvegarde en BDD
        
    }
    public function getCommerciaux()/*retourne une collection de commercial*/ 
        {
          
             // $limit=0;
            $lesComm=array();
        $les = R::find('commerciaux'/*,'limit 5 offset 5'*/);
            foreach ($les as $depe){
                $comm=new commerciaux($depe->nom,$depe->prenom,$depe->tel,
                $depe->email,$depe->adresse,$depe->ville,$depe->cp);
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

        $id=r::find("commerciaux", "nom = ? and prenom = ? and tel = ? and email = ? and adresse = ? and ville = ? and cp = ?",
        array($nom,$prenom,$tel,$email,$adresse,$ville,$cp));

        foreach($id as $unid){
            return($unid->id);
        }

        
        }
        
        public function getCommercial($idC){
           
           $res = R::getAll("select nom, prenom, tel, email, adresse, ville, cp, codeagence ,compte ,iban ,bic, codebanque,clerib
            from commerciaux left join infob on commerciaux.id=infob.idcommerciaux where commerciaux.id=".$idC."");
           
            foreach($res as $resu){
            $comm=new commerciaux($resu["nom"],$resu["prenom"],$resu["tel"],
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

            $commercial=r::load('commerciaux',$idC);// on recupere le commercial
            $commercial->nom = $nom; // on lui donne les champs
            $commercial->prenom = $prenom;
            $commercial->tel=$tel;
            $commercial->email=$email;
            $commercial->adresse=$adresse;
            $commercial->ville=$ville;
            $commercial->cp=$cp;
            R::store($commercial); // on le sauvegarde en BDD

            }
            public function nbLigne(){
                $nb=  r::getAll('select count(*)from commerciaux');
                return($nb[0]["count"]);
          }

        public function delete($commercial){
            $id=$this->getIdCommercial($commercial);
            $idcommission=r::find("commission", " idcommerciaux = ?", array($id));

            foreach($idcommission as $unid){
                $pourcentage=r::load('pourcentage',$unid);
                r::trash($pourcentage);
                $one_shot=r::load('one_shot',$unid); 
                r::trash($one_shot);
                $commission=r::load('commission',$unid);
                r::trash($commission);
            }
            $commercial=r::load('commerciaux',$id);
            r::trash($commercial);
            

            

        

        }
}