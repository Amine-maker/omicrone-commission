<div class="container"> 
<h1>Client</h1>
<label><strong>Recherche</strong></label>
<input type="text" name="category" class='rechercher' id="categoryFilter"><br><br>

<div class="interior">
    <a class="btn" href="#open-modal">Ajouter</a><br><br>
  </div>
<?php print tableauClient($lesclients);?>

  <br>
<div id="open-modal" class="modal-window">
  <div>
 
    <div class="form-style-5">
    <form method="POST" action="index.php?uc=client&action=addclient">

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

<style>
input {margin-bottom: 15px!important;}
</style>

<a href="#" title="Close" id="close" class="modal-close">Fermer</a>
<input type="submit" name="addclient" value="Ajouter"/>
</form>
</div>
  </div>
</div>
