<div class="form-style-5">
    <div class="left">
        <form method="POST" action="index.php?uc=clientaction=addclient">
            <fieldset>
                <legend><span class="number"></span>Information du client</legend>
                <input type="text" name="rsl" value="<?php if (isset($_POST['rsl'])){echo $_POST['rsl'];} ?>" placeholder="Raison Social"><br>
                <input type="text" name="siret" value="<?php if (isset($_POST['siret'])){echo $_POST['siret'];} ?>" placeholder="SIRET"><br>
                <input type="text" name="adr" value="<?php if (isset($_POST['adr'])){echo $_POST['adr'];} ?>" placeholder="Adresse"><br>
                <input type="text" name="ville" value="<?php if (isset($_POST['ville'])){echo $_POST['ville'];} ?>" placeholder="Ville"><br>
                <input type="text" min=0 name="cp" value="<?php if (isset($_POST['cp'])){echo $_POST['cp'];} ?>" placeholder="Code Postale"><br>
                
<!--                <input type="hidden" name="addclient">-->
            </fieldset>
        </form>
    </div> 
    <div class="right">
        
            <fieldset>
                <legend><span class="number"></span></legend>
                test
                <input type="email" name="email" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>" placeholder="Email 1"><br>
                <input type="email" name="email2" value="<?php if (isset($_POST['email2'])){echo $_POST['email2'];} ?>" placeholder="Email 2 "><br>
                <input type="email" name="email3" value="<?php if (isset($_POST['email3'])){echo $_POST['email3'];} ?>" placeholder="Email 3 "><br>
                <input type="number" min=0 name="bureau" value="<?php if (isset($_POST['bureau'])){echo $_POST['bureau'];} ?>" placeholder="Bureau"><br>
                <input type="number" min=0 name="fax" value="<?php if (isset($_POST['fax'])){echo $_POST['fax'];} ?>" placeholder="Fax"><br>
                <input type="number" min=0 name="tel3" value="<?php if (isset($_POST['tel3'])){echo $_POST['tel3'];} ?>" placeholder="Téléphone"><br>
                
               
            </fieldset>
        </form>
    </div> 
     <input type="submit" name="addcontact" value="Ajouter">
</div>