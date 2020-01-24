<div class="container"> 
<h1>Les clients</h1>

<div class="interior">
    <div style = 'float : right'><label><strong>Recherche</strong></label>
    <input type="text" name="category" class='rechercher' id="categoryFilter"><br><br></div>
    
     <a class="btn" href="#open-modal">AJOUTER</a>
</div>
<?php print tableauClient($lesclients);?>

  <br>
<div id="open-modal" class="modal-window" style = "position: fixed;">
  <div>
 
    <div class="form-style-5">
    <form method="POST" action="index.php?uc=client&action=addclient">

    <input type="text" name="rsl"  required="required" pattern="[A-Za-z]{1,20}" placeholder="Raison Social"><br>
    <input type="text" name="siret"  required="required" pattern="[0-9]{1,20}" placeholder="SIRET (ex : 00010010010000)"><br>
    <input type="text" name="adr"  required="required" placeholder="Adresse"><br>
    <input type="text" name="ville"  required="required" placeholder="Ville"><br>
    <input type="text" min=0 name="cp" pattern="{0,5}"  required="required" placeholder="Code Postale (ex: 12345)"><br>
    <input type="email" name="email" required="required" placeholder="Email "><br>
    <input type="email" name="email2"  placeholder="Email (facultatif) "><br>
    <input type="email" name="email3"  placeholder="Email (facultatif)  "><br>
    <input type="text" pattern="[0-9]{10}" name="tel3" placeholder="Numero de telephone *" required="required">
    <input type="tel" min=0 name="bureau"  placeholder="Bureau"><br>
    <input type="tel" min=0 name="fax" placeholder="Fax"><br>               
      * Champs obligatoire
    <script>
      function afficher(){
         if (document.getElementById('voir').checked)
          {
            document.getElementById('affichage').style.display='block';
          }
           else {
                 document.getElementById('affichage').style.display='none';
                }
          }
    </script>
    <div class="control-group">
      <label class="control control-checkbox">Ajouter un RIB
      <input onclick="afficher()" type="checkbox" id="voir" name="regarder">
      <div class="control_indicator"></div></label>
    </div>
        <div style="display: none" id="affichage" class="cacher">
        <input type="text" pattern="[0-9]{5}" name="codeAgence" placeholder="Code de l'agence * (ex : 12345)">
        <input type="text" min="0" pattern="[a-zA-Z0-9]{11}" name="compte" placeholder="N° compte * (ex : 0000000D000)">
        <input type="text" pattern="[a-zA-Z0-9]{27}" name="iban" placeholder="IBAN * (27 caractères)">
        <input type="text" pattern="{8|11}" name="bic" placeholder="BIC * (ex: XXXXXXXXXXX)">
        <input type="text" pattern="[0-9]{5}" name="codeBanque" placeholder="Code de la banque * (5 caractères)">
        <input type="text" pattern="[0-9]{2}" name="cleRib" placeholder="cle RIB * (ex : 45)">
    </div>
<style>
input {margin-bottom: 15px!important;}
</style>

<a href="#" title="Close" id="close" class="modal-close">Fermer</a>
<input type="submit" name="addclient" value="Ajouter"/>
</form>
</div>
  </div>
</div>
