
<div class="form-style-5">
    <div class="left">
        <form method="POST" action="index.php?uc=clientaction=validmodifclient&idclient=<?php echo $idclient?>">
            <fieldset>
                <legend><span class="number"></span>Information du client</legend>
                <input type="text" name="rsl" value="<?php echo $raisonsocial ?>" placeholder="Raison Social"><br>
                <input type="text" name="siret" value="<?php echo $siret?>" placeholder="SIRET"><br>
                <input type="text" name="adr" value="<?php echo $adr?>" placeholder="Adresse"><br>
                <input type="text" name="ville" value="<?php echo $ville?>" placeholder="Ville"><br>
                <input type="text" min=0 name="cp" value="<?php echo $cp?>" placeholder="Code Postale"><br>
                
                <input type="hidden" name="modifclient">
            </fieldset>
        </form>
    </div> 
    <div class="right">
        
            <fieldset>
                <legend><span class="number"></span></legend>
                <input type="email" name="email" value="<?php echo $email?>" placeholder="Email 1"><br>
                <input type="email" name="email2" value="<?php echo $email2?>" placeholder="Email 2 "><br>
                <input type="email" name="email3" value="<?php echo $email3?>" placeholder="Email 3 "><br>
                <input type="number" min=0 name="bureau" value="<?php echo $bureau ?>" placeholder="Bureau"><br>
                <input type="number" min=0 name="fax" value="<?php echo $fax ?>" placeholder="Fax"><br>
                <input type="number" min=0 name="tel3" value="<?php echo $tel3 ?>" placeholder="Téléphone"><br>
                
               
            </fieldset>
        </form>
    </div> 
     <input type="submit" name="modifcontact" value="Modifier">
</div>