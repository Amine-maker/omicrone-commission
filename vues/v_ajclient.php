<div class="container"> 
<div class="form-style-5">
        <form method="POST" action="index.php?uc=client&action=addclient">
            <fieldset>
                <legend>Information du client</legend>
                <input type="text" name="rsl" value="<?php if (isset($_POST['rsl'])){echo $_POST['rsl'];} ?>" required="required" placeholder="Raison Social"><br>
                <input type="text" name="siret" value="<?php if (isset($_POST['siret'])){echo $_POST['siret'];} ?>" required="required" placeholder="SIRET"><br>
                <input type="text" name="adr" value="<?php if (isset($_POST['adr'])){echo $_POST['adr'];} ?>" required="required" placeholder="Adresse"><br>
                <input type="text" name="ville" value="<?php if (isset($_POST['ville'])){echo $_POST['ville'];} ?>" required="required" placeholder="Ville"><br>
                <input type="text" min=0 name="cp" pattern="{0,5}" value="<?php if (isset($_POST['cp'])){echo $_POST['cp'];} ?>" required="required" placeholder="Code Postale"><br>
                <input type="email" name="email" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>"required="required" placeholder="Email "><br>
                <input type="email" name="email2" value="<?php if (isset($_POST['email2'])){echo $_POST['email2'];} ?>" placeholder="Email (facultatif) "><br>
                <input type="email" name="email3" value="<?php if (isset($_POST['email3'])){echo $_POST['email3'];} ?>" placeholder="Email (facultatif)  "><br>
                <input type="tel" min=0 name="tel3" value="<?php if (isset($_POST['tel3'])){echo $_POST['tel3'];} ?>" required="required" placeholder="Téléphone"><br>
                <input type="tel" min=0 name="bureau" value="<?php if (isset($_POST['bureau'])){echo $_POST['bureau'];} ?>" placeholder="Bureau"><br>
                <input type="tel" min=0 name="fax" value="<?php if (isset($_POST['fax'])){echo $_POST['fax'];} ?>" placeholder="Fax"><br>
                
                
                <input type="submit" name="addclient" value="Ajouter">
            </fieldset>
        </form>
    </div> 
     
</div>