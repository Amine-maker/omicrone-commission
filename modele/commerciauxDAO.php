<?php

class commerciauxDao {

    
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
        $idC = r::getAll("SELECT id FROM utilisateur WHERE id = (SELECT MAX(id) FROM utilisateur)");
        $id = $idC[0]["id"];
        r::getAll("insert into commercial values ($id, 'FALSE')");
        
    }
    public function getCommerciaux()/*retourne une collection de commerciall*/ 
        {
             // $limit=0;
            $lesComm=array();
            $les = r::getAll('select nom, prenom, tel, email, adresse, ville, cp from utilisateur join commercial on utilisateur.id=commercial.idutilisateur where cacher = false order by id desc');
       // $les = R::find('commerciall'/*,'limit 5 offset 5'*/,"order by id desc");
            foreach ($les as $depe){
                $comm=new commercial($depe["nom"],$depe["prenom"],$depe["adresse"],$depe["ville"],$depe["cp"],$depe["tel"], $depe["email"]);
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

        $id=r::getAll("select idutilisateur from commercial join utilisateur on commercial.idutilisateur = utilisateur.id where nom = '$nom' and prenom = '$prenom' and adresse = '$adresse' and ville = '$ville' and cp = $cp and tel = $tel and email = '$email'");

            return($id[0]["idutilisateur"]);
   
        }
        
        public function getCommercial($idC){
           
           $res = R::getAll("select nom, prenom, tel, email, adresse, ville, cp, codeagence ,compte ,iban ,bic, codebanque,clerib
           from utilisateur join commercial on utilisateur.id=commercial.idutilisateur left join infob on commercial.idutilisateur=infob.idcommercial where commercial.idutilisateur=$idC");
           
            foreach($res as $resu){
            $comm=new commercial($resu["nom"],$resu["prenom"],$resu["adresse"],$resu["ville"],$resu["cp"],$resu["tel"],$resu["email"]);

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

            $commercial=r::load('utilisateur',$idC);// on recupere le commercial
            $commercial->nom = $nom; // on lui donne les champs
            $commercial->prenom = $prenom;
            $commercial->tel=$tel;
            $commercial->email=$email;
            $commercial->adresse=$adresse;
            $commercial->ville=$ville;
            $commercial->cp=$cp;
            R::store($commercial); // on le sauvegarde en BDD
            $vraiComm = r::getAll("update commercial set cacher = false where idutilisateur = $idC");


            }
            public function nbLigne(){
                $nb = r::getAll('select count(*)from commercial');
                return($nb[0]["count"]);
            }

            public function delete($commercial){
            $id=$this->getIdCommercial($commercial);
            r::getAll("update commercial set cacher = true where idutilisateur = $id");

            

        }
}