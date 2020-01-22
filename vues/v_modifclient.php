<div class="container"> 
<div class="form-style-5">
    <div class="left">
        <form method="POST" action="index.php?uc=client&action=validmodifclient&idclient=<?php echo $idclient?>">
            <fieldset>
                <legend>Information du client</legend>
                <input type="text" required="required" name="rsl" value="<?php echo $raisonsocial ?>" placeholder="Raison Social"><br>
                <input type="text" required="required" name="siret" value="<?php echo $siret?>" placeholder="SIRET"><br>
                <input type="text" required="required" name="adr" value="<?php echo $adr?>" placeholder="Adresse"><br>
                <input type="text" required="required" name="ville" value="<?php echo $ville?>" placeholder="Ville"><br>
                <input type="text" required="required" min=0 name="cp" value="<?php echo $cp?>" placeholder="Code Postale"><br>
                
                <input type="email" required="required" name="email" value="<?php echo $email?>" placeholder="Email"><br>
                <input type="email"  name="email2" value="<?php echo $email2?>" placeholder="Email (facultatif)"><br>
                <input type="email"  name="email3" value="<?php echo $email3?>" placeholder="Email (facultatif)"><br>
                <input type="tel" required="required" min=0 name="tel3" value="<?php echo $tel3 ?>" placeholder="Téléphone"><br>
                <input type="text"  name="bureau" value="<?php echo $bureau ?>" placeholder="Bureau (facultatif)"><br>
                <input type="text"  name="fax" value="<?php echo $fax ?>" placeholder="Fax (facultatif) "><br>
                
                <input type="submit" name="modifcontact" value="Modifier">
               
            </fieldset>
        </form>
    </div> 
     
</div>