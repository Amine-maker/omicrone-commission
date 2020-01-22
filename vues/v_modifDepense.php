
<div class="container">
  
<div class="form-style-5">

        <form method="post" action="index.php?uc=depense&action=modifierDepense">
        <fieldset>
        <legend align="center">Information(s) à modifier</legend><br>
        <input type="number" min="0" name="montant" placeholder="Montant *" required="required" value="<?php echo $depense->getMontant() ?>">
        <input type="text" pattern="[A-Za-z]{1,20}" name="libelle" placeholder="Libelle *" required="required" value="<?php echo $depense->getLibelle() ?>">
        <input type="hidden" value="<?php echo $_REQUEST["idDepense"] ?>" name="idDepense">

</fieldset>


<input type="submit" name="modifier" value="Modifier"/>
</form>
</div>
  </div>