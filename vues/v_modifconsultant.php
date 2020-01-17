<div class="container">
    <div class="form-style-5">
        <form method="post" action="index.php?uc=consultant&action=validmodif&idconsultant=<?php echo $idConsultant?>"> 
            <fieldset>   
                <input type="text" value="<?php echo $consultant->getNom();?>" pattern="[A-Za-z]{1,20}" name="nom" placeholder="Nom *" required="required">
                <input type="text" value="<?php echo $consultant->getPrenom();?>" pattern="[A-Za-z]{1,20}" name="prenom" placeholder="Prenom *" required="required">
                <input type="text" value="<?php echo $consultant->getAdresse();?>" name="adr" placeholder="Adresse *" required="required">
                <input type="text" value="<?php echo $consultant->getVille();?>"  name="ville" placeholder="Ville *" required="required">
                <input type="number" value="<?php echo $consultant->getCp();?>" min="0" name="cp" placeholder="Code Postal *" required="required">
                <input type="text" value="<?php echo $consultant->getTel();?>" pattern="[0-9]{10}" name="tel" placeholder="Numero de telephone *" required="required">
                <input type="email" value="<?php echo $consultant->getEmail();?>" name="email" placeholder="Email *" required="required">
                <input type="submit" value="Modifier" name="modif" />
            </fieldset>
        </form>
    </div>
</div>