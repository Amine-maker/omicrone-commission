<div class="container"> 
<h1><center>Les clients</center></h1>
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

    <input type="text" name="rsl"  required="required" pattern="[A-Za-z]{1,20}" placeholder="Raison Social"><br>
    <input type="text" name="siret"  required="required" pattern="[0-9]{1,20}" placeholder="SIRET"><br>
    <input type="text" name="adr"  required="required" placeholder="Adresse"><br>
    <input type="text" name="ville"  required="required" placeholder="Ville"><br>
    <input type="text" min=0 name="cp" pattern="{0,5}"  required="required" placeholder="Code Postale"><br>
    <input type="email" name="email" required="required" placeholder="Email "><br>
    <input type="email" name="email2"  placeholder="Email (facultatif) "><br>
    <input type="email" name="email3"  placeholder="Email (facultatif)  "><br>
    <input type="text" pattern="[0-9]{10}" name="tel3" placeholder="Numero de telephone *" required="required">
    <input type="tel" min=0 name="bureau"  placeholder="Bureau"><br>
    <input type="tel" min=0 name="fax" placeholder="Fax"><br>               

<style>
input {margin-bottom: 15px!important;}
</style>

<a href="#" title="Close" id="close" class="modal-close">Fermer</a>
<input type="submit" name="addclient" value="Ajouter"/>
</form>
</div>
  </div>
</div>
